
function doMenu()
{
    $.ajax({
                  url: 'programm_ajax.php',
                  cache: false,
                  data: {'request': 'readMenu'},
                  dataType: 'json',
                  success: function(data)
                  {
                        var dataArray = data.resultData;
                        var thisCatId = 0;
                        var menuCatId =0;
                        var outputStr = "<ul class='nav'><li><a href='homePage.php'>Home</a></li>";
                        for (var i = 0; i < dataArray.length; i++)
                        {
                          //alert(dataArray[i].catId);
                          thisCatId = Number(dataArray[i].catId);               //get this menu cat
                          if (thisCatId != menuCatId)                           // are we doing a new catagory
                          {
                            
                            if (menuCatId >0)                                   //if not the first one then close the previous one
                                outputStr = outputStr + "</ul></li>";
                            outputStr = outputStr + "<li><a href='#'>" + dataArray[i].catDesc + "</a><ul>";         //display menu cat desc
                            menuCatId = thisCatId;                              //Yes - save it
                          }
                          //Now display the program as li with hrel link for user to click
                          outputStr = outputStr + "<li>";
                          outputStr = outputStr + "<a href='" + dataArray[i].programeName + "'>" + dataArray[i].programsDesc +  "</a>";
                          outputStr = outputStr + "</li>";
                        }
                        outputStr = outputStr + "</ul></li>";       //add close of the last menu cat
                        outputStr = outputStr + "</ul>";
                        //alert(outputStr);
                        $('#divMenu').html(outputStr);
                        $('.nav').navgoco();
                  }
                });          
    
}