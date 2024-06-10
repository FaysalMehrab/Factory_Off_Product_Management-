<?php
session_start();
@include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header('location:login_form.php');
    exit;
}

$id = $_SESSION['admin_id'];
$sql = "SELECT * FROM login_info WHERE id = $id";

// Execute the Query
$res = mysqli_query($connect, $sql);

// Check whether the query executed successfully or not
if ($res == true) {
    $row = $res->fetch_assoc();

    // Store the retrieved information in variables
    $id = $row['id'];
    $nid = $row['nid'];
    $name = $row['name'];
} else {
    echo 'No user found with the provided ID.';
    exit;
}

$message = '';

// Check if there's a message in the session and display it
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $board_name = $_POST['board_name'];
    $length_width = $_POST['length_width'];
    $entry_date = $_POST['entry_date'];
    $entry_ammount = $_POST['entry_ammount'];
    $usage = $_POST['usage_of_board'];
    $category = $_POST['Category'];
    
    $insert_query = "INSERT INTO off_entry (board_name, length_width, entry_date, entry_ammount, usage_of_board, Category) VALUES ('$board_name', '$length_width', '$entry_date', '$entry_ammount', '$usage', '$category')";
   
    if (mysqli_query($connect, $insert_query)) {
        $_SESSION['message'] = "<p style='color:green; text-align:center;'>Data submitted successfully!</p>";
        
        // Check if the board name already exists in the 'available' table
        $check_query = "SELECT * FROM available WHERE board_name = '$board_name' and length_width = '$length_width'";
        $check_result = mysqli_query($connect, $check_query);
        
        if ($check_result) {
            if (mysqli_num_rows($check_result) > 0) {
                // If the board name exists, update the record
                $update_query = "UPDATE available SET available = available + $entry_ammount WHERE board_name = '$board_name' and length_width = '$length_width'";
                mysqli_query($connect, $update_query);
            } else {
                // If the board name doesn't exist, insert a new record
                $insert_available_query = "INSERT INTO available (board_name, length_width, category, available, usage_of_board) VALUES ('$board_name', '$length_width', '$category', '$entry_ammount', '$usage')";
                mysqli_query($connect, $insert_available_query);
            }
        } else {
            $_SESSION['message'] = "<p style='color:red; text-align:center;'>Error: " . mysqli_error($connect) . "</p>";
        }
        
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
    <title>Admin Home Page</title>
    <link rel="stylesheet" type="text/css" href="../css/user_page.css">
</head>
<body>

<div class="top-right-buttons">
    <a href="../admin/register_info.php" class="button">Registration Information</a>
    <a href="../logout.php" class="button">Logout</a>
    <a href="../admin/off_exit.php" class="btn">Off Board Exit</a>
</div>

<h3>Admin Home Page</h3>

<ul id="options">
    <h2>Welcome <span><?php echo htmlspecialchars($name); ?></span></h2>
</ul>

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
        
        <label for="entry_date">Entry Date:</label>
        <input type="date" id="entry_date" name="entry_date" required>
        
        <label for="entry_ammount">Entry Amount:</label>
        <input type="number" id="entry_ammount" name="entry_ammount" placeholder="Enter Amount" required>

        <label for="Category">Category:</label>
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
    <h3>Off Entry Data</h3>
    <table>
        <tr>
            <th>S.No</th>
            <th>Board Name</th>
            <th>Width X Length</th>
            <th>Entry Date</th>
            <th>Entry Amount</th>
            <th>Category</th>
            <th>Remarks</th>
        </tr>
        <?php
        $select_query = "SELECT * FROM off_entry";
        $result = mysqli_query($connect, $select_query);
        $serial_number = 1;

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$serial_number}</td>
                        <td>{$row['board_name']}</td>
                        <td>{$row['length_width']}</td>
                        <td>{$row['entry_date']}</td>
                        <td>{$row['entry_ammount']}</td>
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
