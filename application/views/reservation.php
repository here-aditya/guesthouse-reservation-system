<div class="row-fluid">
	<div class="span10 offset1">
		<div class="html_border">
			<div id="html_container">
				<div class="row-fluid">
					<h2><?=$page_data->head?></h2>
					<p class="paddrow"><?=$page_data->content?></p>
				</div>
				<div class="row-fluid">
                	<div class="rooms_cont">
					<?php
					if(is_array($contact_details))
					{
						foreach($contact_details as $contact)
						{
					?>
					<div class="row-fluid">
						<div class="span6 offset2 rooms_cont small_block">
							<div class="span6">
								<address>	
									<h3><?=$contact->city?></h3>
									<p>
										<u><strong><?=$contact->name?></strong></u><br />
										<em><?=$contact->address?></em><br />
									</p>
								</address>
							</div>
							<div class="span6">
								<div class="row-fluid">
									<p>&nbsp;</p>
									<p>&nbsp;</p>
								</div>
								<div class="row-fluid">	
									<p class="pull-right">
										<?php if( ! empty($contact->phone)) { ?> <span class="add-on"><i class="icon-signal padd-right"></i></span><?=$contact->phone?><br /> <?php } ?>
										<?php if( ! empty($contact->mobile)) { ?> <span class="add-on"><i class="icon-signal"></i></span><?=$contact->mobile?><br /> <?php } ?>
										<?php if( ! empty($contact->fax)) { ?> <span class="add-on"><i class="icon-print"></i></span><?=$contact->fax?><br /> <?php } ?>
										<?php if( ! empty($contact->email)) { ?> <span class="add-on"><i class="icon-envelope"></i></span><a href="mailto:<?=$contact->email?>"><?=$contact->email?></a><br /> <?php } ?>
									</p>
								</div>	
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