<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>Menu déroulant</title>
</head>
<body> 
<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
manage_php_session();
ini_set('display_errors', 'on');

$db=connect_db();

$resultat=$db->query("SELECT id, parent_id, name FROM categories ORDER BY name");
$categories=array();
while ($resultat1=$resultat->fetch())
    {
    $categories[] = array(
        'parent_id' => $resultat1['parent_id'],
        'categorie_id' => $resultat1['id'],
        'nom_categorie' => $resultat1['name']
    );
    }

    function afficher_menu($parent, $niveau, $array) { 
        $html = "";
        $niveau_precedent = 0;
          
        if (!$niveau && !$niveau_precedent) $html .= "\n<ul id='menu-deroulant'>\n";
          
        foreach ($array AS $noeud) {
          
            if ($parent == $noeud['parent_id']) {
          
            if ($niveau_precedent < $niveau) $html .= "\n<ul id='menu-deroulant'>\n";
          
            //$html .= "<li>" . $noeud['departement'];
            $html .= "<li><a href=#" . $noeud['categorie_id'] . "\">" . $noeud['nom_categorie'] . "</a>";
         
            $niveau_precedent = $niveau;
          
            $html .= afficher_menu($noeud['categorie_id'], ($niveau + 1), $array);
          
            }
        }
          
        if (($niveau_precedent == $niveau) && ($niveau_precedent != 0)) $html .= "</ul>\n</li>\n";
        else if ($niveau_precedent == $niveau) $html .= "</ul>\n";
        else $html .= "</li>\n";
          
        return $html;
          
        }
        echo afficher_menu(0, 0, $categories);

?>
</body>
</html>

<!--function showProducts(){
    $db=connect_db();
    $bddCategories = "SELECT id, name, littleimg, price FROM products INNER JOIN categories ON products.category_id=categories.id WHERE categories.id=products.category_id";
    $query1=$db->prepare($bddCategories);
    $query1->execute();
    $result1 = $query1->fetchAll(PDO::FETCH_ASSOC);
    }
        echo showProducts();
}-->