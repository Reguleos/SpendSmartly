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
 ?>
<!DOCTYPE html>
<html>
<head>
     <title> SpendSmartly | About </title>
     <link rel="icon" type="image/x-icon" href="Logo.ico">
     <style type="text/css">
          * {
               font-family: sans-serif;
               color: #012401;
          }
          html {
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
               z-index: 1;
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
               width: 90%;
               margin: 0px 5% 0px 5%;
               top: 0;
               text-align: center;
          }
          div.body h1 {
               margin: 90px auto 15px auto;
          }
          div.body div.container {
               width: 80%;
               margin: 0px auto 60px auto;
               display: grid;
               grid-template-columns: 47% 47%;
               column-gap: 6%;
          }
          div.body div.paragraph {
               display: inline-block;
               position: relative;
               margin-bottom: 0px;
               display: -webkit-flex;
               display: flex;
               align-items: center;
          }
          div.body div.paragraph p.text {
               font-size: 20px;
               font-weight: 700;
          }
          div.body div.paragraph p.paragraph {
               text-align: justify;
               text-indent: 50px;
          }
          div.body div.image {
               display: inline-block;
               position: relative;
               width: 100%;
          }
          div.body div.image img {
               width: 100%;
               object-fit: scale-down;
               margin-top: 16px;
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
          <h1> About SpendSmartly </h1>
          <div class="container">
               <div class="paragraph">
                    <div>
                         <p class="paragraph"> Welcome to SpendSmartly – we're dedicated to simplifying your financial life. Our user-friendly interface allows you to effortlessly track bills, manage monthly expenses, and gain valuable insights into your spending patterns. Security and privacy are our top priorities, ensuring your financial data remains confidential. Our team is committed to promoting financial literacy and empowering individuals to make informed decisions. Join us on the path to financial success with our expenses tracker – where managing your finances is simple, secure, and personalized. </p>
                         <p class="paragraph"> The goal of SpendSmartly is to not only streamline your financial management but also to help you achieve your financial goals by providing insights, budgeting tools, and personalized recommendations. Join us on your journey to financial wellness with SpendSmartly where managing bills and expenses is easy and secure.</p>
                    </div>
               </div>   
               <div class="image">
                    <image src="Finance.png">
               </div>
               <div class="image">
                    <image src="Logo-Blur.png">
               </div>
               <div class="paragraph">
                    <p class="paragraph"> SpendSmartly is developed by a group of BSIT students from CvSU-Trece Martires City Campus. Driven by our shared passion for technology and financial literacy, we came together to create a platform that simplifies personal finance management. Our journey began with a simple idea: to empower individuals with the knowledge and tools they need to make smart financial decisions. At SpendSmartly, our mission is not just about providing information, but also about fostering a community where users can learn, grow, and achieve their financial goals with confidence. </p>
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