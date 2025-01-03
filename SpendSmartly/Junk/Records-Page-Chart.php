
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

               $chart_type = $_GET['type'];
               $chart_year = $_GET['year'];
               $chart_sql = "SELECT `month`, `amount` FROM `records` WHERE `user_id` = '$user_id' AND `year` = '$chart_year' AND `type` = '$chart_type';";
               $chart_result = mysqli_query($conn, $chart_sql);
               while($row = mysqli_fetch_array($chart_result)){
                    $chart_month[] = $row['month']; 
                    $chart_amount[] = $row['amount'];
               }
               //$chart_amount_fmax = array_diff($chart_amount, [null]);
               $max1 = max($chart_amount);
               if($max1==0 || $max1==null) {
                    $chart_max = 100;
               } else {
                    $chart_max = $max1+($max1/5);
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
               top: 0;
               text-align: center;
          }
          div.body h1 {
               margin: 90px auto 15px auto;
          }
          div.body div.chart {
               margin: 0px auto 70px auto;
               width: 80%;
               border: 1px solid #012401;
               border-radius: 8px;
               display: grid;
               grid-template-columns: auto 1px 75%;
          }
          div.body div.chart div.list {
               text-align: left;
               padding: 10%;
               line-height: 30px;
          }
          div.body div.chart div.list p {
               text-decoration: none;
               margin: 0px;
               font-weight: normal;
               transition: 0.3s;
          }
          div.body div.chart div.list a {
               text-decoration: none;
          }
          div.body div.chart div.list a:hover {
               text-decoration: underline dashed;
               text-shadow: 0 0 1px #012401;
               transition: 0.2s;
          }
          div.body div.chart div.list ul {
               padding-left: 15px;
               margin: 0px;
          }
          div.body div.chart div.line {
               align-content: center;
          }
          div.body div.chart div.line hr {
               height: 90%;
               background-color: #012401;
          }
          div.body div.chart div.graphs {
               width: 90%;
               margin: 20px auto 0px auto;
               border-spacing: 30px;
               border-radius: 6px;
               text-align: center;
               font-size: 0px;
          }
          div.body div.chart div.graphs div.graph-container {
               height: 480px;
               margin-top: 30px;
               margin-bottom: 50px;
               border: 1px solid #012401;
               border-spacing: 30px;
               border-radius: 6px;
          }
          div.body div.chart div.message {
               position: absolute;
               width: 54%;
          }
          div.body div.chart div.message p.success {
               margin: 0px;
               font-size: 12px;
          }
          div.body div.chart div.graphs p.label {
               background-color: green;
               margin: 0px;
               height: 50px;
               border-top-left-radius: 6px;
               border-top-right-radius: 6px;
               padding-top: 0px;
               color: #EEEEEE;
               line-height: 50px;
               font-weight: bold;
               font-size: 20px;
          }
          div.body div.chart div.graphs canvas {
               margin: 40px auto 20px auto;
               max-height: 300px;
               max-width: 95%;
          }
          div.body a button.view-edit {
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
          div.body a button.view-edit:hover {
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
          <h1> Records </h1>
          <?php if (isset($_GET['success'])) { ?>
               <div class="message"> 
                    <p class="success"> <?php echo $_GET['success']; ?> </p>
               </div>
          <?php } ?>
          <div class="chart">
               <div class="list">
                    <?php 
                    if ($typenum_value > 0) {
                         $i = 1;
                         $index = 0;
                         $year_index = 0;
                         while($i<=$typenum_value) { ?>
                              <p> <?php echo $typenum[$index] ?> </p>
                              <ul> 
                              <?php 
                              while($typenum[$index]==$year_type[$year_index]){ ?>
                                   <li> <a href="Records-Page-Chart.php?type=<?php echo$year_type[$year_index]?>&year=<?php echo$year_year[$year_index]?>"> <?php echo $year_year[$year_index] ?> </a> </li>
                              <?php 
                                   $year_index++;
                                   if($year_index==$year_count) {
                                        // $year_type[$year_index] = null;
                                        // $year_year[$year_index] = null;
                                        break;
                                   } 
                              }
                              
                              ?>
                              </ul>
                         <?php 
                         $i++;
                         $index++;
                         }
                    } 
                    echo "i: ", $i, ", index: ", $index, ", year_index: ", $year_index, ", typenum_value: ", $typenum_value, ", year_count: ", $year_count ; ?>
                    <a href="New-Record-Page.php"> Create new record </a> <br>
               </div>
               <div class="line"> 
                    <hr>
               </div>

               <div class="graphs">
                    
                    <div class="graph-container">
                         <p class="label"> <?php echo $chart_type ?> of <?php echo $chart_year ?> </p>
                         <canvas id="graph_js"> </canvas>
                         <a href="#"> <button class="view-edit"> View Note </button> </a>
                         <?php $type = $_GET['type']; $year = $_GET['year']; ?>
                         <a href="Edit-Record-Page.php?type=<?php echo$type?>&year=<?php echo$year?>"> <button class="view-edit"> Edit Record </button> </a>
                    </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script type="text/javascript">
     const xValues = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];

     const yValues = [<?php echo json_encode($chart_amount[0]) ?>, 
                      <?php echo json_encode($chart_amount[1]) ?>, 
                      <?php echo json_encode($chart_amount[2]) ?>, 
                      <?php echo json_encode($chart_amount[3]) ?>, 
                      <?php echo json_encode($chart_amount[4]) ?>, 
                      <?php echo json_encode($chart_amount[5]) ?>, 
                      <?php echo json_encode($chart_amount[6]) ?>, 
                      <?php echo json_encode($chart_amount[7]) ?>, 
                      <?php echo json_encode($chart_amount[8]) ?>, 
                      <?php echo json_encode($chart_amount[9]) ?>, 
                      <?php echo json_encode($chart_amount[10]) ?>, 
                      <?php echo json_encode($chart_amount[11]) ?>];

     new Chart("graph_js", {
          type: "line",
          data: {
               labels: xValues,
               datasets: [{
                    fill: false,
               lineTension: 0,
               backgroundColor: "#012401",
               borderColor: "rgba(1,36,1,0.3)",
               data: yValues
               }]
          },
          options: {
               legend: {display: false},
               maintainAspectRatio: false,
               scales: {
                    yAxes: [{ticks: {min: 0, max: <?php echo $chart_max ?> }}],
               }
          }
     });
</script> 