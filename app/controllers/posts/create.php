<?
require_once MODELS."/validator.php";

$title = $header = "New Post";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['title', 'content', 'description']; //то что ожидаем  - белый список
    $data = load_request_data($fillable);

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
    // dump($validator->gerError());

    // если у нас есть ошибки то нам надо оставаться на той же странице
    // если пост успешно создался, то нам надо куда то перейти
    if(!$validator->hasErrors()) {
        try {
            $sql = "INSERT INTO `posts`(`title`, `descroption`, `content`) VALUES (:title, :description, :content)";
            $db->query($sql, $data);
            redirect("/");
            // перенаправиться на главную страницу
        }
        catch (PDOException $e) {
            dump([$e]);
        }

    }
    else {
        redirect("posts/create");
    }



}

require_once V_POSTS . '/create.tmpl.php';
