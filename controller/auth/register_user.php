<?php
include "../../models/Methods.php";
include "../../models/User.php";
$db = new DataBase('library');

if ($db->connect()) {
    $user = new User();
    $status = $user->register(to_value($_POST['username']), to_value($_POST['password']), $_POST['fname'], $_POST['lname'], $_POST['gender']);

    if ($status) {
        header('Location: ../../views/sign_in.php?msg=Login to proceed.');
    } else {
        header('Location: ../../views/sign_up.php?msg=Signing up failed.');
    }
}

$db->close();
die('Server Connection Error');