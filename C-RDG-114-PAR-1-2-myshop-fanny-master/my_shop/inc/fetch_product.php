<?php
// Access connexion anywhere


class Product
{
    public $db = null;

    public function __construct(DBController $db) 
    {
        if(!isset($db->connexion)) return null; 
        $this->db = $db;

    }

    public function getData($table='products')
    {
        // requete de tous les produits hors pagination
        $Req2="SELECT * FROM {$table} ";
        $stmt2 = $this->db->connexion->prepare($Req2);
        $stmt2->execute();
        $result2 = $stmt2->fetchall();
        $nbproducts=count($result2);
        $_SESSION['nb_products']=$nbproducts;
               
        
        // requete des produits par pagination
        $page = $_GET['page'] ?? 1;
        $limit=(($page*12)-12);
        $Req="SELECT * FROM {$table} LIMIT ". $limit . " , 12";
        $stmt = $this->db->connexion->prepare($Req);
        $stmt->execute();
                     

 $resultArray = array();

    while ($item = $stmt->Fetch(PDO::FETCH_ASSOC)){

        $resultArray[]= $item;
        }
        return $resultArray;
    }

    /*public function get_Product_Cat($cat_id)
    {       
        if($cat_id==1)
        {
            $statment = $this->db->connexion->prepare("SELECT * FROM products");
            $statment->execute();
            $ResultArray = array();

            while ($rowcat = $statment->fetch(PDO::FETCH_ASSOC)){
            $ResultArray[] = $rowcat;
            }
            return $ResultArray;
        }
        elseif($cat_id==2)
        {
            $statment = $this->db->connexion->prepare("SELECT * FROM products WHERE category_id>=14");
            $statment->execute();
            $ResultArray = array();

            while ($rowcat = $statment->fetch(PDO::FETCH_ASSOC)){
            $ResultArray[] = $rowcat;
            }
            return $ResultArray;
        }
        elseif($cat_id==3)
        {
            $statment = $this->db->connexion->prepare("SELECT * FROM products WHERE category_id BETWEEN 6 AND 7");
            $statment->execute();
            $ResultArray = array();

            while ($rowcat = $statment->fetch(PDO::FETCH_ASSOC)){
            $ResultArray[] = $rowcat;
            }
            return $ResultArray;
        }
        elseif($cat_id==4)
        {
            $statment = $this->db->connexion->prepare("SELECT * FROM products WHERE category_id BETWEEN 8 AND 11");
            $statment->execute();
            $ResultArray = array();

            while ($rowcat = $statment->fetch(PDO::FETCH_ASSOC)){
            $ResultArray[] = $rowcat;
            }
            return $ResultArray;
        }
        elseif($cat_id==5)
        {
            $statment = $this->db->connexion->prepare("SELECT * FROM products WHERE category_id>14");
            $statment->execute();
            $ResultArray = array();

            while ($rowcat = $statment->fetch(PDO::FETCH_ASSOC)){
            $ResultArray[] = $rowcat;
            }
            return $ResultArray;
        }
        else
        {
            $statment = $this->db->connexion->prepare("SELECT * FROM products INNER JOIN categories ON products.category_id=categories.id WHERE $cat_id=products.category_id");
            $statment->execute();
            $ResultArray = array();

            while ($row = $statment->fetch(PDO::FETCH_ASSOC)){
            $ResultArray[] = $row;
            }
            return $ResultArray;
        } 
    }*/

    public function getCategorie1(){

        $statment = $this->db->connexion->prepare("SELECT * FROM products");
        $statment->execute();

        $ResultArray = array();

        while ($rowcat = $statment->fetch(PDO::FETCH_ASSOC)){
            $ResultArray[] = $rowcat;
        }

        return $ResultArray;
    } 
}//"SELECT * FROM products INNER JOIN categories ON products.category_id=categories.id WHERE $cat_id=products.category_id"

//"WITH RECURSIVE products(id, name, category_id) AS (SELECT id, name, CAST(name AS CHAR(255)) FROM categories WHERE parent_id=$cat_id GROUP BY id UNION ALL SELECT categories.id, categories.name, CONCAT(products.category_id,' -> ',categories.name) FROM products INNER JOIN categories ON products.category_id=categories.id) SELECT * FROM products";
