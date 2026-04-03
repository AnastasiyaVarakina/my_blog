<?
global $db;
require_once MODELS."/validator.php";

$title = $header = "Registrarion user";

// $sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES (:name, :email, :password)";
//             $db->query($sql, $data);

// правила для регистрации пользователя


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['title', 'content', 'description']; //то что ожидаем  - белый список
    $data = load_request_data($fillable);

    $rules2 = [
    'username' => [],
    'email' => true,
    'password' => [
        'required' => true,
        'min' => 3,
        'max' => 10,
    ],
    'password_confirm' => [
        'match' => "password" //Значение поле с которым должнен совпадать пароль
    ]
];

    $validator = new Validator();
    $validator->validate($data, $rules2);
}
require_once V_USER . '/registr-form.tmpl.php';
