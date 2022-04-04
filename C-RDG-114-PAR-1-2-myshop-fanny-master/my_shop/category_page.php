
<?php
include('inc/header.php');
include('inc/cat.php');
include('inc/pagination.php');


$cat_id= $_GET['id'];
$prod=getAllProductFromMainCateg($cat_id);


?>


<section class="productsection">
    <div class="container productdiv px-lg-5">
        <div class="row productrow gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
            <?php

                       

            foreach ($prod as $rowcat){ 
                
                    
            ?>
                    <div class="col mb-5">

                        <div class="card productcard">

                            <!-- image-->

                            <a href=""><img class="card-img-top" src=" <?php echo $rowcat['littleimg']; ?>" alt="<?php echo $rowcat['name']; ?>" /></a>
                            <!-- Product details-->
                            <div class="card-body">
                                <div class="text-center">
                                    <!-- name-->

                                    <a class="product_name" href="">
                                        <h5 class=""> <?php echo $rowcat['name']; ?></h5>
                                    </a>
                                    <!--  price-->

                                    <span> <?php echo $rowcat['price']; ?> € </span>
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
            <?php
               
            }
            ?>
        </div>

    </div>

</section>

<nav aria-label="...">
    <ul class="pagination pagination-sm">

        <?php
        $page_number = "?id=".$_GET['id']."&page=";
        $url = $_SERVER['SCRIPT_NAME'] . $page_number;
        $nbproducts = $_SESSION['nb_products_categ'];
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
