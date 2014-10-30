<?php

/*
 * project 3
 * J.Burton-Power
 * 06/10/14
 * 
 */
$request = $_REQUEST['request'];
$info = new stdClass(); //class to hold data
$info->errmsg = '';
$dbuser = "bliss";
$dbpass = "monkey";
$dbase = "erp";
if ($request == "insertEmployee") {
    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $dob = $_REQUEST['dob'];
    $ninumber = $_REQUEST['niNumber'];
    $telNo = $_REQUEST['telNo'];
    $emailAdress = $_REQUEST['email'];
    $jobRole = $_REQUEST['$jobRole'];
    $gender = $_REQUEST['gender'];
    $nationality = $_REQUEST['nationality'];
    $originalDate = $dob;
    $newdob = date("Y/m/d", strtotime($originalDate));
    $errflg = 0;
    $errMsg = '';
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "INSERT INTO employee (firstName, lastName, niNumber, telNo, email, dob, jobRolesId, gender, nationality) VALUES ('$firstName','$lastName','$ninumber','$telNo','$emailAdress','$newdob', $jobRole, '$gender', '$nationality')";

        if (!mysqli_query($con, $sql)) {
            $errMsg = mysqli_error($con);
        }
    }
    mysqli_close($con);
    //$info->resultData = $DataArray;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}
if ($request == "amendEmployee") {
    $employeeId = $_REQUEST['employeeId'];
    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $dob = $_REQUEST['dob'];
    $ninumber = $_REQUEST['niNumber'];
    $telNo = $_REQUEST['telNo'];
    $emailAdress = $_REQUEST['email'];
    $jobRole = $_REQUEST['jobRole'];
    $gender = $_REQUEST['gender'];
    $nationality = $_REQUEST['nationality'];
    $originalDate = $dob;
    $newdob = date("Y/m/d", strtotime($originalDate));
    $errflg = 0;
    $errMsg = '';
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "update employee set firstName='$firstName', lastName='$lastName', niNumber='$ninumbers', telNo='$telNo', email='$emailAdress', dob='$newdob', jobRolesId='$jobRole', gender='$gender', nationality='$nationality' where employeeId=$employeeId";

        if (!mysqli_query($con, $sql))
            ;
        {
            $errMsg = mysqli_error($con);
        }
    }
    mysqli_close($con);
    //$info->resultData = $DataArray;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}
if ($request == "insertJobRole") {
    $jobRollId = $_REQUEST['jobRollId'];
    $jobDesc = $_REQUEST['jobdesc'];
    $errflg = 0;
    $errMsg = '';
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "INSERT INTO jobrole (jobRoleds) VALUES ('$jobDesc')";
        echo $sql;
        if (!mysqli_query($con, $sql)) {
            $errMsg = mysqli_error($con);
        }
    }
    mysqli_close($con);
    //$info->resultData = $DataArray;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}
if ($request == "readJobId") {
    $jobRolesId = $_REQUEST['jobRolesId'];
    $errflg = 0;
    $errMsg = '';
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "SELECT * FROM jobrole WHERE jobRolesId = $jobRolesId";
        //echo $sql;
        $result = mysqli_query($con, $sql);
        if (!$result) {
            $errMsg = mysqli_error($con);
        } else {
            $row = mysqli_fetch_array($result);
            $jobRolesId = $row['jobRolesId'];
            $jobRoleDs = $row['jobRoleDs'];
        }
    }
    mysqli_close($con);
    //$info->resultData = $DataArray;
    $info->jobRolesId = $jobRolesId;
    $info->jobRoleDs = $jobRoleDs;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}
if ($request == "amendJobRole") {
    $jobRollId = $_REQUEST['jobRollId'];
    $jobDesc = $_REQUEST['jobdesc'];
    $errflg = 0;
    $errMsg = '';
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "update jobRole set jobRoleDs='$jobDesc' WHERE jobRolesId=$jobRollId";
        echo $sql;
        if (!mysqli_query($con, $sql)) {
            $errMsg = mysqli_error($con);
        }
    }
    mysqli_close($con);
    //$info->resultData = $DataArray;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}
if ($request == "jobRolesList") {
    $errflg = 0;
    $errMsg = '';
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "SELECT * FROM jobRole";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            $errMsg = mysqli_error($con);
        } else {
            while ($row = mysqli_fetch_array($result)) {
                $rowData = array();
                $rowData['jobRolesId'] = $row['jobRolesId'];
                $rowData['jobRoleDs'] = $row['jobRoleDs'];
                $DataArray[] = $rowData;
            }
        }
    }
    mysqli_close($con);
    $info->resultData = $DataArray;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}
?>