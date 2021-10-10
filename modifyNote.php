<?php
    $db = new PDO("mysql:host=127.0.0.1;port=3306;dbname=test", "root", "root");
    $db->exec("set names utf8");

    if($_POST["action"] == "edit") {
        $id = (int) $_POST["ID"];
        $edit = $db->prepare("UPDATE notes set content=:content WHERE ID=:id");
        $edit->execute(array(":id"=>$id, ":content"=>"yolo)"));
    }
    
    if($_POST["action"] == "delete") {
        $id = (int) $_POST["ID"];
        $delete = $db->prepare("DELETE FROM notes WHERE ID=" . $id);
        $delete->execute();
    }

    header('Location:index.php');
    exit;
?>