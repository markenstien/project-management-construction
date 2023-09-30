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
              <h3 class="heading-text"><?php echo COMPANY_NAME?> <br/> Project Management Software</h3>
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
                Generate Lorem Ipsum placeholder text for use in your graphic, 
                print and web layouts, and discover plugins for your favorite writing, design and blogging tools. E
                xplore the origins, history and meanin
                </p>
                <a href="#" class="btn btn-primary btn-sm">Tell me more</a>
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

        <div class="row project">

            <div class="col-md-4">
                <img src="<?php echo _path_upload_get('images_asset/IMG-7641.JPG')?>" style='width: 100%;'>
            </div>

            <article class="col-md-8">
                <p>
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, 
                non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, 
                sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, 
                craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. 
                Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.

                </p>
                <a href="#" class="btn btn-primary btn-sm">Show Project</a>
            </article>
        </div>

        <div class="row project">
            <article class="col-md-8">
                <p
                >Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
                3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                 Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                </p>
                <a href="#" class="btn btn-primary btn-sm">Show Project</a>
            </article>

            <div class="col-md-4">
                <img src="<?php echo _path_upload_get('images_asset/IMG-7639.JPG')?>" style='width: 100%;'>
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
    </style>
<?php endbuild()?>
<?php loadTo('tmp/public')?>