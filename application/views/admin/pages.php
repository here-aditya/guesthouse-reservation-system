<?php
$option_sel = $this->uri->segment(3); // check which operation performed (save/update)
?>
<!-- Main Inner Container -->
<div class="span9">
  <!--inner row1-->
  <div class="row-fluid">
      <div class="heading gradient_deepgrey">
        <h3>Manage Pages</h3>
      </div>
  </div>
  <!--/inner row1-->
  
  <!--inner row2-->
  <div class="row-fluid">
      <div class="container-fluid action_panel gradient_milkywhite">
        <div class="row-fluid">
          <div class="mid_main_head">
              <span>Pages :
              	<font class="submenu">
                <?php ! empty($menu_bread_crumb) ? print $menu_bread_crumb : ''  ?>
                </font>
              </span>
              <span class="pull-right">
              	<input type="button" class="btn btn-inverse <?php if(isset($frm_validation_err) && $frm_validation_err || $sel_front_menu_id == 5) echo 'hide'?>" value="Add Page">
              </span>
          </div>
        </div>
        
        <!-- operation tab -->
        <div class="row-fluid padd_row <?php isset($frm_validation_err) && $frm_validation_err ? print 'no_disp' : ''?>" id="id_div_table">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>MENU / PAGE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(is_array($front_menu))
                    {
                        $arr_front_menu = getMenu($front_menu, $sel_front_menu_id); // get list of  menus / pages by sel_front_menu_id
                        if(empty($arr_front_menu))
                        {
                    ?>
                        <tr><td colspan="2">No Data Found</td></tr>
                    <?php
                        }
                        else
                        {
                            foreach($arr_front_menu as $front_menu)
                            {
                    ?>
                    <tr>
                        <td><?=$front_menu->menu_name?></td>
                        <td>
                            <img class="padd_right img_edit" src="<?=$RPath?>pics/site/edit.png" height="16" width="16" title="Edit" 
                            alt="Edit" id="edit_menu_id_<?=$front_menu->id?>_<?=$front_menu->menu_id?>"/>
                            <?php
                            // menu_id = 5 = EXCURSIONS
                            if($front_menu->default != 1 && $front_menu->menu_id != 5 ) 
                            {
                            ?>|
                            <img class="img_del padd_left padd_right" src="<?=$RPath?>pics/site/delete.png" height="16" width="16" title="Delete" 
                            alt="Delete" id="del_menu_id_<?=$front_menu->id?>_<?=$front_menu->menu_id?>"/>
                            <?php
                            }
                            ?>|
                            <img class="img_stat padd_left padd_right <?='status_'.$front_menu->status?>" height="16" width="16" title="Status" 
                            alt="" id="stat_img_id_<?=$front_menu->id?>"/>
                            <?php
                            // id = 5 = EXCURSIONS, id = 2 = ROOMS, id = 1 = HOME, menu_id = 19 = LOCAL ATTRACTIONS, menu_id = 20 = TOURIST POINT
                            if($front_menu->id== 1 || $front_menu->menu_id == 2 || $front_menu->menu_id == 5 || $front_menu->menu_id == 19 || $front_menu->menu_id == 20)
                            {
                            ?>|
                            <img class="img_gallery noimg_add padd_left padd_right" src="<?=$RPath?>pics/site/image_off.png" height="16" width="16" 
                            title="Gallery Images" alt="Gallery Images" id="image_gallery_id_<?=$front_menu->id?>"/>
                            <?php
                            }
                            ?>
                            <?php
                            // id = 2 = ROOMS, id = 5 = EXCURSIONS, menu_id = 5 = EXCURSIONS
                            if($front_menu->id == 5 || $front_menu->id == 2 || $front_menu->menu_id == 5) 
                            {
                            ?>|
                            <a href="<?=site_url('admin/pages/'.$front_menu->id)?>">
                                <img class="menu_add padd_left padd_right" src="<?=$RPath?>pics/site/submenu_on.png" height="16" width="16" title="Sub Menu" 
                                alt="Sub Menu"/>
                            </a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                            }	// end of foreach
                        }	// end of else
                    }	// outer if 
                    else
                    {
                    ?>
                        <tr><td colspan="2">No Data Found</td></tr>	
                    <?php	
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /operation tab -->
        
        <!-- content tab -->
        <div class="row-fluid <?php isset($frm_validation_err) && $frm_validation_err ? '' : print 'no_disp'?>" id="id_div_menu">
            <div class="div_border">
                    <?php
					$attributes = array('class' => 'form-horizontal', 'id' => 'frm_menu_page');
                    echo form_open(site_url("admin/pages/{$option_sel}"), $attributes);
					echo form_hidden('sel_front_menu_id', $sel_front_menu_id);
					echo form_hidden('edit_front_menu_id', $edit_front_menu_id);
					echo form_hidden('del_front_menu_id', $del_front_menu_id);
					?>
                        <div class="inner_head gradient_grey">
                          <div id="inner_head">Add Menu / Page</div>
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
                            <label class="control-label" for="txt_pg_title">Menu / Page Title</label>
                            <div class="controls">
                                <input id="txt_pg_title" name="txt_pg_title" type="text" class="input-xlarge" placeholder="Menu / Page Title" maxlength="50" value="<?=set_value('txt_pg_title');?>">
								<?=form_error('txt_pg_title','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="">Page Heading</label>
                            <div class="controls">
                                <input id="txt_pg_head" name="txt_pg_head" type="text" class="input-xlarge" placeholder="Page Heading" maxlength="50" value="<?=set_value('txt_pg_head');?>">
                            </div>
                        </div>
                        <div class="control-group no_disp">
                            <label class="control-label" for="">Latitude</label>
                            <div class="controls">
                                <input id="txt_lat" name="txt_lat" type="text" class="input-xlarge" placeholder="Latitude" maxlength="50" value="<?=set_value('txt_lat');?>">
                            </div>
                        </div>
                        <div class="control-group no_disp">
                            <label class="control-label" for="">Longitude</label>
                            <div class="controls">
                                <input id="txt_long" name="txt_long" type="text" class="input-xlarge" placeholder="Longitude" maxlength="50" value="<?=set_value('txt_long');?>">
                            </div>
                        </div>
                        <div class="control-group no_disp">
                            <label class="control-label" for="">Zoom Level</label>
                            <div class="controls">
                                <input id="txt_zoom" name="txt_zoom" type="text" class="input-xlarge" placeholder="Zoom Level" maxlength="2" value="<?=set_value('txt_zoom');?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="ckeditor">Page Content</label>
                            <div class="controls">
                                <textarea id="ckeditor" name="txt_pg_content" rows="10" class="input-xlarge" placeholder="Page Content">
									<?php $temp = set_value('txt_pg_content', null); ! empty($temp) ? print $temp : ''?>
                                </textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_pg_meta">Meta Keywords</label>
                            <div class="controls">
                                <textarea id="txt_pg_meta" name="txt_pg_meta_key" rows="3" class="input-xlarge" placeholder="Meta Keywords">
									<?php $temp = set_value('txt_pg_meta_key', null); ! empty($temp) ? print $temp : ''?>
                                </textarea>
                            </div>
                        </div>
                        <div class="control-group">  
                          <div class="controls">
                            <button class="btn btn-primary <?php if($option_sel != 'save') echo 'hide'?>" type="submit" name="save" value="save">Save</button>
                            <button class="btn btn-primary <?php if($option_sel != 'update') echo 'hide'?>" type="submit" name="update" value="update">Update</button>
                            <button class="btn btn-primary <?php if($option_sel != 'delete') echo 'hide'?>" type="submit" name="delete" value="delete">Delete</button>
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
<script src="<?=$RPath?>ckeditor/ckeditor.js"></script>

<script type="text/javascript">
CKEDITOR.replace( 'ckeditor', {
								toolbar : 'Basic',
								filebrowserBrowseUrl : '<?=$RPath?>ckeditor/browser/browser.html?Type=Image&Connector=<?=$RPath?>ckeditor/uploader/browse.php',
								filebrowserWindowWidth : '320',
        						filebrowserWindowHeight : '480'
								});
	
								
// Change status of image
function changeStatus(sel_img_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/pages/changeImageStatus')?>",
							type: "POST",
							data: {img_id : sel_img_id},
							dataType: "json"
						});
	request.done(function(msg) {
		if(msg.cur_stat == 'active')
		{
			$('#stat_img_id_'+sel_img_id).removeClass('status_inactive').addClass('status_active');
		}
		else
		{
			$('#stat_img_id_'+sel_img_id).removeClass('status_active').addClass('status_inactive');
		}
		$('#flash_popup').on('show', function () {
				$('.modal-header h3').html('Status Changed');
				$('.modal-body p').html('Status changed to '+msg.cur_stat+'.');
			});
		$('#flash_popup').modal('show');
	});
	request.fail(function(jqXHR, textStatus) {
		$('#flash_popup').on('show', function () {
				$('.modal-header h3').html('Request Failed');
				$('.modal-body p').html(textStatus);
			});
		$('#flash_popup').modal('show');
	});
}


// Retrieve Data for Editing
function fetchData(sel_menu_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/pages/fetch')?>",
							type: "POST",
							data: {menu_id : sel_menu_id},
							dataType: "json"
						});
	request.done(function(msg) {
		$('#txt_pg_title').val(msg.pg_title);
		$('#txt_pg_head').val(msg.pg_head);
		//$('#ckeditor').text(msg.pg_content);
		CKEDITOR.instances['ckeditor'].setData(msg.pg_content);
		$('#txt_pg_meta').val(msg.pg_meta);
		$('#txt_lat').val(msg.pg_latitude);
		$('#txt_long').val(msg.pg_longitude);
		$('#txt_zoom').val(msg.pg_zoom);
	});
	request.fail(function(jqXHR, textStatus) {
		$('#flash_popup').on('show', function () {
				$('.modal-header h3').html('Request Failed');
				$('.modal-body p').html(textStatus);
			});
		$('#flash_popup').modal('show');
	});
}


