<?php ob_start();

require_once('auth.php');

//capture the selected admin_id from the url and store it in a variable with the same name
$admin_id = $_GET['admin_id'];
try {
    require_once('db.php');

    //write the sql commmand
    $sql = "DELETE FROM administrators WHERE admin_id = :admin_id";

    //create a command object so we can populate the admin_id value, the run the deletion
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $cmd->execute();

    //disconnect
    $conn = null;
}catch(Exception $e){
    header('location:error.php');
    mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
}
//redirect the user back to get-admins.php
header('location:get-admins.php');
//embed the footer
require_once('footer.php');
ob_flush();?>