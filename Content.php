    <link rel="stylesheet" href="style.css">
    
    <div class="maincontent-area">
        <div class="zigzag-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="latest-product">
                            <h2 class="section-title">Products</h2>
                        </div>
                            <?php
                                include_once("Connection.php");
                                $result = pg_query($conn, "SELECT * FROM public.product");
                                if (!$result)
                                {
                                    die('Invalid query: ' . pg_error($conn));
                                }

                                while ($row = pg_fetch_array($result, NULL, PG_ASSOC))
                                {
                            ?>
                                <div>
                                    <br/><br/><br/>                   
                                    <h3 class="card-title"><?php echo  $row['Pro_name']?></h3>
                                    <p class="card-text"><?php echo "Price:" . " " . $row['Price'] ." "."VND"?></p>
                                </div>

                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="images/<?php echo $row['Pro_img']?>" class="card-img-top" alt="..." width="567px" height="540px" >
                                        <img src="images/<?php echo $row['Pro_img']?>" class="card-img-top" alt="..." width="567px" height="540px" >
                                        <div class="product-hover">
                                            <a href="?page=cart" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="?page=single-product" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>