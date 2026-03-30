<?
function dump($array)
{
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
}

function dd($array)
{
    dump($array);
    die;
}

function abort($code = 404) {
    http_response_code($code);//получаем ошибку и выводим страницу отображения этой оишбки
    require_once VIEWS."/404.tmpl.php";
    die;
}


function load_request_data(array $fillable) {
    $data = [];
    foreach($_POST as $key=>$value) {
        if(in_array($key, $fillable)){
            $data[$key] = $value;
        }
    }



    return $data;
}