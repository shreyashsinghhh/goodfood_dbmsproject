<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style.css">
<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style1.css">

<link rel="stylesheet" href="style.css">

<?php

$db = new PDO('mysql:host=localhost;dbname=shreyashdb');

$restaurant_id = $_GET['restaurant_id'];
$user_id = $_SESSION['user_id'];

if (!$user_id) {
  echo 'You must be logged in to add a review.';
  exit;
}

$rating = $_POST['rating'];
$comment = $_POST['comment'];

$query = 'INSERT INTO reviews (user_id, restaurant_id, rating, comment) VALUES (:user_id, :restaurant_id, :rating, :comment)';
$statement = $db->prepare($query);
$statement->bindParam(':user_id', $user_id);
$statement->bindParam(':restaurant_id', $restaurant_id);
$statement->bindParam(':rating', $rating);
$statement->bindParam(':comment', $comment);
$statement->execute();

if ($statement) {
  header('Location: restaurant_details.php?restaurant_id=' . $restaurant_id);
} else {
  echo 'There was an error adding the review.';
}

?>