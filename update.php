<?php
require_once "database.php";
function validate($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST["edit"])) {
    if (!(empty($_POST["title"]) or empty($_POST["description"]))) {
        $id = validate($_POST["id"]);
$title = validate($_POST["title"]);
$description = validate($_POST["description"]);
$update_sql = "UPDATE `task` SET `title`= ? ,`description`= ? WHERE id = ?";
$update_result = $handler->prepare($update_sql);
$update_result -> execute(array($title,$description,$id));
if ($update_result) {
    header("Location: index.php");
}
    }
    else {
        header("Location: index.php?filled=no");
    }

}
?>