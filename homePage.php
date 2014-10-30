<?php
/*
 * project 4
 * J.Burton-Power
 * 10/10/14
 * 
 */

$ckUserName = $_COOKIE['userName'];
$userIp = $_SERVER['REMOTE_ADDR'];
if (trim($ckUserName)=="")
{
    //not logged in...
    header('location:loginpage.php');
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
                //Need to read this users menu programs and create the menu - use ajax call 
                doMenu();
            });
            
            function doLogOut()
            
            document.location.href="logInPage.php"

        </script>
        <style>
            
        </style>
    </head>
    <body>
        <div id='divMenu'>               
        </div>
    <center>
        <div id="header">
            <img src="marpacs.jpg" width="100px" height="100px">
        </div>
    </center>
        <div id="middlePage">
            BLISS ERP system is the original enterprise resource planning solution for the Food and Drink Sectors. 
            Drive Computing, BLISS developers, has been helping companies stay competitive since the 1980s. 
            It is the top ERP food software for small and medium sized operations. 
            Is all your supply chain information at your finger tips? Is it actionable?
            <br>
            Do you need to improve margins? Are customers demanding longer shelf life? Today, customer demands are greater than ever before.
            Margins are under pressure. If you are looking for greater control, we have the solution. Today BLISS is widely used in: 
            <br>
             Ready Meals, Soups and Sauces, Bakeries, Chilled and Ambient, Tinned produced, Beverages, Fish Processing and Health Foods.
             BLISS ERP software gives manufacturers greater end to end visibility of their business. For example, the BLISS erp solution gives companies control over:
             <br>
            Batch/Lot Tracking and Traceability
            Quality Control Processes
            Enhanced Warehouse Management
            Product Shelf Life Management
            <br>
            <br>
           After all these years, the BLISS ERP system is still the best solution for small to medium sized food and beverage companies:
           manage perishable inventory, meet tightening statutory obligations, stay on top of quality issues and manage margins all from one user friendly 
           Naturally BLISS is continuously developed. We have an active user group which meets periodically at locations around the UK.
           <br>
           <br>
           This unique partnership between Drive Computing and its clients is at the heart of the ongoing development of BLISS. 
           BLISS is modular and all modules are integrated. This means they share data to improve business processes, processes that cut across traditional functional boundaries.
           At the heart of BLISS is a fully integrated financial suite incorporating General Ledger, Fixed Assets, Accounts Payable and Accounts receivable.
           In addition the standard BLISS modules are:
           <br>
           <br>
            Customer Relationship Management
            Material and Inventory Management
            Recipe and Formulation Management
            Product Specification and Quality
            Product Cost Management
            Manufacturing Planning Management
            Purchase Order Processing
            Sales Order Processing
            Health and Safety Management
            Electronic Data Interchange
            Quotation Management
            Contract Orders Management
            Business Intelligence.
        </div>


    </body>
</html>