<?php ob_start();
//make and authorize page
require_once('auth.php');
//embed the header
require_once('header.php');

$image = null;
//check for a upload if one
    $ok = true;
    //if the image isnt empty
    if (!empty($_FILES['image'])) {
        //store the name of the image
        $name = $_FILES['image']['name'];
        //check the name behind the last period
        $arr = end(explode('.', $name));

        //set everthing in the array to lower case
        $type = strtolower($arr);

        //check file names
        $filesTypes = ['png', 'gif', 'jpg', 'svg'];

        //if the image is not a valid image type
        if (!in_array($type, $filesTypes)) {
            echo 'invalid image type <br />';
            $ok = false;
        }

        $size = $_FILES['image']['size'];
        //validate the size of the image
        if ($size > 2048000) {
            echo 'Cover Image must be less then 2mb <br />';
            $ok = false;
        }
        if($ok == true) {
            //rename the file to a unique name
            $image = "logo.png";
            //copy to images
            $tempName = $_FILES['image']['tmp_name'];
            move_uploaded_file($tempName, "uploads/$image");
            //show a confirmation message to the user
            echo 'photo has been added';
        }

    }


include_once('footer.php');
ob_flush(); ?>
