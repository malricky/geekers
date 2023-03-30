<?php
    session_start();
    require "database_connector.php";
    require 'functions.php';
?>
<html>
    <head>
        <title>e-Agricultural Marketplace | Buyers</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet"href="src/stylesheet.css"/>
    </head>
    <body>

        <!-- The Modal -->
        <div id="myModal" class="modal">

            <div class="modal-content">

                <div class="modal-header">
                    <span style="font-weight: bold;">SEND BUYING REQUEST</span>
                </div>

                <div class="modal-body">
                    <span style="display: block;"><b>Buyer's Name:</b> <span id="buyer-name">Himesh Kumar Yadav</span></span>
                    <span style="display: block;"><b>Price Offered:</b> &#8377;<span id="offered-price">500</span>/QUNITAL</span>

                    <form name="buying-request">
                        <label style="display: block;margin-top: 5px;font-weight: bold;">Quantity To Be Sold</label>
                        <input type="text"name="quantity"placeholder="Quantity"style="width:50%;height:25px;"/> <span>QUINTAL(s)</span>
                    
                        <label style="display: block;margin-top: 5px;font-weight: bold;">Preferred Price (in &#8377;)</label>
                        <input type="text"id="price-text-box"name="price"placeholder="Price"style="width:30%;height:25px;"value="500"/> <span>/QUINTAL(s)</span>
                    </form>
                </div>

                <div class="modal-footer">
                    <button name="submit-buying-requset"type="submit"style="background-color:white;padding:5px 15px;color:#5cb85c;font-weight:bold;border:none;border-radius:4px;">SEND REQUEST</button>
                    <button class="close"name="submit-buying-requset"type="button"style="background-color:white;padding:5px 15px;color:#5cb85c;font-weight:bold;border:none;border-radius:4px;margin-left:6px;">CLOSE</button>
                </div>

            </div>
  
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
            </div>
        </div>

        <div style="display: block;margin-top: 70px;"></div>

        <hr style="margin-left: 8px;margin-right: 8px;">
            <center><span style="color:white;font-weight: bold;font-size: 18px;">AVAILABLE BUYERS</span></center>
        <hr style="margin-left: 8px;margin-right: 8px;">

        <div class="buyers-grid">

            <?php
                $d_base = new Users();
                $d_base = $d_base->get_Database();
                $data = $d_base->getReference("crop_types/{$_GET['crop_type']}/{$_GET['variety']}/dealers")->getSnapshot()->getValue();
                foreach($data as $key => $value){
                    $buyer_name = getBuyerName($key);
                    ?>
                    <div class="buyers-view buyers-view-grid">

<div class="buyers-sub-grid-items"style="border-top-left-radius:5px;border-bottom-left-radius:5px;text-align:center;padding:5px;padding-left:0px;padding-top:16px;border-right:1px solid gray;">
    <img src="assets/profile.png"style="width:40px;height:40px;"/>
</div>

<div class="buyers-sub-grid-items"style="border-top-right-radius:5px;border-bottom-right-radius:5px;padding-left:0px;">
    <span style="display: block;margin-left: 4px;font-weight: bold;"><?php echo $buyer_name; ?></span>
    <span style="display: block;color:gray;font-size: 11px;margin-left: 4px;"><i class="material-icons"style="font-size:11px;vertical-align:-2px;">phone</i> <?php echo $key; ?></span>
    <span style="display: block;font-size: 11px;margin-left: 4px;">PRICE: &#8377;<?php echo $value; ?>/QUINT</span>
    <span id="request-btn"onclick="showModal(<?php echo '\''.ucwords(strtolower($buyer_name)).'\',\''.$value.'\''; ?>)"style="margin-top:6px;padding:5px;display: block;background-color: dodgerblue;color:white;font-size: 12px;text-align: center;">SEND REQUEST</span>
</div>

</div>
                    <?php
                }
            ?>

            <!--

            <div class="buyers-view buyers-view-grid">

                <div class="buyers-sub-grid-items"style="border-top-left-radius:5px;border-bottom-left-radius:5px;text-align:center;padding:5px;padding-left:0px;padding-top:16px;border-right:1px solid gray;">
                    <img src="assets/profile.png"style="width:40px;height:40px;"/>
                </div>

                <div class="buyers-sub-grid-items"style="border-top-right-radius:5px;border-bottom-right-radius:5px;padding-left:0px;">
                    <span style="display: block;margin-left: 4px;font-weight: bold;">MANISH MAITY</span>
                    <span style="display: block;color:gray;font-size: 11px;margin-left: 4px;"><i class="material-icons"style="font-size:11px;vertical-align:-2px;">phone</i> 8766509876</span>
                    <span style="display: block;font-size: 11px;margin-left: 4px;">PRICE: &#8377;550/QUINT</span>
                    <span id="request-btn"onclick="showModal()"style="margin-top:6px;padding:5px;display: block;background-color: dodgerblue;color:white;font-size: 12px;text-align: center;">SEND REQUEST</span>
                </div>

            </div>

            <div class="buyers-view buyers-view-grid">

                <div class="buyers-sub-grid-items"style="border-top-left-radius:5px;border-bottom-left-radius:5px;text-align:center;padding:5px;padding-left:0px;padding-top:16px;border-right:1px solid gray;">
                    <img src="assets/profile.png"style="width:40px;height:40px;"/>
                </div>

                <div class="buyers-sub-grid-items"style="border-top-right-radius:5px;border-bottom-right-radius:5px;padding-left:0px;">
                    <span style="display: block;margin-left: 4px;font-weight: bold;">RAVI SHANKAR</span>
                    <span style="display: block;color:gray;font-size: 11px;margin-left: 4px;"><i class="material-icons"style="font-size:11px;vertical-align:-2px;">phone</i> 7809673305</span>
                    <span style="display: block;font-size: 11px;margin-left: 4px;">PRICE: &#8377;750/QUINT</span>
                    <span id="request-btn"onclick="showModal()"style="margin-top:6px;padding:5px;display: block;background-color: dodgerblue;color:white;font-size: 12px;text-align: center;">SEND REQUEST</span>
                </div>

            </div>

            <div class="buyers-view buyers-view-grid">

                <div class="buyers-sub-grid-items"style="border-top-left-radius:5px;border-bottom-left-radius:5px;text-align:center;padding:5px;padding-left:0px;padding-top:16px;border-right:1px solid gray;">
                    <img src="assets/profile.png"style="width:40px;height:40px;"/>
                </div>

                <div class="buyers-sub-grid-items"style="border-top-right-radius:5px;border-bottom-right-radius:5px;padding-left:0px;">
                    <span style="display: block;margin-left: 4px;font-weight: bold;">MANOJ SINGH</span>
                    <span style="display: block;color:gray;font-size: 11px;margin-left: 4px;"><i class="material-icons"style="font-size:11px;vertical-align:-2px;">phone</i> 9566342311</span>
                    <span style="display: block;font-size: 11px;margin-left: 4px;">PRICE: &#8377;400/QUINT</span>
                    <span id="request-btn"onclick="showModal()"style="margin-top:6px;padding:5px;display: block;background-color: dodgerblue;color:white;font-size: 12px;text-align: center;">SEND REQUEST</span>
                </div>

            </div> -->
            
        </div>

        <br><br><br><br><br><br><br><br><br><br><br>

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
            // Get the modal
            var modal = document.getElementById("myModal");
            
            // Get the button that opens the modal
            var btn = document.getElementById("request-btn");
            
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            
            // When the user clicks the button, open the modal 
            function showModal(name,price) {
              modal.style.display = "block";
              document.getElementById('buyer-name').innerHTML = name;
              document.getElementById('offered-price').innerHTML = price;
              document.getElementById('price-text-box').value = price;
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
            </script>

    </body>
</html>