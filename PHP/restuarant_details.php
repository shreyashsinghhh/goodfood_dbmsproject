<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style.css">
<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style1.css">

<?php

$db = new PDO('mysql:host=localhost;dbname=shreyashdb'; 'username', 'password');

$restaurant_id = $_GET['restaurant_id'];

$query = 'SELECT * FROM restaurants WHERE restaurant_id = :restaurant_id';
$statement = $db->prepare($query);
$statement->bindParam(':restaurant_id', $restaurant_id);
$statement->execute();

$row = $statement->fetch_assoc();

if (!$row) {
  echo 'There are no results.';
} else {
  echo '<h1>' . $row['restaurant_name'] . '</h1>';
  echo '<p>' . $row['restaurant_address'] . '</p>';
  echo '<p>' . $row['restaurant_phone_number'] . '</p>';

  $query = 'SELECT * FROM menu WHERE restaurant_id = :restaurant_id';
  $statement = $db->prepare($query);
  $statement->bindParam(':restaurant_id', $restaurant_id);
  $statement->execute();

  $results = $statement->fetchAll(PDO::FETCH_ASSOC);

  if (count($results) == 0) {
    echo 'There are no menu items.';
  } else {
    echo '<ul>';
    foreach ($results as $result) {
      echo '<li>' . $result['item_name'] . ' - $' . $result['price'] . ' <br>' . $result['description'] . '</li>';
    }
    echo '</ul>';
  }

  $query = 'SELECT * FROM restaurant_cuisines WHERE restaurant_id = :restaurant_id';
  $statement = $db->prepare($query);
  $statement->bindParam(':restaurant_id', $restaurant_id);
  $statement->execute();

  $row = $statement->fetch_assoc();

  if (!$row) {
    echo 'There is no cuisine.';
  } else {
    echo '<p>' . $row['cuisine'] . '</p>';
  }

  $query = 'SELECT * FROM reviews WHERE restaurant_id = :restaurant_id';
  $statement = $db->prepare($query);
  $statement->bindParam(':restaurant_id', $restaurant_id);
  $statement->execute();

  $results = $statement->fetchAll(PDO::FETCH_ASSOC);

  if (count($results) == 0) {
    echo 'There are no reviews.';
  } else {
    foreach ($results as $result) {
      echo '<p>' . $result['rating'] . ' stars - ' . $result['comment'] . '</p>';
    }
  }
  echo '<a href="add_review.php?restaurant_id=' . $restaurant_id . '">Add Review</a>';
}

?>
