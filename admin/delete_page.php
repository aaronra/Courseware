<?php
session_start();
include_once '../db/db.php';
global $db;

//$var = $db->get_row("SELECT * FROM `content` LEFT JOIN `links` ON content.link_id = links.id WHERE content.id ='" . $db->escape($_GET['id']) . "' ");

$db->query("DELETE FROM content WHERE id = '" . $db->escape($_GET['id']) . "'");
$db->query("DELETE FROM links WHERE id = '" . $db->escape($_GET['id']) . "'");
$_SESSION['message'] = 'Content has been successfully updated!';
header("location: /courseware/admin/index.php");
die;
    

?>