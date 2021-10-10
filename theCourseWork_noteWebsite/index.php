<?php
error_reporting(E_ALL ^ E_WARNING);

function printNote($note) {
    echo "<form action='/index.php' method='GET'><div class='note'>";
    echo "<h2 class='note_title'>", $note["title"], "</h2>";
    echo "<p class='note_content'>", $note["content"], "</p>";
    echo "<button class='edit_note' name='action' value='edit' type='submit'>&#9998;</button>";
    echo "<button class='delete_note' name='action' value='delete' type='submit'>&times;</button>";
    echo "<input name='id' value='", $note["ID"], "' hidden></div></form>";
}

$db = new PDO("mysql:host=127.0.0.1;port=3306;dbname=test", "root", "123");
$db->exec("set names utf8");



if($_GET["action"] == "delete") {
    $id = (int) $_GET["id"];
    $delete = $db->prepare("DELETE FROM notes WHERE id=" . $id);
    $delete->execute();
}

if($_GET["title"] && $_GET["content"] && !$_GET["action"]) {
    $title = $_GET["title"];
    $content = $_GET["content"];
    $id = $db->prepare("SELECT count(*) FROM notes");
    $id->execute();
    $id = $id->fetchAll(PDO::FETCH_DEFAULT)[0]['count(*)'];

    $insertion = $db->prepare("INSERT INTO notes (id, title, content) VALUES (:id, :title, :content)");
    $insertion->execute(array(":id"=>$id, ":title"=>$title, ":content"=>$content));
}

$notes = $db->prepare("SELECT * FROM notes");
$notes->execute();
$notes = $notes->fetchAll(PDO::FETCH_DEFAULT);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
                <title>Web-страница</title>
    </head>
    <body>
        <div id="container">
            <form id="newnote" action="/index.php" method="GET">
                <input id="title" name="title" type="text" placeholder="Заголовок" autocomplete="off">
                <textarea id="content" name="content" placeholder="Запишите, что-нибудь"></textarea>
                <button id="send" type="submit">Добавить заметку</button>
            </form>
            <div id="notes">
                <?php
                foreach($notes as $note) {
                    printNote($note);
                }
                ?>
            </div>
        </div>
    </body>
    <script src="script.js"></script>
</html>
