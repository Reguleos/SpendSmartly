<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

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

               $chart1_type = "Electric Bills";
               $chart1_sql = "SELECT `month`, `amount` FROM `records` WHERE `user_id` = $user_id AND `year` = 2023 AND `type` = '$chart1_type';";
               $chart1_result = mysqli_query($conn, $chart1_sql);
               while($row = mysqli_fetch_array($chart1_result)){
                    $chart1_month[] = $row['month']; 
                    $chart1_amount[] = $row['amount'];
               }
               $max1 = max($chart1_amount);
               $chart1_max = $max1+($max1/5);

               $chart2_type = "Store Expenses";
               $chart2_sql = "SELECT `month`, `amount` FROM `records` WHERE `user_id` = $user_id AND `year` = 2023 AND `type` = '$chart2_type';";
               $chart2_result = mysqli_query($conn, $chart2_sql);
               while($row = mysqli_fetch_array($chart2_result)){
                    $chart2_month[] = $row['month']; 
                    $chart2_amount[] = $row['amount'];
               }
               $max2 = max($chart2_amount);
               $chart2_max = $max2+($max2/5);

               $chart3_type = "Internet Bills";
               $chart3_sql = "SELECT `month`, `amount` FROM `records` WHERE `user_id` = $user_id AND `year` = 2023 AND `type` = '$chart3_type';";
               $chart3_result = mysqli_query($conn, $chart3_sql);
               while($row = mysqli_fetch_array($chart3_result)){
                    $chart3_month[] = $row['month']; 
                    $chart3_amount[] = $row['amount'];
               }
               $max3 = max($chart3_amount);
               $chart3_max = $max3+($max3/5);

               $chart4_type = "Grocery Expenses";
               $chart4_sql = "SELECT `month`, `amount` FROM `records` WHERE `user_id` = $user_id AND `year` = 2023 AND `type` = '$chart4_type';";
               $chart4_result = mysqli_query($conn, $chart4_sql);
               while($row = mysqli_fetch_array($chart4_result)){
                    $chart4_month[] = $row['month']; 
                    $chart4_amount[] = $row['amount'];
               }
               $max4 = max($chart4_amount);
               $chart4_max = $max4+($max4/5);
               
          }
 ?>
