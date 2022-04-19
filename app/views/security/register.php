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
                            <div class="card-body">
                            	<?php
                            		Form::open([
                            			'method' => 'post',
                            			'action' => '/UserController/register'
                            		]);
                            	?>
                                    <div class="form-head">
                                        <a href="index.html" class="logo">
                                        <?php wBackgroundImage([
                                            'size' => '200px'
                                        ])?>
                                        </a>
                                    </div> 
                                    <h4 class="text-primary my-4">Sign Up !</h4>
                                    <?php Flash::show()?>
                                    
                                    <div class="text-left">
                                        <div class="form-group">
                                            <?php
                                                Form::label('First Name *');
                                                Form::text('first_name' , '' , [
                                                    'class' => 'form-control',
                                                    'required' => '',
                                                    'placeholder' => 'Enter First Name',
                                                    'id' => 'first_name'
                                                ]);
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                                Form::label('Last Name *');
                                                Form::text('last_name' , '' , [
                                                    'class' => 'form-control',
                                                    'required' => '',
                                                    'placeholder' => 'Enter Last Name',
                                                    'id' => 'last_name'
                                                ]);
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <?php

                                                Form::label('Email *');
                                                $formAttr = [
                                                    'class' => 'form-control',
                                                    'required' => '',
                                                    'placeholder' => 'Enter Email',
                                                    'id' => 'email'
                                                ];

                                                if( isset($email) )
                                                    $formAttr['readonly'] = true;
                                                Form::text('email' , $email ?? '' , $formAttr);
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                                Form::label('Password *');
                                                Form::password('password' , '' , [
                                                    'class' => 'form-control',
                                                    'required' => '',
                                                    'placeholder' => 'Enter Password',
                                                    'id' => 'password'
                                                ]);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-row mb-3">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-checkbox text-left">
                                                <input name="terms" type="checkbox" class="custom-control-input" id="terms">
                                                <label class="custom-control-label font-14" for="terms">I Agree to Terms & Conditions of Orbiter</label>
                                            </div>                                
                                        </div>
                                    </div>                          
                                  <button type="submit" class="btn btn-success btn-lg btn-block font-18">Register</button>
                                <?php Form::close()?>
                                <p class="mb-0 mt-3">Already have an account? <a href="/SecurityController/login">Sign In</a></p>
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