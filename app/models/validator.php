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
    public function validate($data = [], $rules = []): Validator
    {
        // надо узнать есть ли для этого поля правила валидации

        $rules = [
            'title' => [
                'required' => true,
                'min' => 3,
                'max' => 10,
            ],
            'description' => [
                'required' => true,
                'min' => 3,
                'max' => 10,
            ],
            'content' => [
                'required' => true,
                'min' => 5,
                'max' => 10,
            ]
        ];

        foreach ($data as $fieldname => $field_data) {
            // что мы ищем и где мы ищем
            if (in_array($fieldname, array_keys($rules))) {
                // валидируем
                $this->checkAndValidate([
                    'fieldname' => $fieldname,
                    'field_data' => $field_data,
                    'rules' => $rules[$fieldname]
                ]);
            }
        }
        return $this;
    }

    private function checkAndValidate($field) {
        foreach($field["rules"] as $rule_name => $rule_value) {
            // если такой валидатор есть
            if(in_array($rule_name, $this->validatorsList)) {
                // если не прошли валидацию то добавляем  ошибку
                if(!call_user_func_array([$this, $rule_name], [$field['field_data'],$rule_value])) {
                    $this->addError($field['fieldname'], 
                    str_replace(
                        [":fieldname:", ":rulevalue:"],
                        [$field['fieldname'], $rule_value],
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
