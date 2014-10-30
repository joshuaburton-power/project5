<?php
/*
 * project 6
 * J.Burton-Power
 * 06/10/14
 * 
 */
$pageTitle = "recipe insert";
$amend = false;
$recipeId = $_REQUEST['recipeId'];
if (trim($recipeId) != "") {
    
    //read for this product - passed produtId
    $amend = true;
    $pageTitle = "recipe insert";
    $dbuser = "bliss";
    $dbpass = "monkey";
    $dbase = "erp";
    $con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
    if (mysqli_connect_errno($con)) {
        $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
        $errflg = 1;
    } else {
        $sql = "SELECT * from recipe  WHERE recipeId = " . $recipeId;
        $result = mysqli_query($con, $sql);
        if (!$result) {
            $errMsg = mysqli_error($con);
        } else {
            $row = mysqli_fetch_array($result);
            $recipeDesc = $row['recipeDesc'];
            $picture = $row['picture'];
            $desc = $row['prodDesc'];
            $inscructions = $row['inscructions'];    
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
                                if (dataArray[i].recipeId === "<?php echo trim($recipeId); ?>")
                                    selectTxt = "selected";

                                var tmpStr = "<option value='" + dataArray[i].recipeId + "' " + selectTxt + " >" + dataArray[i].recipeDesc + "</option>";
                                $("#recipeId").append(tmpStr);

                            }
                        }
                    }
                });
            });

            function doHome()
            {
                document.location.href = "recipeMain.php";
            }
            function doSave()
            {     
                var recipeId = '<?php echo $recipeId; ?>';
                var recipeDesc = $('#recipeDesc').val();
                var picture = $('#inscructions').val();
                //alert (recipeId);
              
                var urlRequest = "insertrecipe";
                <?php
                if ($amend)
                    echo " urlRequest = 'recipeInsert'";
                ?>;
                $.ajax({
                    url: 'sqlproduct.php',
                    cache: false,
                    data: {'request': urlRequest, 'recipeId': recipeId, 'recipeDesc': recipeDesc, 'picture': picture, 'inscructions': inscructions},
                    dataType: 'json',
                    success: function(data)
                    {
                        document.location.href = 'recipeMain.php';
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
        <form name="recipeInsert" >
            <table>
                <tr>
                    <td>
                        recipe description
                    </td>
                    <td>
                        <input type="text" name="recipeDesc" id="recipeDesc" value ='<?php echo trim($recipeDesc); ?>' maxlength='200'>
                    </td>
                </tr>
                <tr>
                    <td>
                        picture
                    </td>
                    <td>
                        <input type="text" name="picture" id="picture" value='<?php echo trim($picture); ?>'>
                    </td>
                </tr>
                <tr>
                    <td>
                        inscructions
                    </td>
                    <td>
                        <input type="text" id="inscructions" name="inscructions" size='50' value='<?php echo trim($inscructions); ?>' >
                    </td>
                </tr>
            </table>
            <input type="hidden" id="recipeId" value="<?php echo $recipeId ?>" >
            <input type="button" name="save" class="button" id="save" value="save details" onclick="doSave();">
            <input type="button" name="home" class="button" id="home" value="Return Home" onclick="doHome();">
        </form>
    </body>
</html