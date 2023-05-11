<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style.css">
<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style1.css">

<?php

$db = new PDO('mysql:host=localhost;dbname=shreyashdb');

$user_id = $_SESSION['user_id'];

$show_liked_restaurants = isset($_GET['show_liked_restaurants']) && $_GET['show_liked_restaurants'] === 'true';

if ($show_liked_restaurants) {
  $sql = "SELECT * FROM restaurants WHERE id IN (SELECT restaurant_id FROM likes WHERE user_id = :user_id)";
} else {
  $sql = "SELECT * FROM restaurants";
}

$statement = $db->prepare($sql);
$statement->bindParam(':user_id', $user_id);
$statement->execute();

$results = $statement->fetchAll(PDO::FETCH_ASSOC);

if (count($results) == 0) {
  echo 'There are no restaurants.';
} else {
  foreach ($results as $result) {
    echo '<h3>' . $result['restaurant_name'] . '</h3>';
    echo '<p>' . $result['restaurant_address'] . '</p>';
    echo '<p>' . $result['restaurant_phone_number'] . '</p>';
    echo '<p><a href="restaurant_details.php?restaurant_id=' . $result['restaurant_id'] . '">View Details</a></p>';
  }
}

?>
