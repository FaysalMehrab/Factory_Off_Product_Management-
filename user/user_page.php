<?php
    @include '../config.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('location:login_form.php');
        exit;
    }
    $id = $_SESSION['user_id'];
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

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/user_page.css">

</head>
<body>




<div class="top-right-buttons">
    
    <a href="../logout.php" class="button">Logout</a>
    
</div>


    <ul id="options">
      <h2>Welcome <span><?php echo $name?></span> </h2>
      
    </ul>




<div class="table-container">
    <h3>Available Boards</h3>
    <table>
        <tr>
            <th>S.No</th>
            <th>Board Name</th>
            <th>Width X Length</th>
            <th>Category</th>
            <th>Available Amount</th>
            <th>Remarks</th>
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
                        <td>{$row['usage_of_board']}</td>
                      </tr>";
                $serial_number++;
            }
        } else {
            echo "<tr><td colspan='6' style='text-align:center;'>No data available</td></tr>";
        }
        ?>
    </table>
</div>





</body>
</html>
