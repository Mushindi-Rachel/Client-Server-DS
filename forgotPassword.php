<?php 
include_once('config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

$error = '';

function generateRandomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $password = array(); 
    $alpha_length = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alpha_length);
        $password[] = $alphabet[$n];
    }
    return implode($password); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['mail']; 
        // Check if the email exists in the database
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $error = "Email address not found";
        } else {
            // Generate a new password
            $new_password = generateRandomPassword();
                
            // Update the user's password in the database
            $query = "UPDATE users SET password='$new_password' WHERE email='$email'";
            if (!mysqli_query($conn, $query)) {
                $error = "Error updating password: " . mysqli_error($conn);
            } else {
                // Send a password reset email to the user's email address
                try {
                    // Get user's name
                    $name_row = mysqli_fetch_array(mysqli_query($conn, "SELECT name FROM users WHERE email='$email'"));
                    $name = $name_row['name'];

                    // Instantiate PHPMailer
                    $mail = new PHPMailer(true);

                    // Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';  
                    $mail->SMTPAuth = true;
                    $mail->Username = 'lizabee202@gmail.com'; 
                    $mail->Password = 'xywo eehj ssja gtqk'; 
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    //Recipients
                    $mail->setFrom('lizabee202@gmail.com', 'Eschool');
                    $mail->addAddress($email);  

                    //Content
                    $mail->isHTML(false);  // Set email format to plain text
                    $mail->Subject = 'Password Reset';
                    $mail->Body = "Hi $name,\n\nYou are receiving this because you (or someone else) have requested the reset of the password for your account.\n\nYour new password is: $new_password";

                    // Send email
                    $mail->send();

                    // Redirect the user to a confirmation page
                    header("Location: login.html");
                    exit;
                } catch (Exception $e) {
                    $error = "Error sending email: " . $e->getMessage();
                }
            }
        }
    }
// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div id="response">

        <form action="forgotPassword.php" id="form" method="post">
            <h2 style="font-weight: bold; color: blue;">Reset password</h2>

            <label for="email" style="font-size: 1.5rem;">Enter your email to reset password:</label><br>
            <input type="email" name="mail" required><br><br>
            <input type="submit" name="submit" value="Reset Password" id="reset-password-btn">
        </form>
        <?php if($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>