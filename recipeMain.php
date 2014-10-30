<?php
/*
 * project 6
 * J.Burton-Power
 * 06/10/14
 * 
 */
$pageTitle = "recipe Maintence page";
$dbuser = "bliss";
$dbpass = "monkey";
$dbase = "erp";
$con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
if (mysqli_connect_errno($con)) {
    $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
    $errflg = 1;
} else {
    $sql = "SELECT * from recipe";
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
        <title>Drive computing</title>
        <script type='text/javascript'>
            $(document).ready(function()
            {
                

            });
            function doNewRecipe()
            {
                document.location.href = "amendRecipe.php";
            }
            function doAmend(emId)
            {
                $('#recipeId').val(emId);
                document.forms['frmAmend'].submit();
            }
            function doCatagories()
            {
                document.location.href = "catagories.php";
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
        <input type="button" name="project" class="button" id="button1" value="recipe Insert" onclick="doNewRecipe();">
        <input type="button" name="catagories" class="button" id="button2" value="catagories" onclick="doCatagories();">
        <table class="table">
            <tr>
                <td></td>
                <td>recipe Description</td>
                <td>picture</td>
                <td>inscructions</td>
            </tr>
<?php
echo $errMsg;
while ($row = mysqli_fetch_array($result)) {
    $emId = $row['recipeId'];
    echo "<tr>";
    echo "<td><input type='button' value='amend' class='button' onclick='doAmend(\"$emId\");'>" . $emId . "</td>";
    echo "<td>" . $row['recipeDesc'] . "</td>";
    echo "<td>" . $row['picture'] . "</td>";
    echo "<td>" . $row['inscructions'] . "</td>";
    echo "</tr>";
}
mysqli_close($con);
?>
        </table>
        <form name="frmAmend" action="amendRecipe.php" method="post">
            <input type="hidden" name="recipeId" id="recipeId">
        </form>
    </body>
</html>