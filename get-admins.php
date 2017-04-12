<?php ob_start();

//make sure that only authorized users can enter
require_once('auth.php');

//set page title to Admin
$page_title = 'Admin';

//embed the header
require_once('header.php');


try{

    //connect to the database
    require_once('db.php');

    //set up the sql query
    $sql = "SELECT * FROM administrators";

    //run the query and store the results
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $admin = $cmd->fetchAll();
    echo '<a href="adminRegister.php" title="new admin" class="button">Add a new admin</a>';
    //start out grid
    echo '<table class="table table-striped"><thead><th>Username</th><th>Edit</th><th>Delete</th></thead><tbody>';
    //create a loop that goes through the query results and display
    foreach ($admin as $admins) {
        echo '<tr><td>' . $admins['username'] . '</td>
				<td><a class="btn btn-info" href="edit-admin.php?admin_id=' . $admins['admin_id'] . '">Edit</a></td>
				<td><a class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this admin ? \');" href="delete-admin.php?admin_id=' . $admins['admin_id'] . '">Delete</a></td></tr>';
    }
    //close the grid
    echo '</tbody></table>';
    //disconnect
    $conn = null;
}catch (Exception $e){
    header('location:error.php');
    mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
}

require_once("footer.php");
ob_flush();
?>
