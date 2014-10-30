<?php
/*
 * project 6
 * J.Burton-Power
 * 06/10/14
 * 
 */
$pageTitle = "new employee";
$amend = false;
$employeeId = $_REQUEST['employeeId'];
if (trim($employeeId) != "") {
    $amend = true;
    $pageTitle = "Amend employee";
    $dbuser = "bliss";
    $dbpass = "monkey";
    $dbase = "erp";
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "SELECT * from employee  WHERE employeeId = " . $employeeId;
        $result = mysqli_query($con, $sql);
        if (!$result) {
            $errMsg = mysqli_error($con);
        } else {
            $row = mysqli_fetch_array($result);
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $datepicker = $row['dob'];
            $datepicker = date("d/m/Y", strtotime($datepicker));
            $niNumber = $row['niNumber'];
            $telNo = $row['telNo'];
            $email = $row['email'];
            $employeeId = $row['employeeId'];
            $jobRoleId = $row['jobRolesId'];
            $gender = $row['gender'];
            $nationality = $row['nationality'];
        }
    }
}
?>
<html>
    <head> 
        <link rel="icon" type="image/png" href="browserlogo.ico"/>
        <script type='text/javascript' src='jquery/jquery.min.js'></script>
        <script type='text/javascript' src='jquery/jquery.ui.min.js'></script>
        <script type='text/javascript' src='project4.js'></script>
        <link href='jquery/css/smoothness/jquery-ui.css' rel='stylesheet'/>
        <link href="project4.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="navgoco/src/jquery.navgoco.js"></script>
        <link rel="stylesheet" href="navgoco/src/jquery.navgoco.css" type="text/css" media="screen"/>
        <title>Drive Computing </title>
        <script type='text/javascript'>
            $(document).ready(function()
            {
                $("#datepicker").datepicker({
                });

                //read to get job roles
                /*
                 * 1 - ajax call to get list of job roles.
                 * Need id and desc
                 * Show desc to user but use id for insert/update on employee tabble
                 * 
                 * 
                 */
                $.ajax({
                    url: 'sqlEmployee.php',
                    cache: false,
                    data: {'request': 'jobRolesList'},
                    dataType: 'json',
                    success: function(data)
                    {
                        //loop round data and add the values to the select box as new options
                        var dataArray = data.resultData;
                        if (dataArray != null)
                        {
                            for (var i = 0; i < dataArray.length; i++)
                            {
                                var selectTxt = "";
                                if (dataArray[i].jobRolesId == "<?php echo trim($jobRoleId); ?>")
                                    selectTxt = "selected";

                                var tmpStr = "<option value='" + dataArray[i].jobRolesId + "' " + selectTxt + " >" + dataArray[i].jobRoleDs + "</option>";
                                $("#jobRole").append(tmpStr);

                            }
                        }


                    }
                });

<?php
//if male check radio button
if ($gender == 'M') {
    ?>
                    $('#genderM').prop("checked", true);
    <?php
}
if ($gender == 'F') {
    ?>
                    $('#genderF').prop("checked", true);
<?php }
?>
            });

            function doHome()
            {
                document.location.href = "firstPage.php";
            }
            function doSave()
            {
                document.forms['employeeInsert'].submit();

                var firstName = $('#firstName').val();
                var lastName = $('#lastName').val();
                var dob = $('#datepicker').val();
                var niNumber = $('#niNumber').val();
                var telNo = $('#telNo').val();
                var email = $('#email').val();
                var employeeId = $('#employeeId').val();
                var jobRole = $('#jobRole').val();
                var nationality = $('#nationality').val();
                var gender = "";
                if ($('#genderF').is(':checked'))
                {
                    gender = "F";
                }
                if ($('#genderM').is(':checked'))
                {
                    gender = "M";
                }
                var urlRequest = "insertEmployee";

<?php
if ($amend)
    echo " urlRequest = 'amendEmployee'";
?>;
                var nationality = $('#nationality').val();


                $.ajax({
                    url: 'sqlEmployee.php',
                    cache: false,
                    data: {'request': urlRequest, 'firstName': firstName, 'lastName': lastName, 'dob': dob, 'niNumber': niNumber, 'telNo': telNo, 'email': email, 'employeeId': employeeId, 'jobRole': jobRole, 'gender': gender, 'nationality': nationality},
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
        <form name="employeeInsert" action="sqlEmployee.php" method="post">
            <table>
                <tr>
                    <td>
                        first name
                    </td>
                    <td>
                        <input type="text" name="firstName" id="firstName" value ='<?php echo trim($firstName); ?>'>
                    </td>
                </tr>
                <tr>
                    <td>
                        last name
                    </td>
                    <td>
                        <input type="text" name="lastName" id="lastName" value='<?php echo trim($lastName); ?>'>
                    </td>
                </tr>
                <tr>
                    <td>
                        D.O.B
                    </td>
                    <td>
                        <input type="text" id="datepicker" name="dob" value='<?php echo trim($datepicker); ?>' >
                    </td>
                </tr>
                <tr>
                    <td>
                        N.I number
                    </td>
                    <td>
                        <input type="text" name="niNumber" id="niNumber" value='<?php echo trim($niNumber); ?>'>
                    </td>
                </tr>
                <tr>
                    <td>
                        telNo
                    </td>
                    <td>
                        <input type="text" name="telNo" id="telNo" value='<?php echo trim($telNo); ?>'>
                    </td>
                </tr>
                <tr>
                    <td>
                        Email Adress
                    </td>
                    <td>
                        <input type="text" name="email" id="email" value='<?php echo trim($email); ?>'>
                    </td>
                </tr>
                <tr>
                    <td>
                        Job Role
                    </td>
                    <td>
                        <select name="jobRole" id="jobRole">

                        </SELECT>   
                    </td>
                </tr>
                <tr>
                    <td>
                        Male <input type='radio' value='M' name='gender' id='genderM'>
                    </td>
                    <td>
                        Female <input type='radio' value='F' name='gender' id='genderF'>
                    </td>
                </tr>
                <tr>
                    <td>
                        nationality
                    </td>
                    <td>
                        <input type='text' name='nationality' id='nationality' value='<?php echo trim($nationality); ?>'>
                    </td>
                </tr>
            </table>
            <input type="hidden" id="employeeId" value="<?php echo $employeeId ?>" >
            <input type="button" name="save" class="button" id="save" value="save details" onclick="doSave();">
            <input type="button" name="home" class="button" id="home" value="Return Home" onclick="doHome();">
        </form>
    </body>
</html