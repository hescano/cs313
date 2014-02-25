   <?php
      include_once("dialog_helper.php");
      printLogin();
   ?>
   <!-- Bootstrap core JavaScript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script type="text/javascript">
      $(function()
      {
         hideAlert();
      });
      function hideAlert()
         {
            if($(".alert").length > 0)
            {
               setTimeout(function()
               {
                  $(".alert").slideUp("slow");
               }, 10000);
            }
         }
   </script>
   </body>
</html>