<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style.css">
<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style1.css">

<?php

$db = new PDO('mysql:host=localhost;dbname=shreyashdb');

$owner_id = $_SESSION['owner_id'];

$query = 'SELECT * FROM restaurants WHERE owner_id = :owner_id';
$statement = $db->prepare($query);
$statement->bindParam(':owner_id', $owner_id);
$statement->execute();

$results = $statement->fetchAll(PDO::FETCH_ASSOC);

if (count($results) == 0) {
  echo 'You do not own any restaurants.';
} else {
  foreach ($results as $result) {
    echo '<h3>' . $result['restaurant_name'] . '</h3>';
    echo '<p>' . $result['restaurant_address'] . '</p>';
    echo '<p>' . $result['restaurant_phone_number'] . '</p>';
  }
}
echo '<a href="new_restaurant.php">Add New Restaurant</a>';

$query = 'SELECT * FROM reservations';
$statement = $db->prepare($query);
$statement->execute();

$reservations = $statement->fetchAll(PDO::FETCH_ASSOC);

if (count($reservations) === 0) {
  echo 'There are no reservations.';
} else {
  foreach ($reservations as $reservation) {
    $query = 'SELECT name FROM restaurants WHERE id = :restaurant_id';
    $statement = $db->prepare($query);
    $statement->bindParam(':restaurant_id', $reservation['restaurant_id']);
    $statement->execute();

    $restaurant = $statement->fetchColumn();

    echo '<h3>' . $reservation['reservation_date'] . '</h3>';
    echo '<p>' . $restaurant . '</p>';
    echo '<p>' . $reservation['user_name'] . '</p>';
    echo '<p>' . $reservation['party_size'] . '</p>';
  }
}

?>

