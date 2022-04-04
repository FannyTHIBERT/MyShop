<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
include('inc/header_admin.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">   
</head>
<body>   
<?php
        
      
        // Afficher tous les éléments "categories" de la bdd
        $db=connect_db();
        $var="users";
        $bddUsers = "SELECT * FROM ".$var;
        $query=$db->prepare($bddUsers);
        $query->execute();
        $result1 = $query->fetchAll(PDO::FETCH_ASSOC);  
?>    
    <main class="container self">
        <div class="row adminbtn">
            <section class="col-12">
            <div class="row">

        <?php if(!is_null($_SESSION['success_admin_message'])): ?>
        <p> <a class="alert alert-success" role="success"><?=htmlspecialchars($_SESSION['success_admin_message']) ?></a> </p>
        <?php unset($_SESSION['success_admin_message']);?>
        <?php endif; ?>

            
         <?php if(!is_null($_SESSION['success_admin2_message'])): ?>
         <p> <a class="alert alert-success" role="success"><?=htmlspecialchars($_SESSION['success_admin2_message']) ?></a> </p>
         <?php unset($_SESSION['success_admin2_message']);?>
         <?php endif; ?>    



            <section class="col-12">
                <a class="btn btn-secondary-menu" href="users_admin.php">Users</a>
                <a class="btn btn-secondary-menu" href="categories_admin.php">Catégories</a>
                <a class="btn btn-secondary-menu" href="products_admin.php">Products</a>
            </section>
        </div>    

                               
                <h1>Users</h1>
                
                <div>
                <a href="users_add.php" class="btn btn-secondary-menu">Ajouter un user</a>
                </div> 
                
                <table class="table">

                <thead>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Created_at</th>
                </thead>
                <tbody>
                    <?php
                    //boucle sur la variable result1
                    foreach($result1 as $users){
                        ?>
                        <tr>
                            <td><?= $users['id'] ?></td>
                            <td><?= $users['username'] ?></td>
                            <td><?= substr($users['password'],0,20) ?></td>
                            <td><?= $users['email'] ?></td>
                            <td><?= $users['admin'] ?></td>
                            <td><?= $users['created_at'] ?></td>
                            <td><a class="btn btn-info" href="users_details.php?id=<?= $users['id'] ?>">Détails</a>  <a class="btn btn-warning" href="users_edit.php?id=<?= $users['id'] ?>">Modifier</a>  <a class="btn btn-danger" href="users_delete.php?id=<?= $users['id'] ?>">Supprimer</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                        </tbody>
                    </table> 
            <a href="users_add.php" class="btn btn-secondary-menu">Ajouter un user</a>
            </section>
        </div>
    </main>      
</body>
</html>