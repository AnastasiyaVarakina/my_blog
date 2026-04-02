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


// считает кол-во знаков в строке, по определенной кодировке 
function ln($string)
{
    return mb_strlen($string, 'UTF-8');
}

// сохраняет в полях введенные значения
function old($fieldname)
{
    // если было отправлено методом пост то возвращаем значение поля по названию
    if (isset($_POST[$fieldname])) {
        return htmlspecialchars($_POST[$fieldname]);
    } else return '';
}


// перенаправление
function redirect($url = '')
{
    // если урл не пустое то :
    if ($url) {
        $redirect = $url;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }

    header("Location:{$redirect}");
    die;
}



function get_alerts()
{
    // виды запросов
    $alerts = [
        'success',
        'danger',
        'info',
        'warning'
    ];

    if (!empty($_SESSION)) {

        // сам алерт, который выводт нужно сообщения по типу. и будет выводить наш как раз так
        // из сессии что мы создали, сообщение
        function get_alert($type)
        {
        echo "<div class='alert alert-{$type} alert-dismissible fade show' role='alert'>
        {$_SESSION[$type]}
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        };

        // перебираем массив по ключам, где есть нам нужные
        // если наш ключ есть в массиве alerts(выше)
        // то выводим сообщение

        foreach ($_SESSION as $key => $value) {
            echo " <div class='container py-3'>";
            if (in_array($key, $alerts)) {
                get_alert($key);
                unset($_SESSION[$key]);
            }
            echo "</div>";
        }
    }
}
