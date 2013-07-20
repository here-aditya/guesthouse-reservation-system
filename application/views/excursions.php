<div class="row-fluid">
	<div class="span10 offset1">
		<div class="html_border">
			<div id="html_container">
				<div class="row-fluid">
					<h2><?=$page_data->head?></h2>
					<p class="paddrow"><?=$page_data->content?></p>
				</div>
				<div class="paddrow rooms_cont">
                
                    <ul class="nav nav-tabs" id="excursionTab">
                        <li><a href="#local"><?=$excursion_details[0]->head?></a></li>
                        <li class="active"><a href="#tour"><?=$excursion_details[1]->head?></a></li>
                    </ul>
                         
                    <div class="tab-content">
                        <div class="tab-pane" id="local">
                        	<?php 
							if( ! empty($excursion_details[0]->content) )
							{
							?>
                        	<div class="row-fluid">
                            	<div class="span10 offset1">
                            		<?=$excursion_details[0]->content?>
                                </div>
                            </div>
                            <?php
							}
							?>
                        <?php
                        if( ! empty($local_details) )
                        {
                            foreach($local_details as $local)
                            {
                        ?>
                            <div class="row-fluid">
                                <div class="small_block rooms_cont offset1 span10">
                                	<?php
									if( ! empty($local->image_name))
									{
									?>
                                    <div class="span4">
                                    	<img style="width: 200px; height: 150px;" src="<?=$RPath?>pics/image_gallery/<?=$local->image_name?>" class="img-polaroid" alt="">
                                    </div>
                                    <?php
									}
									?>
                                    <div class="span8">
                                        <h3><?=$local->head?></h3>
                                        <p><?=substr($local->content,0, 300)?><a href="<?=site_url('index/'.strtolower(str_replace(' ', '', $local->menu_name)))?>"> Read more ..</a></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        }
                        ?>
                        </div>
                        
                        <div class="tab-pane active" id="tour">
                        	<?php 
							if( ! empty($excursion_details[1]->content) )
							{
							?>
                        	<div class="row-fluid">
                            	<div class="offset1 span10">
                            		<?=$excursion_details[1]->content?>
                                </div>
                            </div>
                            <?php
							}
							?>
                        <?php
                        if( ! empty($tour_details) )
                        {
                            foreach($tour_details as $location)
                            {
                        ?>
                            <div class="row-fluid">
                                <div class="small_block rooms_cont span10 offset1">
                                    <div class="span4">
                                        <img style="width: 200px; height: 150px;" src="<?=$RPath?>pics/image_gallery/<?=$location->image_name?>" class="img-polaroid" alt="200 X 150">
                                    </div>
                                    <div class="span8">
                                        <h3><?=$location->head?></h3>
                                        <p><?=substr($location->content,0, 300)?><a href="<?=site_url('index/'.strtolower(str_replace(' ', '', $location->menu_name)))?>"> Read more ..</a></p>
                                    </div>
                                </div>
                            </div>
						<?php
                            }
                        }
                        ?>
                        </div>
                    </div>
                        
				</div>
			</div>
		</div>
	</div>
</div>


<script>
    $(function () {
    	$('#excursionTab a:last').tab('show');
		// Toggle tab on tab click
		$('#excursionTab a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		})
    });
</script>