<?php include_once('config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="body">
        <header>
            <h1>Welcome!</h1>
            <form id="formsearch" class="search" action="index.php">
                <input type="search" placeholder="Search registration number" name="reg_no">
                <button id="searchButton" type="submit" name="search_btn">Search</button>
            </form>
    
            <p>Please fill in the form</p>

        </header>
        <section>

            <div class="details">
                <form class="DetailForm" id="form" action="register.php" method="post">
                    <label class="form">Registration number:</label><br>
                    <input type="text" name="reg_no"><br><br>
                    <label class="form">Email address:</label><br>
                    <input type="email" name="email"><br><br>
                    <label class="form">Mobile number:</label><br>
                    <input type="tel" name="phone_no"><br><br>
                    <label class="form">Post office address:</label><br>
                    <input type="text" name="postal_code"><br><br>

                    <button id="butn">Save Details</button>

                </form>
            </div>
        </section>
    </div>

    <table id="contactDetailsTable" class="contact-details-table">
    
              
        </thead>
        <tbody id="contactDetailsBody">
           
        </tbody>
    </table>
    <div>
    <?php 
    if (isset($_POST['search'])) {
        $reg_no = $_POST['reg_no'];
        
        // Retrieve data from database
        $sql = "SELECT * FROM student WHERE Reg_No='$reg_no'";
        $result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
		echo"<h2>Contact Information:</h2>";
		echo " <table>
		<tr>
			<th>Registration Number</th>
			<th>Email Address</th>
			<th>Mobile Number</th>
			<th>Address</th>
		</tr>";
	   
                echo '<tr>'
                 .'<td>'.$row['Reg_No'].'</td>'.
                 '<td>'.$row['Email_Address'].'</td>'.
                 "<td>".$row['Mobile_No']."</td>".
                 "<td>".$row['Postal_Address']."</td>".
                 '</tr>';
echo '</table>';
}
else{
echo "No details found for Registration number: $reg_no";
}}
?>
</div>

</body>

</html>