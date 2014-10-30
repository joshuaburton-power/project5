<?php
/*
 * project 6
 * J.Burton-Power
 * 06/10/14
 * 
 */
$pageTitle = "insert catagory";
$amend = false;
$producttypeid = $_REQUEST['producttypeid'];
if (trim($producttypeid) != "") {
    $amend = true;
    $pageTitle = "insert catagory";
    $dbuser = "bliss";
    $dbpass = "monkey";
    $dbase = "erp";
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "SELECT * from producttypeid  WHERE producttypeid = " . $producttypeid;
        $result = mysqli_query($con, $sql);
        if (!$result) {
            $errMsg = mysqli_error($con);
        } else {
            $row = mysqli_fetch_array($result);
            $productsTypeId = $row['productsTypeId'];    
            $desc = $row['typeDesc'];
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
                
            });

            function doHome()
            {
                document.location.href = "productsmain.php";
            }
            function doSave()
            {
                          
                var productId = '<?php echo $productId; ?>';
                var productTypeId = $('#productTypeId').val();
                var desc = $('#typeDesc').val();     
                var urlRequest = "insertCat";
                <?php
                if ($amend)
                    echo " urlRequest = 'amendCat'";
                ?>;
                $.ajax({
                    url: 'sqlproduct.php',
                    cache: false,
                    data: {'request': urlRequest, 'desc': desc, 'productTypeId': productTypeId},
                    dataType: 'json',
                    success: function(data)
                    {
                        document.location.href = 'firstPage.php';
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
        <form name="productInsert" >
            <table>
                <tr>
                    <td>
                        Type description
                    </td>
                    <td>
                        <input type="text" id="typeDesc" name="typeDesc" value='<?php echo trim($typeDesc); ?>' >
                    </td>
                </tr>
            </table>
            <input type="hidden" id="productId" value="<?php echo $productId ?>" >
            <input type="button" name="save" class="button" id="save" value="save details" onclick="doSave();">
            <input type="button" name="home" class="button" id="home" value="Return Home" onclick="doHome();">
        </form>
    </body>
</html