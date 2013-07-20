<?php
$option_sel = $this->uri->segment(3); // check which operation performed (save/update)
$called_controller =  $this->router->class; // change image gallery form submit depending on called controller
?>
<!-- Main Inner Container -->
<div class="span9">
	<!--inner row1-->
    <div class="row-fluid">
        <div class="span12">
            <div class="heading gradient_deepgrey">
              <h3>Manage <?=ucfirst($called_controller)?></h3>
            </div>
        </div>
    </div>
    <!--/inner row1-->
    
    <!--inner row2-->
    <div class="row-fluid">
        <div class="container-fluid action_panel gradient_milkywhite">
            <div class="row-fluid mid_main_head">
                <div class="span12">
                    <span>Gallery Images : <font class="submenu"><?php ! empty($menu_bread_crumb) ? print $menu_bread_crumb : ''  ?></font></span>
                    <input type="button" class="btn btn-inverse pull-right <?php if(isset($frm_validation_err) && $frm_validation_err) echo 'hide'?>" value="Add Image" id="id_btn_addimg">
                </div>
            </div>
            
            <!-- operation tab -->
            <div class="row-fluid padd_row <?php isset($frm_validation_err) && $frm_validation_err ? print 'no_disp' : ''?>" id="id_div_table">
                <table class="table table-bordered table-striped tbl_image">
                    <thead>
                        <tr>
                            <th>TITLE</th>
                            <th>IMAGE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if( ! empty($gallery_images))
                        {
                            foreach($gallery_images as $images)
                            {
                        ?>
                        <tr>
                            <td><?=$images->title_tag?></td>
                            <td>
                                <?php
                                if(! empty($images->image_name))
                                {
                                    $img_name = explode('.', $images->image_name);
                                    $thumb_name = $RPath.'pics/image_gallery/'.$img_name[0].'_thumb'.'.'.$img_name[1];
                                ?>
                                <img src="<?=$thumb_name?>" alt="<?=$images->alt_tag?>" data-src="<?=$RPath?>js/holder.js/128x128" 
                                class="img-rounded thumbnail" />
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <img class="padd_right img_edit" src="<?=$RPath?>pics/site/edit.png" height="16" width="16" title="Edit" alt="Edit" id="edit_img_id_<?=$images->id?>"/>|
                                <img class="img_del padd_left padd_right" src="<?=$RPath?>pics/site/delete.png" height="16" width="16" title="Delete" alt="Delete" id="del_img_id_<?=$images->id?>"/>|
                                <img class="img_stat padd_left padd_right <?='status_'.$images->status?>" id="stat_img_id_<?=$images->id?>" height="16" width="16" title="Status" alt=""/>
                            </td>
                        </tr>
                        <?php
                            }	// end of foreach
                        }	// end of if
                        else
                        {
                        ?>
                            <tr><td colspan="3">No Data Found</td></tr>	
                        <?php	
                        }
                        ?>
                    </tbody>
                </table>
                <div class="pagination pagination-small">
                    <ul>
                        <li><a href="#">&laquo;</a></li>
                        <li class="disabled"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
            <!-- /operation tab -->
            
            <!-- image tab1 -->
            <div class="row-fluid <?php isset($frm_validation_err) && $frm_validation_err ? '' : print 'no_disp'?>" id="id_addimg_div">
                <div class="div_border">
                    <ul class="nav nav-tabs" id="id_addimg_tab">
                        <li class="<?php isset($tab_sel) && $tab_sel == 'multi' ? '' : print 'active';?>">
                        	<a href="#single_up">Single Upload</a>
                        </li>
                        <li class="<?php isset($tab_sel) && $tab_sel == 'multi' ? print 'active' : '';?>">
                        	<a href="#bulk_up">Multiple Upload</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane <?php isset($tab_sel) && $tab_sel == 'multi' ? '' : print 'active';?>" id="single_up">
                        	<?php
							$attributes = array('class' => 'form-horizontal', 'id' => 'frm_menu_image');
                   		 	echo form_open_multipart(site_url("admin/{$called_controller}/{$option_sel}"), $attributes);
							echo form_hidden('sel_gallery_menu_id', $sel_gallery_menu_id);
							echo form_hidden('edit_image_id', $edit_image_id);
							echo form_hidden('del_image_id', $del_image_id);
							?>
							<?php
                            if( ! empty($ErrMsg) && ! isset($tab_sel)) 
                            {
                            ?>
                                <div class="alert alert-error alert-block">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <?=$ErrMsg?>
                                </div>
                            <?php
                            }
                            ?>
                                <div class="control-group" id="sel_img">
                                    <label class="control-label">Select Image</label>
                                    <div class="controls">
                                        <input type="file" class="input-xlarge" id="txt_img_sel" name="txt_img_sel" value="<?=set_value('txt_img_sel');?>">
                                        <p class="muted">Supported Type- .jpg/.jpeg/.gif/.png, Max Size - 2MB</p>
                                        <?=form_error('txt_img_sel','<div class="error">*','</div>'); ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="thumbnail span4 img_container">
                                            <img id="img_prev" src="" alt="" data-src="<?=$RPath?>js/holder.js/260x180" class="img-rounded">
                                            <div class="caption">
                                            	<p>Image Preview</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Image Title</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" placeholder="Image Title" maxlength="50" id="txt_img_title" name="txt_img_title" value="<?=set_value('txt_img_title');?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Image Alt</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" placeholder="Image Alt" maxlength="50" id="txt_img_alt" name="txt_img_alt" alue="<?=set_value('txt_img_alt');?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button class="btn btn-primary <?php if($option_sel != 'saveImage' && $option_sel != 'saveMultiImage') echo 'hide'?>" type="submit" name="save" value="save">Save</button>
                                        <button class="btn btn-primary <?php if($option_sel != 'updateImage') echo 'hide'?>" type="submit" name="update" value="update">Update</button>
                                        <button class="btn btn-primary <?php if($option_sel != 'deleteImage') echo 'hide'?>" type="submit" name="delete" value="delete">Delete</button>
                                        <button class="btn" type="reset" name="cancel" value="cancel">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane <?php isset($tab_sel) && $tab_sel == 'multi' ? print 'active' : '';?>" id="bulk_up">
							<?php
                            $attributes = array('class' => 'form-horizontal', 'id' => 'id_form_images');
                            echo form_open_multipart(site_url("admin/{$called_controller}/saveMultiImage"), $attributes);
							echo form_hidden('sel_gallery_menu_id', $sel_gallery_menu_id);
                            ?>
                            <?php
                            if( ! empty($ErrMsg) && isset($tab_sel)) 
                            {
                            ?>
                                <div class="alert alert-error alert-block">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <?=$ErrMsg?>
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if( isset($SuccMsg) && ! empty($SuccMsg)) 
                            {
                            ?>
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <?=$SuccMsg?>
                                </div>
                            <?php
                            }
                            ?>
                                <div class="control-group">
                                    <label class="padd_right">
                                        Select Images
                                        <input type="button" class="btn" value="+" id="id_btn_moreimg" title="Add More">
                                    </label>
                                </div>
                                <div class="control-group" id="div_img_container">
                                        <div class="row-fluid">
                                            <input type="file" name="multi_img_sel[]">
                                        </div>
                                        <div class="row-fluid">
                                            <input type="file" name="multi_img_sel[]">
                                        </div>
                                        <div class="row-fluid">
                                            <input type="file" name="multi_img_sel[]">
                                        </div>
                                        <div class="row-fluid">
                                            <input type="file" name="multi_img_sel[]">
                                        </div>
                                        <div class="row-fluid">
                                            <input type="file" name="multi_img_sel[]">
                                        </div> 
                                </div>
                                <div class="row-fluid">
                                    <div class="span8">
                                        <button class="btn btn-primary" type="submit" name="multi_save" value="multi_save">Save</button>
                                        <button class="btn" type="reset" name="multi_cancel" value="multi_cancel">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div><!--/tab pane-->
                    </div><!--/tab content-->
                </div><!-- inner span-->
            </div>
            <!-- /image tab1 -->
            
		</div>
    </div>
    <!--/inner row2-->
</div>
<!-- /Main Inner Container -->


<!-- Internal Page JS -->
<script>
// Change status of image
function changeStatus(sel_img_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/'.$called_controller.'/changeImageStatus')?>",
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


// Show image immediately on file selection
function imageHandler(e2) 
{ 
  $('#img_prev').attr('src',e2.target.result);
}


function loadimage(e1)
{
  var filename = e1.target.files[0]; 
  var fr = new FileReader();
  fr.onload = imageHandler;  
  fr.readAsDataURL(filename); 
}


$(document).ready(function(){
	var x = document.getElementById("txt_img_sel");
	x.addEventListener('change', loadimage, false);
});


// Add Image button clicked
$(':button[value="Add Image"]').click(function(){
	$('#frm_menu_image').attr('action',"<?=site_url('admin/'.$called_controller.'/saveImage')?>");
	$(':button[value="update"]').hide();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').show();
	$('#img_prev').attr('src', '');
	$('a[href="#bulk_up"]').show();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_addimg_div').fadeIn('slow');
		$(':button[value="Add Image"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Edit image option clicked
$('.img_edit').click(function() {
	var sel_img_id = $(this).attr('id').split('_')[3];
	fetchData(sel_img_id);	// AJAX function to retrive data from page table
	$('input[name=edit_image_id]').val(sel_img_id);
	$('#frm_menu_image').attr('action',"<?=site_url('admin/'.$called_controller.'/updateImage')?>");
	$(':button[value="update"]').show();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').hide();
	$('a[href="#bulk_up"]').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_addimg_div').fadeIn('slow');
		$(':button[value="Add Image"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Delete image option clicked
$('.img_del').click(function() {
	$('#frm_menu_image').attr('action',"<?=site_url('admin/'.$called_controller.'/deleteImage')?>");
	var sel_img_id = $(this).attr('id').split('_')[3];
	fetchData(sel_img_id);	// AJAX function to retrive data from page table
	$('input[name=del_image_id]').val(sel_img_id);
	$(':button[value="delete"]').show();
	$(':button[value="update"]').hide();
	$(':button[value="save"]').hide();
	$('a[href="#bulk_up"]').hide();
	$('#sel_img').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_addimg_div').fadeIn('slow');
		$(':button[value="Add Image"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Status image option clicked
$('.img_stat').click(function() {
	var sel_img_id = $(this).attr('id').split('_')[3];
	changeStatus(sel_img_id);	// AJAX function to retrive data from page table
});


// Cancel button clicked 
$(':button[value="cancel"], :button[value="multi_cancel"]').click(function(){
	$('.error').remove();
	$('#img_prev').attr('src','');
	$('#sel_img').show();
	$('#id_addimg_div').fadeOut('slow', function() {
		$('#id_div_table').fadeIn('slow');
		$(':button[value="Add Image"]').fadeIn();
		$('.alert').hide();
		$(window).height() <= 480 ? $(document).scrollTop($('.heading').offset().top-5) : $(document).scrollTop(0);
	});
});


// Toggle tab on tab click
$('#id_addimg_tab a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})


// add more image button
$('#id_btn_moreimg').click(function() {
	$('#div_img_container').append('<div class="row-fluid"><input type="file" name="multi_img_sel[]"></div>');
});


// Retrieve Data for Editing
function fetchData(sel_img_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/'.$called_controller.'/fetchImage')?>",
							type: "POST",
							data: {img_id : sel_img_id},
							dataType: "json"
						});
	request.done(function(msg) {
		$('#img_prev').attr('src', msg.img_name);
		$('#txt_img_title').val(msg.img_title);
		$('#txt_img_alt').val(msg.img_alt);
	});
	request.fail(function(jqXHR, textStatus) {
		$('#flash_popup').on('show', function () {
				$('.modal-header h3').html('Request Failed');
				$('.modal-body p').html(textStatus);
			});
		$('#flash_popup').modal('show');
	});
}
</script>