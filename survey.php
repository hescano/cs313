<?php
    session_start();
    if(isset($_SESSION["user_voted"]))
    {
        header('Location: viewresults.php');
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta property="og:type" content="school" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title>Hanlet Escano's Site</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/grey.css" />
    <link href="css/capstone.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript" language="javascript"></script>
    <script type="text/javascript" language="javascript">

        function validate()
        {
            var frequency = document.forms[0]["frequency"];
            var concession = document.forms[0]["concession"];
            var company = document.forms[0]["company"];
            var theater = document.forms[0]["theater"];
            
            if (isAnyChecked(frequency) && isAnyChecked(company) && isAnyChecked(theater) && isAnyChecked(concession))
            {
                return true;
            }
            else
            {
                alert("Please select an option for all questions.");
                return false;
            }
        }

        function isAnyChecked(nodes)
        {
            for(var i = 0; i < nodes.length; i++)
            {
                if(nodes[i].checked)
                {
                    return true;
                }
            }

            //if we get here, none was checked
            return false;
        }
    </script>
    <style>
        input[type='radio'], input[type='checkbox']
        {
            width:20px;
        }
    </style>
</head>
<body>
    <div>
        <div id="outline">
            <div id="wrapper">
                <!-- START HEADER -->
                <div id="header">
                    <div id="headerBox" style="font-style: italic">
                        "Always code as if the guy who ends up maintaining your code will be a violent psychopath who knows where you live."
                        <br />
                        <strong>-Rick Osborne</strong></div>
                    <h1>Movies Survey</h1>
                    <h3 style="text-shadow: 5px 5px 5px #000000;"></h3>
                </div>
                <!-- END HEADER -->
                <!-- START NAVIGATION TOP -->
                <div id="navTop">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#">Homework</a>
                            <ul>
                                <li><a href="survey.php">Homework 1 - Survey</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- END NAVIGATION TOP -->
                <!-- START RIGHT COLUMN -->
                <div id="leftColumn-layout1">
                    <h2>@ The Movies Survey</h2>
                    <strong>Please answer the following question:</strong><br /><br />
                    <p>
                        <form method="post" action="processsurvey.php" onsubmit="return validate();">
                            <table style="width: 600px">
                                <tbody>
                                    <tr>
                                        <td valign="top">
                                            <span style="font-weight: bold">Frequency I go to the Movies:</span>
                                        </td>
                                        <td>
                                            <input type="radio" name="frequency" id="rbFrequency1" value="1" /><label for="rbFrequency1">Every Day</label><br />
                                            <input type="radio" name="frequency" id="rbFrequency2" value="2" /><label for="rbFrequency2">Once per Week</label><br />
                                            <input type="radio" name="frequency" id="rbFrequency3" value="3" /><label for="rbFrequency3">Once per Month</label><br />
                                            <input type="radio" name="frequency" id="rbFrequency4" value="4" /><label for="rbFrequency4">Once per Year</label><br />
                                            <input type="radio" name="frequency" id="rbFrequency5" value="5" /><label for="rbFrequency5">I don't go to the Movies</label><br /><br />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <span style="font-weight: bold">When I go to the Movies I usually buy:</span>
                                        </td>
                                        <td>
                                            <input type="radio" name="concession" id="cbConsession1" value="1" /><label for="cbConsession1">Popcorn</label><br />
                                            <input type="radio" name="concession" id="cbConsession2" value="2" /><label for="cbConsession2">Soda</label><br />
                                            <input type="radio" name="concession" id="cbConsession3" value="3" /><label for="cbConsession3">Candy Bar</label><br />
                                            <input type="radio" name="concession" id="cbConsession4" value="4" /><label for="cbConsession4">Hotdog</label><br />
                                            <input type="radio" name="concession" id="cbConsession5" value="5" /><label for="cbConsession5">Nothing</label><br /><br />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <span style="font-weight: bold">When I go to the Movies I usually go:</span>
                                        </td>
                                        <td>
                                            <input type="radio" name="company" id="rbCompany1" value="1" /><label for="rbCompany1">Alone</label><br />
                                            <input type="radio" name="company" id="rbCompany2" value="2" /><label for="rbCompany2">With other people</label><br /><br />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <span style="font-weight: bold">My favorite Movies in Rexburg is:</span>
                                        </td>
                                        <td>
                                            <input type="radio" name="theater" id="rbTheater1" value="1" /><label for="rbTheater1">Fatcats</label><br />
                                            <input type="radio" name="theater" id="rbTheater2" value="2" /><label for="rbTheater2">Paramount5 (cheap theater)</label><br />
                                            <input type="radio" name="theater" id="rbTheater3" value="3" /><label for="rbTheater3">Teton Vu (Drive-In)</label><br />
                                            <input type="radio" name="theater" id="rbTheater4" value="4" /><label for="rbTheater4">Other</label><br /><br />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="viewresults.php">View Results</a>
                                        </td>
                                        <td>
                                            <input type="submit" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </p>
                    <br />
                    <br />
                </div>
                <!-- END LEFT COLUMN -->
                <!-- START RIGHT COLUMN -->
               <!-- <div id="rightColumn-layout1">
                    <h2>Homework</h2>
                    <div id="sidebar">
                        <ul>
                            <li><a href="survey.php">Homework 1 - Survey</a></li>
                        </ul>
                    </div>
                    <div>
                        <div class="definition" style="display: none;">
                        <h3>
                        Generic Title</h3>
                        <p>I will do something with this in the future.</p>
                        </div>

                        <div class="definition" style="display: block;">
                        <h3>I promise.</h3>
                        <p>Im serious!</p>
                        </div>
                            
                    </div>
                </div>-->
                <!-- END RIGHT COLUMN -->
                <!-- START FOOTER -->
                <div id="footer">
                    Copyright 2014 <a href="http://www.cs313.hamletsoft.net">http://www.cs313.hamletsoft.net</a></div>
                <!-- END FOOTER -->
            </div>
        </div>
    </div>
</body>
</html>