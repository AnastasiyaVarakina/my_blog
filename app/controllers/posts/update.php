<?
global $db;
require_once MODELS."/validator.php";

$title = "Update post";

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);

if($id <= 0) {
    $_SESSION['danger'] = 'Неверный ID';
    redirect('/');

}
$header = "Update post ".$id;

// делаем общий запрос чтоб вообще вывести данные для реадктирования
$post = $db->query("SELECT `title`, `descroption`, `content` FROM `posts` WHERE `posts_id` =  :id", ['id'=>$id])->find();

if(!$post) {
    $_SESSION['danger'] = 'Такого поста не существует';
    redirect('/');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['title', 'content', 'description']; //то что ожидаем  - белый список
    $data = load_request_data($fillable);

    // правила будут те же самые тк по сути это та же самая форма
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


    dump($data);

    $validator = new Validator();
    $validator->validate($data, $rules);

    if(!$validator->hasErrors()) {
        try {
            $sql = "UPDATE `posts` SET `title`= :title,`descroption`= :description,`content`= :content WHERE `posts_id` = $id";
            // $data['id'] = $id;
            $db->query($sql, $data);
            //записываем данные в массив сессии
            $_SESSION['success'] = 'Пост успешно отредактирован';
            redirect("/");
        }
        catch (PDOException $e) {
            // добавляем сессию по которой потом в массиве сессии будем выводит ошибки
            $_SESSION['danger'] = 'Не получилось обновить пост';
            // echo $e;
        }

    }
    else {
    }

}
require_once V_POSTS."/update.tmpl.php";