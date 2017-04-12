<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $page_title; ?></title>
        <!--link to stylesheets-->
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="normalize.css">
        <link rel="stylesheet" href="skeleton.css">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
    <nav class="navbar">
        <ul class="nav">
            <li class="navlist">
                <?php
                $dirname = "uploads/";
                $images = glob($dirname."*.png");

                foreach($images as $image) {
                echo '<img src="'.$image.'" width="70" height="70"/><br />';
                }
                ?>
            </li>
            <li class="navlist">
                <a href="get-admins.php" title="COMP1006-Assignment-2" class="nav">COMP1006 Assignment 2</a>
            </li>
            <?php if(!empty($_SESSION['admin_id'])) { ?>
                <li class="navlist">
                    <a href="pages.php" title="pages" class="nav">Pages</a>
                </li>

                <li class="navlist">
                    <a href="get-admins.php" title="get-admins" class="nav">Admins</a>
                </li>
                <li class="navlist">
                    <a href="logo.php" title="logo" class="nav">Logo</a>
                </li>
                <li class="navlist" id="logout">
                    <a href="logout.php" title="logout" class="nav">Log Out</a>
                </li>
                <?php
            }
            else{ ?>
                <?php
                $conn = new PDO('mysql:host=sql.computerstudi.es;dbname=gc200339389', 'gc200339389', 'dFqU^s25');
                $sql = "SELECT * FROM pag";
                $cmd = $conn->prepare($sql);
                $cmd->execute();
                $arraypages = $cmd->fetchAll();

                foreach ($arraypages as $page){
                    echo '<li class="navlist"><a class="nav" href="default.php?page_id=' . $page['page_id'] . '">' . $page['pages'] . '</a></li>';
                }
                $conn = null;
                ?>
                <li id="register" class="navlist">
                    <a href="adminRegister.php" title="register" class="nav">Register</a>
                </li>

                <li class="navlist" id="login">
                    <a href="login.php" title="Login" class="nav">Login</a>
                </li>
            <?php }?>
        </ul>
    </nav>

    <!-- page content starts here -->
