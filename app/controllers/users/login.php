<?
global $db;
require_once MODELS."/validator.php";
$title = $header = "Sign in";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['username', 'password']; //то что ожидаем  - белый список
    $data = load_request_data($fillable);

    $rules = [
        'username' => [
            'required' => true,
        ],
        'password' => [
            'required' => true,
        ],
    ];

    $validator = new Validator();
    $validator->validate($data, $rules);

    // если валидатор не нашел ошибки то делаем запрос
    if(!$validator->hasErrors()) {
        try{
            $user = $db->query("SELECT * FROM `users` WHERE `name` = ? AND `password` = ?", [$data['username'],$data['password']])->find();
            if(!$user) {
                $_SESSION['danger'] = "Пользователь не найден";
            }
        }
        catch (PDOException $e){
            abort(500);
        }
    }
}

require_once VIEWS."/users/login-form.tmpl.php";