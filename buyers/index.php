<?php
    session_start();
    if(!isset($_SESSION['logged-in-buyer'])){
        header("location: login.php");
    }
    if(isset($_GET['logout'])){
        if($_GET['logout'] == 'true'){
            unset($_SESSION['logged-in-buyer']);
            header("location: index.php");
        }
    }
?>
<html>
    <head>
        <title>e-Agricultural Marketplace | Buyers</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet"href="../src/stylesheet.css"/>
    </head>
    <body>
        <ul>
            <li><i class="material-icons"onclick="openNav()"style="margin-top:11px;margin-left:10px;font-size:32px;">menu</i></li>
            <center><span style="font-family: calibri;font-weight: bold;font-size: 20px;display: inline-block;margin-top: 14px;">e-Agricultural Market</span><img src="../assets/img3.png"height="30px"style="vertical-align:-8px;margin-left:5px;"/></center>
        </ul>

        <div id="myNav" class="overlay">
            
            <div class="login-signup-grid">
                <div class="login-grid-items">
                    <img src="../assets/profile_2.png"style="width:60px;height:60px;border-radius:50%;"/>
                </div>

                <?php
                    if(!isset($_SESSION['logged-in-buyer'])){
                ?>

                <div class="login-grid-items">
                    <a style="all:unset;"href="login.php"><span style="color:blue;font-size: 18px;"><u>Login/Sign In</u></span></a>
                    <button type="button"style="margin-top:6px;display:block;background-color:dodgerblue;border:none;color:white;padding:6px 20px;border-radius:5px;"onclick="window.location.href='signup.php'">Sign Up</button>
                </div>
                
                <?php
                }
                else{
                    if($_SESSION['logged-in-buyer']){
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
              <a href="settings.php">Settings</a>
              <a href="#">Transactions</a>
              <a href="#">About</a>
              <a href="#">Help</a>
              <a href="#">Contact</a>
              <?php
                if(isset($_SESSION['logged-in-buyer'])){
                    if($_SESSION['logged-in-buyer']){
              ?>
              <a href="?logout=true"style="color:blue;">Logout <i class="material-icons"style="vertical-align:-5px;">logout</i></a>
              <?php
                    }
                }
              ?>
            </div>
        </div>

        <div style="display: block;margin-top: 70px;"></div>

        <br><br><br><br><br>

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

        <script src="../src/script.js"></script>

    </body>
</html>