<?

global $db;
$title = "USER";

$sql = "SELECT * FROM `users`";
$users = $db->query($sql)->findAll();


require_once V_USER.'/show-user.tmpl.php';