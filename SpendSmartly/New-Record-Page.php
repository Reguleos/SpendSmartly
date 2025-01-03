
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
               $typenum_sql = "SELECT DISTINCT `type` FROM `records` WHERE `user_id` = '$user_id' ORDER BY `type`;";
               $typenum_result = mysqli_query($conn, $typenum_sql);
               while($row = mysqli_fetch_array($typenum_result)){
                    $typenum[] = $row['type']; 
               }
               if (empty($typenum)==true) {
                    $typenum_value = 0;
               } else {
                    $typenum_value = count($typenum);
               }

               $year_sql = "SELECT DISTINCT `type`, `year` FROM `records` WHERE `user_id`= '$user_id' ORDER BY `type`;";
               $year_result = mysqli_query($conn, $year_sql);
               while($row = mysqli_fetch_array($year_result)){
                    $year_type[] = $row['type']; 
                    $year_year[] = $row['year'];
               }
               if (empty($typenum)==true) {
                    $year_count = null;
               } else {
                    $year_count = count($year_type);
               }
          }
 ?>
<!DOCTYPE html>
<html>
<head>
     <title> SpendSmartly | New Record </title>
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
               top: 0;
               text-align: center;
          }
          div.body p.success {
               margin: 10px 0px 10px 0px;
               font-size: 12px;
          }
          div.body h1 {
               margin: 90px auto 15px auto;
          }
          div.body div.chart {
               margin: 0px auto 50px auto;
               width: 80%;
               border: 1px solid #012401;
               border-radius: 8px;
               display: grid;
               grid-template-columns: 65% 1px auto;
          }
          div.body div.chart div.table-form {
               width: 90%;
               height: 480px;
               margin: 50px auto;
               border: 0px;
               border-radius: 6px;
               text-align: center;
               border-collapse: collapse;
          }
          div.body div.chart div.table-form tr td.t-header {
               background-color: green;
          }
          div.body div.chart div.table-form tr td.t-header input.t-header {
               margin: 0px;
               height: 50px;
               border: 0px;
               padding-top: 0px;
               color: #EEEEEE;
               line-height: 50px;
               font-weight: bold;
               font-size: 20px;
               text-align: center;
               outline: none;
          }
          div.body div.chart div.table-form tr td.t-header input.t-header::placeholder {
               opacity: 0.7;
          }
          div.body div.chart div.table-form table {
               border-collapse: collapse;
               box-sizing: border-box;
               margin-bottom: 30px;
          }
          div.body div.chart div.table-form table tr td {
               width: 25%;
               height: 20px;
               text-align: right;
               border: 1px solid green;
          }
          div.body div.chart div.table-form table tr td p {
               font-size: 17px;
               padding: 0px 8px;
          }
          div.body div.chart div.table-form table tr td input {
               width: 100%;
               height: 50px;
               border: 0;
               background-color: rgba(0, 0, 0, 0);
               font-size: 17px;
               outline: none;
               padding: 0px;
               text-indent: 8px;
          }
          input::-webkit-outer-spin-button,
          input::-webkit-inner-spin-button {
               -webkit-appearance: none;
               margin: 0;
          }
          input[type=number] {
               -moz-appearance: textfield;
          }
          div.body div.chart div.table-form table tr td input.amount:focus {
               background: #EDF5ED;
          }
          div.body div.chart div.table-form a button.view-edit {
               border: 1px solid #012401;
               border-radius: 10px;
               width: 200px;
               height: 50px;
               align-content: center;
               color: #012401;
               background-color: rgba(0, 0, 0, 0);
               font-size: 17px;
               transition: 0.3s;
               margin: 0px 15px 15px 15px;
          }
          div.body div.chart div.table-form a button.view-edit:hover {
               border: 1px solid green;
               background-color: green;
               border-radius: 10px;
               width: 200px;
               height: 50px;
               cursor: pointer;
               color: #EEEEEE;
               font-size: 17px;
               transition: 0.3s;
          }
          div.body div.chart div.line {
               align-content: center;
          }
          div.body div.chart div.line hr {
               height: 90%;
               background-color: #012401;
          }
          div.body div.chart div.notes {
               text-align: left;
               padding: 10px;
               line-height: 30px;
               background-color: #379237;
               margin: 28px;
               border-radius: 8px;
          }
          div.body div.chart div.notes p {
               text-decoration: none;
               margin: 0px;
               font-weight: bold;
               font-size: 20px;
               color: #EEEEEE;
               text-align: center;
          }
          div.body div.chart div.notes hr {
               background-color: #EEEEEE;
               border: 0px;
               height: 2px;
               width: 0%;
               transition: 0.3s;
          }
          div.body div.chart div.notes:hover hr {
               background-color: #EEEEEE;
               border: 0px;
               height: 2px;
               width: 100%;
          }
          div.body div.chart div.notes textarea {
               border: 0px;
               outline: none;
               background-color: rgba(0, 0, 0, 0);
               color: #EEEEEE;
               font-size: 17px;
               width: 100%;
               height: 90%;
               vertical-align: top;
               resize: none;
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
<body onload="notesFunction()">
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
          <h1> Create a new record </h1>
          <?php if (isset($_GET['error'])) { ?>
               <div class="message"> 
                    <p class="success"> <?php echo $_GET['error']; ?> </p>
               </div>
          <?php } ?>
          <div class="chart">
               <form action="New-Records-Actions.php" method="post" id="records-form">
                    <div class="table-form">
                         <table> 
                              <tr>
                                   <td colspan="3" class="t-header" style="border-right-color: #EEEEEE;"> 
                                        <?php if(isset($_GET['type'])) { ?>
                                             <input type="text"  
                                                    name="type" 
                                                    placeholder="Enter Label" 
                                                    class="t-header"
                                                    value="<?php echo $_GET['type']?>">
                                        <?php } else { ?>
                                             <input type="text"  
                                                    name="type" 
                                                    placeholder="Enter Label" 
                                                    class="t-header">
                                        <?php } ?>
                                   </td>
                                   <td class="t-header">
                                        <?php if(isset($_GET['year'])) { ?>
                                             <input type="number"
                                               min="1901"
                                               max="2100" 
                                               name="year"
                                               placeholder="Enter Year"
                                               class="t-header"
                                               value="<?php echo $_GET['year'] ?>"> 
                                        <?php } else { ?>
                                             <input type="number"
                                               min="1901"
                                               max="2100" 
                                               name="year"
                                               placeholder="Enter Year"
                                               class="t-header"> 
                                        <?php } ?>
                                   </td>
                              </tr>
                              <tr> 
                                   <td>
                                        <p> January </p>
                                   </td>
                                   <td>
                                        <?php if(isset($_GET['january'])) { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="january" 
                                                    placeholder="Enter Amount"
                                                    class="amount"
                                                    value="<?php echo$_GET['january']?>">
                                        <?php } else { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="january" 
                                                    placeholder="Enter Amount"
                                                    class="amount">
                                        <?php } ?>
                                   </td>
                                   <td>
                                        <p> July </p>
                                   </td>
                                   <td>
                                        <?php if(isset($_GET['july'])) { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="july" 
                                                    placeholder="Enter Amount"
                                                    class="amount"
                                                    value="<?php echo$_GET['july']?>">
                                        <?php } else { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="july" 
                                                    placeholder="Enter Amount"
                                                    class="amount">
                                        <?php } ?>
                                   </td>
                              </tr>
                              <tr> 
                                   <td>
                                        <p> February </p>
                                   </td>
                                   <td>
                                        <?php if(isset($_GET['february'])) { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="february" 
                                                    placeholder="Enter Amount"
                                                    class="amount"
                                                    value="<?php echo$_GET['february']?>">
                                        <?php } else { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="february" 
                                                    placeholder="Enter Amount"
                                                    class="amount">
                                        <?php } ?>
                                   </td>
                                   <td>
                                        <p> August </p>
                                   </td>
                                   <td>
                                        <?php if(isset($_GET['august'])) { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="august" 
                                                    placeholder="Enter Amount"
                                                    class="amount"
                                                    value="<?php echo$_GET['august']?>">
                                        <?php } else { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="august" 
                                                    placeholder="Enter Amount"
                                                    class="amount">
                                        <?php } ?>
                                   </td>
                              </tr>
                              <tr> 
                                   <td>
                                        <p> March </p>
                                   </td>
                                   <td>
                                        <?php if(isset($_GET['march'])) { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="march" 
                                                    placeholder="Enter Amount"
                                                    class="amount"
                                                    value="<?php echo$_GET['march']?>">
                                        <?php } else { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="march" 
                                                    placeholder="Enter Amount"
                                                    class="amount">
                                        <?php } ?>
                                   </td>
                                   <td>
                                        <p> September </p>
                                   </td>
                                   <td>
                                        <?php if(isset($_GET['september'])) { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="september" 
                                                    placeholder="Enter Amount"
                                                    class="amount"
                                                    value="<?php echo$_GET['september']?>">
                                        <?php } else { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="september" 
                                                    placeholder="Enter Amount"
                                                    class="amount">
                                        <?php } ?>
                                   </td>
                              </tr>
                              <tr> 
                                   <td>
                                        <p> April </p>
                                   </td>
                                   <td>
                                        <?php if(isset($_GET['april'])) { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="april" 
                                                    placeholder="Enter Amount"
                                                    class="amount"
                                                    value="<?php echo$_GET['april']?>">
                                        <?php } else { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="april" 
                                                    placeholder="Enter Amount"
                                                    class="amount">
                                        <?php } ?>
                                   </td>
                                   <td>
                                        <p> October </p>
                                   </td>
                                   <td>
                                        <?php if(isset($_GET['october'])) { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="october" 
                                                    placeholder="Enter Amount"
                                                    class="amount"
                                                    value="<?php echo$_GET['october']?>">
                                        <?php } else { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="october" 
                                                    placeholder="Enter Amount"
                                                    class="amount">
                                        <?php } ?>
                                   </td>
                              </tr>
                              <tr> 
                                   <td>
                                        <p> May </p>
                                   </td>
                                   <td>
                                        <?php if(isset($_GET['may'])) { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="may" 
                                                    placeholder="Enter Amount"
                                                    class="amount"
                                                    value="<?php echo$_GET['may']?>">
                                        <?php } else { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="may" 
                                                    placeholder="Enter Amount"
                                                    class="amount">
                                        <?php } ?>
                                   </td>
                                   <td>
                                        <p> November </p>
                                   </td>
                                   <td>
                                        <?php if(isset($_GET['november'])) { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="november" 
                                                    placeholder="Enter Amount"
                                                    class="amount"
                                                    value="<?php echo$_GET['november']?>">
                                        <?php } else { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="november" 
                                                    placeholder="Enter Amount"
                                                    class="amount">
                                        <?php } ?>
                                   </td>
                              </tr>
                              <tr> 
                                   <td>
                                        <p> June </p>
                                   </td>
                                   <td>
                                        <?php if(isset($_GET['june'])) { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="june" 
                                                    placeholder="Enter Amount"
                                                    class="amount"
                                                    value="<?php echo$_GET['june']?>">
                                        <?php } else { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="june" 
                                                    placeholder="Enter Amount"
                                                    class="amount">
                                        <?php } ?>
                                   </td>
                                   <td>
                                        <p> December </p>
                                   </td>
                                   <td>
                                        <?php if(isset($_GET['december'])) { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="december" 
                                                    placeholder="Enter Amount"
                                                    class="amount"
                                                    value="<?php echo$_GET['december']?>">
                                        <?php } else { ?>
                                             <input type="number"
                                                    min="0" 
                                                    name="december" 
                                                    placeholder="Enter Amount"
                                                    class="amount">
                                        <?php } ?>
                                   </td>
                              </tr>
                         </table>
                         <a> <button type="submit" class="view-edit"> Save </button> </a>
                    </div>
               </form>
               <div class="line"> 
                    <hr>
               </div>
               <div class="notes">
                    <p> Notes </p>
                    <hr> 
                    <?php if(isset($_GET['notes'])) { 
                         $notes = $_GET['notes']; ?>
                         <textarea type="text" name="notes" form="records-form" placeholder="Enter notes here..." id="notes"></textarea>
                    <?php } else { ?>
                         <textarea type="text" name="notes" form="records-form" placeholder="Enter notes here..."></textarea>
                    <?php } ?>
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
<script>
     function notesFunction() {
          document.getElementById("notes").value = "<?php echo $notes ?>";
     }
</script>
</html>

<?php 
}
else{
     header("Location: Log-In-Page.php");
     exit();
}?>