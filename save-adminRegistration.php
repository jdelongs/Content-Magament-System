<?php ob_start();
$page_title = 'Save Admin';
include_once('header.php');
//1. store form inputs in variables
$admin_id = $_POST['admin_id'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

$ok = true;
//2. validate the inputs - no blanks, matching password
if(empty($username)){
    echo 'A username is required <br />';
    $ok = false;
}
//3. if inputs are ok connect
if (empty($password)){
    echo 'password is required <br />';
    $ok = false;
}
if (empty($confirm)){
    echo 'Confirming your password is required <br />';
    $ok = false;
}
if ($password != $confirm){
    echo 'passwords must match <br />';
    $ok = false;
}
//if the username is greater than 0 in the database say that username already exists
if(count($admin) > 0)
{
    echo 'Username already exists';
    $ok = false;
}
//3. if inputs are ok connect
if($ok) {


    try {

        require_once('db.php');

        $sql1 = "SELECT username FROM administrators WHERE username = '.$username.' ";
        $cmd = $conn->prepare($sql1);
        $cmd->execute();
        $admin = $cmd->fetchAll();


        if (empty($admin_id) == true){
            //set up the sql command
            $sql = "INSERT INTO administrators (username, password) VALUES (:username, :password)";
        }else{
            $sql ="UPDATE administrators SET username = :username, password = :password WHERE admin_id = :admin_id";
        }



        //5. hash the password for added security
        $hashed_password = hash('sha512', $password);

        //6. execute the save
        $cmd = $conn->prepare($sql);

        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $hashed_password, PDO::PARAM_STR, 128);

        if(!empty($admin_id))
        {
            $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        }
        $cmd->execute();

        //7. disconnect
        $conn = null;
        //catch error
    }catch(Exception $e){
        header('location:error.php?error=Username%20already%20exists');
        mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
    }
    //8. show a confirmation message to the user
    echo 'registration has been submitted';
}
include_once('footer.php');
ob_flush(); ?>
