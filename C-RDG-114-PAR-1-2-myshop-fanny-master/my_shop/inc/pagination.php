<?php
require_once('inc/session.php');
require_once('inc/connect.php');

function pagination_search($nbproducts,$nbproducts_page=null)
{
$nbproducts_page=12;
$nbproducts=$_SESSION['query_result'];
return ceil($nbproducts/$nbproducts_page);
}

function pagination_products($nbproducts,$nbproducts_page=null)
{
$nbproducts_page=12;
$nbproducts=$_SESSION['nb_products'];
return ceil($nbproducts/$nbproducts_page);
}



//$a=pagination_search(248,20);
//echo $a;


?>
