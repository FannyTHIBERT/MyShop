
<?php
require_once('connect.php');
require_once('env.php');

function get_category() 
{
$db=connect_db();
$bddCategories = "SELECT id, name, parent_id FROM categories";
$query1 = $db->prepare( $bddCategories);
$query1->execute();
$res=$query1->fetchAll(PDO::FETCH_ASSOC);
return $res;

}


function category_parent_exist($parent_id){
$db=connect_db();
$bddCategories = "SELECT id, name, parent_id FROM categories WHERE parent_id=:parent_id";
$query1 = $db->prepare( $bddCategories);
$query1->bindValue(':parent_id', $parent_id, PDO::PARAM_INT);
$res=$query1->execute();
if(!empty($res)){
return true;
}
return false;    
}

function category_exist($id){
    try{
    $db=connect_db();
    $bddCategories = "SELECT id, name, parent_id FROM categories WHERE id=:id";
    $query1 = $db->prepare($bddCategories);
    $query1->bindValue(':id', $id, PDO::PARAM_INT);
    $query1->execute();
    $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($res1)){
     
    $heurelog=date('Y-m-d H:i:s');
    file_put_contents(JOURNAL_LOG_FILE,"la categ existe" .$heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
    return true;
        }
        else{
        $heurelog=date('Y-m-d H:i:s');
        file_put_contents(JOURNAL_LOG_FILE,"la categ n' existe pas" .$heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
        throw new Exception('email déjà utilisé');
        }
    }
        catch (Exception $e) {
            $_SESSION['error_admin_message'] = $e->getMessage();
        }
}


function modify_category($id =null,$name = null,$parent_id= null) 
{
   
try{
$db=connect_db();
$bddProducts = "UPDATE categories SET name=:name, parent_id=:parent_id WHERE id=:id;";
$query1 = $db->prepare( $bddProducts);
$query1->bindValue(':id', $id, PDO::PARAM_INT);
$query1->bindValue(':name', $name, PDO::PARAM_STR);
$query1->bindValue(':parent_id', $parent_id, PDO::PARAM_STR);
return true;

//fin try
    }
catch (Exception $e) {
    $_SESSION['error_admin_message'] = $e->getMessage();
}
}


function verify_category() 
{// début fonction
try{     // debut du try

    if(!isset($_GET['id']) || empty($_GET['id']))
    {
        header('Location: categories_admin.php');
        throw new Exception("url invalide");
    
    return false;
    }
    else {


    if(isset($_GET['id']) && !empty($_GET['id']))
    {
        $db=connect_db();
        $id = strip_tags($_GET['id']);
        $bddCategories = "SELECT * FROM `categories` WHERE `id`=:id;";
        $query1 = $db->prepare($bddCategories);
        $query1->bindValue(':id', $id, PDO::PARAM_INT);
        $query1->execute();
        $result1 = $query1->fetch();
            if(empty($result1))
                {
                    header('Location: categories_admin.php');
                    throw new Exception("Cet id n'existe pas");
                
                return false;
                }
            else{
                return true;
                }    
            
            }
        }

    } //Fin du try
 
catch (Exception $e) { $_SESSION['error_admin_message'] = $e->getMessage();}

}  //fin fonction
 
?>

