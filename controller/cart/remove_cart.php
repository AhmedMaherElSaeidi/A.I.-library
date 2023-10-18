<?php
include "../../models/ORM.php";
include "../../models/Database.php";
$db = new DataBase('library');

if ($db->connect()) {
  $orm = new ORM($db);

  $url = $_GET['url'];
  $cart_id = $_GET['cart_id'];
  $params = $_GET['params'];

  $state = $orm->delete('cart', "cart_id={$cart_id}");
  $db->close();

  if ($state) {
    header("Location: ../../views/{$url}.php?msg='Removed successfully.'&{$params}");
  } else {
    header("Location: ../../views/{$url}.php?msg='Encountered error.'&{$params}");
  }
}

$db->close();
die('Server Connection Error');