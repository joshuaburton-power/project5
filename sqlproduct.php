<?php

/*
 * project 6
 * J.Burton-Power
 * 06/10/14
 * 
 * 
 * 
 */
$request = $_REQUEST['request'];
$info = new stdClass(); //class to hold data
$info->errmsg = '';
$dbuser = "bliss";
$dbpass = "monkey";
$dbase = "erp";
if ($request == "insertProduct") {
    $barcode = $_REQUEST['barcode'];
    $weightKg = $_REQUEST['weightKg'];
    if (trim($weightKg) == "")
    {
        $weightKg = 0;
    }
    $desc = $_REQUEST['desc'];
    $productTypeId = $_REQUEST['productTypeId'];
    $errflg = 0;
    $errMsg = '';
    
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "INSERT INTO products (barcode, weightKg, prodDesc, productTypeId ) VALUES ('$barcode',$weightKg,'$desc', $productTypeId)";
        //echo $sql;
        if (!mysqli_query($con, $sql)) {
            $errMsg = mysqli_error($con);
        }
    }
    mysqli_close($con);
    //$info->resultData = $DataArray;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}
if ($request == "productTypeList")
{
    //this will return a list of product types.
    $errflg = 0;
    $errMsg = '';
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "SELECT * FROM producttypeid";

        if (!mysqli_query($con, $sql));
        {
            $errMsg = mysqli_error($con);
        }
        $result = mysqli_query($con, $sql);
        if (!$result) {
            $errMsg = mysqli_error($con);
        } else {
            while ($row = mysqli_fetch_array($result)) {
                $rowData = array();
                $rowData['producttypeid'] = $row['productTypeId'];
                $rowData['typeDesc'] = $row['typeDesc'];
                $DataArray[] = $rowData;
            }
        }
    }
    mysqli_close($con);
    $info->resultData = $DataArray;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}
if ($request == "amendProduct") {
    $productId = $_REQUEST['productId'];
    $barcode = $_REQUEST['barcode'];
    $weightKg = $_REQUEST['weightKg'];
    $desc = $_REQUEST['prodDesc'];
    $productTypeId = $_REQUEST['productTypeId'];
    $errflg = 0;
    $errMsg = '';
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "update products set barcode='$barcode', weightKg=$weightKg, prodDesc='$desc', productTypeId=$productTypeId where productId=$productId";
        

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
if ($request == "readproductsId") {
    //read a specific product id
    $productsId = $_REQUEST['productsId'];
    $errflg = 0;
    $errMsg = '';
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "SELECT * FROM products WHERE productsId = $productsId";
        //echo $sql;
        $result = mysqli_query($con, $sql);
        if (!$result) {
            $errMsg = mysqli_error($con);
        } else {
            $row = mysqli_fetch_array($result);
            $productId = $row['productId'];
            $weightKg = $row['weightKg'];
            $desc = $row['prodDesc'];
            $productTypeId = $row['productTypeId'];
        }
    }
    mysqli_close($con);
    //$info->resultData = $DataArray;
    $info->productId = $$productId;
    $info->weightKg = $weightKg;
    $info->desc = $desc;
    $info->productTypeId = $productTypeId;
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

if ($request == "amendCat") {
    $productTypeId = $_REQUEST['productTypeId'];
    $typeDesc = $_REQUEST['typeDesc'];
    $productTypeId = $_REQUEST['productTypeId'];
    $errflg = 0;
    $errMsg = '';
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "update producttypeid set typeDesc='$typeDesc' where producttypeid=$productTypeId";
        echo $sql;
        if (!mysqli_query($con, $sql));
        {
            $errMsg = mysqli_error($con);
        }
    }
    mysqli_close($con);
    //$info->resultData = $DataArray;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}

if ($request == "insertCat") {
    $typeDesc = $_REQUEST['desc'];
    $errflg = 0;
    $errMsg = '';
    
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "INSERT INTO producttypeid (typeDesc) VALUES ('$typeDesc')";
        //echo $sql;
        if (!mysqli_query($con, $sql)) {
            $errMsg = mysqli_error($con);
        }
    }
    mysqli_close($con);
    //$info->resultData = $DataArray;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}
if (trim($request) == 'searchResults')

{
    $searchTxt = $_REQUEST['searchTxt']; 
    $con = mysqli_connect("127.0.0.1", "bliss", "monkey", "erp");
    $sql = "SELECT * FROM products WHERE prodDesc = '$searchTxt'";
    //echo $sql;
    $result = mysqli_query($con, $sql); 
    $row_cnt = mysqli_num_rows($result);  
    while ($row = mysqli_fetch_array($result))
    {
        $rowData = array();
        $rowData['prodId'] = $row['prodId'];
        $rowData['prodDesc'] = $row['prodDesc'];    
        $dataArray[] = $rowData;
    }
    mysqli_close($con);
    $info->resultData = $dataArray;
    $info->errMsg = $errMsg;
    echo json_encode($info);
}