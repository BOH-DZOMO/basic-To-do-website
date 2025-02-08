<!DOCTYPE html>
<html lang="en">
<?php
require_once "header.php";
require_once "database.php";
require_once "function.php";
$read_result = incomplete_read_task();
if (isset($_GET["filled"])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  Some input fields were empty (Operation unsuccessfull)
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>

<body>
    <div id="alert"></div>
    <div class="container-fluid">

        <div class="row py-2 navbar">
            <div class="col-lg">TO DO</div>
            <div class="col-lg-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Task</button>
            </div>
            <div class="col-lg-auto">
                <a href="delete_page.php">deleted</a>
            </div>
            <div class="col-lg-auto">
                <a href="complete_page.php">complete</a>
            </div>
            <div class="col-lg-auto">
                <span>incomplete</span>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-10 m-auto body">

                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">1</th>

                        </tr>
                        <?php
                        if ($read_result) {
                            foreach ($read_result as $result) {
                        ?>
                                <tr>
                                    <th scope="row">
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <div class="title"><?php echo $result["title"] ?></div>
                                            </div>
                                            <div class="col-lg-2">
                                                <span class=""><?php echo $result["created"] ?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <div class="description"><?php echo $result["description"] ?></div>
                                            </div>
                                            <div class="col-lg-auto"><span onclick="view_data(<?php echo $result['id'] ?>)" data-bs-toggle="modal" data-bs-target="#exampleModal3"><i class="fa fa-eye"></i></span></div>
                                            <div class="col-lg-auto"><span class="complete" onclick="send_data(<?php echo $result['id'] ?>)"><i class="fa fa-check"></i></span></div>
                                            <div class="col-lg-auto"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick="do_update(<?php echo $result['id'] ?>)">Edit</button></div>
                                            <div class="col-lg-auto"><button class="btn btn-danger" onclick="do_delete(<?php echo $result['id'] ?>)">Delete</button></div>
                                        </div>
                                    </th>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <th>No data available</th>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- add task -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="addTaskModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="function.php?value=index_add" method="post">
                            <div><label for="title">Title</label></div>
                            <input type="text" name="title" class="form-control" id="title">
                            <div><label for="description">Description</label></div>
                            <textarea class="form-control" name="description" id="description"></textarea>
                            <div class="d-flex justify-content-center pt-2">
                                <input type="submit" id="submit" name="submit" value="submit" class="btn btn-success">
                                <input type="reset" value="Reset" class="btn btn-danger ms-2">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!--update-task -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="editTaskModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="function.php?value=index_update" method="post">
                            <input type="hidden" name="id" id="updateId">
                            <div><label for="title">Title</label></div>
                            <input type="text" name="title" class="form-control" id="title1">
                            <div><label for="description">Description</label></div>
                            <textarea class="form-control" name="description" id="description1"></textarea>
                            <div class="d-flex justify-content-center pt-2">
                                <input type="submit" id="edit" name="edit" value="submit" class="btn btn-success">
                                <input type="reset" value="Reset" class="btn btn-danger ms-2">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!--view-task -->
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="viewTaskModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">View Form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="updateId">
                        <div><label for="title2">Title</label></div>
                        <input type="text" name="title" class="form-control" id="title2" readonly>
                        <div><label for="description2">Description</label></div>
                        <textarea class="form-control" name="description" id="description2" readonly rows="4"></textarea>
                        <div><span class=>created: </span> <span class="ms-2" id="created"></span></div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script>
        let $input1 = $('#title');
        let $input2 = $('#description');

        function checkFields1() {
            $('#submit').prop('disabled', $input1.val() === "" || $input2.val() === "");
        }
        checkFields1();
        $input1.on('input', checkFields1);
        $input2.on('input', checkFields1);
        //
        let $update_input1 = $('#title1');
        let $update_input2 = $('#description1');

        function checkFields2() {
            $('#edit').prop('disabled', $update_input1.val() === "" || $update_input2.val() === "");
        }
        checkFields2();
        $update_input1.on('input', checkFields2);
        $update_input2.on('input', checkFields2);

        function do_delete(id) {
            if (confirm("Are you sure to DELETE????")) {
                $.post("function.php", {
                        id: id,
                        action: "delete_incomplete"
                    })
                    .done(function(data) {
                        var a = JSON.parse(data);
                        if (a == "success") {
                            window.location.href = "index.php";
                        } else {
                            document.getElementById("alert").innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
  Operation Unsuccessful(Could not delete)
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`
                        }

                    });
            }
        };

        function do_update(data) {
            $.post("function.php", {
                    id: data,
                    action: "get_update_data"
                })
                .done(function(data) {
                    var result = JSON.parse(data);
                    $('#title1').val(result[0].title);
                    $('#description1').val(result[0].description);
                    $('#updateId').val(result[0].id);

                });
        };

        function view_data(data) {
            $.post("function.php", {
                    id: data,
                    action: "get_update_data"
                })
                .done(function(data) {
                    var result = JSON.parse(data);
                    $('#title2').val(result[0].title);
                    $('#description2').val(result[0].description);
                    $('#created').text(result[0].created);

                });
        };

        function send_data(data) {
            $.post("function.php", {
                    id: data,
                    action: "set_complete"
                })
                .done(function() {
                    window.location.href = "index.php";
                });
        };
    </script>
</body>

</html>
<?php



?>