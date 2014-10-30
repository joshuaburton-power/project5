<?php
/*
 * project 6
 * J.Burton-Power
 * 06/10/14
 * 
 */
$pageTitle = "employee record page";
$dbuser = "bliss";
$dbpass = "monkey";
$dbase = "erp";
$con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
if (mysqli_connect_errno($con)) {
    $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
    $errflg = 1;
} else {
    $sql = "SELECT * FROM employee ";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        $errMsg = mysqli_error($con);
    } else {
        //got data
    }
}
?>
<html>
    <head> 
        <link rel="icon" type="image/png" href="favicon.ico"/>
        <script type='text/javascript' src='jquery/jquery.min.js'></script>
        <script type='text/javascript' src='jquery/jquery.ui.min.js'></script>
        <script type='text/javascript' src='project4.js'></script>
        <link href='jquery/css/smoothness/jquery-ui.css' rel='stylesheet'/>
        <link href="project4.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="navgoco/src/jquery.navgoco.js"></script>
        <link rel="stylesheet" href="navgoco/src/jquery.navgoco.css" type="text/css" media="screen"/>
        <title>Core Fitness  </title>
        <script type='text/javascript'>
            $(document).ready(function()
            {
                

            });
            function doNewEmployee()
            {
                document.location.href = "newEmployee.php";
            }
            function doAmend(emId)
            {
                $('#employeeId').val(emId);
                document.forms['frmAmend'].submit();
            }
            function dojobRoll()
            {
                document.location.href = "jobRoll.php";
            }
            function doHome()
            {
                document.location.href = "homePage.php";
            }
        </script>
        <style>
        </style>
    </head>
    <body>
        <?php include_once('header.php');
        ?>
        <input type="button" id="home"class="button" value="home" onclick="doHome();">    
        <input type="button" name="employee" class="button" id="button1" value="Employee Insert" onclick="doNewEmployee();">
        <input type="button" name="jobRoll" class="button" id="button2" value="Job Roll" onclick="dojobRoll();">
        <table>
<?php
echo $errMsg;
while ($row = mysqli_fetch_array($result)) {
    $emId = $row['employeeId'];
    echo "<tr>";
    echo "<td><input type='button' value='amend' class='button' onclick='doAmend(\"$emId\");'>" . $emId . "</td>";
    echo "<td>" . $row['firstName'] . "</td>";
    echo "<td>" . $row['lastName'] . "</td>";
    echo "<td>" . $row['dob'] . "</td>";
    echo "<td>" . $row['niNumber'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "</tr>";
}
mysqli_close($con);
?>
        </table>
        <form name="frmAmend" action="newEmployee.php" method="post">
            <input type="hidden" class='button' name="employeeId" id="employeeId">
        </form>
    </body>
</html>