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
                <p>“To become one of the ideal and reliable construction company serving our valued customers with integrity, transparency and truthfulness”</p>
            </div>
            <br>
            <div class="text-center col">
                <h3>Vission</h3>
                <p>To achieve the highest level of customer satisfaction as we continue designing dreams,
                building futures and above all a God-fearing company as we strive hard in reaching our
                goal, “Excellence is not our priority, it’s our Standard”.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h4 class="section-title">Why Choose us?</h4>
        <article>
            <p>
                PaintMan Construction delivers a one of a kind quality of service in the field of
                architectural designs and building construction. With our four major endeavor, namely:
                Design, Construct, Painting and Waterproofing, our company has achieved the level of
                excellence through the use of state-of-the-art equipment especially for painting and
                waterproofing services.
            </p>
        </article>

        <article>
            <p>
                With our wide sources of construction supplies, technical knowledge and supports,
                highly skilled structural and field engineers, design and development architects,
                PaintMan Construction makes it easier to design, construct, paint and waterproof a
                particular construction project.
            </p>
        </article>

        <article>
            <p>
                Furthermore, PaintMan Construction has sufficient staff that can handle all the fields of
                construction. From plumbing and sanitation, electrical and mechanical works, civil works,
                fabrications, interior designs and architectural fit-outs, tiling, architectural and decorative
                coating and our line of specialization; painting and waterproofing which we utilized Airless
                Spray-Painting Machine to hasten the time of finishing.
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