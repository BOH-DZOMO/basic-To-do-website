<?php
require_once "database.php";
function validate($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
echo "sleep"."<br>";
if (isset($_POST["submit"])) {
    $title = validate($_POST["title"]);
    $description = validate($_POST["description"]);
    $insert_sql = "INSERT INTO `task`(`title`, `description`) VALUES (?,?)";
    $insert_result = $handler -> prepare($insert_sql);
    $insert_result->execute(array($title,$description));
    if ($insert_result) {
        echo "Data inserted successfully!";
    } else {
        echo "Error inserting data.";
        // Handle the error (e.g., display error message, log the error)
        print_r($stmt->errorInfo()); 
    }
}
?>