<?php
    require_once('../Classes/Client.php');

    $id      = $_POST['id'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $amount  = $_POST['amount'];

    $user = new Users();

    $conn = $user->connect();

    $stmt = $conn->prepare("
        UPDATE orders 
        SET address = ?, contact = ?, total_amount = ?
        WHERE item_id = ?
    ");

    $stmt->bind_param("ssii", $address, $contact, $amount, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Update failed"]);
    }

    $stmt->close();
    $conn->close();