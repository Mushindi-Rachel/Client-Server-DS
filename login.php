<?php include_once('config.php');

$email = $_POST['email'];
$password = $_POST['pass'];

$email = stripcslashes($email);
$password = stripcslashes($password);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

$sql = "select * from users where email='$email' and password='$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count > 0){
    			header("Location: index.html");
			exit();
		} else {
			// Password is incorrect
			echo"<script>alert('invalid email or password')</script>";
                    }
{
            header("Location: login.html");
        }


?>

