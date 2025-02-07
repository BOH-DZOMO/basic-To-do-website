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
function delete_read_task()
{
    global $handler;
    $read_sql = "SELECT `id`, `title`, `description`, `created` FROM `task` WHERE status ='inactive'";
    $read_result = $handler->prepare($read_sql);
    $read_result->execute();
    $result = $read_result->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
//delete| delete_incomplete
function delete_incomplete($id)
{
    if (isset($_POST["id"])) {
        global $handler;
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

//get update data
function get_update_data($id)
{
    if (isset($_POST['id'])) {
        global $handler;
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
function set_complete($id)
{
    if (isset($_POST["id"])) {
        global $handler;
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

///////

//create_task/index.php
if (isset($_GET["value"]) and $_GET["value"] === "index_add") {
    create_task();
    header("Location: index.php");
    exit; 
}
//update/index.php
if (isset($_GET["value"]) and $_GET["value"] === "index_update") {
    update();
    header("Location: index.php");
    exit; 
}

//


//ajax handling for all pages

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'delete_incomplete':
                delete_incomplete($_POST['id']);
                break;
            case 'get_update_data':
                get_update_data($_POST['id']);
                break;
            case 'set_complete':
                set_complete($_POST['id']);
                break;
            default:
                echo json_encode('Invalid action');
        }
        
    } else {
        echo json_encode('No action specified');
    }
}