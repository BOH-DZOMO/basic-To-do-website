<?php
require_once "database.php";
if (isset($_POST["id"])) {
    
    $id = $_POST["id"];
    $read_sql = "SELECT `id`, `title`, `description`, `created` FROM `task` WHERE status ='active' and state = 'incomplete' and id = ?";
    $read_result = $handler->prepare($read_sql);
    $read_result->execute(array($id));
    $result = $read_result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

