<?
global $db;
require_once MODELS."/validator.php";

$title = $header = "Registrarion user";

// правила для регистрации пользователя


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['name', 'email', 'password','password_confirm']; //то что ожидаем  - белый список
    $data = load_request_data($fillable);

    $rules2 = [
    'name' => [
        'required' => true,
        'min' => 3,
        'max' => 10,
    ],
    'email' => [
        'required' => true,
        'min' => 3,
        'max' => 10,
    ],
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

    if(!$validator->hasErrors()) {
        // придется поменять массив дата, чтобы добавить хеширование пароля
        $data_new = [
            'name' => $data['name'],
            'email' => $data['name'],
            'password' => password_hash($data['name'], PASSWORD_DEFAULT)
        ];

        $sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES (:name, :email, :password)";
        $db->query($sql, $data_new);
        $_SESSION['success'] = 'Пользователь успешно добавлен!';
        redirect("/");
    }
}
require_once V_USER . '/registr-form.tmpl.php';
