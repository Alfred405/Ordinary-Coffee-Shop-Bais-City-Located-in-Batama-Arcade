<?php
include('../Classes/Client.php');
$clients = new Users();

if (isset($_POST['book_now'])) {
    $add = $_POST['add'];
    $contact = $_POST['contact'];
    $userId = $_POST['userId'];
    $roomId = $_POST['roomId'];
    $amount = $_POST['amount'];

    // Validations
    if ($add == '' && $contact == '') {
        $response = array(
            'error' => "Please input accurately!",
        );
    } else {

        $book = $clients->bookNow($amount, $add, $contact, $userId, $roomId);

        if ($book === 1) {
            $response = array(
                'success' => "Order success!",
            );
        } else if ($book === 2) {
            $response = array(
                'error' => "Please try again",
            );
        } else {
            $response = array(
                // 'session' => $_SESSION['username'],
                'error' => "Database error",
            );
        }
    }

    echo json_encode($response);
    exit;
}