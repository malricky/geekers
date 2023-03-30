<?php
    session_start();
    require 'database_connector.php';
    require_once('functions.php');
?>
<html>
    <head>
        <title>e-Agricultural Marketplace | Potato</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet"href="src/stylesheet.css"/>
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
                    <span style="color:blue;font-size: 18px;"><u>Login/Sign In</u></span>
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
              <a href="index.php"class="active">Home</a>
              <a href="#">Transactions</a>
              <a href="#">About</a>
              <a href="#">Help</a>
              <a href="#">Contact</a>
              <?php
                if(isset($_SESSION['logged-in'])){
                    if($_SESSION['logged-in']){
              ?>
              <a href="?logout=true"style="color:blue;">Logout <i class="material-icons"style="vertical-align:-5px;">logout</i></a>
              <?php
                    }
                }
              ?>
            </div>
        </div>

        <div style="display: block;margin-top: 70px;"></div>

        <div class="filter-row">
            <form name="filter-form">

                <div class="filter-items"style="vertical-align:middle;">
                    <i class="material-icons"style="color:white;font-size:38px;display:block;">filter_alt</i>
                </div>

                <div class="filter-items">
                    <label style="color:white;display:block;font-size: 14px;font-weight: bold;">CROP TYPE</label>
                    <select name="crop"style="border:none;height:28px;width:90px;padding:5px 1px;margin-top:3px;border-radius:4px;">
                        <option value="all">All</option>
                        <option value="potato">Potato</option>
                        <option value="onion">Onion</option>
                        <option value="cabbage">Cabbage</option>
                        <option value="rice">Rice</option>
                    </select>
                </div>

                <div class="filter-items">
                    <label style="color:white;display:block;font-size: 14px;font-weight: bold;">CROP VARIETY</label>
                    <select name="variety"style="border:none;height:28px;width:110px;padding:5px 1px;margin-top:3px;border-radius:4px;">
                        <option value="all">All</option>
                        <option value="potato">Chandramukhi</option>
                        <option value="onion">Pokhraj</option>
                        <option value="cabbage">Jyoti</option>
                        <option value="rice">S1</option>
                    </select>
                </div>

                <div class="filter-items">
                    <button type="submit"style="border:none;font-weight:bold;background-color:#0DAC50;color:white;padding:7px 18px;border-radius:4px;">APPLY</button>
                </div>

            </form>
        </div>

        <?php
            if(isset($_GET['crop'])){
                $data = new Users();
                $buyer = $data->get_Database();
                $data = $data->get('crop_types');
                $data = $data[$_GET['crop']];
                foreach($data as $crop_variety => $crop_details){
                    $buyer_name = "Not Available";
                    $buyer_price = 0;
                    if($buyer->getReference("crop_types/{$_GET['crop']}/$crop_variety")->getSnapshot()->hasChild("dealers")){
                    $buyer_data = $buyer->getReference("crop_types/{$_GET['crop']}/$crop_variety/dealers")->getSnapshot()->getValue();
                    foreach($buyer_data as $key => $value){
                        if($buyer_price < $value){
                            $buyer_price = $value;
                            $buyer_name = $key;
                        }
                    }
                    $buyer_name = getBuyerName($buyer_name);
                }
                    ?>

        <div onclick="loadSpinner();window.location.href=<?php echo '\'buyers.php?crop_type='.$_GET['crop'].'&variety='.$crop_variety.'\''; ?>"class="crop-container-grid">
            <div class="crops-section"style="text-align:center;border-top-left-radius:5px;border-bottom-left-radius:5px;">
                <img src="assets/<?php echo $crop_details['image']; ?>"style="width:90px;height:90px;"/>
            </div>
            <div class="crops-section">
                <span style="display: block;margin-top: 15px;margin-left: 6px;font-weight: bold;"><?php echo(strtoupper($crop_variety)); ?></span>
                <span style="display: block;margin-top: 5px;margin-left: 6px;color:green;">HIGHEST S.P: &#8377;<?php echo $buyer_price; ?>/QUINTAL</span>
                <span style="display: block;margin-top: 5px;margin-left: 6px;color:blue;font-style: italic;">BUYER: <u><?php echo $buyer_name; ?></u></span>
            </div>
            <div class="crops-section"style="background-color:dodgerblue;border-top-right-radius:5px;border-bottom-right-radius:5px;">
                <i class="material-icons"style="color:white;font-size:35px;display:block;text-align:center;margin-top:25px;">chevron_right</i>
            </div>
        </div>
                    <?php
                }
            }
        ?>
        
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
            function loadSpinner() {
                    document.getElementById("overlay-spinner").style.display = "block";
                }
        </script>

    </body>
</html>