<?php build('content')?>
<section class="banner" 
    style="background: url(/assets/about-banner.jpg) no-repeat center center; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      height: 40vh;">
      <div class="container">
          <div class="text-center justif" id="bannerHeading">
              <h3 class="heading-text">About Us</h3>
          </div>
      </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="text-center col">
                <h3>Mission</h3>
                <p>“Generate Lorem Ipsum placeholder text for use in your graphic, print and web layouts, 
                    and discover plugins for your favorite writing, design and blogging tools. 
                    E xplore the origins, history and meanin”</p>
            </div>
            <br>
            <div class="text-center col">
                <h3>Vission</h3>
                <p>"Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, 
                    raw denim aesthetic synth nesciunt you probably haven't 
                    heard of them accusamus labore sustainable VHS.”.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h4 class="section-title">Why Choose us?</h4>
        <article>
            <p>
                <?php echo COMPANY_NAME?> Construction delivers a one of a kind quality of service in the field of
                architectural designs and building construction. With our four major endeavor, namely:
                Design, Construct, Painting and Waterproofing, our company has achieved the level of
                excellence through the use of state-of-the-art equipment especially for painting and
                waterproofing services.
            </p>
        </article>

        <article>
            <p>
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
                3 wolf moon officia aute, non cupidatat skateboard dolor brunch. 
                Food truck quinoa nesciunt laborum eiusmod. 
                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
            </p>
        </article>

        <article>
            <p>
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, 
                non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. 
                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee 
                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica.
            </p>
        </article>
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