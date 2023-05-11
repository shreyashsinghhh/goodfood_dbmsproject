<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style.css">
<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style1.css">

<?php

$db = new PDO('mysql:host=localhost;dbname=shreyashdb');

$owner_name = $_POST['owner_name'];
$owner_email = $_POST['owner_email'];
$owner_password = $_POST['owner_password'];

$query = 'SELECT * FROM restaurant_owners WHERE owner_name = :owner_name';
$statement = $db->prepare($query);
$statement->bindParam(':owner_name', $owner_name);
$statement->execute();

$row = $statement->fetch_assoc();

if ($row) {
  echo 'The owner name ' . $owner_name . ' already exists.';
} else {
  $query = 'INSERT INTO restaurant_owners (owner_name, owner_email, owner_password) VALUES (:owner_name, :owner_email, :owner_password)';
  $statement = $db->prepare($query);
  $statement->bindParam(':owner_name', $owner_name);
  $statement->bindParam(':owner_email', $owner_email);
  $statement->bindParam(':owner_password', $owner_password);
  $statement->execute();

  echo 'You have been signed up successfully.<br>';
  echo '<meta http-equiv="refresh" content="2;url=home.php">';
}

?>