// Add Menu Button Clicked
$(':button[value="Add Page"]').click( function() {
	$('#frm_menu_page').attr('action',"<?=site_url('admin/pages/save')?>");
	$('.error').remove();
	// Sub Pages of TOURIST POINT  || LOCAL ATTRACTIONS
	<?=$sel_front_menu_id?> == 19 || <?=$sel_front_menu_id?> == 20 ? $('#txt_long, #txt_lat, #txt_zoom').parent().parent().removeClass('no_disp') : $('#txt_long, #txt_lat, #txt_zoom').parent().parent().addClass('no_disp');	
	$('#inner_head').text('Add Page / Menu');
	$(':button[value="update"]').hide();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').show();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_menu').fadeIn('slow');
		$(':button[value="Add Page"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Edit Option Clicked
$('.img_edit').click( function() {
	var sel_menu_id = $(this).attr('id').split('_')[3];
	var top_menu_id = $(this).attr('id').split('_')[4];
	fetchData(sel_menu_id);	// AJAX function to retrive data from page table
	$('input[name=edit_front_menu_id]').val(sel_menu_id);
	$('#frm_menu_page').attr('action',"<?=site_url('admin/pages/update')?>");
	$('.error').remove();
	// Page = EXCURSIONS, LOCATION
	sel_menu_id == 6 || top_menu_id == 19 || top_menu_id == 20 ? $('#txt_long, #txt_lat, #txt_zoom').parent().parent().removeClass('no_disp') : $('#txt_long, #txt_lat, #txt_zoom').parent().parent().addClass('no_disp');	
	$('#inner_head').text('Edit Page / Menu');
	$(':button[value="update"]').show();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_menu').fadeIn('slow');
		$(':button[value="Add Page"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Delete Option Clicked
$('.img_del').click( function() {
	var sel_menu_id = $(this).attr('id').split('_')[3];
	var top_menu_id = $(this).attr('id').split('_')[4];
	fetchData(sel_menu_id);	// AJAX function to retrive data from page table
	$('input[name=del_front_menu_id]').val(sel_menu_id);
	$('#frm_menu_page').attr('action',"<?=site_url('admin/pages/delete')?>");
	$('.error').remove();
	// Page = EXCURSIONS, LOCATION
	sel_menu_id == 6 || top_menu_id == 19 || top_menu_id == 20 ? $('#txt_long, #txt_lat, #txt_zoom').parent().parent().removeClass('no_disp') : $('#txt_long, #txt_lat, #txt_zoom').parent().parent().addClass('no_disp');	
	$('#inner_head').text('Delete Page / Menu');
	$(':button[value="update"]').hide();
	$(':button[value="delete"]').show();
	$(':button[value="save"]').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_menu').fadeIn('slow');
		$(':button[value="Add Page"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Cancel Button Clicked
$(':button[value="cancel"]').click( function() {
	$('#id_div_menu').fadeOut('slow', function() {
		$('#id_div_table').fadeIn('slow');
		$(':button[value="Add Page"]').fadeIn();
		$('.alert').hide();
		$(window).height() <= 480 ? $(document).scrollTop($('.heading').offset().top-5) : $(document).scrollTop(0);
	});
});


// Status image option clicked
$('.img_stat').click(function() {
	var sel_img_id = $(this).attr('id').split('_')[3];
	changeStatus(sel_img_id);	// AJAX function to retrive data from page table
});


// Image Gallery option Clicked
$('.img_gallery').click(function() {
	var sel_menu_id = $(this).attr('id').split('_')[3];
	window.location = '<?=site_url('admin/pages/imageGallery')?>/' + sel_menu_id;
});
</script>