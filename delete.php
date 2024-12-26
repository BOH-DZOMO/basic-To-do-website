<?php
$id = $_POST["id"];//id from POST Ajax request
if (isset($_POST)) {
    $delete_sql = "UPDATE `task` SET `status`='inactive' WHERE id = ?";
$delete_result = $handler->prepare($delete_sql);
$delete_result -> execute(array($id));

}
?>