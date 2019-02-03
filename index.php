<?php 
session_start();
include_once "views/classes.php";
include_once "views/checkIfLogin.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
    <script src="js/main.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <header class="col-sm-12 col-md-12 col-lg-12"></header>
        </div>
        <div class="row">
            <nav class="col-sm-12 col-md-12 col-lg-12">
            <?php include_once "views/menu.php" ?>
            </nav>
        </div>
        <div class="row">
        <section class="col-sm-12 col-md-12 col-lg-12">
        <?php 
        if (isset($_GET['page'])){
            $page= $_GET['page'];
            switch ($page) {
                case '1':
                    include_once "views/catalogue.php";
                    break;
                    case '2':
                    include_once "views/cart.php";
                    break;
                    case '3':
                    include_once "views/register.php";
                    break;
                    case '4':
                    include_once "views/admin.php";
                    break;
                default:
                include_once "views/error404.php";
                    break;
            }
        }
        ?>
        </section>
        </div>
    </div>
   
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
</html>