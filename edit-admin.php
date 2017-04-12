<?php ob_start();
require_once('auth.php');
//set up the title
$page_title = 'Create User';
// embed the header
require_once('header.php');

//check the url for a admin_id parameter and store the value in a variable if we find one
if (empty($_GET['admin_id']) == false) {
    $admin_id = $_GET['admin_id'];


    try {
        //connect to the database
        require_once('db.php');

        //write the sql query
        $sql = "SELECT * FROM administrators WHERE admin_id = :admin_id";

        //execute the query and store the results
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        $cmd->execute();
        $admins = $cmd->fetchAll();

        //populate the fields for the selected admin from the query result
        foreach ($admins as $admin) {
            $username = $admin['username'];
        }

        //disconnect from the database
        $conn = null;
    }catch(Exception $e){
        header('location:error.php');
        mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
    }
}
?>
    <main class="container">
        <h1>Register</h1>

        <form method="post" action="save-adminRegistration.php">
            <fieldset class="form-group">
                <label for="username">Email:</label>
                <input class="u-full-width" name="username" id="username" required type="email" value="<?php echo $username; ?>" placeholder="example@gmail.com"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="password">Password:</label>
                <input class="u-full-width" name="password" required type="password" placeholder="**********"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="confirm">Confirm:</label>
                <input class="u-full-width" name="confirm" required type="password" placeholder="**********">
            </fieldset>
            <input name="admin_id" type="hidden" value="<?php echo $admin_id; ?>" />
            <button type="submit" class="button-primary">Register</button>
        </form>
    </main>
<?php
require_once('footer.php');
ob_flush();
?>