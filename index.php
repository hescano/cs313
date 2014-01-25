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
        $(document).ready(function () {
            var divs = $('.definition').hide(), i = 0;
            (function cycle() {
                divs.eq(i).fadeIn(400)
              .delay(10000)
              .fadeOut(400, cycle);
                i = ++i % divs.length; // increment i, 
                //   and reset to 0 when it equals divs.length
            })();
        });
    </script>
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
                    <h1>Project Name Here</h1>
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
                    <h2>Homework 1 - Survey using the File System</h2>
                    <strong>Data Storage without a database.</strong>
                    <p>
                        Our first real assignment of the semester is to build a survey system using the filesystem. Here are the requirements:
                        <ul>
                            <li>Your survey/results should look professional</li>
                            <li>There should be at least 4 questions</li>
                            <li>Provide a link on the question page to go directly to the results (without voting)</li>
                            <li>When the user casts their vote, they should then see the results</li>
                            <li>Store the results on the filesystem, so they can be retrieved / added to later</li>
                            <li>If the user returns to the question page after they have voted, they should be automatically directed to the results. (think sessions)</li>
                            <li>Create a link to your survey from your assignments page</li>
                        </ul>
                        Click <a href="survey.php">here</a> to go to the survey.
                    </p>
                    <br />
                    <br />
                </div>
                <!-- END LEFT COLUMN -->
                <!-- START RIGHT COLUMN -->
                <div id="rightColumn-layout1">
                    <h2>Homework</h2>
                    <div id="sidebar">
                        <ul>
                            <li><a href="survey.php">Homework 1 - Survey</a></li>
                        </ul>
                    </div>
                    <!--<div>
                        <div class="definition" style="display: none;">
                        <h3>
                        Generic Title</h3>
                        <p>I will do something with this in the future.</p>
                        </div>

                        <div class="definition" style="display: block;">
                        <h3>I promise.</h3>
                        <p>Im serious!</p>
                        </div>
                            
                    </div>-->
                </div>
                <!-- END RIGHT COLUMN -->
                <!-- START FOOTER -->
                <div id="footer">
                    Copyright
                    2014
                    <a href="#sitename">http://www.cs313.hamletsoft.net</a></div>
                <!-- END FOOTER -->
            </div>
        </div>
    </div>
</body>
</html>
