<?php
require_once('database.php');

try {
  $results = $db->query('SELECT * FROM film');
} catch(Exception $e) {
  echo $e->getMessage();
  die();
}
//Results per page
$itemsPerPage = 10;

// Grab all results
$films = $results->fetchAll(PDO::FETCH_ASSOC);




// Pagination
function countResults() {
  mysqli_select_db('database');
  $results = $db->query('SELECT * FROM table');
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
} // end countResults()

function getResults($position, $itemsPerPage) {
  mysqli_select_db('database');
  $results = mysqli_query('SELECT * FROM table LIMIT $position, $itemsPerPage');
} // end getResults()


// Grab total number of results
$sql = "SELECT COUNT(*) FROM film";
$res = $db->query($sql);
$totalResults = $res->fetchColumn();

// Divide the number of results by how many items to display per page to get the total page numbers
$totalPages = ceil($totalResults / $itemsPerPage);
// Validate given page number, subtract it by 1
// If you don't subtract by 1, then the wrong results will be displayed
if(isset($_GET['page']) && is_numeric($_GET['page'])) {
  $page = $_GET['page'] - 1;
} else {
  $page = 0;
}
// This is the offset used in the LIMIT query
$position = $page * $itemsPerPage;
// Get the results
$items = getResults($position, $itemsPerPage);
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

  <h2>Films by Title</h2>

  <ol>
    <?php
    // Display pagination results
    foreach($items as $item) {
      echo $item['column'] . '<br />';
    }
    // Display the page numbers at the bottom
    $pagination = "";
    if($totalPages > 1) {
      $pagination .= '<ul>';
      for($i = 1; $i <= $totalPages; $i++) {
        if ($i == $page + 1) {
          $pagination .= '<li><a href="index.php?page=' . $i .  '"><u>' . $i . '</u></a></li>';
        } else {
          $pagination .= '<li><a href="index.php?page=' . $i .  '">' . $i . '</a></li>';
        }
      }
    }
    $pagination .= '</ul>';
    // Show each $film in database as <li>
      foreach($films as $film) {
        echo '<li><i class="lens"></i><a href="films.php?id=' .
        $film["film_id"] .
        '">' .
        $film["title"] . '</li>';
      }

    ?>
  </ol>
<?php echo $pagination; ?>
</body>

</html>
