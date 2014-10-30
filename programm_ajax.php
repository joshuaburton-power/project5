
<?php

$request = $_REQUEST['request'];
$info = new stdClass(); //class to hold data
$info->errmsg = '';

$sqlHost = "127.0.0.1";
$sqlUser = "bliss";
$sqlPass = "monkey";
$sqlDbase = "erp";

//echo $request;

if (trim($request) == 'readMenu') {
    //Read the menu and return the list of programs and cat description

    $con = mysqli_connect($sqlHost, $sqlUser, $sqlPass, $sqlDbase);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL" . mysqli_connect_error();
    } else {
        $sql = "SELECT programme.programeId,
       programme.catId,
       programme.programeName,
       programme.programsDesc,
       cat.catDesc
       FROM programme
       INNER JOIN cat cat ON (programme.catId = cat.catId)
       ORDER BY programme.catId ASC";
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
                    $rowData['catId'] = $row['catId'];
                    $rowData['catDesc'] = $row['catDesc'];
                    $rowData['programsDesc'] = $row['programsDesc'];
                    $rowData['programeName'] = $row['programeName'];
                    $dataArray[] = $rowData;
                }
            }
        }
    }

    mysqli_close($con);
    $info->resultData = $dataArray;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}

               if (trim($request) == 'searchResults')
{
    $searchTxt = $_REQUEST['searchTxt']; 
    $con = mysqli_connect("127.0.0.1", "bliss", "monkey", "erp");
    $sql = "SELECT * FROM products WHERE producId = '$searchTxt'";
    //echo $sql;
    $result = mysqli_query($con, $sql);
    $row_cnt = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result))
    {
        $rowData = array();     
        $rowData['prodDesc'] = $row['prodDesc'];
        $rowData['prodDesc'] = $row['prodDesc'];
        $dataArray[] = $rowData;
    }
    mysqli_close($con);
    $info->resultData = $dataArray;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}

