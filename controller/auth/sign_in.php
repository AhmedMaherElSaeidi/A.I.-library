<?php
include "../../models/Methods.php";
include "../../models/User.php";

$username = to_value($_POST['username']);
$password = to_value($_POST['password']);

$user = new User();
if ($user->logIn($username, $password)) {
    header('Location: ../../index.php');
} else {
    header('Location: ../../views/sign_in.php?msg=Not valid account');
}