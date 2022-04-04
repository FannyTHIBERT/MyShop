<?php
require_once('inc/functions.php');
include_once('inc/search.php');
include_once('inc/logout.php');
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');

manage_php_session();
session_start();
logout();
is_logged();
is_admin();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Découvrez  nos offres Salon MILIBOO sur My_Shop. Faîtes votre choix parmi nos nombreuses références Meuble" />
    <meta name="author" content="" />
    <title> My_shop | <?php echo $pagetitle; ?> </title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS main -->
    <link href="css/styles.css" rel="stylesheet" />

    

    <link rel="stylesheet" href="css/owl.carousel.min.css">

   
    
    
    <!-- Style Crsl -->
    <link rel="stylesheet" href="css/style.css">

<?php 

?>
</head>

<body>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php"><img src="images/Logo.png" alt="logo"></a>
            <button name="creatbtn" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item "><a class="nav-link <?php if ($currentPage == 'Home') {echo 'active';} ?>" aria-current="page" href="index.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link <?php if ($currentPage == 'Shop') {echo 'active';} ?>" href="shop.php">SHOP</a></li>
                    <li class="nav-item"><a class="nav-link <?php if ($currentPage == 'Magazine') {echo 'active';} ?>" href="magazine.php">MAGAZINE</a></li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    CATEGORIES
                </a>
                <div class="dropdown-menu pt-0" aria-labelledby="navbarDropdown">
                    
                    <?php
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
                            
                            $html .= "<li><a href=\"category_page.php?id=". $noeud['categorie_id'] . "\">" . $noeud['nom_categorie'] . "</a>";                       
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

                    </div>
                    </li>
                </ul>
                    </li>
                    </ul>
                    <form class="d-flex">
                        <!-- ajouter  si client connu => nom du client else div login ci dessous-->
                        <?php if (is_logged()) : ?>
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                                <li class="nav-item"><a class="nav-link" href="my_account.php"><?= htmlspecialchars($_SESSION['username']) ?>      </a></li>
                                <li class="nav-item"><a class="nav-link" href="signin.php?action=logout"> Se déconnecter</a></li>
                            </ul>
                        <?php else : ?>
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                                <li class="nav-item"><a class="nav-link <?php if ($currentPage == 'Login') {echo 'active';} ?>" href="signin.php">LOGIN</a></li>
                            </ul>
                        <?php endif; ?>
                        <button name="creatbtn" class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                         </button>      
                        </form>
                </div>
            </div>
    </nav>



    <!-- End Navigation -->
    <div class="container searchbar">

        <div class="search">
            <form class="search-form">
            <?php $keywords=$_GET["keywords"] ?? ''; ?>
                <input type="text" name="keyword" value="<?php echo $keywords ?>" placeholder="Search for products, categories ..">
                            
                <button id='searchbtn' type="button" name="valider" value="Rechercher" class="btn btn-outline-grey" onclick="location.href='page_search.php';">
                    <i class="bi bi-search"></i>
                </button>

            </form>
            
    </div>
    </div>