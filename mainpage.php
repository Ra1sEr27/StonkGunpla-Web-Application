<?php require_once('config.php'); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mainpage lol</title>
    <link rel="stylesheet" href="style.css"><!--Awaiting further css file-->
</head>

<body id="mainbackground">
    <div id="header">
        <form action="product.php" method="post">
            <a class="logo"href="mainpage.php"><img src="Images/logo.png" alt="profileicon" width="70"></a>
            <a class="storename"href="mainpage.php">Stonk Gunpla</a>
            <!-- <a class="logout"href="logout.php">Log out<img src="Images/logout.png" alt="logouticon" width="20"></a> -->
            <a class="login"href="login.php">Login/Sign up<img src="Images/login.png" alt="loginicon" width="20"></a>
            <a class="prod"href="productlist.php">Product<img src="Images/product.png" alt="productcon" width="20"></a>
        </form>
    </div>
    <div id= "mainpagebody">
        
        <div id="news"><!--bullshit scrolling picture-->
            
            <!-- Slideshow container -->
            <div class="slideshow-container">

        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
            <!-- <input type="hidden" name="productname" value = "HG Wing Gundam"> -->
            <div class="numbertext">1 / 3</div>
            <!-- <img src="Images/HG Wing Gundam.jpg" style="width:100%"> -->
            <a href="product.php?productname='HG Wing Gundam'" name="productname"><img src="Images/HG Wing Gundam.jpg" width="100%"></a>
            <!-- <div class="text">HG Gundam Wing</div> -->
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <a href="product.php?productname='HG Gundam Deathscyth'" name="productname"><img src="Images/HG Gundam Deathscyth.jpg" width="100%"></a>
        <!-- <div class="text">HG Gundam Deathscythe</div> -->
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <a href="product.php?productname='HG Gundam HeavyArms'" name="productname"><img src="Images/HG Gundam HeavyArms.jpg" width="100%"></a>
        <!-- <div class="text">HG Gundam HeavyArms</div> -->
        </div>
    
        <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
    
        <!-- The dots/circles -->
        <!-- <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div> -->
        <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            // Next/previous controls
            function plusSlides(n) {
            showSlides(slideIndex += n);
            }

            // Thumbnail image controls
            function currentSlide(n) {
            showSlides(slideIndex = n);
            }

            function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
            }
        </script>
        </div>
        <div class = "newarrived">
                <h2>New arrived products</h2>
        </div>
        <div class ="bestselling">
            <label>Best selling products</label>
        </div>
        <div id="recommend">
            
            <table class="spacing-table">
                <col width="30%">
                <col width="10%">
                <col width="30%">
                <col width="10%">
                <col width="30%">
                
                <tr> <!--first row -->

                    <th>
                        <div class="product1">
                        <form action="product.php" method="POST">
                            <img class="recommend" src="Images/MG Gundam Astray Red Frame.jpg" name='productname' value="MG Gundam Astray Red Frame" height="120" width="220">
                            <input type="hidden" name="productname" value = "MG Gundam Astray Red Frame">
                            <button class="btnmore" type="submit" name="seemore">More</button>
                        </form>
                        </div>
                    </th>
                    <th></th>
                    <th>
                        <div class="product1">
                        <form action="product.php" method="POST">
                            <img class="recommend" src="Images/HG Gundam OO Sky.jpg" name="productname" value="HG Gundam OO Sky" height="120" width="220">
                            <input type="hidden" name="productname" value = "HG Gundam OO Sky">
                            <button class="btnmore" type="submit" name="seemore">More</button>
                            </form>
                        </div>
                    </th>
                    <th></th> 
                    <th>
                        <div class="product1">
                        <form action="product.php" method="POST">
                            <img class="recommend" src="Images/MG Eclipse Gundam.jpg" name="productname" value="MG Eclipse Gundam" height="120" width="220">
                            <input type="hidden" name="productname" value = "MG Eclipse Gundam">
                            <button class="btnmore" type="submit" name="seemore">More</button>
                        </form>
                        </div>
                    </th>
                </tr>

                <tr> <!--second row -->
                    <th>
                        <div class="product1">
                        <form action="product.php" method="POST">
                            <img class="recommend" src="Images/MG Freedom Gundam Ve 2.0.jpg" name="productname" value="MG Freedom Gundam Ve 2.0" height="120" width="220">
                            <input type="hidden" name="productname" value = "MG Freedom Gundam Ve 2.0">
                            <button class="btnmore" type="submit" name="seemore">More</button>
                        </form>
                        </div>
                    </th>
                    <th></th> 
                    <th>
                        <div class="product1">
                        <form action="product.php" method="POST">
                            <img class="recommend" src="Images/SD Sangoku Soketsude.jpg" name="productname" value="SD Sangoku Soketsude" height="120" width="220">
                            <input type="hidden" name="productname" value = "SD Sangoku Soketsude">
                            <button class="btnmore" type="submit" name="seemore">More</button>
                            </form>    
                        </div>
                    </th>
                    <th></th>
                    <th>
                        <div class="product1">
                        <form action="product.php" method="POST">
                            <img class="recommend" src="Images/SD EX Valkylander.jpg" name="productname" value="SD EX Valkylander" height="120" width="220">
                            <input type="hidden" name="productname" value = "SD EX Valkylander">
                            <button class="btnmore" type="submit" name="seemore">More</button>
                        </form>
                        </div>
                    </th>
                </tr>
            </table>
    </div>
    
    
</div>
<br>
<br>
</body>
</html>