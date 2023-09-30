<?php build('content')?>
<div id="containerbar" class="containerbar authenticate-bg">
    <!-- Start Container -->
    <div class="container">
        <div class="auth-box register-box">
            <!-- Start row -->
            <div class="row no-gutters align-items-center justify-content-center">
                <!-- Start col -->
                <div class="col-md-6 col-lg-5">
                    <!-- Start Auth Box -->
                    <div class="auth-box-right">
                        <div class="card">
                            <div class="card-body text-left">
                            	<?php
                            		Form::open([
                            			'method' => 'post',
                            			'action' => '/UserController/login'
                            		]);
                            	?>
                                    <div class="form-head text-center">
                                        <a href="index.html" class="logo">
                                            <?php wBackgroundImage([
                                                'size' => '200px'
                                            ])?>
                                        </a>
                                    </div> 
                                    <h4 class="text-primary my-4 text-center">Sign In</h4>
                                    <?php Flash::show()?>

                                    <div class="form-group">
                                        <?php
                                            Form::label('Email');
                                            Form::text('email' , '' , [
                                                'class' => 'form-control',
                                                'required' => '',
                                                'placeholder' => 'Enter Email',
                                                'id' => 'email'
                                            ]);
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <?php
                                            Form::label('Password');
                                            Form::password('password' , '' , [
                                                'class' => 'form-control',
                                                'required' => '',
                                                'placeholder' => 'Enter Password',
                                                'id' => 'password'
                                            ]);
                                        ?>
                                    </div>

                                    <!-- <div class="form-group">
                                        <a href="/ForgetPasswordController/index">Forget password</a>
                                    </div>                          -->
                                  <button type="submit" class="btn btn-success btn-lg btn-block font-18">Sign in</button>
                                <?php Form::close()?>
                            </div>
                        </div>
                    </div>
                    <!-- End Auth Box -->
                </div>
                <!-- End col -->
            </div>
            <!-- End row -->
        </div>
    </div>
    <!-- End Container -->
</div>
<?php endbuild()?>
<?php loadTo('tmp/public')?>