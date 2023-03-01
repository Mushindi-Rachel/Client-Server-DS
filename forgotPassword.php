<?php include_once('config.php');

$conn;
if(isset($_POST['submit'])) {

    // get the user's email address
    $email = $_POST['mail'];
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

    // generate a new password
    $new_password = generateRandomPassword();

    // update the user's password in the database
    $query = "UPDATE users SET password='$new_password' WHERE email='$email'";
    mysqli_query($conn, $query);
    mysqli_close($conn);

    // send the new password to the user's email address
    $to_email = $email;
    $subject = "Reset password";
    $body = "You can reset your password by clicking on the link ";
    $headers = "From: mushindi@gmail.com";
    
    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";
    }


}
?>