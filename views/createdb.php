<?php 
include_once "classes.php";
$pdo=TOOLS::connect();
// $roles = "CREATE table Roles(
//     id int not NULL AUTO_INCREMENT PRIMARY KEY,
//     role  varchar(32) not NULL UNIQUE)
//     DEFAULT charset='utf8'";

// $costomer ="CREATE table Costomers(
//     id int not null AUTO_INCREMENT PRIMARY KEY,
//     login varchar(32) not NULL UNIQUE,
//     password varchar(32) not NULL,
//     roleId int, FOREIGN KEY (roleId) REFERENCES Roles(id) on UPDATE CASCADE,
//     discount int,
//     total int,
//     imagePath varchar(255)) 
//     DEFAULT charset='utf8'";
// $categories = "CREATE table Categories(
//     id int not null AUTO_INCREMENT PRIMARY KEY,
//     category varchar(64) not NULL)
//     DEFAULT charset='utf8'";

$subCategories = "CREATE table SubCategories(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    subCategory varchar(64) not NULL UNIQUE,
    categoryId int,  FOREIGN KEY (categoryId) REFERENCES Categories(id) on UPDATE CASCADE)
    DEFAULT charset='utf8'";
$items = "CREATE table Items(
    id int not NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(128) not NULL,
    categoryId int,  FOREIGN KEY (categoryId) REFERENCES Categories(id) on UPDATE CASCADE,
    priceIn int not null,
    priceSale int not null,
    info varchar(255) not null,
    rate varchar(255),
    imagePAth varchar(255) not NULL
    ) DEFAULT charset='utf8'";

$images =  "CREATE table Images(
        id int not null AUTO_INCREMENT PRIMARY KEY,
        itemId int,  FOREIGN KEY (itemId) REFERENCES Items(id) on UPDATE CASCADE,
        imagePath varchar(255) not NULL,
        alt varchar(255),
        title varchar(255)
        ) DEFAULT charset='utf8'";
$sales = "CREATE table Sales(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    customerName varchar(128),
    priceIn int,
    priceSale int,
    dateSale date
    ) DEFAULT charset='utf8'";


// $pdo->exec($roles);
// $pdo->exec($costomer);
// $pdo->exec($categories);
// $pdo->exec($subCategories);
// $pdo->exec($items);
// $pdo->exec($images);
// $pdo->exec($sales);

?>


