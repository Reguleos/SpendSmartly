<!DOCTYPE html>
<html>
<head>
	<title> SpendSmartly: Practice Better Budgeting, Spend Smartly </title>
	<link rel="icon" type="image/x-icon" href="Logo.ico">
	<style type="text/css">
		* {
			font-family: sans-serif;
			color: #012401;
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
			background-image: url('Back-wave.png'), linear-gradient(#EEEEEE, #EEEEEE);
			background-size: contain;
			background-repeat: no-repeat;
			animation: 4s infinite alternate float;
			margin: 0;
		}
		div.background-2 {
			background-image: url('Front-wave.png');
			background-size: contain;
			background-repeat: no-repeat;
			animation: 3s infinite alternate-reverse float;
			height: 660px;
			width: 100%;
			position: relative;
			margin: 0;
			bottom: 0;
		}
		section.divider {
			grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
			display: grid;
			width: 70%;
			height: 600px;
			margin-top: 5%;
			margin-left: 15%;
			margin-right: 15%;
			border-bottom: 10.8% solid rgba(0, 0, 0, 0);
			background-image: linear-gradient(rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.4)) , url("Papers.png");
			background-repeat: repeat;
			background-size: auto 600px;
			box-shadow: 5px 5px 10px rgba(0, 0, 0, .2);
			
		}
		div.image-holder {
			width: 100%;
		}
		div.image-holder h1 {
			font-size: 45px;
			margin: 180px 10% 15px 10%;
		}
		div.image-holder p.slogan {
			margin: 0px 10%;
		}
		div.login {
			background-color: rgb(255, 255, 0255);
			width: 100%;
			text-align: center;
			padding: 60px 0px;
		}
		div.login h1 {
			margin-bottom: 10px;
		}
		hr {
			height: 2px;
			background-color: #012401;
			border: 0px;
			width: 80%;
			margin-bottom: 10px;
		}
		div.login p.error {
			margin: 0px 12%;
			font-size: 12px;
			color: #CD1818;
		}
		div.login p.success {
			margin: 0px 12%;
			font-size: 12px;
		}
		div.login p.label {
			width: 150px;
			font-size: 12px;
			text-align: left;
			margin-bottom: 5px;
			margin-left: 12%;
			align-content: center;
		}
		div.login input {
			width: 75%;
			height: 25px;
			border-radius: 8px;
			border: 1px solid #012401; 
			padding: 3px;
			font-size: 14px;
		}
		div.login input:focus {
			width: 75%;
			height: 25px;
			border-radius: 8px;
			border: 1px solid #012401; 
			outline-width: 0px;
			padding: 3px;
			font-size: 14px;
			outline: none;
		}
		div.login button {
			border: 1px solid #012401;
            border-radius: 10px;
            width: 30%;
            height: 40px;
            align-content: center;
            color: #012401;
            background-color: rgba(0, 0, 0, 0);
            font-size: 17px;
            transition: 0.3s;
            z-index: -1;
            margin-top: 20px;
            margin-bottom: 25px;
		}
		div.login button:hover {
			border: 1px solid green;
            background-color: green;
            border-radius: 10px;
            width: 30%;
            height: 40px;
            cursor: pointer;
            color: #EEEEEE;
            font-size: 17px;
            transition: 0.3s;
            margin-bottom: 25px;
		}
		div.login a {
			text-decoration: none;
		}
		div.login a:hover {
			text-decoration: underline dashed;
            text-shadow: 0 0 1px #012401;
            transition: 0.3s;
		}
		div.footer {
               background-color: #379237;
               width: 100%;
               height: 100px;
               text-align: center;
               bottom: 0;
          }
          div.footer table {
               width: 80%;
               height: 100%;
               margin: 0px auto;
          }
          div.footer table tr td h1.name {
               margin: 15px 0px 0px 0px;
               font-size: 40px;
               text-align: left;
               text-decoration: underline;
          }
          div.footer table tr td p.slogan {
               font-size: 15px;
               font-style: italic;
               text-align: left;
               margin-top: 0px;
          }
          div.footer table tr td p.copyright {
               font-size: 17px;
               text-align: right;
          }
	</style>
</head>
<body>
	<div class="background-2">
		     <form action="Login-Actions.php" method="post">
		     	<section class="divider">
		     		<div class="image-holder">
		     			<h1> Welcome to SpendSmartly! </h1>
		     			<hr>
		     			<p class="slogan"> Practice Better Budgeting, Spend Smartly </p>
		     		</div>
		     		<div class="login">
				     	<h1> Log In </h1>
				     	<hr>
				     	<?php if (isset($_GET['error'])) { ?>
				     		<p class="error"> <?php echo $_GET['error']; ?> </p>
				     	<?php } ?>
				     	<?php if (isset($_GET['success'])) { ?>
     						<p class="success"> <?php echo $_GET['success']; ?> </p>
     					<?php } ?>
				     	<p class="label"> Username </p>
				     	<input type="text" name="uname" placeholder="Enter username"><br>

				     	<p class="label"> Password </p>
				     	<input type="password" name="password" placeholder="Enter password"><br>

				     	<a> <button type="submit"> Log In </button> </a>
				     	<p> Don't have an account? <a href="Sign-Up-Page.php"> Sign up. </a> </p>
			     	</div>
		     	</section>
		     </form>
	</div>
	<div class="footer">
          <table>
               <tr>
                    <td> 
                         <h1 class="name"> SpendSmartly </h1>
                         <p class="slogan"> Practice Better Budgeting, Spend Smartly. </p> 
                    </td>
                    <td style="vertical-align: bottom;">  
                         <p class="copyright"> Copyright © 2024 SpendSmartly. All Rights Reserved </p>
                    </td>
               </tr>
          </table>
     </div>
</body>
</html>