<!DOCTYPE html>
<html>
<head>
     <title> SpendSmartly: Practice Better Budgeting, Spend Smartly </title>
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
          div.body {
               width: 100%;
               margin: 0px;
               top: 0;
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
          table.graphs {
               width: 85%;
               height: 600px;
               margin: 0px auto;
               border-spacing: 30px;
          }
          table.graphs tr td {
               width: 50%;
               height: 50%;
               border: 1px solid #012401;
               border-radius: 10px;
               padding: 0px;
               text-align: center;
          }
          table.graphs tr td p {
               background-color: green;
               margin: 0px;
               height: 50px;
               border-top-left-radius: 10px;
               border-top-right-radius: 10px;
               padding-top: 0px;
               color: #EEEEEE;
               line-height: 50px;
               font-weight: bold;
               font-size: 20px;
          }
          table.graphs tr td canvas {
               margin: 10px auto;
               max-height: 300px;
               max-width: 95%;
          }
          div.body a button.details {
               border: 1px solid #012401;
               border-radius: 10px;
               width: 200px;
               height: 50px;
               align-content: center;
               color: #012401;
               background-color: rgba(0, 0, 0, 0);
               font-size: 17px;
               transition: 0.3s;
               margin-bottom: 15px;
          }
          div.body a button.details:hover {
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
               margin-top: 30px;
               width: 100%;
               height: 100px;
               text-align: center;
          }
          div.footer table {
               width: 80%;
               height: 100%;
               margin: 0px auto;
               
          }
          div.footer table tr td h1.name {
               margin: 0px;
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
               padding-bottom: 14px;
          }
     </style>
</head>
<body>
     <div class="header"> 
          <table>
               <tr>
                    <td> <a href="Home-Page.php"> <p> Home </p> </a> </td>
                    <td> <a href="#"> <p> Records </p> </a> </td>
                    <td> <a href="Profile-Page.php"> <p> Account </p> </a> </td>
                    <td> <a href="About-Page.php"> <p> About </p> </a> </td> 
               </tr>
          </table>
     </div>
     <div class="body"> 
          <h1 class="name"> SpendSmartly </h1>
          <p class="slogan"> Practice Better Budgeting, Spend Smartly. </p>
          <a href="#Expenses"> <button class="view"> View Expenses </button> </a>
          <p class="greet" id="Expenses"> Hello, <?php echo $first_name,'!'; ?> Here are your expenses: </p>
          <!-- <div class="graph-holder" id="expenses"> -->
               <table class="graphs">
                    <tr>
                         <td>
                              <p> <?php echo $chart1_type ?> </p>
                              <canvas id="graph_js1"> </canvas>
                              <a href="#"> <button class="details"> View Full Details </button> </a>
                         </td>
                         <td>
                              <p> <?php echo $chart2_type ?> </p>
                              <canvas id="graph_js2"> </canvas>
                              <a href="#"> <button class="details"> View Full Details </button> </a>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <p> <?php echo $chart3_type ?> </p>
                              <canvas id="graph_js3"> </canvas>
                              <a href="#"> <button class="details"> View Full Details </button> </a>
                         </td>
                         <td>
                              <p> <?php echo $chart4_type ?> </p>
                              <canvas id="graph_js4"> </canvas>
                              <a href="#"> <button class="details"> View Full Details </button> </a>
                         </td>
                    </tr>
               </table>
               <!-- <form action="" method="get">
                    
                    <button type="submit" name="type" value="Electric Bill"> Electric Bill </button>
                    <button type="submit" name="type" value="Water Bill"> Water Bill </button>
                    <button type="submit" name="type" value="Store Expenses"> Store Expenses </button>
               </form> -->
                <br>
          <!-- </div> -->
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

<script >
     const xValues = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];

     const yValues1 = [<?php echo json_encode($chart1_amount[0]) ?>, <?php echo json_encode($chart1_amount[1]) ?>, <?php echo json_encode($chart1_amount[2]) ?>, <?php echo json_encode($chart1_amount[3]) ?>, <?php echo json_encode($chart1_amount[4]) ?>, <?php echo json_encode($chart1_amount[5]) ?>, <?php echo json_encode($chart1_amount[6]) ?>, <?php echo json_encode($chart1_amount[7]) ?>, <?php echo json_encode($chart1_amount[8]) ?>, <?php echo json_encode($chart1_amount[9]) ?>, <?php echo json_encode($chart1_amount[10]) ?>, <?php echo json_encode($chart1_amount[11]) ?>, ];

     const yValues2 = [<?php echo json_encode($chart2_amount[0]) ?>, <?php echo json_encode($chart2_amount[1]) ?>, <?php echo json_encode($chart2_amount[2]) ?>, <?php echo json_encode($chart2_amount[3]) ?>, <?php echo json_encode($chart2_amount[4]) ?>, <?php echo json_encode($chart2_amount[5]) ?>, <?php echo json_encode($chart2_amount[6]) ?>, <?php echo json_encode($chart2_amount[7]) ?>, <?php echo json_encode($chart2_amount[8]) ?>, <?php echo json_encode($chart2_amount[9]) ?>, <?php echo json_encode($chart2_amount[10]) ?>, <?php echo json_encode($chart2_amount[11]) ?>, ];

     const yValues3 = [<?php echo json_encode($chart3_amount[0]) ?>, <?php echo json_encode($chart3_amount[1]) ?>, <?php echo json_encode($chart3_amount[2]) ?>, <?php echo json_encode($chart3_amount[3]) ?>, <?php echo json_encode($chart3_amount[4]) ?>, <?php echo json_encode($chart3_amount[5]) ?>, <?php echo json_encode($chart3_amount[6]) ?>, <?php echo json_encode($chart3_amount[7]) ?>, <?php echo json_encode($chart3_amount[8]) ?>, <?php echo json_encode($chart3_amount[9]) ?>, <?php echo json_encode($chart3_amount[10]) ?>, <?php echo json_encode($chart3_amount[11]) ?>, ];

     const yValues4 = [<?php echo json_encode($chart4_amount[0]) ?>, <?php echo json_encode($chart4_amount[1]) ?>, <?php echo json_encode($chart4_amount[2]) ?>, <?php echo json_encode($chart4_amount[3]) ?>, <?php echo json_encode($chart4_amount[4]) ?>, <?php echo json_encode($chart4_amount[5]) ?>, <?php echo json_encode($chart4_amount[6]) ?>, <?php echo json_encode($chart4_amount[7]) ?>, <?php echo json_encode($chart4_amount[8]) ?>, <?php echo json_encode($chart4_amount[9]) ?>, <?php echo json_encode($chart4_amount[10]) ?>, <?php echo json_encode($chart4_amount[11]) ?>, ];

     new Chart("graph_js1", {
          type: "line",
          data: {
               labels: xValues,
               datasets: [{
                    fill: false,
               lineTension: 0,
               backgroundColor: "#012401",
               borderColor: "rgba(1,36,1,0.3)",
               data: yValues1
               }]
          },
          options: {
               legend: {display: false},
               maintainAspectRatio: false,
               scales: {
                    yAxes: [{ticks: {min: 0, max: <?php echo $chart1_max ?> }}],
               }
          }
     });


     new Chart("graph_js2", {
          type: "line",
          data: {
               labels: xValues,
               datasets: [{
                    fill: false,
               lineTension: 0,
               backgroundColor: "#012401",
               borderColor: "rgba(1,36,1,0.3)",
               data: yValues2
               }]
          },
          options: {
               legend: {display: false},
               maintainAspectRatio: false,
               scales: {
                    yAxes: [{ticks: {min: 0, max: <?php echo $chart2_max ?> }}],
               }
          }
     });

     new Chart("graph_js3", {
          type: "line",
          data: {
               labels: xValues,
               datasets: [{
                    fill: false,
               lineTension: 0,
               backgroundColor: "#012401",
               borderColor: "rgba(1,36,1,0.3)",
               data: yValues3
               }]
          },
          options: {
               legend: {display: false},
               maintainAspectRatio: false,
               scales: {
                    yAxes: [{ticks: {min: 0, max: <?php echo $chart3_max ?> }}],
               }
          }
     });

     new Chart("graph_js4", {
          type: "line",
          data: {
               labels: xValues,
               datasets: [{
                    fill: false,
               lineTension: 0,
               backgroundColor: "#012401",
               borderColor: "rgba(1,36,1,0.3)",
               data: yValues4
               }]
          },
          options: {
               legend: {display: false},
               maintainAspectRatio: false,
               scales: {
                    yAxes: [{ticks: {min: 0, max: <?php echo $chart4_max ?> }}],
               }
          }
     });
</script> 