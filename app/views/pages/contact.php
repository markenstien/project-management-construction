<?php build('content')?>
<section class="banner" 
    style="background: url(/assets/services-banner.jpg) no-repeat center center; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      height: 40vh;">
      <div class="container">
          <div class="text-center justif" id="bannerHeading">
              <h3 class="heading-text">Contact Us</h3>
          </div>
      </div>
</section>

<section class="section" id="contactSection">
    <div class="container">
        <div class="row">
            <div class="col-md-5 text-center">
                <img src="<?php echo URL.DS.'assets/hero.jpg'?>" style="width: 100%;">
                <p>PaintMan Team Corporate Team <br/>will reach you within 24 hours!</p>
            </div>

            <div class="col-md-7">
                <div class="card" id="contactForm">
                    <div class="card-header">
                        <h4 class="card-title">Send us a message</h4>
                    </div>

                    <div class="card-body">
                        <?php
                            Form::open([
                                'method' => 'post',
                                'action' => _route('mailing:publicBasic' )
                            ]);
                        ?>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <?php
                                    Form::label('Name');
                                    Form::text('name' , '' , [
                                        'class' => 'form-control'
                                    ]);
                                ?>
                            </div>

                            <div class="form-group col-sm-12">
                                <?php
                                    Form::label('Email');
                                    Form::text('email' , '' , [
                                        'class' => 'form-control'
                                    ]);
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php
                                Form::label('Message');
                                Form::textarea('message' , '' , [
                                    'class' => 'form-control',
                                    'rows'  => 5
                                ]);
                            ?>
                        </div>

                        <div class="form-group">
                            <?php 
                                Form::submit('' , 'Send Message' , [
                                    'class' => 'btn btn-primary btn-block'
                                ]);
                            ?>
                        </div>
                        <?php Form::close()?></div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php endbuild()?>


<?php build('headers')?>
    <style type="text/css">
        #bannerHeading{
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            padding-top: 50px;
        }

        #bannerHeading .heading-text
        {
            color: #fff;
            font-size: 2.3em;
            margin-bottom: 50px;
        }
    </style>
<?php endbuild()?>
<?php loadTo('tmp/public')?>