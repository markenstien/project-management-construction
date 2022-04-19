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
              <h3 class="heading-text">Services</h3>
          </div>
      </div>
</section>

<section class="section">
    <div class="container">
        <h4 class="section-title">Delivering a one of a kind quality services </h4>
        <ul class="list-group">
            <li class="list-group-item">Design</li>
            <li class="list-group-item">Construction</li>
            <li class="list-group-item">Painting and Waterproofing</li>
        </ul>
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