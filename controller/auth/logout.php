<?php
include "../../models/User.php";

$user = new User();
$user->logOut();

header('Location: ../../views/sign_in.php');
