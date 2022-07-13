<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";
if(isset($_POST['submit'])){
$name = $_POST['name'];
$phone = $_POST['phone'];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "insert into entry (name,phone) values('$name','$phone')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
unset($_POST);
header("Location: " . $_SERVER['PHP_SELF']);   
$conn->close();
}
?>