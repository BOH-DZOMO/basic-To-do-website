<?php
require_once "database.php";
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $update_sql = "UPDATE `task` SET state = 'complete' WHERE id = ?";
    $update_result = $handler->prepare($update_sql);
    $update_result->execute(array($id));
   
}