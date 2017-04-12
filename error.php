<?php
$page_title = 'COMP1006 App - Yikes!';
require_once('header.php');
?>
<?php
//if there is an error get it and display it
if($error = $_GET['error']) {
    echo $error;
}else{
?>
    <main class="container">

        <h1>We're Sorry!</h1>

        <p class="errormsg">Something unexpected just happened.  Our support team has been notified and will get right on it.</p>
    </main>
    <?php }
require_once('footer.php');
?>