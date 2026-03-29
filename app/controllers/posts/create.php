<?

$title = $header = "New Post";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['title', 'content', 'description']; //то что ожидаем
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


    $errors = [];
}

require_once V_POSTS . '/create.tmpl.php';
