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
    <style>
        .clear{
clear:both;}
 
.graphcont {
padding-top:10px;
color:#000;
font-weight:700;
float:left
}
 
.graph {
float:left;
margin-top:10px;
background-color:#cecece;
position:relative;
width:280px;
padding:0
}
 
.graph .bar {
display:block;
position:relative;
background-image:url(images/bargraph.gif);
background-position:right center;
background-repeat:repeat-x;
border-right:#538e02 1px solid;
text-align:center;
color:#fff;
height:25px;
font-family:Arial, Helvetica, sans-serif;
font-size:12px;
line-height:1.9em
}
 
.graph .bar span {
position:absolute;
left:1em
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
                    <h2>Survey Results</h2>
                    <?php
                        $file = 'survey.txt';
                        $lines = file($file);
                        $count = count($lines);

                        $elements = array();

                        echo "<strong>$count people have taken the survey:</strong><br /><br />";
                        foreach($lines as $line)
                        {
                            $elem = explode("|", $line);
                            $elements[] = array("frequency"=>$elem[0], "concession"=>$elem[1], "company"=>$elem[2], "theater"=>$elem[3]);
                        }


                        getByName("frequency", $elements, 1, $count, "People who go to the Movies everyday.");
                        getByName("frequency", $elements, 2, $count, "People who go to the Movies once per Week.");
                        getByName("frequency", $elements, 3, $count, "People who go to the Movies once per Month.");
                        getByName("frequency", $elements, 4, $count, "People who go to the Movies once per year.");
                        getByName("frequency", $elements, 5, $count, "People who do not go to the Movies.");

                        getByName("concession", $elements, 1, $count, "People who bought Popcorn.");
                        getByName("concession", $elements, 2, $count, "People who bought Soda.");
                        getByName("concession", $elements, 3, $count, "People who bought Candy Bar.");
                        getByName("concession", $elements, 4, $count, "People who bought Hotdog.");
                        getByName("concession", $elements, 5, $count, "People who didn't buy anything.");

                        getByName("company", $elements, 1, $count, "People who go alone to the Movies.");
                        getByName("company", $elements, 2, $count, "People who go with others to the Movies.");

                        getByName("theater", $elements, 1, $count, "People who rather go to Fatcats.");
                        getByName("theater", $elements, 2, $count, "People who prefer Paramount 5.");
                        getByName("theater", $elements, 3, $count, "People who enjoy the Drive-In (Teton Vu).");
                        getByName("theater", $elements, 4, $count, "People who probably traveled to Idaho Falls.");


                        function getByName($name, $array, $value, $votes, $description)
                        {
                            $count = 0;
                            foreach($array as $elem)
                            {
                                if ($elem[$name] == $value)
                                {
                                    $count++;
                                }
                            }

                            if ($count > 0)
                            {
                                $votePercentage = round(($count / $votes) * 100);
                                echo "<div class='rating'><div class='graphcont'>&nbsp;&nbsp;&nbsp;&nbsp;$description<div class='graph'><strong class='bar' style='width:$votePercentage%'>$votePercentage% ($count/$votes)</strong></div></div></div>";
                            }
                            
                        }
                    ?>
                    <br />
                    <br />
                </div>
                <!-- END LEFT COLUMN -->
                <!-- START FOOTER -->
                <div id="footer">
                    Copyright 2014 <a href="http://www.cs313.hamletsoft.net">http://www.cs313.hamletsoft.net</a></div>
                <!-- END FOOTER -->
            </div>
        </div>
    </div>
</body>
</html>