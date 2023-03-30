<?php
    session_start();
    require 'database_connector.php';
    if(isset($_GET['logout'])){
        if($_GET['logout'] == 'true'){
            unset($_SESSION['logged-in']);
            header("location: index.php");
        }
    }
?>
<html>
    <head>
        <title>e-Agricultural Marketplace</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet"href="src/stylesheet.css"/>
        <link rel="manifest" href="manifest.json">
        <link rel="icon" type="image/x-icon" href="assets/img3.ico">
    </head>
    <body>

        <div id="overlay-spinner">
            <div id="loader"></div>
        </div>


        <ul>
            <li><i class="material-icons"onclick="openNav()"style="margin-top:11px;margin-left:10px;font-size:32px;">menu</i></li>
            <center><span style="font-family: calibri;font-weight: bold;font-size: 20px;display: inline-block;margin-top: 14px;">e-Agricultural Market</span><img src="assets/img3.png"height="30px"style="vertical-align:-8px;margin-left:5px;"/></center>
        </ul>

        <div id="myNav" class="overlay">
            
            <div class="login-signup-grid">
                <div class="login-grid-items">
                    <img src="assets/profile_2.png"style="width:60px;height:60px;border-radius:50%;"/>
                </div>

                <?php
                    if(!isset($_SESSION['logged-in'])){
                ?>

                <div class="login-grid-items">
                    <a style="all:unset;"href="login.php"><span style="color:blue;font-size: 18px;"><u>Login/Sign In</u></span></a>
                    <button type="button"style="margin-top:6px;display:block;background-color:dodgerblue;border:none;color:white;padding:6px 20px;border-radius:5px;"onclick="window.location.href='signup.php'">Sign Up</button>
                </div>
                
                <?php
                }
                else{
                    if($_SESSION['logged-in']){
                    ?>
                <div class="login-grid-items"style="margin-top:10px;">
                    <span style="display:block;color:black;font-size: 18px;font-weight:bold;"><?php echo $_SESSION['name']; ?></span>
                    <span style="display:block;color:gray;font-size: 15px;font-weight:bold;"><?php echo $_SESSION['phone']; ?></span>
                </div>
                    <?php
                    }
                }
                ?>

                <div class="login-grid-items">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> 
                </div>
            </div>

            <div class="overlay-content">
              <a href="#"class="active">Home</a>
              <a href="#">Transactions</a>
              <a href="#">About</a>
              <a href="#">Help</a>
              <a href="#">Contact</a>
              <?php
                if(isset($_SESSION['logged-in'])){
                    if($_SESSION['logged-in']){
              ?>
              <a href="index.php?logout=true"style="color:blue;">Logout <i class="material-icons"style="vertical-align:-5px;">logout</i></a>
              <?php
                    }
                }
              ?>
            </div>
        </div>

        <div class="flex-container">

            <div style="width:10%;text-align:center;"onclick="plusSlides(-1)"><span class="material-icons"style="padding-top:3px;color:white;margin-top:50px;display:block;width:30px;height:27px;border-radius:50%;background-color:black;">chevron_left</span></div>
            
            <div onclick="loadSpinner();window.location.href='crops.php?crop=potato'"class="mySlides fade"style="background-color:white;width:80%;border: 1px solid black;border-radius: 5px;">
                <center><img src="assets/img1.png"style="width:60%;margin-top:15px;"/></center>
                <center><span style="font-size: 11px;display: inline-block ;margin-top: -20px;margin-left: 4px  ;">POTATO (JYOTI ALOO)</span></center>
                <span style="display: inline-block ;margin-top: -60px;margin-left: 4px  ;"><i class="material-icons"style="font-size:20px;">trending_up</i><span style="vertical-align: 5px;font-size: 11px;">&nbsp;PRICE: &#8377;500/QUINT</span></span>
            </div>

            <div onclick="loadSpinner();window.location.href='crops.php?crop=onion'"class="mySlides fade"style="background-color:white;width:80%;border: 1px solid black;border-radius: 5px;">
                <center><img src="assets/img2.png"style="width:60%;margin-top:15px;"/></center>
                <center><span style="font-size: 11px;display: inline-block ;margin-top: -20px;margin-left: 4px  ;">ONION (ORGANIC)</span></center>
                <span style="display: inline-block ;margin-top: -60px;margin-left: 4px  ;"><i class="material-icons"style="font-size:20px;">trending_up</i><span style="vertical-align: 5px;font-size: 11px;">&nbsp;PRICE: &#8377;750/QUINT</span></span>
            </div>

            <div onclick="loadSpinner();window.location.href='crops.php?crop=rice'"class="mySlides fade"style="background-color:white;width:80%;border: 1px solid black;border-radius: 5px;">
                <center><img src="assets/img4.jpg"style="width:60%;margin-top:15px;"/></center>
                <center><span style="font-size: 11px;display: inline-block ;margin-top: -20px;margin-left: 4px  ;">RICE (MINIKET)</span></center>
                <span style="display: inline-block ;margin-top: -60px;margin-left: 4px  ;"><i class="material-icons"style="font-size:20px;">trending_up</i><span style="vertical-align: 5px;font-size: 11px;">&nbsp;PRICE: &#8377;1700/QUINT</span></span>
            </div>

            <div onclick="loadSpinner();window.location.href='crops.php?crop=cabbage'"class="mySlides fade"style="background-color:white;width:80%;border: 1px solid black;border-radius: 5px;">
                <center><img src="assets/img5.jpg"style="width:60%;margin-top:15px;"/></center>
                <center><span style="font-size: 11px;display: inline-block ;margin-top: -20px;margin-left: 4px  ;">CABBAGE (ORGANIC)</span></center>
                <span style="display: inline-block ;margin-top: -60px;margin-left: 4px  ;"><i class="material-icons"style="font-size:20px;">trending_up</i><span style="vertical-align: 5px;font-size: 11px;">&nbsp;PRICE: &#8377;900/QUINT</span></span>
            </div>

            <div style="width:10%;text-align:center;"onclick="plusSlides(1)"><span class="material-icons"style="padding-top:3px;color:white;margin-top:50px;display:block;width:30px;height:27px;border-radius:50%;background-color:black;">chevron_right</span></div>
        
        </div>

        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span> 
            <span class="dot" onclick="currentSlide(2)"></span> 
        </div>

        <hr>

        <center>
        <div id="search">
        <form name="search"style="display:inline-block;width:75%;">
            <input type="text"name="search-text"placeholder="Search... (Potato, Rice, Onion)"id="search-box"/>
        </form>
        <button type="submit"name="search-btn"id="search-btn"><i class="material-icons">search</i></button>
        </div>
        </center>

        <hr style="margin-left: 8px;margin-right: 8px;">
            <center><span style="color:white;font-weight: bold;font-size: 18px;">AVAILABLE DISTRICTS</span></center>
        <hr style="margin-left: 8px;margin-right: 8px;">

        <div class="grid-container">
            <div class="item1">
                <img src="assets/hoogly_1.jpg"style="border-radius:50%;height:70px;"/>
                <center><span style="display: block;padding-top: 10px;">HOOGHLY</span></center>
            </div>
            <div class="item2">
                <img src="assets/bankura_1.jpg"style="border-radius:50%;height:70px;"/>
                <center><span style="display: block;padding-top: 10px;">BANKURA</span></center>
            </div>
            <div class="item3">
                <img src="assets/coch_behar_1.jpg"style="border-radius:50%;height:70px;"/>
                <center><span style="display: block;padding-top: 10px;">COCH BEHAR</span></center>
            </div>  
            <div class="item4">
                <img src="assets/west_medinipur_1.jpg"style="border-radius:50%;height:70px;"/>
                <center><span style="display: block;padding-top: 10px;">WEST MEDINIPUR</span></center>
            </div>
            <div class="item5">
                <img src="assets/malda_1.jpg"style="border-radius:50%;height:70px;"/>
                <center><span style="display: block;padding-top: 10px;">MALDA</span></center>
            </div>
            <div class="item6">
                <img src="assets/howrah_1.jpg"style="border-radius:50%;height:70px;"/>
                <center><span style="display: block;padding-top: 10px;">HOWRAH</span></center>
            </div>  
        </div>

        <hr style="margin-left: 8px;margin-right: 8px;">
            <center><span style="color:white;font-weight: bold;font-size: 18px;">LIST OF BUYERS</span></center>
        <hr style="margin-left: 8px;margin-right: 8px;">

        <div class="buyer-containers">

            <div class="buyer-overview grid-container-buyer">
                <div class="grid-item"style="text-align:center;border-top-left-radius:5px;border-bottom-left-radius:5px;">
                    <img src="assets/profile.png"style="width:45px;height:45px;border-radius:50%;margin-top:2px;"/>
                </div>
                <div class="grid-item"style="border-top-right-radius:5px;border-bottom-right-radius:5px;">
                    <span style="font-size: 12px;display: block;font-weight: bold;">HIMESH KUMAR YADAV</span>
                    <span style="font-size: 12px;display: block;">Deals With:</span>
                    <div class="dealing-category">
                        <span class="tags"style="background-color:green;">Rice</span>
                        <span class="tags"style="background-color:orange;">Potato</span>
                        <span class="tags"style="background-color:violet;">Cabbage</span>
                    </div>
                </div>
            </div>

            <div class="buyer-overview grid-container-buyer">
                <div class="grid-item"style="text-align:center;border-top-left-radius:5px;border-bottom-left-radius:5px;">
                    <img src="assets/profile.png"style="width:45px;height:45px;border-radius:50%;margin-top:2px;"/>
                </div>
                <div class="grid-item"style="border-top-right-radius:5px;border-bottom-right-radius:5px;">
                    <span style="font-size: 12px;display: block;font-weight: bold;">RAVI SHANKAR</span>
                    <span style="font-size: 12px;display: block;">Deals With:</span>
                    <div class="dealing-category">
                        <span class="tags"style="background-color:orange;">Potato</span>
                        <span class="tags"style="background-color:green;">Rice</span>
                    </div>
                </div>
            </div>

            <div class="buyer-overview grid-container-buyer">
                <div class="grid-item"style="text-align:center;border-top-left-radius:5px;border-bottom-left-radius:5px;">
                    <img src="assets/profile.png"style="width:45px;height:45px;border-radius:50%;margin-top:2px;"/>
                </div>
                <div class="grid-item"style="border-top-right-radius:5px;border-bottom-right-radius:5px;">
                    <span style="font-size: 12px;display: block;font-weight: bold;">MANISH MAITY</span>
                    <span style="font-size: 12px;display: block;">Deals With:</span>
                    <div class="dealing-category">
                        <span class="tags"style="background-color:violet;">Cabbage</span>
                        <span class="tags"style="background-color:green;">Rice</span>
                    </div>
                </div>
            </div>

        </div>

        <footer class="footer-distributed">

			<div class="footer-right">

				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-linkedin"></i></a>
				<a href="#"><i class="fa fa-github"></i></a>

			</div>

			<div class="footer-left">
				<p class="footer-links">
					<a class="link-1" href="#">Home</a>
					<a href="#">Transactions</a>
					<a href="#">About</a>
					<a href="#">Help</a>
					<a href="#">Contact</a>
				</p>
				<p>e-Agricultural Marketplace &copy; 2023</p>
			</div>
		</footer>

        <script src="src/script.js"></script>
        <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            setInterval(plusSlides,3000,1);

            function showSlides(n) {
                var i;
                var sec_slideIndex = slideIndex;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("dot");
                if (n > slides.length) {
                    slideIndex = 1;
                    sec_slideIndex = 1;
                }    
                if (n < 1) {
                    slideIndex = slides.length;
                    sec_slideIndex = 0;
                 }
                if(sec_slideIndex >= slides.length){
                    sec_slideIndex = 1;
                    slideIndex = 1;
                }
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";  
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex-1].style.display = "block";  
                slides[sec_slideIndex].style.display = "block";  
                }

                function loadSpinner() {
                    document.getElementById("overlay-spinner").style.display = "block";
                }
        </script>

<script>
if('serviceWorker' in navigator) {
  navigator.serviceWorker.register('service_worker.js', { scope: '.' });
}
</script>

    </body>
</html>