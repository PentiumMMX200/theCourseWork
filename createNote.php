<?php

$db = new PDO("mysql:host=127.0.0.1;port=3306;dbname=test", "root", "root");
$db->exec("set names utf8");


if($_POST["title"] && $_POST["content"] && !$_POST["action"]) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $id = $db->prepare("SELECT count(*) FROM notes");
    $id->execute();
    $id = $id->fetchAll(PDO::FETCH_DEFAULT)[0]['count(*)'];

    $insertion = $db->prepare("INSERT INTO notes (ID, title, content) VALUES (:id, :title, :content)");
    $insertion->execute(array(":id"=>$id+1, ":title"=>$title, ":content"=>$content));
}
header('Location:index.php');
  exit;
?>