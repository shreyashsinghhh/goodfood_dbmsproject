<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style.css">
<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style1.css">

<?php

$db = new PDO('mysql:host=localhost;dbname=shreyashdb');

$owner_email = $_POST['owner_email'];
$owner_password = $_POST['owner_password'];

$query = 'SELECT * FROM restaurant_owners WHERE owner_email = :owner_email AND owner_password = :owner_password';
$statement = $db->prepare($query);
$statement->bindParam(':owner_email', $owner_email);
$statement->bindParam(':owner_password', $owner_password);
$statement->execute();

$row = $statement->fetch_assoc();

if ($row) {
  $owner_id = $row['owner_id'];
  $_SESSION['owner_id'] = $owner_id;

  header('Location: owner_dashboard.php');
} else {
  echo 'Invalid owner name or password.<br>';
  echo '<meta http-equiv="refresh" content="2;url=owner_login.php">';
}

?>