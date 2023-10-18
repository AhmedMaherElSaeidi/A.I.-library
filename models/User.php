<?php
include_once "Database.php";
include_once "ORM.php";
class User
{
    function logIn($email, $password)
    {
        $db = new DataBase('library');
        if ($db->connect()) {
            $orm = new ORM($db);
            $result = $orm->select("user", "user.username = '{$email}' AND user.password = '{$password}'", True);

            if (count($result) !== 1) {
                $db->close();
                return false;
            }

            session_start();
            $user = $result[0];
            $_SESSION['role'] = $user['role'];
            $_SESSION['gender'] = $user['gender'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_profile'] = $user['user_profile'];
            $_SESSION['fullname'] = $user['first_name'] . " " . $user['last_name'];
            $db->close();

            return true;
        }

        $db->close();
        die('Server Connection Error');
    }

    function register($email, $password, $fname, $lname, $gender)
    {
        $db = new DataBase('library');
        if ($db->connect()) {
            $orm = new ORM($db);
            $result = $orm->insert("user", "(NULL, '{$email}', '{$password}', '{$fname}', '{$lname}', '{$gender}', 'user', 'null')");

            if (!$result) {
                $db->close();
                return false;
            }

            $db->close();
            return true;
        }

        $db->close();
        die('Server Connection Error');
    }

    function logOut()
    {
        session_start();
        unset($_SESSION['role']);
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['fullname']);
        unset($_SESSION['user_profile']);
        session_destroy();
    }
}