<?php 
  include_once("header.php");
  include_once("Update.php");
?>
    <div class="jumbotron" style="background:url(http://www.pitonik.com/Sayfalar/Moduller/Resimler/fotograflar/b45da986caf39e0451604dedd2d53bcc521.jpg)">
      <h1>TestO'Matic</h1>
      <p>If you are in the process of learning new material at school, or studying really hard for that latest Microsoft Certification,
        then you migh find that creating practice tests is one way to memorize, and become better at anything. </p>
      <p>
      <a class="btn btn-lg btn-primary" href="tour.php" role="button">Take the Tour &raquo;</a>
      </p>
    </div>
    
  <div class="row">
    <div class="col-xs-6">
      <h3>Recent Public Tests <span class="glyphicon glyphicon-bullhorn"></span></h3>
      <ul>
        <?php 

          $updates = Update::getAllUpdates();
          if (count($updates) > 0)
          {
            foreach ($updates as $item)
            {
              echo $item->UpdateHtmlText;
            }
          }
          else
          {
            echo "<li>No updates.</li>";
          }
        ?>
      </ul>
    </div>
    <div class="col-xs-6">
      <h3>Not registered yet?</h3>
      <h5><a href="Register.php">Create your free account!</a></h5>
    </div>
  </div>

  <!-- End Header-->
</div>
<?php 
  include_once("footer.php");
?>