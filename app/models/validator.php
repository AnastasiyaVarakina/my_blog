<?
class Validator
{
    private $errors = []; //ошибки которые будет собирать валидатор

    private $validatorsList = ['require', 'min', 'max']; //список всех сущ валидаторов

    private $messages = [
        'required' => 'The :fieldname: field is required',
        'min' => 'The :fieldname: field must be at least :rulevalue: characters',
        'max' => 'The :fieldname: field must be maximum :rulevalue: characters',
    ];

    // должен получить массив правил и отфильтрованный массив
    // data - массив значений
    public function validate($data = [], $rules = []): Validator
    {
        // надо узнать есть ли для этого поля правила валидации

        foreach ($data as $fieldname => $field_data) {
            // что мы ищем и где мы ищем
            if (in_array($fieldname, array_keys($rules))) {
                // валидируем
                // объект $field
                $this->checkAndValidate([
                    'fieldname' => $fieldname,
                    'field_data' => $field_data,
                    'rules' => $rules[$fieldname]
                    // взять из массив rules элемент, ключом которого яв-ся имя текущего поля
                    // и записываем в ассоциативный массив под ключом 
                    // те мы берем в массиве rules значения(правила) которые совпадают 
                    // с названием поля элемента массива, который мы сейчас перебираем
                ]);
            }
        }
        return $this;
    }

    private function checkAndValidate($field) {
        // field - Это массив с ключами  имя поля значение поля и правило к этому полю
        foreach($field["rules"] as $rule_name => $rule_value) {
            // берем из 3 объекта название правила(типо заголовок формы) и само правило
            // $rule_value) Тк тут массив внутри мы получаем типо по названию поля свое правило например
            // ['required' => true, 'min' => 3, 'max' => 10]
            // если в массиве есть такое название правила

            // если нашла в массиве валидаторов по названию находим нужный массив и 
            // внутри этого массива рассматривам ключи, если они совпадают то :

            if(in_array($rule_name, $this->validatorsList)) {

                // [$this, $rule_name]нужно вызвать рул нейм (три правила)
                //из текущего объекта, второй аргемент - то что будет передано
                
                // эта функция сама выбирает нужный метод по названию находит
                if(!call_user_func_array([$this, $rule_name], [$field['field_data'],$rule_value])) {
                    $this->addError($field['fieldname'], 
                    // функция которая делает замену
                    str_replace(
                        [":fieldname:", ":rulevalue:"],
                        [$field['fieldname'], $rule_value],
                        // где заменить, заменяем по кллючу с нужной ошибкой
                        $this->messages[$rule_name]
                    ));
                }
            }
        }

    }

    public function addError($fieldname, $error_message)
    {
        $this->errors[$fieldname][] = $error_message;
    }

    public function gerError()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }


    // возвращают true или false. В зависимости от того выполняется ли действие
    protected function required($value, $rule_value) {
        return !empty($value);//если он не пустой значит мы прошли валидацию

    }

    protected function min($value, $rule_value) {
        return ln($value) >= $rule_value;
    }

    protected function max($value, $rule_value) {
        return ln($value) <= $rule_value;
    }
}
