<?php

// remove before live
ini_set('display_errors', 'on');

try {
  $db = new PDO('sqlite:./database.db');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
  echo $e->getMessage();
  die();
}

?>
