<?php
/*
 * project 6
 * J.Burton-Power
 * 06/10/14
 * 
 */
$pageTitle = "products Maintence page";
$dbuser = "bliss";
$dbpass = "monkey";
$dbase = "erp";
$con = mysqli_connect('127.0.0.1', $dbuser, $dbpass, $dbase);
if (mysqli_connect_errno($con)) {
    $errMsg = 'Could not connect to Database.' . mysqli_connect_error();
    $errflg = 1;
} else {
    $sql = "SELECT * contact
       FROM contactId contactId
       INNER JOIN employees employees
       ON (contactId.contactId = contact.contactId)";
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
            function doNewProduct()
            {
                document.location.href = "productInsert.php";
            }
            function doAmend(emId)
            {
                $('#productId').val(emId);
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
            
            function selectContact()
            {
                var contact = $('#selectContact').val();
                $.ajax({
                    url: 'project4_ajax.php',
                    cache: false,
                    data: {'request': 'selectContact', 'contact': contact},
                    dataType: 'json',
                    success: function(data)
                    {
                        var dataArray = data.resultData;
                        var outputStr = "";    
                        outputStr = "<br><table class='table'>";
                        outputStr = outputStr + "<tr><th>First Name</th><th>Last Name</th><th>Age</th><th>Address</th><th>Post Code</th><th>Phone Number</th><th>Company</th>";
                            for (var i = 0; i < dataArray.length; i++)
                            {
                                outputStr = outputStr + "<tr>";
                                outputStr = outputStr + "<td>" + dataArray[i].firstName + "</td>";
                                outputStr = outputStr + "<td>" + dataArray[i].lastName + "</td>";
                                outputStr = outputStr + "<td>" + dataArray[i].age + "</td>";
                                outputStr = outputStr + "<td>" + dataArray[i].address + "</td>";
                                outputStr = outputStr + "<td>" + dataArray[i].telNumber + "</td>";
                                outputStr = outputStr + "<td>" + dataArray[i].companyId + "</td>";
                                outputStr = outputStr + "</tr>";
                            }
                        outputStr = outputStr + "</table>";
                        $('#selectContact').html(outputStr); 
                    }
                });
                }
        </script>
        <style>
        </style>
    </head>
    <body>
<!--        <div id="middlePage">
            
        </div>   -->
<div id="selectContacts">
 <table class="table">
            <tr>
                <td></td>
                <td>first Name</td>
                <td>last Name</td>
                <td>age</td>
                <td>address</td>
                <td>postCode</td>
                <td>phone Number</td>
                <td>company Id</td>
            </tr>
<?php
echo $errMsg;
while ($row = mysqli_fetch_array($result)) {
    $emId = $row['productId'];
    echo "<tr>";
    echo "<td><input type='button' value='amend' class='button' onclick='doAmend(\"$emId\");'>" . $emId . "</td>";
    echo "<td>" . $row['firstName'] . "</td>";
    echo "<td>" . $row['lastName'] . "</td>";
    echo "<td>" . $row['age'] . "</td>";
    echo "<td>" . $row['address'] . "</td>";
    echo "<td>" . $row['postCode'] . "</td>";
    echo "<td>" . $row['telNumber'] . "</td>";
    echo "<td>" . $row['companyId'] . "</td>";
    echo "</tr>";
}
mysqli_close($con);
?>
</table>
</div>
    </body>
</html>