
<?php

/*
 *
 *
 *
 */

//$USERNAME = $_COOKIE['USERNAME'];

$request = $_REQUEST['request'];
$info = new stdClass(); //class to hold data
$info->errmsg = '';

$sqlHost = "127.0.0.1";
$sqlUser = "bliss";
$sqlPass = "monkey";
$sqlDbase = "erp";

//echo $request;

if (trim($request) == 'chkUser') {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $userValid = false;

    $con = mysqli_connect($sqlHost, $sqlUser, $sqlPass, $sqlDbase);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL" . mysqli_connect_error();
    } else {
        //Insert the order data
        $sql = "SELECT * FROM users where (username = '$username' and password = '$password')";
        $result = mysqli_query($con, $sql);
        if ($result == null) {
            //die('Error: ' . mysqli_error($con));
            $errFlg = 1;
            $errMsg = "Sorry, this is an invalid user";
        } else {
            //check how many records are returned
            $row_cnt = mysqli_num_rows($result);
            //if zero thenm invalid username or password
            if ($row_cnt == 0) {
                $userValid = false;
            }
            //if greater than 0 then valid user
            if ($row_cnt > 0) {
                $result = mysqli_query($con, $sql);
                $userValid = true;
                setcookie("userName", $username, time() + 36000);  /* expire in 10 hour */
            }
        }
    }

    mysqli_close($con);
    $info->userValid = $userValid;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}
if (trim($request) == 'selectContact') {
    //Read the menu and return the list of programs and cat description

    $con = mysqli_connect($sqlHost, $sqlUser, $sqlPass, $sqlDbase);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL" . mysqli_connect_error();
    } else {
        $sql = "SELECT programme.programeId,
       contact.contactId,
       contact.firstName,
       contact.lastName,
       contact.age,
       contact.address
       contact.telNumber,
       contact.companyId,
       FROM contact
       INNER JOIN employee employee ON (contact.contactId = contact.contactId)
       ORDER BY contact.contactId ASC";
        $result = mysqli_query($con, $sql);
        if ($result == null) {
            //die('Error: ' . mysqli_error($con));
            $errFlg = 1;
            $errMsg = "Unable to read menu files";
        } else {
            //check how many records are returned
            $row_cnt = mysqli_num_rows($result);
            //if zero thenm invalid username or password
            if ($row_cnt == 0) {
                $errMsg = "There are no menus available";
            }
            //if greater than 0 then valid user
            if ($row_cnt > 0) {
                //Loop around rs create array to pass back data
                while ($row = mysqli_fetch_array($result)) {
                    $rowData = array();
                    $rowData['contactId'] = $row['contactId'];
                    $rowData['firstName'] = $row['firstName'];
                    $rowData['lastName'] = $row['lastName'];
                    $rowData['age'] = $row['age'];
                    $rowData['address'] = $row['address'];
                    $rowData['telNumber'] = $row['telNumber'];
                    $rowData['companyId'] = $row['companyId'];
                    $dataArray[] = $rowData;
                }
            }
        }
    }
}