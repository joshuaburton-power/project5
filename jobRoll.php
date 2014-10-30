<?php
/*
 * project 6
 * J.Burton-Power
 * 06/10/14
 * 
 */
$pageTitle = "job roll";
$amend = false;
$ejobRoleId = $_REQUEST['jobRollId'];
//$amend = true;
$pageTitle = "Amend job roll";
$dbuser = "bliss";
$dbpass = "monkey";
$dbase = "erp";
$con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
if (mysqli_connect_errno($con)) {
    $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
    $errflg = 1;
} else {
    $sql = "SELECT * from jobRole";
    //    echo $sql;
    $result = mysqli_query($con, $sql);
    if (!$result) {
        $errMsg = mysqli_error($con);
    } else {
        
    }
}
?>
<html>
    <head> 
        <link rel="icon" type="image/png" href="favicon.ico"/>
        <script type='text/javascript' src='jquery/jquery.min.js'></script>
        <script type='text/javascript' src='jquery/jquery.ui.min.js'></script>
        <link href='jquery/css/smoothness/jquery-ui.css' rel='stylesheet'/>
        <link href="project4.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="navgoco/src/jquery.navgoco.js"></script>
        <link rel="stylesheet" href="navgoco/src/jquery.navgoco.css" type="text/css" media="screen"/>
        <title>Core Fitness  </title>
        <script type='text/javascript'>
            $(document).ready(function()
            {
                $("#datepicker").datepicker({
                });
                $("#btnAmend").hide();
                $("#amendText").hide();
                doMenu();
            });

            function doHome()
            {
                document.location.href = "firstPage.php";
            }
            function dojobInsert()
            {
                //document.forms['jobRoleId'].submit();

                var jobDesc = $('#jobDesc').val();
                var jobRollId = $('#jobRoleId').val();

                var urlRequest = "insertJobRole";
<?php
if ($amend)
    echo "urlRequest = 'amendJobRoll'";
?>
                $.ajax({
                    url: 'sqlEmployee.php',
                    cache: false,
                    data: {'request': urlRequest, 'jobdesc': jobDesc, 'jobRollId': jobRollId},
                    dataType: 'json',
                    success: function(data)
                    {
                        document.location.href = 'firstPage.php';
                    }
                });
            }
            function doRead(jobRolesId)
            {
                $.ajax({
                    url: 'sqlEmployee.php',
                    cache: false,
                    data: {'request': 'readJobId', 'jobRolesId': jobRolesId},
                    dataType: 'json',
                    success: function(data)
                    {
                        $('#jobRolesId').val(data.jobRolesId);
                        $('#jobDesc').val(data.jobRoleDs);
                        //show div for amend button - hide div for insert burtton
                        $("#btnAmend").show();
                        $("#btnInsert").hide();
                        $("#amendText").show();
                        $("#insertText").hide();
                    }
                });
            }
            function dojobAmend()
            {
                //document.forms['jobRoleId'].submit();

                var jobDesc = $('#jobDesc').val();
                var jobRollId = $('#jobRolesId').val();

                var urlRequest = "amendJobRole";


                $.ajax({
                    url: 'sqlEmployee.php',
                    cache: false,
                    data: {'request': urlRequest, 'jobdesc': jobDesc, 'jobRollId': jobRollId},
                    dataType: 'json',
                    success: function(data)
                    {
                        document.location.href = 'firstPage.php';
                    }
                });
            }
        </script>
        <style>
            #employeeInsert
            {
                border-collapse:collapse;
                border:2px solid black;
            }
        </style>
    </head>
    <body>
        <?php include_once('header.php');
        ?>     
        <div id="home">
            <input type="button" name="home" class="button" id="home" value="Return Home" onclick="doHome();">
        </div>
        <div id="insertText">
            In the text box below, type your job roll and click the insert button to upload it to our datebase.
        </div>
        <div id="amendText">
            In the text box below, type your amended job roll in and click the "Amend" button to upload your updated version.
        </div>
        <div id="jobRoleTable">
            <form name="jobRoll">
                <table>
                    <tr>
                        <td>
                            job description<TEXTAREA Name="content" ROWS=2 COLS=20 id="jobDesc"></TEXTAREA>
                    </td>
                </tr>
            </table>
        </div>
            <input type="hidden" id="jobRolesId" value="<?php echo $jobRollId ?>" >
            
            <div id="Insert">
               <input type="button" name="insert" class="button" id="btnInsert" value="insert" onclick="dojobInsert();">
            </div>
            <div id="divAmend">
               <input type="button" name="insert" class="button" id="btnAmend" value="Update" onclick="dojobAmend();">
            </div>
        </form>
        <div id="grid">
        <?php
        echo '<Table>';
        echo '<tr><th> Id </th><th> desc </th></tr>';
        while ($row = mysqli_fetch_array($result)) {
            $jobRolesId = $row['jobRolesId'];
            echo "<tr>";
            echo "<td>" . "<input type='button' value='amend' class='amendButton' onclick='doRead(\"$jobRolesId\");'>" . "</td>";
            echo "<td>" . $row['jobRoleDs'] . "</td>";
            echo "</tr>";
        }
        echo '</table>';
        echo "<br>";

        mysqli_close($con);
        ?>
        </div>
    </body>
</html