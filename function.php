<?php
require_once "database.php";
function validate($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
//complete page data
function complete_read_task()
{
    global $handler;
    $read_sql = "SELECT `id`, `title`, `description`, `created` FROM `task` WHERE  state = 'complete'";
    $read_result = $handler->prepare($read_sql);
    $read_result->execute();
    $result = $read_result->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
//create_task
function create_task()
{

    if (isset($_POST["submit"])) {
        global $handler;
        $title = validate($_POST["title"]);
        $description = validate($_POST["description"]);
        $insert_sql = "INSERT INTO `task`(`title`, `description`) VALUES (?,?)";
        $insert_result = $handler->prepare($insert_sql);
        $insert_result->execute(array($title, $description));
        if ($insert_result) {
            header("Location: index.php");
        }
    }
}
//delete_page_data
function read_task_delete()
{
    global $handler;
    $read_sql = "SELECT `id`, `title`, `description`, `created` FROM `task` WHERE status ='inactive'";
    $read_result = $handler->prepare($read_sql);
    $read_result->execute();
    $result = $read_result->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
//delete| delete_incomplete
function delete_incomplete()
{
    if (isset($_POST)) {
        global $handler;
        $id = $_POST["id"];
        $delete_sql = "UPDATE `task` SET `status`='inactive' WHERE id = ?";
        $delete_result = $handler->prepare($delete_sql);
        $delete_result->execute(array($id));
        $affectedRows = $delete_result->rowCount();
        $flag = "";
        if ($affectedRows > 0) {
            $flag = 'success';
        } else {
            $flag = 'failure';
        }
        echo json_encode($flag);
    }
}

//get update date
function get_update_data()
{
    if (isset($_POST["id"])) {
        global $handler;
        $id = $_POST["id"];
        $read_sql = "SELECT `id`, `title`, `description`, `created` FROM `task` WHERE  id = ?";
        $read_result = $handler->prepare($read_sql);
        $read_result->execute(array($id));
        $result = $read_result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }
}

//read task |incomplete 
function incomplete_read_task()
{
    global $handler;
    $read_sql = "SELECT `id`, `title`, `description`, `created` FROM `task` WHERE status ='active' and state = 'incomplete'";
    $read_result = $handler->prepare($read_sql);
    $read_result->execute();
    $result = $read_result->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
//set complete
function set_complete()
{
    if (isset($_POST["id"])) {
        global $handler;
        $id = $_POST["id"];
        $update_sql = "UPDATE `task` SET state = 'complete' WHERE id = ?";
        $update_result = $handler->prepare($update_sql);
        $update_result->execute(array($id));
    }
}

//update
function update()
{
    if (isset($_POST["edit"])) {
        if (!(empty($_POST["title"]) or empty($_POST["description"]))) {
            global $handler;
            $id = validate($_POST["id"]);
            $title = validate($_POST["title"]);
            $description = validate($_POST["description"]);
            $update_sql = "UPDATE `task` SET `title`= ? ,`description`= ? WHERE id = ?";
            $update_result = $handler->prepare($update_sql);
            $update_result->execute(array($title, $description, $id));
            if ($update_result) {
                header("Location: index.php");
            }
        } else {
            header("Location: index.php?filled=no");
        }
    }
}
