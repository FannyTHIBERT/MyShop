<?php
include_once('inc/search.php');
include('inc/header.php');
include('inc/pagination.php');

?>


  <?php

  $product_search = search($_GET["keyword"], $_SESSION['sort']);
  $monUrl1 = "/page_search.php?keyword=" . $_GET["keyword"] . "&sort=price&order=asc";
  $monUrl2 = "/page_search.php?keyword=" . $_GET["keyword"] . "&sort=price&order=desc";
  $monUrl3 = "/page_search.php?keyword=" . $_GET["keyword"] . "&sort=name&order=asc";
  $monUrl4 = "/page_search.php?keyword=" . $_GET["keyword"] . "&sort=name&order=desc"

  ?>



 

  <?php if (!is_null($_SESSION['query_result'])) : ?>
    <div id="nbr">
      <p> Produits retrouvé(s): </p> <?= htmlspecialchars($_SESSION['query_result']) ?>
    </div>
  <?php endif; ?>

    

    <div class="row justify-content-center" >
    
      <div class="btn-group col-md-6 align-self-center btn-block" id="trier">
        <button  name="creatbtn" type="button " class="btn btn-primary dropdown-toggle trier " data-bs-toggle="dropdown">Trier</button>
        <div class="dropdown-menu align-self-center">
            <a href="<?php echo $monUrl1 ?>" class="dropdown-item">Du - cher au + cher</a>
            <a href="<?php echo $monUrl2 ?>" class="dropdown-item">Du + cher au - cher</a>
            <a href="<?php echo $monUrl2 ?>" class="dropdown-item">De A à Z</a>
            <a href="<?php echo $monUrl4 ?>" class="dropdown-item">De Z à A</a>
            
        </div>
    </div>
    </div>

      <section class="productsection">
        
        <div class="container productdiv px-lg-5">
          <div class="row productrow gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
              
            <?php foreach ($product_search as $item) { ?>


              <div class="col-10 ">

                <div class="card h-100">

                  <!-- image-->

                  <a href="<?php printf('%s?id=%s', 'product_page.php', $item['id']) ?>"><img class="card-img-top" src="<?php echo $item['littleimg']; ?>" alt="..." /></a>
                  <!-- Product details-->
                  <div class="card-body p-4">
                    <div class="text-center">
                      <!-- name-->

                      <a class="product_name" href="<?php printf('%s?id=%s', 'product_page.php', $item['id'])  ?>">
                        <h5 class="fw-bolder"> <?php echo $item['name']; ?></h5>
                      </a>
                      <!--  price-->

                      <span> <?php echo $item['price']; ?> € </span>
                    </div>
                  </div>
                  <!-- Add to cart-->

                  <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><button name="creatbtn"class="btn btn-outline-dark" type="submit">
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
          if (is_null($_GET["keyword"])) {
            $query = "";
          } else {
            $query = "?keyword=" . $_GET["keyword"];
          }
          if (is_null($_GET["sort"])) {
            $sort2 = "";
          } else {
            $sort2 = "&sort=" . $_GET["sort"];
          }
          if (is_null($_GET["order"])) {
            $order2 = "";
          } else {
            $order2 = "&order=" . $_GET["order"];
          }
          $page_number = "&page=";
          $url = $_SERVER['SCRIPT_NAME'] . $query . $sort2 . $order2 . $page_number;

          $nbproducts = $_SESSION['query_result'];
          $nbproducts_page = 12;
          $nbpages = ceil($nbproducts / $nbproducts_page);

          for ($i = 1; $i <= $nbpages; $i++) { ?>
            <li class="page-item"> <a class="page-link" href="<?php $limit = $i;
                                                              echo $url . $limit ?>"><?php echo $i ?></a> </li>
          <?php } ?>


        </ul>
      </nav>







      </body>


      <?php

      include('inc/footer.php');

      ?>



      </html>