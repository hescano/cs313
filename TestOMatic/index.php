<?php 
  include_once("header.php");
  include_once("Update.php");
?>
    <!--<div class="jumbotron">
      <h1>Welcome</h1>
      <p>This example is a quick exercise to illustrate how the default, static navbar and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
      <p>
      <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a>
      </p>
    </div>
    -->
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

      <form class="form-signin" role="form">
        <h5>Create your free account!</h5>
        <input type="email" class="form-control" placeholder="Email address" required="" autofocus="" />
        <input type="username" class="form-control" placeholder="User Name" required="" />
        <input type="fullname" class="form-control" placeholder="Full Name" required="" />
        <input type="password" class="form-control" placeholder="Password" required="" />
        <input type="password" class="form-control" placeholder="Repeat Password" required="" />
        <br />
        <button class="btn btn-primary btn-block" type="submit">Register</button>
      </form>

    </div>
  </div>

  <!-- End Header-->
</div>
<?php 
  include_once("footer.php");
?>