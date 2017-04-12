<?php ob_start();

require_once('auth.php');

// capture the selected page_id from the url and store it in a variable with the same name
$page_id = $_GET['page_id'];
try {
    require_once('db.php');

    //write the sql query
    $sql = "DELETE FROM pag WHERE page_id = :page_id";

    //create a command object so we can populate the page_id value, the run the deletion
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
    $cmd->execute();

    //disconnect
    $conn = null;
}catch(Exception $e){
    header('location:error.php');
    mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
}
//redirect the user back to pages.php
header('location:pages.php');

require_once('footer.php');
ob_flush();?>