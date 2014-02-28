<!DOCTYPE html>
<html>
   <head>
      <title>Scriptures</title>
   </head>
   <body>
      <h2>Scripture Resources</h2>
      <?php

         $DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
         $DBUser   = 'root';
         $DBPass   = '0160515';
         $DBName   = 'scriptures';
         $mysqli = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

         $query = "SELECT * FROM scriptures";
         if (isset($_POST))
         {
            $book = $_POST["txtScripture"];

            if (isset($book) && $book !== "")
            {
               $query = $query . " WHERE book='$book'";
            }
         }

         $result = $mysqli->query($query);

         if ($result->num_rows > 0)
         {
            while ($row = $result->fetch_assoc())
            {
               echo "<strong>" . $row["book"] . " " . $row["chapter"] . ":" . $row["verse"] . "</strong> - &quot;" . $row["content"] . "&quot; <br /><br />";
            }   
         }
         else
         {
            echo "<strong style='color: red;'>No scriptures found.</strong><br /><br />";
         }
         


      ?>

      <fieldset style="width: 500px;">
         <legend>Search by Book:</legend>
         <form action="Scriptures.php" method="post">
            <strong>Book Name: </strong><input type="text" name="txtScripture" value="<?php echo $_POST['txtScripture']; ?>" />
            <input type="submit" value="Search"/>
         </form>
      </fieldset>
   </body>
</html>