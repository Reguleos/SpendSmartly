
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
                    $chart_max = round($max1+($max1/5));
               }
               
               $bulletnum_sql = "SELECT `type`, COUNT(`type`) AS `duplicate` FROM `records` WHERE `user_id`='$user_id' GROUP BY `type` HAVING COUNT(*) > 1;";
               $bulletnum_result = mysqli_query($conn, $bulletnum_sql);
               while($row = mysqli_fetch_array($bulletnum_result)){
                    $bulletnum_arr[] = $row['duplicate']; 
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

               $notes_sql = "SELECT `note` FROM `notes` WHERE `user_id`='$user_id' AND `type`='$chart_type' AND `year`='$chart_year';";
               $notes_result = mysqli_query($conn, $notes_sql);
               while($row = mysqli_fetch_array($notes_result)){
                    $note_note[] = $row['note']; 
                    if($note_note[0]==null) {
                         $notes = "You have no notes for this record...";
                    } else {
                         $notes = $note_note[0]; 
                    }
               }
               
          }
 ?>
<!DOCTYPE html>
<html>
<head>
     <title> SpendSmartly | <?php echo $chart_type ?> of <?php echo $chart_year ?> </title>
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
               line-height: 30px;
               position: relative;
               display: inline-block;
               text-align: center;
          }
          div.body div.chart div.list div.list-subdiv {
               padding: 10% 10% 10px 10%;
               text-align: left;
          }
          div.body div.chart div.list p {
               text-decoration: none;
               margin: 0px;
               font-weight: normal;
               transition: 0.3s;
          }
          div.body div.chart div.list a.year {
               text-decoration: none;
          }
          div.body div.chart div.list a.year:hover {
               text-decoration: underline dashed;
               text-shadow: 0 0 1px #012401;
               transition: 0.2s;
          }
          div.body div.chart div.list a button.new-record-button {
               border: 1px solid #012401;
               border-radius: 10px;
               width: 200px;
               height: 50px;
               color: #012401;
               background-color: rgba(0, 0, 0, 0);
               font-size: 17px;
               transition: 0.3s;
          }
          div.body div.chart div.list a button.new-record-button:hover {
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
          div.body div.chart div.list ul {
               padding-left: 15px;
               margin: 0px;
          }
          div.body div.list h3 {
               margin: 0px;
               font-size: 18px;
          }
          div.body div.list div.notes {
               position: absolute;
               overflow: auto;
               z-index: 1;
               width: 0%;
               bottom: 5%;
               right: 0px;
               border-bottom-left-radius: 8px;
               border-top-left-radius: 8px;
               background-color: green;
               scrollbar-width: none;
               overflow-y: scroll;
          }
          div.body div.list div.notes h2 {
               color: #EEEEEE;
               margin: 20px 20px 8px 20px;
               text-align: right;
          }
          div.body div.list div.notes textarea {
               background-color: green;
               width: 83.5%;
               height: 437px;
               bottom: 0;
               border: 0px;
               resize: none;
               scrollbar-width: none;
               overflow-y: scroll;
               padding: 0px 20px 20px 20px;
               text-align: justify;
               <?php
               if($note_note[0]==null) { ?> 
                    font-style: italic;
                    color: rgba(238, 238, 238, 0.8);
               <?php } else { ?>
                    color: #EEEEEE;
               <?php }?>
               
          }
          div.body div.list div.notes textarea::-webkit-scrollbar {
               display: none;
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
          div.body button.view-edit {
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
          div.body button.view-edit:hover {
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
          <h1> Records </h1>
          <?php if (isset($_GET['success'])) { ?>
               <div class="message"> 
                    <p class="success"> <?php echo $_GET['success']; ?> </p>
               </div>
          <?php } ?>
          <div class="chart">
               <div class="list">
                    <div class="list-subdiv">
                         <?php 
                         if($typenum_value > 0) {
                              $index = 0;
                              $year_index = 0; 
                              foreach($typenum as $type_x) { ?>
                                   <h3> <?php echo $typenum[$index] ?> </h3>
                                   <?php
                                   $bulletnum = $bulletnum_arr[$index]/12;
                                   for($i = 0; $i < $bulletnum; $i++) {
                                        ?>
                                        <ul>
                                             <a href="Records-Page-Chart.php?type=<?php echo$year_type[$year_index]?>&year=<?php echo$year_year[$year_index]?>" class="year"> <li> <?php echo $year_year[$year_index] ?> </li> </a>
                                        </ul>
                                   <?php
                                        $year_index++;
                                   }
                                   $index++;
                              }
                         } ?>
                    </div>
                    <a href="New-Record-Page.php"> <button class="new-record-button"> Create new record </button> </a> <br>
                    <div class="notes" id="notes-div">
                         <h2> Notes </h2>
                         <textarea readonly disabled id="notes"> </textarea>
                    </div>
               </div>
               <div class="line"> 
                    <hr>
               </div>

               <div class="graphs">
                    
                    <div class="graph-container">
                         <p class="label"> <?php echo $chart_type ?> of <?php echo $chart_year ?> </p>
                         <canvas id="graph_js"> </canvas>
                         <button class="view-edit" id="note-button" onclick="notesFunction()"> View Note </button>
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

     document.getElementById("note-button").onclick = function() {
          var notesDiv = document.getElementById("notes-div");
          if (notesDiv.style.width === "0%") {
               notesDiv.style.width = "100%";
               
               notesDiv.style.transition = "all 0.3s";
          } else {
               notesDiv.style.width = "0%";
               notesDiv.style.color = "green";
          }
     };

     function notesFunction() {
          document.getElementById("notes").value = "<?php echo $notes ?>";
     }

</script> 