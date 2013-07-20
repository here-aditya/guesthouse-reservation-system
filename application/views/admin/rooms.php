<?php
$option_sel = $this->uri->segment(3); // check which operation performed (save/update)
?>
<!-- Main Inner Container -->
<div class="span9">
  <!--inner row1-->
  <div class="row-fluid">
      <div class="heading gradient_deepgrey">
        <h3>Rooms & Rates</h3>
      </div>
  </div>
  <!--/inner row1-->
  
  <!--inner row2-->
  <div class="row-fluid">
      <div class="container-fluid action_panel gradient_milkywhite">
        <div class="row-fluid mid_main_head">
          	  <div class="span12">
                  <span>Category : <font class="submenu"><?=$rooms_catg_details[0]->name?></font></span>
                  <input type="button" class="btn btn-inverse <?php if(isset($frm_validation_err) && $frm_validation_err) echo 'hide'?> pull-right" value="Add Rooms">
              </div>
        </div>
        
        <!-- operation tab -->
        <div class="row-fluid padd_row <?php isset($frm_validation_err) && $frm_validation_err ? print 'no_disp' : ''?>" id="id_div_table">
            <div class="">
                <table class="table table-bordered table-striped table-hover tbl_rooms">
                    <thead>
                        <tr>
                            <th>ROOM NO</th>
                            <th>FLOOR</th>
                            <th>DONATION</th>
                            <th>DONATION (OFF)</th>
                            <th>MAINT.</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						if(empty($rooms_list))
						{
                        ?>
                            <tr><td colspan="6">No Data Found</td></tr>
                        <?php
                        }
						else
						{
							foreach($rooms_list as $rooms)
							{
                        ?>
                        <tr>
                            <td><?=$rooms->room_no?></td>
                            <td><?php $rooms->floor_no == 0 ? print 'Ground' : print show_ordinal($rooms->floor_no)?></td>
                            <td><?=$rooms->ses_donation?></td>
                            <td><?=$rooms->off_ses_donation?></td>
                            <td><?=$rooms->maintenance?></td>
                           	<td>
                                <img class="padd_right img_edit" src="<?=$RPath?>pics/site/edit.png" height="16" width="16" title="Edit" alt="Edit" id="edit_distributor_id_<?=$rooms->id?>"/>|
                                <img class="img_del padd_left padd_right" src="<?=$RPath?>pics/site/delete.png" height="16" width="16" title="Delete" alt="Delete" id="del_distributor_id_<?=$rooms->id?>"/>|
                                <img class="img_stat padd_left padd_right <?='status_'.$rooms->status?>" id="stat_distributor_id_<?=$rooms->id?>" height="16" width="16" title="Status" alt=""/>
                            </td>
                        </tr>
                        <?php
                            }	// end of foreach
                        }	// end of else
						?>
					</tbody>
                </table>
            </div>
        </div>
        <!-- /operation tab -->
        
        <!-- content tab -->
        <div class="row-fluid <?php isset($frm_validation_err) && $frm_validation_err ? '' : print 'no_disp'?>" id="id_div_rooms">
            <div class="div_border">
                    <?php
					$attributes = array('class' => 'form-horizontal', 'id' => 'frm_menu_page');
                    echo form_open(site_url("admin/category/{$option_sel}"), $attributes);
					echo form_hidden('sel_rooms_catg_id', $sel_rooms_catg_id);
					echo form_hidden('edit_rooms_id', $edit_rooms_id);
					echo form_hidden('del_rooms_id', $del_rooms_id);
					?>
                        <div class="inner_head gradient_grey">
                          <div id="inner_head">Add Rooms</div>
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
                            <label class="control-label" for="txt_room_no">Room No.</label>
                            <div class="controls">
                                <input id="txt_room_no" name="txt_room_no" type="text" class="input-small" placeholder="Room No." 
                                maxlength="3" value="<?=set_value('txt_room_no');?>">
								<?=form_error('txt_room_no','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="sel_floor_no">Floor</label>
                            <div class="controls">
                                <select class="input-small" name="sel_floor_no" id="sel_floor_no">
                                    <option value="0" <?=set_select('sel_floor_no', 0);?>>Ground</option>
                                    <?php
                                    for($i=1;$i<=10;$i++)
                                    {
                                    ?>
                                      <option value="<?=$i?>" <?=set_select('sel_floor_no', $i);?>><?=show_ordinal($i)?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?=form_error('sel_floor_no','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="sel_single_bed">Single Bed</label>
                            <div class="controls">
                                <select class="input-small" name="sel_single_bed" id="sel_single_bed">
                                	<option value="0" <?=set_select('sel_single_bed', 0);?>>0</option>
                                    <?php
                                    for($i=1;$i<=10;$i++)
                                    {
                                    ?>
                                      <option value="<?=$i?>" <?=set_select('sel_single_bed', $i);?>><?=$i?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?=form_error('sel_single_bed','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="sel_double_bed">Double Bed</label>
                            <div class="controls">
                                <select class="input-small" name="sel_double_bed" id="sel_double_bed">
                                	<option value="0" <?=set_select('sel_double_bed', 0);?>>0</option>
                                    <?php
                                    for($i=1;$i<=10;$i++)
                                    {
                                    ?>
                                      <option value="<?=$i?>" <?=set_select('sel_double_bed', $i);?>><?=$i?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?=form_error('sel_double_bed','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="sel_sofa_bed">Sofa cum Bed</label>
                            <div class="controls">
                                <select class="input-small" name="sel_sofa_bed" id="sel_sofa_bed">
                                	<option value="0" <?=set_select('sel_sofa_bed', 0);?>>0</option>
                                    <?php
                                    for($i=1;$i<=10;$i++)
                                    {
                                    ?>
                                      <option value="<?=$i?>" <?=set_select('sel_sofa_bed', $i);?>><?=$i?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?=form_error('sel_sofa_bed','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_donation">Sessional Donation</label>
                            <div class="controls">
                            	<div class="input-prepend">
                                    <span class="add-on">Rs.</span>
                                    <input id="txt_donation" name="txt_donation" type="text" class="input-small" placeholder="0" 
                                    maxlength="4" value="<?=set_value('txt_donation');?>">
                                </div>
								<?=form_error('txt_donation','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_donation_off">Off Session Donation</label>
                            <div class="controls">
                            	<div class="input-prepend">
                                    <span class="add-on">Rs.</span>
                                    <input id="txt_donation_off" name="txt_donation_off" type="text" class="input-small" placeholder="0" 
                                    maxlength="4" value="<?=set_value('txt_donation_off');?>">
                                </div>
								<?=form_error('txt_donation_off','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_maint">Maintenance</label>
                            <div class="controls">
                            	<div class="input-prepend">
                                    <span class="add-on">Rs.</span>
                                    <input id="txt_maint" name="txt_maint" type="text" class="input-small" placeholder="0" 
                                    maxlength="4" value="<?=set_value('txt_maint');?>">
                                </div>
								<?=form_error('txt_maint','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Room Description</label>
                            <div class="controls">
                                <textarea rows="8" class="input-xlarge" placeholder="Room Description" name="txt_desc" id="ckeditor"><?=set_value('txt_desc');?></textarea>
								<?=form_error('txt_desc','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">  
                          <div class="controls">
                            <button class="btn btn-primary <?php if($option_sel != 'saveRoom') echo 'hide'?>" type="submit" name="save" value="save">Save</button>
                            <button class="btn btn-primary <?php if($option_sel != 'updateRoom') echo 'hide'?>" type="submit" name="update" value="update">Update</button>
                            <button class="btn btn-primary <?php if($option_sel != 'deleteRoom') echo 'hide'?>" type="submit" name="delete" value="delete">Delete</button>
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

// Retrieve Data for Editing
function fetchData(sel_rooms_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/category/fetchRooms')?>",
							type: "POST",
							data: {room_id : sel_rooms_id},
							dataType: "json"
						});
	request.done(function(msg) {
		$('#txt_room_no').val(msg.room_no);
		$('#sel_floor_no').val(msg.floor_no);
		$('#txt_donation').val(msg.ses_donation);
		$('#txt_donation_off').val(msg.off_ses_donation);
		$('#txt_maint').val(msg.maintenance);
		$('#sel_single_bed').val(msg.single_bed);
		$('#sel_double_bed').val(msg.double_bed);
		$('#sel_sofa_bed').val(msg.sofa_cum_bed);
		CKEDITOR.instances['ckeditor'].setData(msg.description);
	});
	request.fail(function(jqXHR, textStatus) {
		$('#flash_popup').on('show', function () {
				$('.modal-header h3').html('Request Failed');
				$('.modal-body p').html(textStatus);
			});
		$('#flash_popup').modal('show');
	});
}


// Change status of rooms
function changeStatus(sel_rooms_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/category/changeRoomsStatus')?>",
							type: "POST",
							data: {rooms_id : sel_rooms_id},
							dataType: "json"
						});
	request.done(function(msg) {
		if(msg.cur_stat == 'active')
		{
			$('#stat_distributor_id_'+sel_rooms_id).removeClass('status_inactive').addClass('status_active');
		}
		else
		{
			$('#stat_distributor_id_'+sel_rooms_id).removeClass('status_active').addClass('status_inactive');
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


// Add Menu Button Clicked
$(':button[value="Add Rooms"]').click( function() {
	$('#frm_menu_page').attr('action',"<?=site_url('admin/category/saveRoom')?>");
	$('.error').remove();
	$('#inner_head').text('Add Rooms');
	$(':button[value="update"]').hide();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').show();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_rooms').fadeIn('slow');
		$(':button[value="Add Rooms"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Edit Option Clicked
$('.img_edit').click( function() {
	var sel_rooms_id = $(this).attr('id').split('_')[3];
	fetchData(sel_rooms_id);	// AJAX function to retrive data from page table
	$('input[name=edit_rooms_id]').val(sel_rooms_id);
	$('#frm_menu_page').attr('action',"<?=site_url('admin/category/updateRoom')?>");
	$('.error').remove();
	$('#inner_head').text('Edit Rooms');
	$(':button[value="update"]').show();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_rooms').fadeIn('slow');
		$(':button[value="Add Rooms"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Delete Option Clicked
$('.img_del').click( function() {
	var sel_rooms_id = $(this).attr('id').split('_')[3];
	fetchData(sel_rooms_id);	// AJAX function to retrive data from page table
	$('input[name=del_rooms_id]').val(sel_rooms_id);
	$('#frm_menu_page').attr('action',"<?=site_url('admin/category/deleteRoom')?>");
	$('.error').remove();
	$('#inner_head').text('Delete Rooms');
	$(':button[value="update"]').hide();
	$(':button[value="delete"]').show();
	$(':button[value="save"]').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_rooms').fadeIn('slow');
		$(':button[value="Add Rooms"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Cancel Button Clicked
$(':button[value="cancel"]').click( function() {
	$('#id_div_rooms').fadeOut('slow', function() {
		$('#id_div_table').fadeIn('slow');
		$(':button[value="Add Rooms"]').fadeIn();
		$('.alert').hide();
		$(window).height() <= 480 ? $(document).scrollTop($('.heading').offset().top-5) : $(document).scrollTop(0);
	});
});


// Status rooms option clicked
$('.img_stat').click(function() {
	var sel_rooms_id = $(this).attr('id').split('_')[3];
	changeStatus(sel_rooms_id);	// AJAX function to retrive data from page table
});
</script>