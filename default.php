<?php
require_once('header.php');
require_once('db.php');
if (empty($_GET['page_id']) == false) {
    $page_id = $_GET['page_id'];

    try {
        //connect to the database
        require_once('db.php');

        //write the sql query
        $sql = "SELECT * FROM pag WHERE page_id = :page_id";

        //execute the query and store the results
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        $cmd->execute();
        $araypages = $cmd->fetchAll();

        //populate the fields for the selected book from the query result
        foreach ($araypages as $currentpage) {
           echo '<h1>' . $pages = $currentpage['pages'] . '</h1>';
           echo '<p>' . $content = $currentpage['content'] . '</p>';

        }

        // disconnect
        $conn = null;
    }catch(Exception $e){
        header('location:error.php');
        mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
    }
}
//embed  the footer
require_once('footer.php');
?>

