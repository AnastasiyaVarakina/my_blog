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
    dd($validator->gerError());

}

require_once V_POSTS . '/create.tmpl.php';
