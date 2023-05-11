<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style.css">
<link rel="stylesheet" href="D:\Personal\Projects\Social Media for Foodies Using DBMS\DBS-Project-frontend-main\css\style1.css">

<?php

$db = new PDO('mysql:host=localhost;dbname=shreyashdb');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$query = 'SELECT * FROM user WHERE username = :username';
$statement = $db->prepare($query);
$statement->bindParam(':username', $username);
$statement->execute();

$row = $statement->fetch_assoc();

if ($row) {
  echo 'The username ' . $username . ' already exists.';
} else {
  $query = 'INSERT INTO user (username, password, email) VALUES (:username, :password, :email)';
  $statement = $db->prepare($query);
  $statement->bindParam(':username', $username);
  $statement->bindParam(':password', $password);
  $statement->bindParam(':email', $email);
  $statement->execute();

  echo 'You have been signed up successfully.<br>';
  echo '<meta http-equiv="refresh" content="2;url=home.php">';
}

?>
