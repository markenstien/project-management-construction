<?php build('content')?>
<section class="banner" 
    style="background: url(/assets/banner.jpg) no-repeat center center; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      height: 80vh;">


      <div class="container">
          <div class="text-center justif" id="bannerHeading">
              <h3 class="heading-text"><?php echo COMPANY_NAME?></h3>
              <!-- <a href="<?php echo _route('quote:projectClassification')?>" class="btn btn-primary">Get Free Quote</a> -->
          </div>
      </div>
</section>


<section class="section">
    <div class="container">
        <h4 class="section-title">About</h4>
        <div class="row">
            <article class="col-md-8">
                <p>
                    Prado and Sons Industries is a
                    leading global manufacturer of armored trucks and truck bodies in the Philippines.
                </p>
            </article>

            <div class="col-md-4">
                <img src="<?php echo _path_upload_get('images_asset/IMG-7651.JPG')?>" style='width: 100%;'>
            </div>
        </div>
    </div>
</section>

<section class="section" id="project">
    <div class="container">
        <h4 class="section-title">Projects</h4>

        <div class="row" id="projectItems">
            <div class="col-md-4">
                <img src="<?php echo _path_upload_get('images_asset/afp_pickup.png')?>" style='width: 100%;'>
            </div>

            <div class="col-md-4">
                <img src="<?php echo _path_upload_get('images_asset/afp_wagon.png')?>" style='width: 100%;'>
            </div>

            <div class="col-md-4">
                <img src="<?php echo _path_upload_get('images_asset/dump_truck.png')?>" style='width: 100%;'>
            </div>

            <div class="col-md-4">
                <img src="<?php echo _path_upload_get('images_asset/armored_car.jpg')?>" style='width: 100%;'>
            </div>

            <div class="col-md-4">
                <img src="<?php echo _path_upload_get('images_asset/fire_truck.jpg')?>" style='width: 100%;'>
            </div>
        </div>
    </div>
</section>


<!-- <section class="section" id="partners">
    <div class="container">
        <h4 class="section-title">Our Partners</h4>
        <div class="partners-show-case">
            <div class="partners-logo">
                <img src="<?php echo URL.DS.'assets/partners/graco.png'?>">
            </div>
            <div class="partners-logo">
                <img src="<?php echo URL.DS.'assets/partners/hardieflex.PNG'?>">
            </div>
            <div class="partners-logo">
                <img src="<?php echo URL.DS.'assets/partners/davies.PNG'?>">
            </div>
            <div class="partners-logo">
                <img src="<?php echo URL.DS.'assets/partners/moldex.PNG'?>">
            </div>
        </div>

        <div class="partners-show-case">
            <div class="partners-logo">
                <img src="<?php echo URL.DS.'assets/partners/davco.PNG'?>">
            </div>
            <div class="partners-logo">
                <img src="<?php echo URL.DS.'assets/partners/parex.PNG'?>">
            </div>
            <div class="partners-logo">
                <img src="<?php echo URL.DS.'assets/partners/lanko.PNG'?>">
            </div>
            <div class="partners-logo">
                <img src="<?php echo URL.DS.'assets/partners/boysen.PNG'?>">
            </div>
        </div>
    </div>
</section>

<section class="section" id="contactSection">
    <div class="container">
        <h4 class="section-title">Contact US</h4>

        <div class="row">
            <div class="col-md-5 text-center">
                <img src="<?php echo URL.DS.'assets/hero.jpg'?>" style="width: 100%;">
                <p>MonsterThesis Team <br/>will reach you within 24 hours!</p>
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
</section> -->
<?php endbuild()?>


<?php build('headers')?>
    <style type="text/css">
        #bannerHeading{
            text-align: center;
            height: 100%;
            height: 80vh;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        #bannerHeading .heading-text
        {
            color: #fff;
            font-size: 2.3em;
            margin-bottom: 50px;
        }

        #project div.project
        {
            margin-bottom: 100px;
        } 

        #partners
        {
            background: #E5E5E5;
        }

        .partners-show-case {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .partners-show-case .partners-logo
        {
            width: 150px;
            max-height: 100px;
            margin: 30px;
        }

        .partners-show-case .partners-logo img 
        {
            width: 100%;
        }

        #projectItems div{
            margin-bottom: 30px;
        }
    </style>
<?php endbuild()?>
<?php loadTo('tmp/public')?>