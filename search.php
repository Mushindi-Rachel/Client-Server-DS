<?php include_once('config.php');

if (isset($_POST['search'])) {
    $reg_no = $_POST['reg_no'];
  
    // Retrieve data from database
    $sql = "SELECT * FROM student WHERE Reg_No='$reg_no'";
    $result = mysqli_query($conn, $sql);
  
    //   Display data in the form
    if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		echo json_encode($row);
	} else {
		echo json_encode(array('error' => 'No information found'));
	}
}
	// Close database connection
	mysqli_close($conn);
?>
