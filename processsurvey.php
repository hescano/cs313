<?php 

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $frequency = $_POST["frequency"];
        $concession = $_POST["concession"];
        $company = $_POST["company"];
        $theater = $_POST["theater"];

      


        //begin process
         $file = 'survey.txt';
         $content = "$frequency|$concession|$company|$theater\r\n";

         echo $content;
         file_put_contents($file, $content, FILE_APPEND | LOCK_EX);

         session_start();
         $_SESSION["user_voted"] = "true";

         header('Location: viewresults.php');

    }
?>