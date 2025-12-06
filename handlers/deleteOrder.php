<?php
    require_once('../Classes/Client.php');

    $id = $_POST['id'];

    $user = new Users();
    $conn = $user->connect();

    $stmt = $conn->prepare("DELETE FROM orders WHERE item_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Delete failed"]);
    }

    $stmt->close();
    $conn->close();
?>