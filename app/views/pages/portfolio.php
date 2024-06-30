<?php build('content')?>
<section class="banner" 
    style="background: url(/assets/portfolio-banner.jpg) no-repeat center center; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      height: 40vh;">
      <div class="container">
          <div class="text-center justif" id="bannerHeading">
              <h3 class="heading-text">Our Portfolio</h3>
          </div>
      </div>
</section>

<?php
    $worksSamples = scandir(BASE_DIR.DS.'public/assets/projects');
?>
<section class="section">
    <h4 class="section-title">Some of our best paint works!</h4>
    <div class="container">
        <div class="row">
            <?php foreach($worksSamples as $work) :?>
                <?php if(isEqual($work, ['.','...']) || is_dir($work)) continue?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <img src="<?php echo _path_asset('projects/'.$work)?>" style="width:100%">
                        </div>
                    </div>
                </div>
            <?php endforeach?>
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