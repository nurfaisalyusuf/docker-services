<?php 
phpinfo();
$servername = "db_percona-server";
$username = "root";
$password = "secret";

// try {
//   $conn = new PDO("mysql:host=$servername;port=3306;dbname=test", $username, $password);
//   // set the PDO error mode to exception
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully pdo";
// } catch(PDOException $e) {
//   echo "Connection failed: " . $e->getMessage();
// }

// $mysqli = new mysqli($servername,$username,$password,"test");
// if ($mysqli -> connect_errno) {
//   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
//   exit();
// } else {
//   echo "Connected successfully mysqli";
// }
?>