<?
$title = "Blog home";
$header = "Recent Post";

$sql = "SELECT * FROM `posts` ORDER BY `created_at` DESC";
$posts = $db->query($sql)->findAll();


$sql = "SELECT * FROM `posts` ORDER BY `created_at` DESC LIMIT 5";
$sidebar_posts = $db->query($sql)->findAll();

require_once VIEWS."/index.tmpl.php";

?>