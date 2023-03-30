<?php
    session_start();
    error_reporting(E_ALL ^ E_WARNING);
    require 'database_connector.php';
    if(!isset($_SESSION['logged-in-buyer'])){
        header("location: login.php");
    }

    if(isset($_POST['add-crop-sub-btn'])){
        $d_base = new Users();
        $d_base = $d_base->get_Database();
        $variety= strtolower($_POST['variety']);
        $flag = $d_base->getReference("users_buyers/{$_SESSION['phone']}/dealing_crops/{$_POST['crop']}/$variety")->set($_POST['price']);
        if($flag){
            $flag = $d_base->getReference("crop_types/{$_POST['crop']}/$variety/dealers/{$_SESSION['phone']}")->set($_POST['price']);
            if($flag){
            header("location: settings.php");
            }
        }
        else{
            echo "<script>console.log('error');</script>";
        }
    }
?>
<html>
    <head>
        <title>e-Agricultural Marketplace | Buyers - Settings</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link rel="stylesheet"href="../src/stylesheet.css"/>
    </head>
    <body>

        <div id="overlay-spinner">
            <div id="loader"></div>
        </div>

        <!-- The Modal -->
        <div id="myModal" class="modal">

            <div class="modal-content">

                <div class="modal-header">
                    <span style="font-weight: bold;">ADD NEW DEALING CROP</span>
                </div>

                <div class="modal-body">

                    <form name="add-crop"style="width:100%;"method="post"action="settings.php">
                        
                    <div class="filter-items"style="width:30%;">
                        <label style="color:black;display:block;font-size: 14px;font-weight: bold;">CROP TYPE</label>
                        <select name="crop"style="border:1px solid grey;height:28px;width:100%;padding:5px 1px;margin-top:3px;border-radius:4px;"onchange="fetchVarieties()"id="crop-type">
                        <option value="all">Select</option>
                        <?php
                            $d_base = new Users();
                            $d_base = $d_base->get_Database();
                            $data = $d_base->getReference('crop_types')->getSnapshot()->getValue();
                            foreach($data as $key => $value){
                                ?>
                        <option value="<?php echo $key; ?>"><?php echo strtoupper($key); ?></option>
                                <?php
                            }
                        ?>
                        </select>
                    </div>

                    <div class="filter-items"style="width:60%;">
                        <label style="color:black;display:block;font-size: 14px;font-weight: bold;">CROP VARIETY</label>
                        <select name="variety"style="border:1px solid grey;height:28px;width:100%;padding:5px 1px;margin-top:3px;border-radius:4px;"id="crop-varieties">
                        <option value="all">Select</option>
                    
                        </select>
                    </div>

                    <div class="filter-items"style="width:100%;">
                    <label style="display: block;margin-top: 5px;font-weight: bold;">PREFERRED PRICE (IN &#8377;)</label>
                        <input type="text"name="price"placeholder="Price"style="border:1px solid grey;width:30%;height:28px;border-radius:4px;padding:3px 5px;"/> <span> /QUINTAL(s)</span>
                    </div>

                    <input type="submit"name="add-crop-sub-btn"id="add-crop-sub-btn"style="display:none"/>

                    </form>
                </div>

                <div class="modal-footer">
                    <button name="submit-buying-requset"type="submit"style="background-color:white;padding:5px 15px;color:#5cb85c;font-weight:bold;border:none;border-radius:4px;"onclick="loadSpinner();document.getElementById('add-crop-sub-btn').click()">ADD CROP</button>
                    <button class="close"name="submit-buying-requset"type="button"style="background-color:white;padding:5px 15px;color:#5cb85c;font-weight:bold;border:none;border-radius:4px;margin-left:6px;">CLOSE</button>
                </div>

            </div>
  
        </div>


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
              <a href="#">Transactions</a>
              <a href="#">About</a>
              <a href="#">Help</a>
              <a href="#">Contact</a>
              <?php
                if(isset($_SESSION['logged-in-buyer'])){
                    if($_SESSION['logged-in-buyer']){
              ?>
              <a href="index.php?logout=true"style="color:blue;">Logout <i class="material-icons"style="vertical-align:-5px;">logout</i></a>
              <?php
                    }
                }
              ?>
            </div>
        </div>

        <div style="display: block;margin-top: 70px;"></div>

        <hr style="margin-left: 8px;margin-right: 8px;">
            <center><span style="color:white;font-weight: bold;font-size: 18px;">DEALING CROPS</span></center>
        <hr style="margin-left: 8px;margin-right: 8px;">

        <button type="button"onclick="showModal()"style="border-radius:20px;font-size:15px;display:block;font-weight:bold;margin-left:10px;background-color:grey;border:none;color:white;padding:7px 25px;">+ Add Crop</button>

        <div class="dealing-crop-container">
            <?php
                $d_base = new Users();
                $d_base = $d_base->get_Database();
                $data = $d_base->getReference("users_buyers/{$_SESSION['phone']}/dealing_crops")->getSnapshot()->getValue();
                foreach($data as $key => $value){
                    $crop_variety = $value;
                    foreach($crop_variety as $crop_name => $crop_price){
                        ?>
                        <div class="crop-tag"><?php echo ucwords($crop_name); ?></div>
                        <?php
                    }
                }
            ?>
        </div>

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

        <script>
            // Get the modal
            var modal = document.getElementById("myModal");
            
            // Get the button that opens the modal
            var btn = document.getElementById("request-btn");
            
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            
            // When the user clicks the button, open the modal 
            function showModal() {
              modal.style.display = "block";
            }
            
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
              modal.style.display = "none";
            }
            
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
              if (event.target == modal) {
                modal.style.display = "none";
              }
            }

            function fetchVarieties(){
                var crop_type = document.getElementById('crop-type').value;
                var crop_varieties = document.getElementById('crop-varieties');

                $.get("api/get_data.php?func=get_crop_variety"+"&crop_type="+crop_type, function(data, status){
                    if(status == 'success'){
                        crop_varieties.innerHTML = "<option value='all'>Select</option>";
                        const varieties = JSON.parse(data);
                        for(var i=0;i<varieties.length;i++){
                            crop_varieties.innerHTML += "<option value='"+varieties[i]+"'>"+varieties[i]+"</option>";
                        }
                    }
                    else{
                        alert("data:"+data+";status:"+status);
                    }
                });

            }

            function loadSpinner() {
                    document.getElementById("overlay-spinner").style.display = "block";
                }
            </script>

    </body>
</html>