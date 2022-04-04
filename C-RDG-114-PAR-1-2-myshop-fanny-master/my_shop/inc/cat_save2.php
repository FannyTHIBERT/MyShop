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
            $allCategs = getAllChildrenCategories($categoryId);
            $db = connect_db();
            $queryProducts = $db->prepare(sprintf('SELECT * FROM products WHERE category_id IN(%s)', implode(',', $allCategs)));
            $queryProducts->execute();
            $products = $queryProducts->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        }
