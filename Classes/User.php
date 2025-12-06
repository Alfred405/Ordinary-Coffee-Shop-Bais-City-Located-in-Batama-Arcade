<?php
require_once('Connection.php');


class Users extends Dbh
{

    public function deleteOrder($orderId) {
        $stmt = $this->connect()->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("i", $orderId);
        return $stmt->execute();
    }
}