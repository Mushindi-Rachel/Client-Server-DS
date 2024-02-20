<?php
// Include the database configuration file
include_once 'config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if (isset($_POST['search'])) {
    // Get the registration number from the form
    $reg_no = $_POST['reg_no'];

    // Prepare the SQL statement to retrieve data based on the registration number
    $stmt = $conn->prepare("SELECT * FROM student WHERE Reg_No = ?");
    $stmt->bind_param("s", $reg_no);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if rows are found
    if ($result->num_rows > 0) {
        // Display contact information in a table
        echo "<h2>Contact Information:</h2>";
        echo "<table>
                <tr>
                    <th>Registration Number</th>
                    <th>Email Address</th>
                    <th>Mobile Number</th>
                    <th>Address</th>
                </tr>";
        // Fetch data and display it in the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Reg_No'] . "</td>";
            echo "<td>" . $row['Email_Address'] . "</td>";
            echo "<td>" . $row['Mobile_No'] . "</td>";
            echo "<td>" . $row['Postal_Address'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // No details found for the given registration number
        echo "No details found for Registration number: $reg_no";
    }

    // Close the statement and database connection
    $stmt->close();
    mysqli_close($conn);
}
?>
