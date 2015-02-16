
            <h1>Forgot Password</h1>
                <?php
                  if (isset($error)){
                      ?>
                      <div class="alert alert-danger alert-sm"><?=$error?></div>
                      <?php
                  }
                  if (isset($success)){
                      ?>
                      <div class="alert alert-success alert-sm"><?=$success?></div>
                      <?php
                  }
                ?>
				
				 <form role="form" class="login" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="username" class="form-control modified-txtbox" placeholder="Username">
                        </div>
                        
                        <button type="submit" name="btn_success" class="btn btn-custom btn-lg btn-block ">Submit</button>
                    </form>
                                               <a href="<?=app_base_url()?>home/auth" class="forget" data-toggle="modal" data-target=".forget-modal">Login</a>
                    <hr>
               