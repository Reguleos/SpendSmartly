<!DOCTYPE html>
<html>
<head>
	<title> SpendSmartly: Practice Better Budgeting, Spend Smartly </title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		* {
			font-family: sans-serif;
		}
		html {
			height: 100%;
			width: 100%;
		}
		@keyframes float {
			0% {
				background-position-y: 100%;
			}
			100% {
				background-position-y: 110%;
			}
		}
		body {
			background-image: url('Wave2.png'), linear-gradient(180deg, #DED0B6, #B0926A);
			background-size: contain;
			background-repeat: no-repeat;
			background-attachment: fixed;
			animation: 4s infinite alternate float;
			margin: 0;
		}
		div.background-2 {
			background-image: url('Wave1.png');
			background-size: contain;
			background-repeat: no-repeat;
			background-attachment: fixed;
			animation: 3s infinite alternate-reverse float;
			height: 820px;
			width: 100%;
			position: relative;
			margin: 0;
			bottom: 0;
		}
		section.divider {
			grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
			display: grid;
			width: 70%;
			height: 755px;
			margin: 4% 15%;
			boder-bottom: 15.8% solid rgba(0, 0, 0, 0);
			background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(176, 146, 106, 0.2));
			background-color: #DED0B6;
			background-repeat: repeat;
			background-size: 700px;
			box-shadow: 5px 5px 10px rgba(0, 0, 0, .2);
			
		}
		div.image-holder {
			width: 100%;
		}
		div.image-holder h1 {
			font-size: 45px;
			color: #3F2305;
			margin: 270px 10% 15px 10%;
		}
		div.image-holder p.slogan {
			color: ;
			margin: 0px 10%;
		}
		div.signup {
			background-color: rgb(255, 255, 0255);
			width: 100%;
			text-align: center;
			padding: 10px 0px;
		}
		div.signup h2 {
			font-family: sans-serif;
			font-weight: 800;
			margin-bottom: 10px;
			color: #3F2305;
		}
		hr {
			height: 2px;
			background-color: #765827;
			border: 0px;
			width: 80%;
			margin-bottom: 10px;
		}
		div.signup p.error {
			margin: 0px 12%;
			font-size: 12px;
			color: #CD1818;
		}
		div.signup p.label {
			width: 150px;
			font-size: 12px;
			text-align: left;
			margin-top: 7px;
			margin-bottom: 5px;
			margin-left: 12%;
			align-content: center;
		}
		div.signup input {
			width: 75%;
			height: 25px;
			border-radius: 8px;
			margin-bottom: 5px;
			border: 1px solid #3F2305; 
			padding: 3px;
			color: #3F2305;
			font-size: 14px;
		}
		div.signup input:focus {
			width: 75%;
			height: 25px;
			border-radius: 8px;
			margin-bottom: 5px;
			border: 1px solid #3F2305; 
			outline-width: 0px;
			padding: 3px;
			color: #3F2305;
			background-color: #FFFFEC;
			font-size: 14px;
		}
		input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
		div.signup div.name {
			grid-template-columns: repeat(auto-fit, minmax(145px, 1fr));
			display: grid;
			width: 76%;
			margin-left: 12%;
		}
		div.signup div.name div.namedivider {
			width: 100%;
		}
		div.signup div.name div.namedivider p.label {
			margin-left: 0%;
		}
		div.signup div.name div.namedivider input {
			width: 90%;
			height: 25px;
			border-radius: 8px;
			margin-bottom: 5px;
			border: 1px solid #3F2305; 
			padding: 3px;
			color: #3F2305;
			font-size: 14px;
		}
		div.signup div.bday-age-gender {
			grid-template-columns: 50% 25% 25%;
			grid-auto-rows: 1fr;
			display: grid;
			width: 76%;
			margin-left: 12%;
			box-sizing: border-box;
		}
		div.signup div.bday-age-gender div.bdaydivider {
			width: 100%;
		}
		div.signup div.bday-age-gender div.bdaydivider p.label {
			margin-left: 0%;
		}
		div.signup div.bday-age-gender div.bdaydivider input {
			width: 90%;
			height: 25px;
			border-radius: 8px;
			margin-bottom: 5px;
			border: 1px solid #3F2305; 
			padding: 3px;
			color: #3F2305;
			font-size: 14px;
		}
		div.signup div.bday-age-gender div.agdivider {
			width: 100%;
		}
		div.signup div.bday-age-gender div.agdivider p.label {
			margin-left: 0%;
			width: 60px;
		}
		div.signup div.bday-age-gender div.agdivider input {
			width: 80%;
			height: 25px;
			border-radius: 8px;
			margin-bottom: 5px;
			border: 1px solid #3F2305; 
			padding: 3px;
			color: #3F2305;
			font-size: 14px;
			float: right;
		}
		div.signup div.bday-age-gender div.agdivider select {
			width: 80%;
			height: 33px;
			border-radius: 8px;
			margin-bottom: 8px;
			border: 1px solid #3F2305; 
			padding: 3px;
			color: #3F2305;
			font-size: 14px;
			float: right;
		}
		div.signup button {
			border: 1px solid #3F2305;
			border-radius: 8px;
			width: 100px;
			height: 30px;
			margin: 20px 0px;
			font-size: 14px;
			color: #3F2305;
		}
		div.signup button:hover {
			border: 1px solid #3F2305;
			background-color: #3F2305;
			border-radius: 8px;
			width: 100px;
			height: 30px;
			margin: 20px 0px;
			font-size: 14px;
			color: #DED0B6;
			cursor: pointer;
		}
		div.signup a {
			color: #3F2305;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div class="background-2">
		<form action="Sign-Up-Actions.php" method="post">
		    <section class="divider">
		     	<div class="image-holder">
		     		<h1> Welcome to SpendSmartly </h1>
		     		<hr>
		     		<p class="slogan"> Practice Better Budgeting, Spend Smartly </p>
		     	</div>
		     	<div class="signup">
				    <h2> Create an Account </h2>
				    <hr>
				    <?php if (isset($_GET['error'])) { ?>
     					<p class="error"><?php echo $_GET['error']; ?></p>
     				<?php } ?>

				    <p class="label"> Username </p>
				    <?php if (isset($_GET['uname'])){ ?>
				    	<input type="text" 
				    			name="uname" 
				    			placeholder="Enter username" 
				    			value="<?php echo $_GET['uname']; ?>"><br>
					<?php } else{ ?>
						<input type="text" name="uname" placeholder="Enter username"><br>
					<?php } ?>

				    <p class="label"> Password </p>
				    <input type="password" name="password" placeholder="Enter password"><br>

					<p class="label"> Confirm Password </p>
				    <input type="password" name="re_password" placeholder="Confirm password"><br>

				    <div class="name">
				     	<div class="namedivider">
						     <p class="label"> First Name </p>
						    <?php if (isset($_GET['first_name'])){ ?>
						     	<input type="text" 
						     			name="first_name" 
						     			placeholder="Enter first name" 
						     			style="float: left;"
						     			value="<?php echo $_GET['first_name']; ?>"><br>
						    <?php } else{ ?>
						     	<input type="text" name="first_name" placeholder="Enter first name" style="float: left;"><br>
						    <?php } ?>
						</div>
						<div class="namedivider">
						    <p class="label"> First Name </p>
						    <?php if (isset($_GET['last_name'])){ ?>
						     	<input type="text" 
						     			name="last_name" 
						     			placeholder="Enter last name" 
						     			style="float: right;"
						     			value="<?php echo $_GET['last_name']; ?>"><br>
						    <?php } else{ ?>
						     	<input type="text" name="last_name" placeholder="Enter last name" style="float: right;"><br>
						    <?php } ?>
					    </div>
					</div>

					<div class="bday-age-gender">
				     	<div class="bdaydivider">
						    <p class="label"> Birthday </p>
						    <?php if (isset($_GET['birthday'])){ ?>
						    	<input type="date" 
						    			name="birthday" 
						    			style="float: left;"
						    			value="<?php echo $_GET['birthday']; ?>"><br>
						    <?php } else{ ?>
						    	<input type="date" name="birthday" style="float: left;"><br>
						   	<?php } ?>
						</div>

						<div class="agdivider">
						    <p class="label" style="padding-left: 10px;"> Age </p>
						    <?php if (isset($_GET['age'])){ ?>
						    	<input type="number" 
						    			name="age" 
						    			placeholder="Enter age" 
						    			min="0" 
						    			max="150"
						    			value="<?php echo $_GET['age']; ?>"><br>
					    	<?php } else{ ?>
					    		<input type="number" name="age" placeholder="Enter age" min="0" max="150"><br>
					    	<?php } ?>
					    </div>

					    <div class="agdivider">
						    <p class="label" style="padding-left: 15px;"> Gender </p>
						    <?php if (isset($_GET['gender'])){ ?>
						    	<input type="text" 
						    			name="gender" 
						    			placeholder="Enter gender" 
						    			style="float: right;"
						    			value="<?php echo $_GET['gender']; ?>"><br>
							<!-- <select name="gender[]">
							    <option value="" selected> Choose gender </option>
							    <option value="male"> Male </option>
							    <option value="female"> Female </option>
							    <option value="null"> Prefer not to say </option>
							</select>  -->
							<?php } else{ ?>
								<input type="text" name="gender" placeholder="Enter gender" style="float: right;"><br>
							<?php } ?>
					     </div>
					</div>

					<p class="label"> Address </p>
					<?php if (isset($_GET['address'])){ ?>
				    	<input type="text" 
				    			name="address" 
				    			placeholder="Enter address"
				    			value="<?php echo $_GET['address']; ?>"><br>
				    <?php } else{ ?>
						<input type="text" name="address" placeholder="Enter address"><br>
					<?php } ?>

				    <p class="label"> E-mail Address </p>
				    <?php if (isset($_GET['e_mail'])){ ?>
				    	<input type="email" 
				    			name="e_mail" 
				    			placeholder="Enter E-mail address"
				    			value="<?php echo $_GET['e_mail']; ?>"><br>
				    <?php } else{ ?>
						<input type="email" name="e_mail" placeholder="Enter E-mail address"><br>
					<?php } ?>

					<p class="label"> Mobile Number </p>
					<?php if (isset($_GET['mobile_number'])){ ?>
				    	<input type="number" 
				    			name="mobile_number" 
				    			placeholder="Enter mobile number"
				    			value="<?php echo $_GET['mobile_number']; ?>"><br>
				    <?php } else{ ?>
						<input type="number" name="mobile_number" placeholder="Enter mobile number"><br>
					<?php } ?>
				    <a> <button type="submit"> Sign Up </button> </a>
				    <p> Already have an account? <a href="Log-In-Page.php"> Log in. </a> </p>
			    </div>
		    </section>
		</form>
	</div>
</body>
</html>