<?php
$option_sel = $this->uri->segment(3); // check which operation performed (save/update)
?>
<!-- Main Inner Container -->
<div class="span9">
  <!--inner row1-->
  <div class="row-fluid">
      <div class="heading gradient_deepgrey">
        <h3>Rooms</h3>
      </div>
  </div>
  <!--/inner row1-->
  
  <!--inner row2-->
  <div class="row-fluid">
      <div class="container-fluid action_panel gradient_milkywhite">
        <div class="row-fluid">
          <div class="mid_main_head">
              <span>Category :
              	<font class="submenu">
                <?php ! empty($menu_bread_crumb) ? print $menu_bread_crumb : ''  ?>
                </font>
              </span>
              <span class="pull-right">
              	<input type="button" class="btn btn-inverse <?php if(isset($frm_validation_err) && $frm_validation_err) echo 'hide'?>" value="Add Category">
              </span>
          </div>
        </div>
        
        <!-- operation tab -->
        <div class="row-fluid padd_row <?php isset($frm_validation_err) && $frm_validation_err ? print 'no_disp' : ''?>" id="id_div_table">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>CATEGORY NAME</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(is_array($rooms_catg) && ! empty($rooms_catg))
                    {
                        foreach($rooms_catg as $catg)
                        {
                    ?>
                    <tr>
                        <td><?=$catg->name?></td>
                        <td>
                            <img class="padd_right img_edit" src="<?=$RPath?>pics/site/edit.png" height="16" width="16" title="Edit" 
                            alt="Edit" id="edit_menu_id_<?=$catg->id?>_<?=$catg->id?>"/>|
                            <img class="img_del padd_left padd_right" src="<?=$RPath?>pics/site/delete.png" height="16" width="16" title="Delete" 
                            alt="Delete" id="del_menu_id_<?=$catg->id?>_<?=$catg->id?>"/>|
                            <img class="img_stat padd_left padd_right <?='status_'.$catg->status?>" height="16" width="16" title="Status" 
                            alt="" id="stat_img_id_<?=$catg->id?>"/>|
                            <img class="img_gallery noimg_add padd_left padd_right" src="<?=$RPath?>pics/site/image_off.png" height="16" width="16" 
                            title="Gallery Images" alt="Gallery Images" id="image_gallery_id_<?=$catg->id?>"/>|
                            <a href="<?=site_url('admin/category/rooms/'.$catg->id)?>">
                                <img class="menu_add padd_left padd_right" src="<?=$RPath?>pics/site/submenu_on.png" height="16" width="16" title="Rooms" 
                                alt="Rooms"/>
                            </a>
                        </td>
                    </tr>
                    <?php
                            }	// end of foreach
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
                    echo form_open(site_url("admin/category/{$option_sel}"), $attributes);
					echo form_hidden('edit_front_menu_id', $edit_front_menu_id);
					echo form_hidden('del_front_menu_id', $del_front_menu_id);
					?>
                        <div class="inner_head gradient_grey">
                          <div id="inner_head">Add Category</div>
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
                            <label class="control-label" for="txt_pg_title">Category Name</label>
                            <div class="controls">
                                <input id="txt_catg_name" name="txt_catg_name" type="text" class="input-xlarge" placeholder="Category Name" maxlength="100" value="<?=set_value('txt_catg_name');?>">
								<?=form_error('txt_catg_name','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="ckeditor">Category Description</label>
                            <div class="controls">
                                <textarea id="ckeditor" name="txt_catg_desc" rows="10" class="input-xlarge" placeholder="Category Description">
									<?php $temp = set_value('txt_catg_desc', null); ! empty($temp) ? print $temp : ''?>
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
							url: "<?=site_url('admin/category/changeImageStatus')?>",
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
							url: "<?=site_url('admin/category/fetch')?>",
							type: "POST",
							data: {menu_id : sel_menu_id},
							dataType: "json"
						});
	request.done(function(msg) {
		$('#txt_catg_name').val(msg.rm_title);
		CKEDITOR.instances['ckeditor'].setData(msg.rm_desc);
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
$(':button[value="Add Category"]').click( function() {
	$('#frm_menu_page').attr('action',"<?=site_url('admin/category/save')?>");
	$('.error').remove();
	$('#inner_head').text('Add Category');
	$(':button[value="update"]').hide();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').show();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_menu').fadeIn('slow');
		$(':button[value="Add Category"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Edit Option Clicked
$('.img_edit').click( function() {
	var sel_menu_id = $(this).attr('id').split('_')[3];
	var top_menu_id = $(this).attr('id').split('_')[4];
	fetchData(sel_menu_id);	// AJAX function to retrive data from page table
	$('input[name=edit_front_menu_id]').val(sel_menu_id);
	$('#frm_menu_page').attr('action',"<?=site_url('admin/category/update')?>");
	$('.error').remove();
	// Page = EXCURSIONS, LOCATION
	sel_menu_id == 6 || top_menu_id == 5 ? $('#txt_long, #txt_lat, #txt_zoom').parent().parent().removeClass('no_disp') : $('#txt_long, #txt_lat, #txt_zoom').parent().parent().addClass('no_disp');	
	$('#inner_head').text('Edit Category');
	$(':button[value="update"]').show();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_menu').fadeIn('slow');
		$(':button[value="Add Category"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Delete Option Clicked
$('.img_del').click( function() {
	var sel_menu_id = $(this).attr('id').split('_')[3];
	var top_menu_id = $(this).attr('id').split('_')[4];
	fetchData(sel_menu_id);	// AJAX function to retrive data from page table
	$('input[name=del_front_menu_id]').val(sel_menu_id);
	$('#frm_menu_page').attr('action',"<?=site_url('admin/category/delete')?>");
	$('.error').remove();
	// Page = EXCURSIONS, LOCATION
	sel_menu_id == 6 || top_menu_id == 5 ? $('#txt_long, #txt_lat, #txt_zoom').parent().parent().removeClass('no_disp') : $('#txt_long, #txt_lat, #txt_zoom').parent().parent().addClass('no_disp');	
	$('#inner_head').text('Delete Category');
	$(':button[value="update"]').hide();
	$(':button[value="delete"]').show();
	$(':button[value="save"]').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_menu').fadeIn('slow');
		$(':button[value="Add Category"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Cancel Button Clicked
$(':button[value="cancel"]').click( function() {
	$('#id_div_menu').fadeOut('slow', function() {
		$('#id_div_table').fadeIn('slow');
		$(':button[value="Add Category"]').fadeIn();
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
	window.location = '<?=site_url('admin/category/imageGallery')?>/' + sel_menu_id;
});
</script>