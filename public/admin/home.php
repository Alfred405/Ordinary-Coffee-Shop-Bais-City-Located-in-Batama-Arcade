<?php

session_start();

echo "Welcome &nbsp " . htmlspecialchars($_SESSION['email']);

echo "&nbsp- Admin";

?>

