<?
global $db;
require_once MODELS."/validator.php";

$title = "Update user";

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);

if($id <= 0) {
    $_SESSION['danger'] = 'Неверный ID пользователя';
    redirect('/user');
}

$header = "Update user ".$id;

// делаем общий запрос чтоб вообще вывести данные для реадктирования
$user = $db->query("SELECT `name`, `email` FROM `users` WHERE `users_id` = :id", ['id'=>$id])->find();

if(!$user) {
    $_SESSION['danger'] = 'Такого пользователя не существует';
    redirect('/user');
}

$method = isset($_POST['_method']) && strtoupper($_POST['_method']) === 'PUT';
if($method) {
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['name', 'email', 'password'];
    $data = load_request_data($fillable);

    if (isset($data['password']) && trim($data['password']) === '') {
        unset($data['password']);
    }

    $rules = [
    'name' => [
        'required' => true,
        'min' => 3,
        'max' => 100,
    ],
    'email' => [
        'required' => true,
        'min' => 3,
        'max' => 100,
    ],
    'password' => [
        'required' => false,
        'min' => 3,
        'max' => 100,
    ],
    ];

    $validator = new Validator();
    $validator->validate($data, $rules);

    if(!$validator->hasErrors()) {
        if(!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE `users` SET `name` = :name, `email` = :email, `password` = :password WHERE `users_id` = :id";
        } else {
            $sql = "UPDATE `users` SET `name` = :name, `email` = :email WHERE `users_id` = :id";
            // unset($data['password']);
        }
        $data['id'] = $id;
        try {
            $db->query($sql, $data);
            $_SESSION['success'] = 'Пользователь успешно отредактирован';
            redirect("/user");
        }
        catch (PDOException $e) {
            $_SESSION['danger'] = 'Не получилось обновить пользователя';
        }

    }

}
require_once V_USER."/update-user.tmpl.php";