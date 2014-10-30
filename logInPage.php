<?php
/*
 * project 6 
 * J.Burton-Power
 * 10/10/14
 * new code
 */


setcookie("userName", "", time()+36000);  /* expire in 10 hour */
?>
<html>
    <head> 
        <link rel="icon" type="image/png" href="browserlogo.ico"/>
        <script type='text/javascript' src='jquery/jquery.min.js'></script>
        <script type='text/javascript' src='jquery/jquery.ui.min.js'></script>
        <link href='jquery/css/smoothness/jquery-ui.css' rel='stylesheet'/>
        <link href="../project4/project4.css" rel="stylesheet" type="text/css"/>
        <title>Drive Computing</title>
        <script type='text/javascript'>
            $(document).ready(function()
            {

            });

            //read programe SQL table

            function doLogin()
            {
                var username = $('#username').val();
                var password = $('#password').val();
                $.ajax({
                    url: 'project4_ajax.php',
                    cache: false,
                    data: {'request': 'chkUser', 'username': username, 'password': password},
                    dataType: 'json',
                    success: function(data)
                    {
                        $('#errMsg').html(data.errMsg);
                        var userValid = data.userValid;
                        if (userValid == false)
                        {
                            alert("Invalid Username or Password");
                        }
                        else
                        {
                            document.location.href = "homePage.php";
                        }
                    }
                });
            }


        </script>
        <style>


        </style>
    </head>
    <body>
        <div id="header">
            Drive computing  
        </div>
        <div id="bliss">
            <center>
                <img src="bliss.jpg" width="200px" height="170px">
            </center>
        </div>
    <center>
        <div id="logIn">
            Log in <input id="username" name="username" type="text">
            <br>
            Password <input id="password" name="password" type="password">
            <br>
            <input type="submit" value="log In" class="logInButton" onclick="doLogin();">
        </div>
    </center>
    <center>
        <div id="footer">
            <img src="marpacs.jpg" width="200px" height="170px">
        </div>
    </center>
</body>
</html>