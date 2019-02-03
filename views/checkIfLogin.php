<?php 
session_start();
include_once 'classes.php';
if (isset($_POST['login_btn'])){
    $pdo=TOOLS::connect();
    $login = $_POST['login'];
    $pass = $_POST['password'];
    $result = $pdo->query("SELECT * FROM Costomers WHERE login='$login' AND password='$pass'");
    if ($result->rowCount()>0){
        $_SESSION['reg']=$login;
       header("location: ".BASE_URL."index.php", true);
     exit(0);
    }else{
        header("location: ".BASE_URL."index.php", false);  
        exit(0);
    }
}
