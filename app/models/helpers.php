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

function abort($code = 404)
{
    http_response_code($code); //получаем ошибку и выводим страницу отображения этой оишбки
    require_once VIEWS . "/404.tmpl.php";
    die;
}


// фильтрация входящих пост запросов
// принимает список ключей которые мы ожидаем
function load_request_data(array $fillable)
{
    $data = []; //результирующий массив
    // перебираем весь массив пост 
    foreach ($_POST as $key => $value) {
        // если ключ присутствует в массиве пост то мы добавляем пару ключ значение 
        if (in_array($key, $fillable)) {
            $data[$key] = trim(htmlspecialchars($value)); //отфильтрованный массив
        }
    }

    return $data;
}

function ln($string)
{
    return mb_strlen($string, 'UTF-8');
}


function old($fieldname)
{
    if (isset($_POST[$fieldname])) {
        return htmlspecialchars($_POST[$fieldname]);
    }
    else return '';
}


// перенаправление
function redirect($url = ' ') {
    // если урл не пустое то :
    if($url) {
        $redirect = $url;
    }
    else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }

    header("Location:{$redirect}");
    die;
}