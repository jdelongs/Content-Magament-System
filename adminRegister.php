<?php ob_start();

//set up the title
$page_title = 'Create User';
//embed the header
require_once('header.php');

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