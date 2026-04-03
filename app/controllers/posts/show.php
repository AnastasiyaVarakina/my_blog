<?
global $db;
$title = "POST";

// извлекает параметр id из url 
$id = (int)$_GET['id'];

$sql = "SELECT * FROM `posts` WHERE `posts_id` = ?";
$posts = $db->query($sql, [$id])->findOrAbort();
// $db - Это уже готовая точка входа


$header = $posts['title'];


// $sidebar_posts = $db->query($sql)->findAll();

// dd($posts);

$sql1 = "SELECT * FROM `posts` ORDER BY `posts_id` DESC LIMIT 5 ";
$sidebar_posts = $db->query($sql1)->findAll();

require_once V_POSTS."/show.tmpl.php";
?>