<!-- Main Inner Container -->
<div class="span9">
  <!--inner row1-->
  <div class="row-fluid">
      <div class="heading gradient_deepgrey">
        <h3>Site Configure</h3>
      </div>
  </div>
  <!--/inner row1-->
  
  <!--inner row2-->
  <div class="row-fluid">
      <div class="container-fluid action_panel gradient_milkywhite">
        <div class="row-fluid">
          <div class="mid_main_head">
              <span>Global Config :</span>
          </div>
        </div>
        
        <!-- content tab -->
        <div class="row-fluid" id="id_div_contact">
            <div class="div_border">
                    <?php
					$attributes = array('class' => 'form-horizontal', 'id' => 'frm_menu_page');
                    echo form_open(site_url("admin/globalconfig/save"), $attributes);
					?>
                        <div class="inner_head gradient_grey">
                          <div id="inner_head">Add Configuration</div>
                        </div>
                        <?php
						if( ! empty($ErrMsg)) 
						{
						?>
                        <div class="alert alert-error alert-block">
                        	<button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?=$ErrMsg?>
                        </div>
                        <?php
						}
						?>
                        <div class="control-group">
                            <label class="control-label" for="txt_name">Global Site Title</label>
                            <div class="controls">
                            	<?php
								$txt_site_title = set_value('txt_site_title');
								$txt_site_title = empty($txt_site_title) && ! empty($site_config_list) ? $site_config_list['site_title'] : $txt_site_title;
								?>
                                <input type="text" rows="3" class="input-xlarge" value="<?=$txt_site_title?>" placeholder="Global Site Title" name="txt_site_title" id="txt_site_title" />
								<?=form_error('txt_site_title','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_name">Global Meta Keyword</label>
                            <div class="controls">
                                <textarea rows="3" class="input-xlarge" placeholder="Global Meta Keyword" name="txt_meta_keyword" id="txt_meta_keyword"><?php
								$txt_meta_keyword = set_value('txt_meta_keyword');
								empty($txt_meta_keyword) && ! empty($site_config_list) ? print $site_config_list['meta_keyword'] : print $txt_meta_keyword;
								?></textarea>
								<?=form_error('txt_meta_title','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_name">Global Meta Description</label>
                            <div class="controls">
                                <textarea rows="3" class="input-xlarge" placeholder="Global Meta Description" name="txt_meta_desc" id="txt_meta_desc"><?php
								$txt_meta_desc = set_value('txt_meta_desc');
								empty($txt_meta_desc) && ! empty($site_config_list) ? print $site_config_list['meta_desc'] : print $txt_meta_desc;
								?></textarea>
								<?=form_error('txt_meta_desc','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_name">Google Analytics</label>
                            <div class="controls">
                                <textarea rows="5" class="input-xlarge" placeholder="Google Analytics" name="txt_analytics" id="txt_analytics"><?php
								$txt_analytics = set_value('txt_analytics');
								empty($txt_analytics) && ! empty($site_config_list) ? print $site_config_list['google_analytic'] : print $txt_analytics;
								?></textarea>
								<?=form_error('txt_analytics','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_name">Site Contact Mail</label>
                            <div class="controls">
                            	<?php
								$txt_contact_mail = set_value('txt_contact_mail');
								empty($txt_contact_mail) && ! empty($site_config_list) ? $txt_contact_mail = $site_config_list['contact_mail'] : '';
								?>
                                <input type="text" rows="3" class="input-xlarge" placeholder="Site Contact Mail" name="txt_contact_mail" id="txt_contact_mail" value="<?=$txt_contact_mail?>" />
								<?=form_error('txt_contact_mail','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">  
                          <div class="controls">
                            <button class="btn btn-primary" type="submit" name="save" value="save">Save</button>
                            <button class="btn" type="reset" name="cancel" value="cancel">Cancel</button>
                          </div>
                        </div>
                    </form>
            </div><!--/div_border -->
        </div>
        <!--/content menu tab -->
      </div>
  </div>
  <!--/inner row2-->
</div>
<!--/Main Inner Container -->


<!-- internal Page JS-->
<script type="text/javascript">
// Cancel Button Clicked
$(':button[value="cancel"]').click( function() {
		$('.alert').hide();
		$(window).height() <= 480 ? $(document).scrollTop($('.heading').offset().top-5) : $(document).scrollTop(0);
});
</script>