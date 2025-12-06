<?php
    include 'Connection.php';

    $id = $_GET['id'];

    $sql = "DELETE FROM orders WHERE user_id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Student deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    header("Location: ('../client/home.php');
    ");
?>