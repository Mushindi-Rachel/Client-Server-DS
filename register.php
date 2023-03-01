<?php include_once('config.php');
$conn;


$reg_no= $_POST['reg_no'];
$email= $_POST['email'];
$phone_no= $_POST['phone_no'];
$postal_code= $_POST['postal_code'];

$sql = $conn->query("INSERT INTO student VALUES('$reg_no', '$email', '$phone_no', '$postal_code')");

echo "<script>alert('User details submitted successfully');</script>";


$conn->close();
header('Location: index.html');
?>