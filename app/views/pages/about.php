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
                <p>Our mission is to design and build state-of-the-art trucks that set the benchmark for
                    quality, durability, and innovation. We strive to exceed our customers&#39; expectations by
                    delivering superior vehicles that enhance their business operations and provide
                    exceptional value. Through cutting-edge technology, rigorous engineering standards,
                    and a commitment to sustainability, we aim to be the preferred choice for truck
                    manufacturing worldwide.</p>
            </div>
            <br>
            <div class="text-center col">
                <h3>Vision</h3>
                <p>Our vision is to lead the truck manufacturing industry by pioneering advancements in
                vehicle design, safety, and environmental sustainability. We aspire to be recognized
                globally for our excellence in engineering and our dedication to producing trucks that not
                only meet but surpass industry standards. By fostering a culture of continuous
                improvement and customer focus, we envision a future where our trucks drive the
                success and growth of businesses around the world.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h4 class="section-title">Why Choose us?</h4>
        <article>
            <p>
                <?php echo COMPANY_NAME?> Prado and Sons Inc. is a leader in the design and production of high-performance
                trucks. Our company prides itself on blending innovation with durability to create
                vehicles that meet the diverse needs of our clients. With a strong commitment to
                excellence, we ensure that each truck we produce upholds the highest standards of
                quality and reliability.
            </p>
        </article>

        <article>
            <p>
            At Prado and Sons, we utilize cutting-edge technology and rigorous engineering
            processes to build trucks that set new benchmarks in the industry. Our team of skilled
            professionals works tirelessly to incorporate the latest advancements into our designs,
            ensuring that our vehicles are not only efficient but also environmentally friendly. We
            believe that innovation and sustainability go hand in hand, driving us to continuously
            improve our manufacturing practices.
            </p>
        </article>

        <article>
            <p>
                Customer satisfaction is at the heart of everything we do. From initial design to final
                    delivery, we prioritize the needs of our clients, offering tailored solutions that enhance
                    their business operations. At Prado and Sons, we provide unparalleled service and
                    support, ensuring that our trucks drive your success and growth.
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