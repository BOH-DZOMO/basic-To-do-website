<?php
require_once "database.php";
if (isset($_POST)) {
    $id = $_POST["id"];
    $delete_sql = "UPDATE `task` SET `status`='inactive' WHERE id = ?";
$delete_result = $handler->prepare($delete_sql);
$delete_result -> execute(array($id));
$affectedRows = $delete_result->rowCount();
    $flag ="";
    if ($affectedRows > 0) {
        $flag = 'success';
    } else {
        $flag = 'failure';
    }
    echo json_encode($flag);

}
?>