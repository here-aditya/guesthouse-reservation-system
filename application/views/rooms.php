<div class="row-fluid">
	<div class="span10 offset1">
		<div class="html_border">
			<div id="html_container">
				<div class="row-fluid">
					<h2><?=$page_data->head?></h2>
					<p class="paddrow"><?=$page_data->content?></p>
				</div>
                
                
                <?php 
				if( ! empty($rooms_catg_details))
				{
				?>
                <div class="paddrow rooms_cont">
                	<div class="accordion" id="accordion">
                    <?php
					$catg_count = 0;
					foreach($rooms_catg_details as $rooms_catg)
					{
                    ?>
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$catg_count?>">
                                <?=$rooms_catg->name?>
                                </a>
                            </div>
                            <div id="collapse<?=$catg_count?>" class="accordion-body collapse <?php $catg_count == 0 ? print 'in' : '' ?>">
                                <div class="accordion-inner">
                                    <div class="row-fluid">
                                        <div class="yellow_gradient span12">
                                            <?php
                                            if( ! empty($rooms_pics[$catg_count]))
                                            {
                                            ?>
                                            <div class="span6">
                                                <div class="carousel slide" id="Carousel<?=$catg_count?>">
                                                    <div class="carousel-inner">
                                                        <?php
                                                        $j = 1;
                                                        foreach($rooms_pics[$catg_count] as $pic)
                                                        {
                                                        ?>
                                                        <div class="item <?php $j == 1 ? print 'active' : print 'next' ?>">
                                                            <img alt="" src="<?=$RPath?>pics/image_gallery/<?=$pic->image_name?>">
                                                            <div class="carousel-caption">
                                                              <h4><?=$page_data->head?> <?=$j?> <?php ! empty($image->title_tag) ? print(' - '.$pic->title_tag) : '' ?></h4>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            $j++;
                                                        }
                                                        ?>
                                                    </div>
                                                    <a data-slide="prev" href="#Carousel<?=$catg_count?>" class="left carousel-control">&lsaquo;</a>
                                                    <a data-slide="next" href="#Carousel<?=$catg_count?>" class="right carousel-control">&rsaquo;</a>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="span6">
                                                <p><?=$rooms_catg->description?></p>
                                                <div class="span11">
													<div class="form-actions rooms_cont">
														<?=form_open()?>
                                                        	<?=form_hidden('sel_catg_id', $rooms_catg->id);?>
                                                            <button type="submit" class="btn btn-info">Check Rates</button>
                                                            <button type="submit" class="btn btn-warning">Check Availability</button>
                                                        <?=form_close()?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    $catg_count++;
					}
					?>
					</div>
                </div>
                <?php
				}	// outer if statement
				?>
                
			</div>
		</div>
	</div>
</div>



<script>
$('button').click(function() {
	if($(this).attr('class').indexOf('btn-info') != -1)
	{
		$(this).parent().attr('action', '<?=site_url("index/rate")?>');
	}
	else if($(this).attr('class').indexOf('btn-warning') != -1)
	{
		$(this).parent().attr('action', '<?=site_url("index/availability")?>');
	}
});
</script>