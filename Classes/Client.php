<?php
require_once('Connection.php');


class Users extends Dbh
{

    public function signup($email, $hashed_password)
    {

        $search = $this->connect()->prepare('SELECT email FROM users WHERE email = ?');

        $search->bind_param('s', $email);
        $search->execute();
        $search->store_result();
        if ($search->num_rows > 0) {
            return 3; //true
        }

        $stmt = $this->connect()->prepare('INSERT INTO users (email, pass, created_date) VALUES (?,?, NOW())');

        $stmt->bind_param('ss', $email, $hashed_password);
        $result = $stmt->execute();

        if ($result) {
            return 1; //true
        } else {
            return 2; //error
        }

        return $result;
    }

    public function login($email, $password)
    {
        session_start();
        $stmt = $this->connect()->prepare("SELECT id, email, pass FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();



        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $hashed_password = $row['pass'];

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];

                    $redirect = ($_SESSION['id'] === 4) ? '../public/admin/home.php' : '../public/client/home.php';

                    return $redirect;
                } else {
                    return 9; // db is error
                }
            }
        } else {
            return 8; // user not found
        }

    }

    public function bookNow($amount, $add, $contact, $userId, $roomId)
    {
        $stmt = $this->connect()->prepare("INSERT INTO orders (user_id, item_id, total_amount, status, address, contact ) VALUES (?,?,?,'pending',?,?)");

        $stmt->bind_param('iiiss', $userId, $roomId, $amount, $add, $contact);
        $result = $stmt->execute();

        if ($result) {
            return 1; // true
        } else {
            return 2; // error
        }

        return $result;
    }

    public function viewOrders($id){
    $stmt = $this->connect()->prepare("SELECT * FROM orders o INNER JOIN users u ON u.
    id = o.user_id WHERE o.user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $response = $result->fetch_all(MYSQLI_ASSOC);
    
    return $response;
}

    public function updateOrder($id, $address, $contact, $amount)
        {
            $stmt = $this->connect()->prepare("
                UPDATE orders 
                SET address = ?, contact = ?, total_amount = ?
                WHERE item_id = ?
            ");

            $stmt->bind_param("ssii", $address, $contact, $amount, $id);

            if ($stmt->execute()) {
                return ["success" => true];
            } else {
                return ["success" => false, "error" => "Update failed"];
            }
        }
        
}

