<?php
session_start();
@include '../config.php';

$message = '';

// Check if there's a message in the session and display it
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $board_name = $_POST['board_name'];
    $length_width = $_POST['length_width'];
    $exit_date = $_POST['exit_date'];
    $exit_ammount = $_POST['exit_ammount'];
    $usage = $_POST['usage_of_board'];
    $Category = $_POST['Category'];

    $insert_query = "INSERT INTO off_exit (board_name, length_width, exit_date, exit_ammount, usage_of_board, Category) VALUES ('$board_name', '$length_width', '$exit_date', '$exit_ammount', '$usage', '$Category')";

    if (mysqli_query($connect, $insert_query)) {
        $_SESSION['message'] = "<p style='color:green; text-align:center;'>Data submitted successfully From Off Board Exit!</p>";

        // Update the available amount by subtracting the exit amount
        $update_query = "UPDATE available SET available = available - $exit_ammount WHERE board_name = '$board_name' and length_width = '$length_width'";
        mysqli_query($connect, $update_query);

        // Redirect to the same page to prevent form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['message'] = "<p style='color:red; text-align:center;'>Error: " . mysqli_error($connect) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Off Board Exit</title>
   <link rel="stylesheet" type="text/css" href="../css/user_page.css">
</head>
<body>

<div class="top-right-buttons">
    <a href="../admin/admin_home.php" class="button">Back to Admin Home</a>
    <a href="../admin/register_info.php" class="button">Registration Information</a>
    <a href="../logout.php" class="button">Logout</a>
</div>

<h3>Off Board Exit</h3>

<?php
// Display the message if set
if (!empty($message)) {
    echo $message;
}
?>

<div class="form-container">
    <form action="" method="POST">
        <label for="board_name">Board Name:</label>
        <select id="board_name" name="board_name" required>
            <option value="12-MM MDF One Side Veneer(Beech)">12-MM MDF One Side Veneer(Beech)</option>
            <option value="15-MM MDF One Side Veneer(Beech)">15-MM MDF One Side Veneer(Beech)</option>
            <option value="18-MM MDF One Side Veneer(Beech)">18-MM MDF One Side Veneer(Beech)</option>
            <option value="12-MM MDF Plain">12-MM MDF Plain</option>
            <option value="15-MM MDF Plain">15-MM MDF Plain</option>
            <option value="18-MM MDF Plain">18-MM MDF Plain</option>
            <option value="16-MM Melamine(LB)">16-MM Melamine(LB)</option>
            <option value="16-MM Antic(LB)">16-MM Antic(LB)</option>
        </select>
        
        <label for="length_width">Width X Length:</label>
        <input type="text" id="length_width" name="length_width" placeholder="Enter Width X Length" required>
        
        <label for="exit_date">Exit Date:</label>
        <input type="date" id="exit_date" name="exit_date" required>
        
        <label for="exit_ammount">Exit Amount:</label>
        <input type="number" id="exit_ammount" name="exit_ammount" placeholder="Enter Exit amount" required>

        <label for="Category">Category</label>
        <select id="Category" name="Category" required>
            <option value="A">A[^400 X 600]</option>
            <option value="B">B[^300 X 400]</option>
            <option value="C">C</option>    
        </select>

        <label for="usage_of_board">Usage of Board:</label>
        <textarea id="usage_of_board" name="usage_of_board" placeholder="Enter usage details" required></textarea>
        
        <button type="submit">Submit</button>
    </form>
</div>

<div class="table-container">
    <h3>Available Boards</h3>
    <table>
        <tr>
            <th>S.No</th>
            <th>Board Name</th>
            <th>Width X Length</th>
            <th>Category</th>
            <th>Available Amount</th>
        </tr>
        <?php
        $select_query = "SELECT * FROM available";
        $result = mysqli_query($connect, $select_query);
        $serial_number = 1;

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$serial_number}</td>
                        <td>{$row['board_name']}</td>
                        <td>{$row['length_width']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['available']}</td>
                      </tr>";
                $serial_number++;
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center;'>No data available</td></tr>";
        }
        ?>
    </table>
</div>

<div class="table-container">
    <h3>Off Exit Data</h3>
    <table>
        <tr>
            <th>S.No</th>
            <th>Board Name</th>
            <th>Width and Length</th>
            <th>Exit Date</th>
            <th>Exit Amount</th>
            <th>Category</th>
            <th>Remarks</th>
        </tr>
        <?php
        $select_query = "SELECT * FROM off_exit";
        $result = mysqli_query($connect, $select_query);
        $serial_number = 1;

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$serial_number}</td>
                        <td>{$row['board_name']}</td>
                        <td>{$row['length_width']}</td>
                        <td>{$row['exit_date']}</td>
                        <td>{$row['exit_ammount']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['usage_of_board']}</td>
                      </tr>";
                $serial_number++;
            }
        } else {
            echo "<tr><td colspan='7' style='text-align:center;'>No data available</td></tr>";
        }
        ?>
    </table>
</div>


</body>
</html>
