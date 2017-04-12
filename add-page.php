<?php ob_start();
require_once('auth.php');
//set up the title
$page_title = 'Add Page';
//embed the header
require_once('header.php');

// check the url for a page_id parameter and store the value in a variable if we find one
if (empty($_GET['page_id']) == false) {
    $page_id = $_GET['page_id'];


    try {
        //connect to the database
        require_once('db.php');

        //Set up mySql query
        $sql = "SELECT * FROM pag WHERE page_id = :page_id";

        //execute the query and store the results
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        $cmd->execute();
        $arpages = $cmd->fetchAll();

        //populate the fields for the selected admin from the query result
        foreach ($arpages as $page) {
            $pages = $page['pages'];
            $content = $page['content'];
        }

        //disconnect from the database
        $conn = null;
    }catch(Exception $e){
        header('location:error.php');
        mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
    }
}
?>
    <main class="container" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        <h1>Add A Page</h1>

        <form method="post" action="save-page.php">
            <fieldset class="form-group">
                <label for="pages">Page Name:</label>
                <input class="u-full-width" name="pages" type="text" value="<?php echo $pages; ?>" />
            </fieldset>
            <fieldset class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" class="u-full-width" id="content" ><?php echo $content; ?></textarea>
            </fieldset>
            <input name="page_id" type="hidden" value="<?php echo $page_id; ?>" />
            <button type="submit" class="button-primary">Add Page</button>
        </form>
    </main>
<?php
//embed the foooter
require_once('footer.php');
ob_flush();
?>