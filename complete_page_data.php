<?php
 require_once "database.php";
function read_task()
{
    global $handler;
    $read_sql = "SELECT `id`, `title`, `description`, `created` FROM `task` WHERE  state = 'complete'";
    $read_result = $handler -> prepare($read_sql);
    $read_result -> execute();
    $result = $read_result -> fetchAll(PDO::FETCH_ASSOC);
    return $result;  
}
?>