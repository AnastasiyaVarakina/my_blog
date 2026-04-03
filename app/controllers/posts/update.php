<?
require_once MODELS."/validator.php";

$title = "Update post";

$id = (int)$_GET['id'];

$header = "Update post ".$id;


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

    $validator = new Validator();
    $validator->validate($data, $rules);

    if(!$validator->hasErrors()) {
        try {
            $sql = "UPDATE `posts` SET `title`= :title,`descroption`= :description,`content`= :content WHERE `posts_id` = $id";
            $db->query($sql, $data);
            //записываем данные в массив сессии
            $_SESSION['success'] = 'Пост успешно создан';
            echo "<h3>Пост был успешно отредактирован!</h3>";
        }
        catch (PDOException $e) {
            // добавляем сессию по которой потом в массиве сессии будем выводит ошибки
            $_SESSION['danger'] = 'Не получилось обновить пост';
        }

    }
    else {
        redirect("update");
    }

}
require_once V_POSTS."/update.tmpl.php";