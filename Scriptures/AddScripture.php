<?php 
   $DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
   $DBUser   = 'root';
   $DBPass   = '0160515';
   $DBName   = 'scriptures';
   $mysqli = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

   if ($_SERVER['REQUEST_METHOD'] === "POST")
   {
      $book = $_POST["txtBook"];
      $chapter = $_POST["txtChapter"];
      $verse = $_POST["txtVerse"];
      $content = $_POST["txtContent"];

      $queryInsert = "INSERT INTO scriptures (book,chapter,verse,content) VALUES('$book', $chapter, $verse, '$content')";
      $mysqli->query($queryInsert);

      $insertedScriptureId = $mysqli->insert_id;
      $isNewTopic = $_POST["txtNewTopic"];

      $topics = $_POST["topics"];
      
      if ($isNewTopic != "")
      {
         $queryInsert = "INSERT INTO topics (name) VALUES('$isNewTopic')";
         $mysqli->query($queryInsert);
         $insertedTopic = $mysqli->insert_id;

         if ($insertedTopic > 0)
         {
            array_push($topics, $insertedTopic);
         }
      }
      

      if(count($topics) > 0) //insert in scripture_topics
      {
         if ($insertedScriptureId > 0)
         {
            foreach($topics as $topic)
            {
               $queryInsert = "INSERT INTO scripture_topics (scripture_id, topic_id) VALUES($insertedScriptureId, $topic)";
               $mysqli->query($queryInsert);
            }
         }
      }

   }

?>
<!DOCTYPE html>
<html>
   <head>
      <title>Scriptures</title>
      <script>
         function doNewTopic(chk)
         {
            if(chk.checked)
            {
               document.getElementById('txtNewTopic').disabled=''; 
               document.getElementById('txtNewTopic').focus();
            }
            else
            {
               document.getElementById('txtNewTopic').disabled='disabled'; 
               document.getElementById('txtNewTopic').value = "";
            }
         }
      </script>
      <style type="text/css">
      label
      {
         font-weight: bold;
      }
      </style>
   </head>
   <body>
      <h2>Add A New Scripture</h2>
      <form action="AddScripture.php" method="post">
         <table>
            <tr>
               <td><label>Book: </label></td><td><input name="txtBook" type="text" /></td>
            </tr>
            <tr>
               <td><label>Chapter: </label></td><td><input type="text" name="txtChapter" /></td>
            </tr>
            <tr>
               <td><label>Verse: </label></td><td><input type="text" name="txtVerse" /></td>
            </tr>
            <tr>
               <td><label>Content: </label></td><td><textarea name="txtContent"></textarea></td>
            </tr>
            <tr>
               <td valign="top"><label>Topics</label></td><td>
               <?php

           
            $query = "SELECT * FROM topics";

            $result = $mysqli->query($query);

            if ($result->num_rows > 0)
            {
               while ($row = $result->fetch_assoc())
               {
                  echo "<input type='checkbox' name='topics[]' value='". $row["id"] ."' /><label>".$row["name"]."</label><br />";
               }   
            }
            else
            {
               echo "<strong style='color: red;'>No scriptures found.</strong><br /><br />";
            }
         ?>
         <input type="checkbox" onchange="doNewTopic(this);" /><input name="txtNewTopic" id="txtNewTopic" type="text" disabled="disabled" />
      </td>
            </tr>
            <tr>
               <td colspan="2">
                  <input type="submit" value="Add Scripture" />
               </td>
            </tr>
         </table>
      </form>
      <hr />
      <h2>Scriptures</h2>
      <?php
         $query = "SELECT * FROM scriptures";
         $result = $mysqli->query($query);
          if ($result->num_rows > 0)
         {
            while ($row = $result->fetch_assoc())
            {
               $query2 = "SELECT * FROM scripture_topics AS st JOIN topics AS t ON t.id = st.topic_id WHERE st.scripture_id=".$row[id];
               $result2 = $mysqli->query($query2);
               echo "<strong>" . $row["book"] . " " . $row["chapter"] . ":" . $row["verse"] . "</strong> - &quot;" . $row["content"] . "&quot;";

               if ($result2->num_rows > 0)
               {
                  echo " - (";
                  while ($row2 = $result2->fetch_assoc())
                  {
                     echo " <strong>".$row2["name"]."</strong> ";
                  }   
                  echo ")";
               }

               echo "<br />";
            }   
         }
         else
         {
            echo "<strong style='color: red;'>No scriptures found.</strong><br /><br />";
         }
      ?>
   </body>
</html>