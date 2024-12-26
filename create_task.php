<?php
require_once "database.php";
function validate($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST["submit"])) {
    $title = validate($_POST["title"]);
    $description = validate($_POST["description"]);
    $insert_sql = "INSERT INTO `task`(`title`, `description`) VALUES (?,?)";
    $insert_result = $handler -> prepare($insert_sql);
    $insert_result->execute(array($title,$description));
    if ($insert_result) {
        header("Location: index.php");
    }
}
?>