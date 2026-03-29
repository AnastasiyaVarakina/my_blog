<?
class Validator{
    protected $errors = [];

    protected $validatorsList = ['require', 'min', 'max'];//список всех сущ валидаторов

    protected $messages = [
        'required' => 'The :fieldname: field is required',
        'min' => 'The :fieldname: field must be at least :rulevalue; characters',
        'max' => 'The :fieldname: field must be maximum :rulevalue; characters',
    ];

    protected function required($value, $rule_value) {

    }

    protected function min($value, $rule_value) {
        
    }

    protected function max($value, $rule_value) {
        
    }
}