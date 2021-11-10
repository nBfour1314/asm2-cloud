<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/icon.png">
    <title>H&T SHOP</title>
    
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>


<?php
    session_start();
    include_once("Connection.php");
?>


<body>
    <!--HEADER-->
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="user-menu">
                        <ul id="menu-align">
                            <?php
                                if (isset($_SESSION['us']) && $_SESSION['us'] != "")
                                {
                                    ?>
                                        <li><a style="color:#000" href="?page=update_customer">
                                            <i class="fa fa-lock"></i>Hi, <?php echo $_SESSION['us'] ?></a></li>
                                        <li><a href="?page=logout" style="color: #000;">
                                            <i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
                                        <li><a href="?page=cart"><i class="fa fa-shopping-cart"></i> CART</a></li>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <li><a href="?page=register"><i class="fa fa-star"></i> Register</a></li>
                                        <li><a href="?page=login"><i class="fa fa-user"></i> Login</a></li> 
                                    <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="site-branding-area">
        <div class="container" id="size">
            <div class="row">
                <div class="col-sm-12">
                    <div class="logo">
                        <a href="index.php"><img id="lg" src="images/logoor.png" width="590px"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 

                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class=""><a href="index.php">HOME</a></li>

                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="?page=proma">PRODUCT  <span class="caret"></span></a></li>

                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="?page=catema">CATEGORY  <span class="caret"></span></a></li>

                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="?page=stor">STORE  <span class="caret"></span></a></li>
                    </ul>
                </div>

                <div id="welcome">
                    <marquee direction="left" behavior="scroll" scrollamount="7">
                        <i>Welcome to the ATN SHOP.COM</i>
                    </marquee>
                </div>
            </div>
        </div>
    </div>
    
    
    <?php
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
        if($page=="login")
        {
            include_once("Login.php");
        }
        elseif($page=="register")
        {
            include_once("Register.php");
        }
        elseif($page=="logout")
        {
        include_once("Logout.php");
        }
        elseif($page=="catema")
        {
        include_once("Category_Management.php");
        }
        elseif($page=="proma")
        {
        include_once("Product_Management.php");
        }
        elseif($page=="stor")
        {
        include_once("Store_Management.php");
        }
        elseif ($page=="add_category")
        {
            include_once("Add_Category.php");
        }
        elseif ($page=="update_category")
        {
            include_once("Update_Category.php");
        }
        elseif ($page=="add_store")
        {
            include_once("Add_Store.php");
        }
        elseif ($page=="update_store")
        {
            include_once("Update_Store.php");
        }
        elseif ($page=="add_product")
        {
            include_once("Add_Product.php");
        }
        elseif ($page=="update_product")
        {
            include_once("Update_Product.php");
        }
        elseif ($page=="datatran1")
        {
            include_once("Datatran1.php");
        }
        }
        elseif ($page=="single-product")
        {
            include_once("See_details.php");
        }
    }
    else
    {
        include_once("Content.php");
    }
?>

    <!--FOOTER-->
    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2 align="center"><span>SOCIAL</span></h2>
                        <div align="center" class="footer-social">
                            <a href="https://www.facebook.com/tang.weian.7"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.facebook.com/tang.weian.7"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.facebook.com/tang.weian.7"><i class="fa fa-youtube"></i></a>
                            <a href="https://www.facebook.com/tang.weian.7"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 align="center" class="footer-wid-title">ABOUT</h2>
                        <p align="justify">ATNN Shop is the most chosen in Vietnam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, eum repellendus? Quibusdam eveniet mollitia neque illo nostrum, facilis a optio?</p>                      
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 align="center" class="footer-wid-title">QUICK LINKS</h2>
                        <ul align="justify" class="list-unstyled">
                            <li class="active"><a href="index.php">HOME</a></li>

                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="?page=catema">CATEGORY<span class="caret"></span></a></li>

                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="?page=proma">PRODUCT<span class="caret"></span></a></li>

                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="?page=stor">STORE<span class="caret"></span></a></li>
                        </ul>                      
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 align="center" class="footer-wid-title">CONNECT</h2>
                        <ul align="justify" class="list-unstyled">
                            <li><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;&nbsp;Email: haonngcc19117@fpt.edu.vn</li>
                            <li><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;&nbsp;&nbsp;Telephone: 039989631</li>
                            <li><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Address: 160, 30/4 Street, An Phu Ward, Ninh Kieu District, Can Tho City</li>
                        </ul>   
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">              
                <div align="center">
                    Copyright © 2021 by ATNSHOP.
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.easing.1.3.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="js/bxslider.min.js"></script>
	<script type="text/javascript" src="js/script.slider.js"></script>
</body>
</html>