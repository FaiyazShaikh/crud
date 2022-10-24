<?php
include "./_partials/_dbconnect.php";
include "./_partials/nav.php";
if (!$conn) {
    die("Failed to Connect - " . mysqli_connect_errno());
}
$alerts = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Data Insertion Successful.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
$alertd = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Failed!</strong> Data Insertion Failed.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
$alertdnf = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Failed!</strong> No Data Found.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
if (isset($_GET['submit'])) {
    if ((isset($_GET['title'])) && (isset($_GET['desc']))) {
        $title = $_GET['title'];
        $desc = $_GET['desc'];

        $query = "INSERT INTO `crud` (`title`, `description`, `time`) VALUES ('$title', '$desc', current_timestamp())";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "$alertd" . mysqli_error($conn);
        } else {
            echo $alerts;
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Create, Read, Update, Delete</title>
    <script type="text/javascrit"></script>
</head>

<body>
    <form action="/crud/index.php" method="GET">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
            <div class="mb-3 mx-auto">
                <label for="description" class="form-label">Description</label>
                <input type="textarea" class="form-control" name="desc" id="desc">
            </div>
            <button type="submit" class="btn btn-primary mx-auto mb-5 d-grid gap-2 col-6 my-5" value="submit" name="submit">Submit</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Srno</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM `crud` WHERE 1";
            $result = mysqli_query($conn, $query);
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $tit = $row['title'];
                    $des = $row['description'];
                    $tim = $row['time'];
                    // for ($i = 0; $i < $row; $i++) {
                    # code...


            ?>
                    <tr>
                        <th scope='row'><?php echo $i + 1 ?></th>
                        <td><?php echo $tit; ?></td>
                        <td><?php echo $des ?></td>
                        <td><?php echo $tim ?></td>
                        <td><a href="update.php?ID=<?php echo $row['srno']; ?>" title='Upadte Record'>
                                <span class='glyphicon glyphicon-pencil'>U</span></a>
                            <a href="delete.php?ID=<?php echo $row['srno']; ?>" title='Delete Record'><i class="material-icons">
                                    <span class='glyphicon glyphicon-trash'>D</span></a>
                        </td>
                    </tr>
            <?php
                    $i++;
                }
            } else echo $alertdnf;
            ?>
        </tbody>
    </table>
</body>
<?php

?>

</html>