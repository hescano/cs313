<?php 

   function printLogin()
   {
      if (!isset($_SESSION["LoggedUser"]))
      {
      ?>
         <!-- Modal Login -->
      <form role="form" action='login.php?previous=<?php echo $_SERVER["REQUEST_URI"]; ?>' method="post">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Log In</h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username or Email</label>
                    <input type="username" class="form-control" name="username" placeholder="Enter Username or Email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> Remember me on this computer
                    </label>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Log In</button>
              </div>
            </div>
          </div>
        </div>
      </form>
        <!-- Modal Login End -->
   <?php
      }
   }
?>