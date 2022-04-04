<?php
$pagetitle = 'Home';
$currentPage ='Home';
include('inc/header.php');
include('inc/pagination.php');

?>
<!-- Header-->
<header class="bg-dark ">
    <div class="container banner">
        <div class="bannertext">
            <h1 class="display-4">Home</h1>
            <p class="lead">Create a space that’s all you on any budget.</p>
        </div>
    </div>

</header>

<!-- Section-->
<?php
$product_home = $product->getData();


//   shuffle($product_home);
?>
<div id="hometitle"><h1> Top Rated Product</h1></div>
<div class="content">

    
    <!-- <div class="site-section bg-left-half mb-5"> -->
      <div class="container owl-2-style">
        
     
        <div class="owl-carousel owl-2">
          <div class="media-29101">
            <a href="#"><img src="images/article1.jpg" alt="Meuble salon" class="img-fluid"></a>
            <h3><a href="#">Meuble salon</a></h3>
            <p class="stars">★★★★☆</p>
          </div>
          <div class="media-29101">
            <a href="#"><img src="images/article2.jpg" alt="Commode RONDO bahut buffet" class="img-fluid"></a>
            <h3><a href="#">Commode RONDO bahut buffet</a></h3>
            <p class="stars">★★★★☆</p>
          </div>
          <div class="media-29101">
            <a href="#"><img src="images/article3.jpg" alt="Canapé convertible réversible" class="img-fluid"></a>
            <h3><a href="#">Canapé convertible réversible</a></h3>
            <p class="stars">★★★★☆</p>
          </div>
          <div class="media-29101">
            <a href="#"><img src="images/article4.jpg" alt="CHAISE SCAND NORDIC" class="img-fluid"></a>
            <h3><a href="#">chaise SCAND Nordic</a></h3>
            <p class="stars">★★★★☆</p>
          </div>
          <div class="media-29101">
            <a href="#"><img src="images/article5.jpg" alt="Fauteuil Chet Jaune Moutarde" class="img-fluid"></a>
            <h3><a href="#"></a>Fauteuil Chet Jaune Moutarde</h3>
            <p class="stars">★★★★☆</p>
          </div>
          <div class="media-29101">
            <a href="#"><img src="images/article6.jpg" alt="Table à manger Georgia" class="img-fluid"></a>
            <h3><a href="#"></a>Table à manger Georgia </h3>
            <p class="stars">★★★★☆</p>
          </div>
        </div>

      </div>
    <!-- </div> -->

  </div>
<!-- End Carrousel -->
<section class="productsection">
    <h1>Latest Products</h1>
    <div class="container productdiv px-lg-5">
        <div class="row productrow gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
            <?php foreach ($product_home as $item) { ?>

                <div class="col mb-5">

                    <div class="card productcard">

                        <!-- image-->

                        <a href="<?php printf('%s?id=%s', 'product_page.php', $item['id']) ?>"><img class="card-img-top" src="<?php echo $item['littleimg']; ?>" alt="<?php echo $item['name']; ?>" /></a>
                        <!-- Product details-->
                        <div class="card-body">
                            <div class="text-center">
                                <!-- name-->

                                <a class="product_name" href="<?php printf('%s?id=%s', 'product_page.php', $item['id'])  ?>">
                                    <h5 class=""> <?php echo $item['name']; ?></h5>
                                </a>
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