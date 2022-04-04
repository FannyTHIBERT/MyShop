<?php

// Connexion Database
require ('connexion.php');

// Product Class
require ('inc/fetch_product.php');

$db=new DBController();

$product = new Product($db);

$category_product = new Product($db);

