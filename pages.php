<?php ob_start();

//make sure that only authorized users can enter
require_once('auth.php');

// set page title to admins
$page_title = 'Edit Pages';

//embed the header
require_once('header.php');


try{

    //connect to the database
    require_once('db.php');

    //set up the sql query
    $sql = "SELECT * FROM pag";

    //run the query and store the results
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $pages = $cmd->fetchAll();
    echo '<a href="add-page.php" title="new admin" class="button">Add a new Page</a>';
    //start out grid
    echo '<table class="table table-striped"><thead><th>Page</th><th>Edit</th><th>Delete</th></thead><tbody>';
    //create a loop that goes through the query results and display
    foreach ($pages as $page) {
        echo '<tr><td>' . $page['pages'] . '</td>
				<td><a class="btn btn-info" href="add-page.php?page_id=' . $page['page_id'] . '">Edit</a></td>
				<td><a class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this page? \');" href="delete-page.php?page_id=' . $page['page_id'] . '">Delete</a></td></tr>';
    }
//close the grid
    echo '</tbody></table>';
//each record on our page
    $conn = null;
}catch (Exception $e){
    header('location:error.php');
    mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
}

require_once("footer.php");
ob_flush();
?>
