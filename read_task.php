<?php

$selected = $_POST["selected"];
if (isset([$_POST["selected"]])) {
    $read_sql = "";
switch ($selected) {
    case 'complete':
       $read_sql = "SELECT `id`, `title`, `description`, `created` FROM `task` WHERE status ='active' and state = 'complete'";
        break;
    case 'incomplete':
        $read_sql = "SELECT `id`, `title`, `description`, `created` FROM `task` WHERE status ='active' and state = 'incomplete'";
        break;
    case 'all':
       $read_sql = "SELECT `id`, `title`, `description`, `created` FROM `task` WHERE status ='active'";
        break;
    default:
        echo "<script>alert('error with select option');</script>";
        break;
}
$read_result = $handler -> prepare($read_sql);
$read_result -> execute();
$result = $read_result ->fetchAll(PDO::FETCH_ASSOC);

    

}
echo json_encode($selected);


//check if ajax/js has a row counter to tell the number of active task for each task or send through ajax from php

?>