<?php

include_once('connect.php');

function getAllChildrenCategories($categId){
            $db = connect_db();
            $allCategs = [];
            $allCategs[] = $categId;
            $query = $db->prepare('SELECT id, parent_id FROM categories WHERE parent_id=:id');
            $query->execute([':id' => $categId]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $categ) {
                $allCategs[] = $categ['id'];
                if($childrens = getAllChildrenCategories($categ['id'])){
                    $allCategs = array_merge($allCategs, $childrens);
                }
            }
            return array_unique($allCategs);
        }
        function getAllProductFromMainCateg($categoryId)
        {

            // requete sur tous les produits hors pagination
            $allCategs = getAllChildrenCategories($categoryId);
            $db2 = connect_db();
            $queryProducts2 = $db2->prepare(sprintf('SELECT * FROM products WHERE category_id IN(%s)', implode(',', $allCategs)));
            $queryProducts2->execute();
            $products2 = $queryProducts2->fetchAll(PDO::FETCH_ASSOC);
            $nbproducts=count($products2);
            $_SESSION['nb_products_categ']=$nbproducts;



            // requete sur les produits de la page
            $allCategs = getAllChildrenCategories($categoryId);
            $db = connect_db();
            $page = $_GET['page'] ?? 1;
            $limit=(($page*12)-12);
            $queryProducts = $db->prepare(sprintf("SELECT * FROM products WHERE category_id IN(%s) LIMIT " . $limit . " , 12" , implode(',', $allCategs)));
            $queryProducts->execute();
            $products = $queryProducts->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        }
