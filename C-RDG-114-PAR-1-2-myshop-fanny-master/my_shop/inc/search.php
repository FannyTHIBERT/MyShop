<?php
include_once("connect.php");

function search($keywords,$sort=null){

$db=connect_db();
$keywords=$_GET["keyword"];
$words=explode(" ",trim($keywords));
for($i=0;$i<count($words);$i++)
$kw[$i]="name like '%". $words[$i] ."%'";


if ($_GET['sort']==""){$sort="id";} 
else {$sort=$_GET['sort'];} 
if ($_GET['order']==""){$order="";} 
else {$order=$_GET['order'];} 

if ($_GET['page']==""){$page=1;} 
else {$page=$_GET['page'];}
$limit=(($page*12)-12);


$var=implode(" AND " , $kw);

//requetes pour afficher les pdts en prenant en compte la pagination
$req="SELECT id, name, littleimg, price FROM products WHERE (". $var . ") ORDER BY " . $sort . " " . $order . " LIMIT ". $limit . ", 12"; 

$res=$db->prepare($req);
$res->setFetchMode(PDO::FETCH_ASSOC);
$res->execute();
$tab=$res->fetchall();


// requete pour afficher le nbre de pdts
$req="SELECT id, name, littleimg, price FROM products WHERE (". $var . ") ORDER BY " . $sort . " " . $order ; 
$res2=$db->prepare($req);
$res2->setFetchMode(PDO::FETCH_ASSOC);
$res2->execute();
$tab2=$res2->fetchall();
$nbresult2=count($tab2);

$heurelog=date('Y-m-d H:i:s'); 
$_SESSION['query']=$_GET["keyword"];
$_SESSION['query_result']=$nbresult2; 
file_put_contents(JOURNAL_LOG_FILE, "search nb results " . $nbresult2. " " . "query=" . $_SESSION['query'] . " " . $heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
return $tab;
}


?>


