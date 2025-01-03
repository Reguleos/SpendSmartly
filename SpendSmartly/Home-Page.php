<?php 
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

     $user_id = $_SESSION['user_id']; 
     
     $sname = "localhost";
     $uname = "root";
     $password = "";
     $db_name = "pbetracker_db";

     $conn = mysqli_connect($sname, $uname, $password, $db_name);
          if (!$conn) {
               echo "Connection failed!";
          }
          else{
               $sql = "SELECT * FROM `user_profile` WHERE `user_id`=$user_id;";
               $result = mysqli_query($conn, $sql);
               while($row = mysqli_fetch_array($result)){
                    $uname = $row['username']; 
                    $pass = $row['password'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $birthday = $row['birthday'];
                    $age = $row['age'];
                    $gender = $row['gender'];
                    $address = $row['address'];
                    $e_mail = $row['e_mail'];
                    $mobile_number = $row['mobile_number'];
               }
          }

          $typenum_sql = "SELECT DISTINCT `type` FROM `records` WHERE `user_id`=$user_id ORDER BY `type`;";
          $typenum_result = mysqli_query($conn, $typenum_sql);
          while($row = mysqli_fetch_array($typenum_result)){
               $typenum[] = $row['type']; 
          }
          if (empty($typenum)==true) {
               $typenum_value = 0;
          } else {
               $typenum_value = count($typenum);
          }

          $year_sql = "SELECT DISTINCT `type`, MAX(`year`) AS 'recent' FROM `records` WHERE `user_id`= '$user_id' GROUP BY `type` ORDER BY `type`; ";
          $year_result = mysqli_query($conn, $year_sql);
          while($row = mysqli_fetch_array($year_result)){
               $year_type[] = $row['type']; 
               $year_year[] = $row['recent'];
          }
          if (empty($typenum)==true) {
               $year_count = null;
          } else {
               $year_count = count($year_type);
          }

 ?>
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
               height: auto;
               width: 100%;
               scroll-behavior: smooth;
               scrollbar-width: none;
          }
          body {
               background-color: #EEEEEE;
               background-attachment: fixed;
               margin: 0px;
          }
          div.header {
               width: 100%;
               margin: 0px 0px;
               background: #379237;
               position: fixed;
               top: 0;
          }
          div.header table {
               margin: 0px 10% 0px auto;
               border: 0px solid white;
               border-spacing: 0px;
          }
          div.header table tr td a {
               font-size: 17px;
               text-decoration: none;
          }
          div.header table tr td a p {
               padding: 15px;
               margin: 0px;
               background: rgba(0, 0, 0, 0.0);
               color: #EEEEEE;
               transition: 0.3s;
          }
          div.header table tr td a p:hover {
               padding: 15px 25px;
               margin: 0px;
               background: #1A5D1A;
               color: #EEEEEE;
               transition: 0.3s;
          }
          div.header table tr td button.Drop-Button {
               border: none;
               font-size: 17px;
               cursor: pointer;
               padding: 15px;
               margin: 0px;
               background: rgba(0, 0, 0, 0.0);
               color: #EEEEEE;
               transition: 0.3s;
          }
          div.header table tr td button.Drop-Button:hover {
               font-size: 17px;
               padding: 15px 25px;
               margin: 0px;
               background: #1A5D1A;
               color: #EEEEEE;
               transition: 0.3s;
          }
          div.header table tr td div.Records-Dropdown {
               position: relative;
               display: inline-block;
          }
          div.header table tr td div.Records-Dropdown div.Records {
               display: none;
               position: absolute;
               min-width: 150px;
               overflow: auto;
               z-index: 1;
               background-color: green;
               border-top: 1px solid #EEEEEE;
          }
          div.header table tr td div.Records-Dropdown div.Records a {
               display: block;
               color: #EEEEEE;
               padding: 8px 10px;
          }
          div.header table tr td div.Records-Dropdown div.Records a:hover {
               display: block;
               color: #EEEEEE;
               padding: 8px 10px;
               background: #1A5D1A;
               transition: 0.3s;
          }
          div.header table tr td div.Records-Dropdown:hover div.Records {
               display: block !important;
          }
          div.header table tr td div.Records-Dropdown:hover button.Drop-Button {
               background-color: #1A5D1A !important;
               padding: 15px 25px;
          }
          div.body {
               width: 100%;
               margin: 0px;
               text-align: center;
          }
          div.body h1.name {
               margin: 0px;
               padding-top: 300px;
               font-size: 50px;
               text-align: center;
               text-decoration: underline;
          }
          div.body p.slogan {
               font-size: 18px;
               font-style: italic;
               text-align: center;
               margin-top: 0px;
               padding-bottom: 5px;
          }
          div.body a button.view {
               border: 1px solid #012401;
               border-radius: 10px;
               width: 200px;
               height: 60px;
               margin: 20px 0px;
               color: #012401;
               background-color: rgba(0, 0, 0, 0);
               font-size: 17px;
               margin-bottom: 200px;
               transition: 0.3s;
          }
          div.body a button.view:hover {
               border: 1px solid green;
               background-color: green;
               border-radius: 10px;
               width: 200px;
               height: 60px;
               margin: 20px 0px;
               cursor: pointer;
               color: #EEEEEE;
               font-size: 17px;
               margin-bottom: 200px;
               transition: 0.3s;
          }
          div.body p.greet {
               width: 80%;
               font-size: 20px;
               font-weight: 700;
               text-align: left;
               margin: 0px auto;
               scroll-margin-top: 100px;
          }
          div.body div.buttons {
               border: 0px;
               width: 80%;
               margin: 0px auto;
               padding: 15px;
               display: grid;
               
               grid-template-columns: repeat(auto-fit, minmax(220px, auto));
          }
          div.body div.button-cell {
               position: relative;
          }
          div.body a button.types {
               border: 1px solid #012401;
               border-radius: 10px;
               width: 90%;
               height: 50px;
               align-content: center;
               color: #012401;
               background-color: rgba(0, 0, 0, 0);
               font-size: 17px;
               transition: 0.3s;
               z-index: -1;
               margin-bottom: 25px;
          }
          div.body a button.types:hover {
               border: 1px solid green;
               background-color: green;
               border-radius: 10px;
               width: 90%;
               height: 50px;
               cursor: pointer;
               color: #EEEEEE;
               font-size: 17px;
               transition: 0.3s;
               margin-bottom: 25px;
          }
          div.body div.about {
               width: 80%;
               display: grid;
               grid-template-columns: 45% 50%;
               gap: 5%;
               margin: 90px auto 120px auto;
          }
          div.body div.about div.texts {
               width: 100%;
               position: relative;
               align-content: center;
          }
          div.body div.about div.texts h1.name {
               margin: 0px;
               padding: 0px;
               font-size: 50px;
               text-align: left;
               text-indent: 0px;
               text-decoration: underline;
          }
          div.body div.about div.texts p.slogan {
               font-size: 18px;
               font-style: italic;
               text-align: left;
               text-indent: 0px;
               margin-top: 0px;
               padding-bottom: 5px;
          }
          div.body div.about div.texts p.paragraph {
               text-indent: 10%;
               text-align: justify;
               padding-bottom: 10px;
               text-decoration: none;
          }
          div.body div.about div.texts a {
               text-decoration: none;
          }
          div.body div.about:hover div.texts a {
               text-decoration: underline dashed;
               text-shadow: 0 0 1px #012401;
               transition: 0.3s;
          }
          div.body div.about div.texts hr {
               width: 0%;
               height: 5px;
               position: absolute;
               background-color: #012401;
               border: 0px;
               transition: 0.3s;
               left: 0;
          }
          div.body div.about:hover div.texts hr {
               width: 100%;
               height: 5px;
               position: absolute;
               background-color: #012401;
               border: 0px;
               transition: 0.3s;
          }
          div.body div.about div.image {
               width: 100%;
               position: relative;
          }
          div.body div.about div.image img {
               width: 100%;
          }
          div.footer {
               background-color: #379237;
               margin-top: 30px;
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
     <div class="header"> 
          <table>
               <tr>
                    <td> <a href="Home-Page.php"> <p> Home </p> </a> </td>
                    <td > 
                         <div class="Records-Dropdown"> 
                              <button class="Drop-Button"> Records </button>
                              <?php 
                              if($typenum_value!=0) { ?>
                                   <div class ="Records"> 
                                        <a href="Records-Page.php"> View Records </a>
                                        <a href="New-Record-Page.php"> Create new record </a>
                                   </div>
                              <?php 
                              } else {?>
                                   <div class ="Records"> 
                                        <a href="New-Record-Page.php"> Create new record </a>
                                   </div>
                              <?php 
                              } ?> 
                         </div>
                    </td>
                    <td> 
                         <div class="Records-Dropdown">
                              <button class="Drop-Button"> Account </button>
                              <div class="Records">
                                   <a href="Profile-Page.php"> Profile </a>
                                   <a href="Logout-Function.php"> Log Out</a>
                              </div>
                         </div>
                    </td>
                    <td> <a href="About-Page.php"> <p> About </p> </a> </td> 
               </tr>
          </table>
     </div>
     <div class="body"> 
          <h1 class="name"> SpendSmartly </h1>
          <p class="slogan"> Practice Better Budgeting, Spend Smartly. </p>
          <a href="#Expenses"> <button class="view"> View Expenses </button> </a>
          <?php if($typenum_value!=0) { ?>
               <p class="greet" id="Expenses"> Hello, <?php echo $first_name,'!'; ?> Here are your expenses: </p>
          <?php 
          } else { ?>
               <p class="greet" id="Expenses"> Hello, <?php echo $first_name,'!'; ?> It looks like you have no records yet. Click here to create one. </p>
          <?php } ?>
          <div class="buttons">
               <?php 
               if ($typenum_value > 0) {
                    $i = 1; 
                    $index = 0;
                    $year_index = 0;
                    while($i<=$typenum_value) {
                         while($typenum[$index]==$year_type[$year_index]){ ?>
                               <a href="Records-Page-Chart.php?type=<?php echo$typenum[$index]?>&year=<?php echo$year_year[$year_index]?>"> <button class="types"> <?php echo $typenum[$index] ?> </button> </a> 
                         <?php 
                              $year_index++;
                              if($year_index==$year_count) {
                                   $year_type[$year_index] = null;
                                   $year_year[$year_index] = null;
                              }
                         }
                    $i++;
                    $index++; 
                    } ?>
                    <div class="button-cell">
                         <a href="New-Record-Page.php"> <button class="types"> + Create New Record </button> </a>
                    </div>
               <?php
               } else { ?>
                    <div class="button-cell">
                         <a href="New-Record-Page.php"> <button class="types"> + Create a Record </button> </a>
                    </div>
               <?php } ?> 
          </div>
          <div class="about">
               <div class="texts">
                    <h1 class="name"> SpendSmartly </h1>
                    <p class="slogan"> Practice Better Budgeting, Spend Smartly. </p>
                    <p class="paragraph"> SpendSmartly is dedicated to simplifying your financial life. Our user-friendly interface allows you to effortlessly track bills, manage monthly expenses, and gain valuable insights into your spending patterns. Security and privacy are our top priorities, ensuring your financial data remains confidential. Our team is committed to promoting financial literacy and empowering individuals to make... <a href="About-Page.php"> See more</a>. </p>
                    <hr> 
               </div>
               <div class="image">
                    <img src="Papers.png">
               </div>
          </div>
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

<?php 
}
else{
     header("Location: Log-In-Page.php");
     exit();
}?>