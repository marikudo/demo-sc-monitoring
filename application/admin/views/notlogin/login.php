
                
                
				
				<h1>Log in with your email account</h1>
				<?php
                  if (isset($error)){
                      ?>
                      <div class="alert alert-danger alert-sm"><?=$error?></div>
                      <?php
                  }
                ?>
                    <form role="form" class="login" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="username" class="form-control modified-txtbox" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Password</label>
                            <input type="password" name="password" class="form-control modified-txtbox" placeholder="Password">
                        </div>
                       
                        <input type="submit" name="btn_success" id="btn-login" class="btn btn-custom btn-lg btn-block " value="Log in">
                    </form>
                    <a href="<?=app_base_url()?>home/forgot" class="forget" data-toggle="modal" data-target=".forget-modal">Forgot your password?</a>
                    <hr>