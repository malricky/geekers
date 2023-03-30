<?php
    session_start();
    require 'database_connector.php';
    if(isset($_POST['new-acc-sub-btn'])){
        $d_base = new Users();
        $d_base = $d_base->get_Database();
        $flag = $d_base->getReference("users_buyers/{$_POST['mobile-number']}")->set([
            'name' => $_POST['full-name'],
            'email' => $_POST['email'],
            'pincode' => $_POST['pincode'],
            'password' => $_POST['new-password']
        ]);
        if($flag){
            $_SESSION['logged-in-buyer'] = true;
            $_SESSION['name'] = $_POST['full-name'];
            $_SESSION['pincode'] = $_POST['pincode'];
            $_SESSION['phone'] = $_POST['mobile-number'];
            $_SESSION['email'] = $_POST['email'];
            header("location:index.php");
        }
        else{
            $_SESSION['logged-in-buyer'] = false;
        }
    }
    else{
        echo("<script>console.log('Button Not Clicked')</script>");
    }
?>
<html>
    <head>
        <title>e-Agricultural Marketplace | Buyers - Sign Up</title>
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
                <div class="login-grid-items">
                    <span style="color:blue;font-size: 18px;"><u>Login/Sign In</u></span>
                    <button type="button"style="margin-top:6px;display:block;background-color:dodgerblue;border:none;color:white;padding:6px 20px;border-radius:5px;">Sign Up</button>
                </div>
                <div class="login-grid-items">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> 
                </div>
            </div>

            <div class="overlay-content">
              <a href="index.php"class="active">Home</a>
              <a href="#">Transactions</a>
              <a href="#">About</a>
              <a href="#">Help</a>
              <a href="#">Contact</a>
            </div>
        </div>

        <div style="display: block;margin-top: 70px;"></div>

        <hr style="margin-left: 8px;margin-right: 8px;">
            <center><span style="color:white;font-weight: bold;font-size: 18px;">CREATE YOUR ACCOUNT</span></center>
        <hr style="margin-left: 8px;margin-right: 8px;">

        <div class="sign-up-container">
            <center>
            <form id="new-acc-form"name="sign-up-form"method="post"action="signup.php">
                <div style="display:block;">
                    <i class="material-icons"style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;border-right:none;display:inline-block;border:1px solid black;background-color:black;color:white;height:38px;font-size:40px;vertical-align:-16px;">person</i><input type="text"name="full-name"placeholder="Full Name"class="sign-up-text-box"/>
                </div>

                <div style="display:block;margin-top:10px;">
                    <i class="material-icons"style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;border-right:none;display:inline-block;border:1px solid black;background-color:black;color:white;height:38px;font-size:40px;vertical-align:-16px;">phone</i><input type="text"name="mobile-number"placeholder="Mobile Number"class="sign-up-text-box"/>
                </div>

                <div style="display:block;margin-top:10px;">
                    <i class="material-icons"style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;border-right:none;display:inline-block;border:1px solid black;background-color:black;color:white;height:38px;font-size:40px;vertical-align:-16px;">email</i><input type="text"name="email"placeholder="Email"class="sign-up-text-box"/>
                </div>

                <div style="display:block;margin-top:10px;">
                    <i class="material-icons"style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;border-right:none;display:inline-block;border:1px solid black;background-color:black;color:white;height:38px;font-size:40px;vertical-align:-16px;">location_on</i><input type="text"name="pincode"placeholder="Area Pincode"class="sign-up-text-box"/>
                </div>
                <div style="display:block;margin-top:10px;">
                    <i class="material-icons"style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;border-right:none;display:inline-block;border:1px solid black;background-color:black;color:white;height:38px;font-size:40px;vertical-align:-16px;">password</i><input type="password"name="new-password"placeholder="New Password"class="sign-up-text-box"/>
                </div>
                <div style="display:block;margin-top:10px;">
                    <i class="material-icons"style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;border-right:none;display:inline-block;border:1px solid black;background-color:black;color:white;height:38px;font-size:40px;vertical-align:-16px;">password</i><input type="password"name="confirm-password"placeholder="Confirm Password"class="sign-up-text-box"/>
                </div>
                <input type="submit"name="new-acc-sub-btn"style="display:none;"id="sub-btn"/>
            </form>
            </center>
            <button onclick="document.getElementById('sub-btn').click();"type="submit"name="signup-btn"style="font-size:15px;font-weight:bold;width:100%;border:none;padding:8px 15px;color:white;border-radius:5px;background-color:#5cb85c;">SIGN UP <i class="material-icons"style="color:white;vertical-align:-7px;">login</i></button>
        </div>

        <center><span style="margin-top:10px;display:block;color:white;">Already Have An Account? <a href="#"style="color:white;font-weight:bold;">Login|Sign In</a></span></center>

        <br><br><br><br>

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