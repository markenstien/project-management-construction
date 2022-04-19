<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Folder : <?php echo $folder->folder?></h4>
		</div>

		<div class="card-body">
			<?php Flash::show()?>

			<!-- <div class="gallery-filter-box text-center m-b-30">
                <div class="gallery-filter">  
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a class="filter-item current" data-filter="*">All</a></li>
                        <li class="list-inline-item"><a class="filter-item" data-filter=".latest">Latest</a></li>
                        <li class="list-inline-item"><a class="filter-item" data-filter=".fashion">Fashion</a></li>
                        <li class="list-inline-item"><a class="filter-item" data-filter=".popular">Popular</a></li>
                        <li class="list-inline-item"><a class="filter-item" data-filter=".trending">Trending</a></li>
                        <li class="list-inline-item"><a class="filter-item" data-filter=".sale">Sale</a></li>
                    </ul>
                </div>
            </div> -->
            <div class="gallery-item-box">
                <div class="gallery-item-box">
                    <div class="grid row justify-content-md-center">
                    	<?php foreach($folder->files as $fileKey => $file) :?>
	                		<?php
								$fileName = $file->name;
								$ext = explode('.' , $fileName);
								$ext = end($ext);
							?>
							<?php if( isEqual( $ext , ['png','gif','jpeg' , 'jpg']) ) :?>
								<div class="grid-item col-sm-6 col-md-6 col-lg-4 col-xl-3 latest">
	                                <div class="gallery-box">
	                                    <div class="gallery-preview">
	                                        <img src="<?php echo $file->url.'/'.$fileName?>" 
	                                        	class="img-fluid img-thumbnail"
	                                        	style="height: 150px;"
	                                        	alt="<?php echo $file->display_name?>"/>
	                                    </div>
	                                    <div class="gallery-content">
	                                        <p>latest</p>
	                                        <h5><a href="#"><?php echo $file->display_name?></a></h5>
	                                    </div>      
	                                </div>
	                            </div>
							<?php endif?>
                        <?php endforeach?>
                    </div>
                </div>
            </div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>