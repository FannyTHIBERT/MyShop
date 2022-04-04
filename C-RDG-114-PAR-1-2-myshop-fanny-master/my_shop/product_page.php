<?php
$pagetitle = "Product Informations";
$currentPage ='Shop';
include('inc/header.php');

?>

<?php 
    // Get id from DB

    $item_id = $_GET['id'];
    foreach($product->getData() as $item):
    if ($item['id'] == $item_id):

?>
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?php echo $item['littleimg']; ?>" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">Ref: <?php echo $item['id']; ?></div>
                        <h1 class="display-5 fw-bolder"><?php echo $item['name']; ?></h1>
                        <div class="fs-5 mb-5">
                            
                            <span><?php echo $item['price']; ?></span>
                        </div>
                        <p class="lead"><?php echo $item['description']; ?></p>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                            <button name="creatbtn" class="btn btn-outline-dark flex-shrink-0" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      
<?php 
    endif;
    endforeach;
?>

<div class="content">
    
      <div class="container owl-2-style">
        
        <h2 class="text-primary py-5 ">More Products</h2>
        

        <div class="owl-carousel owl-2">
          <div class="media-29101">
            <a href="#"><img src="https://photos.zodio.fr/zodio-magento/catalog/products/source/3/5/3560239696377_Z.jpg?height=400&width=400&canvas=400,400&fit=bounds" alt="Image" class="img-fluid"></a>
            <h3><a href="#">Tabouret rembourré Peacok avec pieds en métal noir ø30xh45 cm</a></h3>
          </div>
          <div class="media-29101">
            <a href="#"><img src="https://photos.zodio.fr/zodio-magento/catalog/products/source/3/4/3442440307559_D.png?height=400&width=400&canvas=400,400&fit=bounds" alt="Image" class="img-fluid"></a>
            <h3><a href="#">Tabouret rembourré Taupe avec pieds en métal noir ø30xh45 cm</a></h3>
          </div>
          <div class="media-29101">
            <a href="#"><img src="https://photos.zodio.fr/zodio-magento/catalog/products/source/1/0/10184381_D.jpg?height=400&width=400&canvas=400,400&fit=bounds" alt="Image" class="img-fluid"></a>
            <h3><a href="#">Table avec plateau en fibre naturelle et support métal</a></h3>
          </div>
          <div class="media-29101">
            <a href="#"><img src="https://photos.zodio.fr/zodio-magento/catalog/products/source/1/0/10162456_D.jpg?height=400&width=400&canvas=400,400&fit=bounds" alt="Image" class="img-fluid"></a>
            <h3><a href="#">Tabouret en velours gris avec pied en métal filaire doré</a></h3>
          </div>
          <div class="media-29101">
            <a href="#"><img src="https://photos.zodio.fr/zodio-magento/catalog/products/source/3/5/3560239151081_D.JPG?height=400&width=400&canvas=400,400&fit=bounds" alt="Image" class="img-fluid"></a>
            <h3><a href="#"></a>Plaid sweat Capuche Dino vert 3-10ans</h3>
          </div>
          <div class="media-29101">
            <a href="#"><img src="https://photos.zodio.fr/zodio-magento/catalog/products/source/3/6/3663655050263_D.jpg?height=400&width=400&canvas=400,400&fit=bounds" alt="Image" class="img-fluid"></a>
            <h3><a href="#"></a>Plaid 130x150cm en coton camel Summer Camp</h3>
          </div>
        </div>

      </div>
    

  </div>


        

<?php

include('inc/footer.php');

?>

</body>
</html>     