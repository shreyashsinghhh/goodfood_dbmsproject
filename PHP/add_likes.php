<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style.css">
<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style1.css">

<?php

$user_id = $_SESSION['user_id'];
$restaurant_id = $_GET['restaurant_id'];

$sql = "SELECT * FROM likes WHERE user_id = :user_id AND restaurant_id = :restaurant_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':restaurant_id', $restaurant_id);
$stmt->execute();
$row = $stmt->fetch();

if ($row === false) {
  $sql = "INSERT INTO likes (user_id, restaurant_id) VALUES (:user_id, :restaurant_id)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':user_id', $user_id);
  $stmt->bindParam(':restaurant_id', $restaurant_id);
  $stmt->execute();
}

header('Location: /restaurant_details/' . $restaurant_id);

?>
