<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style.css">
<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style1.css">

<?php

$db = new PDO('mysql:host=localhost;dbname=shreyashdb');

$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$reservation_date = $_POST['reservation_date'];
$party_size = $_POST['party_size'];

$user_id = $_SESSION['user_id'];
$restaurant_id = $_POST['restaurant_id'];

$query = 'SELECT * FROM reservations WHERE reservation_date = :reservation_date AND restaurant_id = :restaurant_id';
$statement = $db->prepare($query);
$statement->bindParam(':reservation_date', $reservation_date);
$statement->bindParam(':restaurant_id', $restaurant_id);
$statement->execute();

$row = $statement->fetch_assoc();

if ($row) {
  echo 'The reservation date is already taken.';
  exit;
}

$query = 'INSERT INTO reservations (user_id, restaurant_id, reservation_date, party_size) VALUES (:user_id, :restaurant_id, :reservation_date, :party_size)';
$statement = $db->prepare($query);
$statement->bindParam(':user_id', $user_id);
$statement->bindParam(':restaurant_id', $restaurant_id);
$statement->bindParam(':reservation_date', $reservation_date);
$statement->bindParam(':party_size', $party_size);
$statement->execute();

$to = $user_email;
$subject = 'Reservation Confirmation';
$message = 'Thank you for your reservation at our restaurant. Your reservation is confirmed for ' . $reservation_date . ' for a party of ' . $party_size . '.';
mail($to, $subject, $message);

header('Location: owner_dashboard.php');

?>
