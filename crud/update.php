<?php
include './_partials/_dbconnect.php';
include "./_partials/nav.php";
$query = "SELECT * FROM `crud` WHERE srno = '" . $_GET['ID'] . "'";
$result = mysqli_query($conn, $query);
if ($result->num_rows > 0) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $tit = $row['title'];
        $des = $row['description'];
        $id = $row['srno'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>

<body>
    <h2 class="my-3">Update your Title and Description For ID : <?php echo $id ?></h2>
    <form action="" method="GET">
        <div class="mb-3">
            <!-- <label for="id" class="form-label">ID</label> -->
            <input style="display: none;" type="number" class="form-control" id="id" name="id" value="<?php echo $id ?>" readonly>
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $tit ?>">
            <div class="mb-3 mx-auto">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" name="desc" id="desc" value="<?php echo $des ?>">
            </div>
            <button type="submit" class="btn btn-primary mx-auto mb-5 d-grid gap-2 col-6 my-5" value="submit" name="submit">Update</button>
    </form>
</body>

</html>
<?php
if (isset($_GET['submit'])) {
    if ((isset($_GET['title'])) && (isset($_GET['desc']))) {
        $title = $_GET['title'];
        $desc = $_GET['desc'];
        $id = $_GET['id'];
        echo $title;
        echo $desc;
        $query = "UPDATE crud SET  title= '" . $title . "', description = '" . $desc . "', time = current_timestamp() WHERE `crud`.`srno` ='" . $id . "'";

        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Update Failed" . mysqli_error($conn);
        } else {
            // echo $alerts;
            header("location:index.php");
        }
    }
}

?>