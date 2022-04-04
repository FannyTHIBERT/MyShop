<?php
$pagetitle = 'Shop';
$currentPage ='Shop';
include('inc/header.php');

;

?>

 <!-- Header-->
 <header class="bg-dark ">
            <div class="container banner ">
                <div class="bannertext">
                    <h1 class="display-4">SHOP</h1>
                    <p class="lead">Faîtes votre choix parmi nos nombreuses références.</p>
                </div>
            </div>
        
</header>

<!-- Section-->
<?php 
    $product_home = $product->getData();
    
?>

<section class="productsection">

            <div class="container productdiv px-lg-5">
            
                <div class="row productrow gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
                
                <?php foreach($product_home as $item) {?>  
                 
                    <div class="col mb-5">
                
                        <div class="card productcard">
                        
                            <!-- image-->
                            
                           <a href="<?php printf('%s?id=%s', 'product_page.php', $item['id'])?>"><img class="card-img-top" src="<?php echo $item['littleimg']; ?>" alt="<?php echo $item['price']; ?>" /></a> 
                            <!-- Product details-->
                            <div class="card-body">
                                <div class="text-center">
                                    <!-- name-->

                                  <a class="product_name" href="<?php printf('%s?id=%s', 'product_page.php', $item['id'])  ?>"><h5 class=""> <?php echo $item['name']; ?></h5></a>  
                                    <!--  price-->

                                    <span> <?php echo $item['price']; ?> € </span>
                                </div>
                            </div>
                            <!-- Add to cart-->

                            <div class="card-footer ">
                                <div class="text-center"><button name="creatbtn" class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            </button></div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <?php } ?>
                </div>
                
            </div>
            
        </section>

<!-- Pagination -->

<!-- pagination start -->


<nav aria-label="...">
    <ul class="pagination pagination-sm">

        <?php
        $page_number = "?page=";
        $url = $_SERVER['SCRIPT_NAME'] . $page_number;
        $nbproducts = $_SESSION['nb_products'];
        $nbproducts_page = 20;
        $nbpages = ceil($nbproducts / $nbproducts_page);

        for ($i = 1; $i <= $nbpages; $i++) { ?>
            <li class="page-item"> <a class="page-link" href="<?php $limit = $i;
                            echo $url . $limit ?>"><?php echo $i ?></a> </li>
        <?php } ?>


    </ul>
</nav>




<?php

include('inc/footer.php');

?>

</body>
</html>     