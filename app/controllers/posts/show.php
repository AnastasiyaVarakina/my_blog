<?
$title = "POST";

$id = (int)$_GET['id'];

$sql = "SELECT * FROM `posts` WHERE `posts_id` = ?";
$posts = $db->query($sql, [$id])->findOrAbort();

$header = $posts['title'];


// $sidebar_posts = $db->query($sql)->findAll();

// dd($posts);

$sql1 = "SELECT * FROM `posts` ORDER BY `posts_id` DESC LIMIT 5 ";
$sidebar_posts = $db->query($sql1)->findAll();

require_once V_POSTS."/show.tmpl.php";
?>