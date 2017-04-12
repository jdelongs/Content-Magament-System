<?php
require_once('auth.php');
require_once('header.php');
?>

<form action = "upload.php" method = "POST" enctype = "multipart/form-data">
    <input type="file" name="image" />
    <input name="photo_id" type="hidden" value="<?php echo $photo_id?>" />
    <input type = "submit"/>


</form>
<?php require_once('footer.php')?>