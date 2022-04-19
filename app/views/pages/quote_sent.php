<?php build('content')?>
<section class="section">
    <div class="container">
        <div class="text-center">
            <?php Flash::show()?>

            <p>You can close this page now.</p>
        </div>
    </div>
</section>
<?php endbuild()?>
<?php loadTo('tmp/public')?>