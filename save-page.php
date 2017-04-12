<?php ob_start();
require_once('auth.php');
$page_title = 'Save page';
include_once('header.php');
//1. store form inputs in variables
$page_id = $_POST['page_id'];
$pages = $_POST['pages'];
$content = $_POST['content'];


$ok = true;

//if inputs are ok connect
if($ok) {


    try {

        require_once('db.php');



        if (empty($page_id) == true){
            //set up the sql command
            $sql = "INSERT INTO pag (pages, content) VALUES (:pages, :content)";
        }else{
            $sql ="UPDATE pag SET pages = :pages, content = :content WHERE page_id = :page_id";
        }



        //execute the save
        $cmd = $conn->prepare($sql);

        $cmd->bindParam(':pages', $pages, PDO::PARAM_STR, 50);
        $cmd->bindParam(':content', $content, PDO::PARAM_STR, 200);

        if(!empty($page_id))
        {
            $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
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
    echo 'Page has been Added';

}
include_once('footer.php');
ob_flush(); ?>
