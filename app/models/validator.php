<?
class Validator
{
    private $errors = []; //ошибки которые будет собирать валидатор

    private $data = [];//массив с данными которые мы будем проверять
    private $validatorsList = ['required', 'min', 'max', 'match', 'email']; //список всех сущ валидаторов

    private $messages = [
        'required' => 'Поле :fieldname: является обязательным',
        'min' => 'В поле :fieldname: должно быть не менее :rulevalue: символов',
        'max' => 'В поле :fieldname: должно быть не более :rulevalue: символов',
        'email' => 'В поле :fieldname: неправильно введена почта',
        'match' => 'Пароли не совпадают',
    ];

    // должен получить массив правил и отфильтрованный массив
    // data - массив значений
    public function validate($data = [], $rules = []): Validator
    {
        // надо узнать есть ли для этого поля правила валидации

        $this->data = $data;//копируем данные
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
    protected function required($value) {
        return !empty($value);//если он не пустой значит мы прошли валидацию

    }

    protected function min($value, $rule_value) {
        return ln($value) >= $rule_value;
    }

    protected function max($value, $rule_value) {
        return ln($value) <= $rule_value;
    }

    //приходит значение поля и название поля с которым сравнивать
    protected function match($value, $rule_value) {
        return $value == $this->data[$rule_value];
    }

    // метод для почты
    protected function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }


    public function listErrors($fieldname) {
        // есть ли ошибки для указанного поля
        if(isset($this->errors[$fieldname])) {
            // если есть то будем возвращать ошибку
            $er_mes = '<ul style="color:red;">';
            foreach ($this->errors[$fieldname] as $er) {
                $er_mes .= '<li>'. htmlspecialchars($er). '</li>';
            }
            $er_mes .= '</ul>';
            return $er_mes;
        }
// если нет то возвращаем пустую строку
        return '';
    }
}

