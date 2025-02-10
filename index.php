<?php
require 'vendor/autoload.php';

// Connect to MongoDB
$client = new MongoDB\Client("mongodb://127.0.0.1:27017");

// Select a database and a collection
$db = $client->selectDatabase('php-mongodb-project');
$collection = $db->selectCollection("php-mongodb");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Swimmers: Names, Surnames, Ages, and Best Strokes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h2 class="text-center text-primary" style="margin-top: 5px; padding-top: 0;">Swimmers: Names, Surnames, Ages, and Best Strokes</h2>
    <div class="">
        <?php
        if(isset($_POST['create'])) {
            $data = [
                'name'       => $_POST['name'] ,
                'surname'    => $_POST['surname'] ,
                'age'        => $_POST['age'],
                'beststroke' => $_POST['beststroke']
                //'createdOn' => new MongoDB\BSON\UTCDateTime
            ];
            $result = $collection->insertOne($data);
            if($result->getInsertedCount() > 0) {
                echo "<div class='alert alert-success'>Info created.</div>";
            } else {
                echo "<div class='alert alert-danger'>Failed</div>";
            }
        }

        // If the form is submitted for updating an existing document:
        if(isset($_POST['update'])) {
            $filter = ['_id' => new MongoDB\BSON\ObjectId($_POST['aid'])];
            $data = [
                'name'       => $_POST['name'],
                'surname'    => $_POST['surname'],
                'age'        => $_POST['age'],
                'beststroke' => $_POST['beststroke']
            ];
            $result = $collection->updateOne($filter, ['$set' => $data]);
            if($result->getModifiedCount() > 0) {
                echo "<div class='alert alert-success'>Article is updated.</div>";
            } else {
                echo "<div class='alert alert-danger'>Failed to update Article.</div>";
            }
        }

        // If the delete action is triggered:
        if(isset($_GET['action']) && $_GET['action'] == 'delete') {
            $filter = ['_id' => new MongoDB\BSON\ObjectId($_GET['aid'])];
            $info = $collection->findOne($filter);
            if(!$info) {
                echo "<div class='alert alert-warning'>Article not found.</div>";
            }
            $result = $collection->deleteOne($filter);
            if($result->getDeletedCount() > 0) {
                echo "<div class='alert alert-success'>Article is deleted.</div>";
            } else {
                echo "<div class='alert alert-danger'>Failed to delete Article.</div>";
            }
        }
        ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Surname</label>
                <input type="text" class="form-control" id="surname" name="surname">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" class="form-control" id="age" name="age">
            </div>
            <div class="mb-3">
                <label for="beststroke" class="form-label">Best Stroke</label>
                <input type="text" class="form-control" id="beststroke" name="beststroke">
            </div>
            <!-- Hidden field for updating an article -->
            <input type="hidden" id="aid" name="aid" value="">
            <button type="submit" name="create" id="create" class="btn btn-primary">Submit</button>
            <button type="submit" name="update" id="update" class="btn btn-secondary" style="display:none;">Update</button>
        </form>
        <!-- Show Articles -->

    </div>
</div>
</body>
</html>





