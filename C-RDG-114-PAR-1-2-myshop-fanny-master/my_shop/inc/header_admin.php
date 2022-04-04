<?php
    require('inc/functions.php');
    require('logout.php');
    logout();
    session_start();
    manage_php_session();
    is_logged();
    is_admin();

    ?>    

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS -->
    <link href="css/styles.css" rel="stylesheet" />

    <!-- requires -->
    <?php
        
    //verification que l'utilisateur est connecté et admin
    if ($_SESSION['is_logged']== true && $_SESSION['is_admin']==1)
    {
        $heurelog=date('Y-m-d H:i:s');    
        $message=" A les droits pour accéder à la page admin catégories";
        file_put_contents(JOURNAL_LOG_FILE,$message. " " .$heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
    else 
    {
    header('Location: signin.php');
    }

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
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php">HOME</a></li>
                  
                               
                                
                            </ul>
                        </li>
                </ul>
                <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" href="my_account.php"><?= htmlspecialchars($_SESSION['username']) ?>      </a></li>
                    <li class="nav-item"><a class="nav-link" href="signin.php?action=logout">Se déconnecter</a></li>
                    </ul>
                

                </form>
            </div>
        
    </nav>
    <!-- End Navigation -->
    
    
<?php if(isset($_SESSION['error_admin_message'])): ?>
<a class="alert alert-danger" role="alert"><?=htmlspecialchars($_SESSION['error_admin_message'])?></a>
<?php unset($_SESSION['error_admin_message']);?>
<?php endif; ?>

<?php
if(isset($_SESSION['error_admin_in_page_message'])): ?>
    <a class="alert alert-danger" role="alert"><?=htmlspecialchars($_SESSION['error_admin_in_page_message'])?></a>
    <?php unset($_SESSION['error_admin_in_page_message']);?>
    <?php endif; ?>
    
    




 