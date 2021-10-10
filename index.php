<?php
error_reporting(E_ALL ^ E_WARNING);

function printNote($note) {
    echo "<form action='/modifyNote.php' method='POST'><div class='note'>";
    echo "<h2 class='note_title'>", $note["title"], "</h2>";
    echo "<p class='note_content'>", $note["content"], "</p>";
    echo "<button class='edit_note' name='action' value='edit' type='submit'>&#9998;</button>";
    echo "<button class='delete_note' name='action' value='delete' type='submit'>&times;</button>";
    echo "<input name='id' value='", $note["ID"], "' hidden></div></form>";
}

$db = new PDO("mysql:host=127.0.0.1;port=3306;dbname=test", "root", "root");
$db->exec("set names utf8");


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
            <form id="newnote" action="/createNote.php" method="POST">
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