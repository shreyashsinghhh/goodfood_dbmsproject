<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style.css">
<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style1.css">

<?php

$db = new PDO('mysql:host=localhost;dbname=shreyashdb');

$restaurant_name = $_POST['restaurant_name'];
$cuisine_name = $_POST['cuisine_name'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];
$owner_id = $_POST['owner_id'];
$tag_name = $_POST['tag_name'];

$query = 'SELECT * FROM restaurants WHERE restaurant_name = :restaurant_name';
$statement = $db->prepare($query);
$statement->bindParam(':restaurant_name', $restaurant_name);
$statement->execute();

$row = $statement->fetch_assoc();

if ($row) {
  echo 'The restaurant name already exists.';
  exit;
}

$query = 'SELECT id FROM cuisine WHERE name = :cuisine_name';
$statement = $db->prepare($query);
$statement->bindParam(':cuisine_name', $cuisine_name);
$statement->execute();

$row = $statement->fetch_assoc();

$cuisine_id = $row['id'];

$query = 'INSERT INTO restaurants (restaurant_name, address, phone_number, owner_id) VALUES (:restaurant_name, :address, :phone_number, :owner_id)';
$statement = $db->prepare($query);
$statement->bindParam(':restaurant_name', $restaurant_name);
$statement->bindParam(':address', $address);
$statement->bindParam(':phone_number', $phone_number);
$statement->bindParam(':owner_id', $owner_id);
$statement->execute();

$restaurant_id = $db->lastInsertId();

$query = 'SELECT id FROM tags WHERE name = :tag_name';
$statement = $db->prepare($query);
$statement->bindParam(':tag_name', $tag_name);
$statement->execute();

$row = $statement->fetch_assoc();

$tag_id = $row['id'];

$query = 'INSERT INTO restaurant_tags (restaurant_id, tag_id) VALUES (:restaurant_id, :tag_id)';
$statement = $db->prepare($query);
$statement->bindParam(':restaurant_id', $restaurant_id);
$statement->bindParam(':tag_id', $tag_id);
$statement->execute();

header('Location: owner_dashboard.php');

?>
