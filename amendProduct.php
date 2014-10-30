<?php
/*
 * project 6
 * J.Burton-Power
 * 06/10/14
 * this page is to amend products.
 */
$pageTitle = "new product";
$amend = false;
$productId = $_REQUEST['productId'];
echo 'productId='. $productId;
if (trim($productId) != "") {
    $amend = true;
    $pageTitle = "Amend product";
    $dbuser = "bliss";
    $dbpass = "monkey";
    $dbase = "erp";
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "SELECT * from products  WHERE productId = " . $productId;
        $result = mysqli_query($con, $sql);
        if (!$result) {
            $errMsg = mysqli_error($con);
        } else {
            $row = mysqli_fetch_array($result);
            $barcode = $row['barcode'];
            $weightKg = $row['weightKg'];
            $prodDesc = $row['prodDesc'];
            $productTypeId = $row['productTypeId'];
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
               $.ajax({
                    //read for list of product types.
                    url: 'sqlproduct.php',
                    cache: false,
                    data: {'request': 'productTypeList'},
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
                                if (dataArray[i].producttypeid === "<?php echo trim($productTypeId); ?>")
                                    selectTxt = "selected";

                                var tmpStr = "<option value='" + dataArray[i].producttypeid + "' " + selectTxt + " >" + dataArray[i].typeDesc + "</option>";
                                $("#productTypeId").append(tmpStr);

                            }
                        }
                    }
                });
            });

            function doHome()
            {
                document.location.href ="productsmain.php";
            }
            function doSave()
            {
                var barcode = $('#barcode').val();
                var weightKg = $('#weightKg').val();
                var prodDesc = $('#prodDesc').val();
                var productTypeId = $('#productTypeId').val();
                var urlRequest = "insertproduct";
                var productId = $('#productId').val();

                <?php
                if ($amend)
                    echo " urlRequest = 'amendProduct'";
                ?>;
                


                $.ajax({
                    url: 'sqlproduct.php',
                    cache: false,
                    data: {'request': urlRequest, 'barcode': barcode, 'weightKg': weightKg, 'prodDesc': prodDesc, 'productTypeId': productTypeId, 'productId': productId},
                    dataType: 'json',
                    success: function(data)
                    {
                        document.location.href = 'productsMain.php';
                    }
                });
            }
        </script>
        <style>
            #productInsert
            {
                border-collapse:collapse;
                border:2px solid black;
            }
        </style>
    </head>
    <body>
<?php include_once('header.php');
?>
        <form name="productInsert" action="sqlproduct.php" method="post">
             <table>
                <tr>
                    <td>
                        barcode
                    </td>
                    <td>
                        <input type="text" name="barcode" id="barcode" value ='<?php echo trim($barcode); ?>'>
                    </td>
                </tr>
                <tr>
                    <td>
                        weightKg
                    </td>
                    <td>
                        <input type="text" name="weightKg" id="weightKg" value='<?php echo trim($weightKg); ?>'>
                    </td>
                </tr>
                <tr>
                    <td>
                        desc
                    </td>
                    <td>
                        <input type="text" id="prodDesc" name="prodDesc" value='<?php echo trim($prodDesc); ?>' >
                    </td>
                </tr>
                <tr>
                    <td>
                        product type Id
                    </td>
                    <td>
                        <select  id="productTypeId">
                        </select>
                    </td>
                </tr>
             </table>
            <input type="hidden" id="productId" value="<?php echo $productId ?>" >
            <input type="button" name="save" class="button" id="save" value="save details" onclick="doSave();">
            <input type="button" name="home" class="button" id="home" value="Return Home" onclick="doHome();">
        </form>
    </body>
</html