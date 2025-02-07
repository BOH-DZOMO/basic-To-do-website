<!DOCTYPE html>
<html lang="en">
<?php
require_once "header.php";
require_once "database.php";
require_once "function.php";
$read_result = complete_read_task();

?>

<body>
    <div id="alert"></div>
    <div class="container-fluid">

        <div class="row py-2 navbar">
            <div class="col-lg">TO DO</div>
            <div class="col-lg-auto">
                <a href="delete_page.php">deleted</a>
            </div>
            <div class="col-lg-auto">
                <span>complete</span>
            </div>
            <div class="col-lg-auto">
                <a href="index.php">incomplete</a>
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
                                            <div class="col-lg-11">
                                                <div class="description"><?php echo $result["description"] ?></div>
                                            </div>
                                            <div class="col-lg-auto"><span onclick="view_data(<?php echo $result['id'] ?>)" data-bs-toggle="modal" data-bs-target="#exampleModal3"><i class="fa fa-eye"></i></span></div>

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
        </div>


    </div>
    <script>
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
    </script>
</body>

</html>
<?php



?>