<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style.css">
<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style1.css">

<?php

$db = new PDO('mysql:host=localhost;dbname=shreyashdb');

$username = $_POST['username'];
$password = $_POST['password'];

$query = 'SELECT * FROM user WHERE username = :username AND password = :password';
$statement = $db->prepare($query);
$statement->bindParam(':username', $username);
$statement->bindParam(':password', $password);
$statement->execute();

$row = $statement->fetch_assoc();

if ($row) {
  $user_id = $row['user_id'];
  $_SESSION['user_id'] = $user_id;

  header('Location: user_dashboard.php');
} else {
  echo 'Invalid username or password.<br>';
  echo '<meta http-equiv="refresh" content="2;url=login.php">';
}

?>