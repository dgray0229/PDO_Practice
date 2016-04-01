<?php
require_once('database.php');

if(!empty($_GET["id"])) {
 $film_id = intval($_GET["id"]);
 try {
  $results = $db->prepare('select * from film where film_id = ?');
  $results->bindParam(1, $film_id);
  $results->execute();
  } catch(Exception $e) {
    echo $e->getMessage();
    die();
  }

  $film = $results->fetch(PDO::FETCH_ASSOC);
}



?>


<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">
  <title>PHP Data Objects</title>
  <link rel="stylesheet" href="style.css">

</head>

<body id="home">

  <h1>Sakila Sample Database</h1>

  <h2>
    <?php
      if (isset($film) && $film !== FALSE) {
        echo $film["title"];
        print_r($film);
      } else {
        echo 'Sorry, No Film Was Found With The Provided ID.';
        die();
      }
    ?>
  </h2>

</body>

</html>

