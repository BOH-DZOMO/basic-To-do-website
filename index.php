<!DOCTYPE html>
<html lang="en">
<?php
require_once "header.php";
require_once "database.php";

?>

<body>
    <div class="container-fluid">

        <div class="row py-2 navbar">
            <div class="col-lg">TO DO</div>
            <div class="col-lg-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Task</button>
            </div>
            <div class="col-lg-auto">
                <label for="selected">All</label>
                <input type="radio" name="selected" id="all" value="all">
            </div>
            <div class="col-lg-auto">
                <label for="selected">Completed</label>
                <input type="radio" name="selected" id="complete" value="complete">
            </div>
            <div class="col-lg-auto">
                <label for="selected">incomplete</label>
                <input type="radio" name="selected" id="incomplete" value="incomplete" checked>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-10 m-auto body">

                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">1</th>

                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="">
                                    <div class="title"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="description"></div>
                                    </div>
                                    <div class="col-lg-auto"><span><i class="fa fa-eye"></i></span></div>
                                    <div class="col-lg-auto"><button class="btn btn-primary">Edit</button></div>
                                    <div class="col-lg-auto"><button class="btn btn-danger">Delete</button></div>
                                </div>
                            </th>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- add task -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="create_task.php" method="post" target="_blank">
                            <div><label for="title">Title</label></div>
                            <input type="text" name="title" class="form-control" id="title">
                            <div><label for="description">Description</label></div>
                            <textarea class="form-control" name="description" id="description"></textarea>
                            <div class="d-flex justify-content-center pt-2">
                                <input type="submit" id="sub" name="submit" value="submit" class="btn btn-success">
                                <input type="reset" value="Reset" class="btn btn-danger ms-2">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let $input1 = $('#title');
            let $input2 = $('#description');

            function checkFields() {
                $('#sub').prop('disabled', $input1.val() === "" || $input2.val() === "");
            }
            checkFields();
            $input1.on('input', checkFields);
            $input2.on('input', checkFields);
            //
            $('input[type="radio"]').on('change', function() {
                
                let selectedValue = $('input[type="radio"]:checked').val();

                $.post("read_task.php", {
                    selected: selectedValue
                })
                .done(function(data) {
                    let result = JSON.parse(data)
                    console.log(result);
                });                
            });

        });
    </script>
</body>

</html>
<?php



?>