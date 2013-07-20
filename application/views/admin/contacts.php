<?php
$option_sel = $this->uri->segment(3); // check which operation performed (save/update)
?>
<!-- Main Inner Container -->
<div class="span9">
  <!--inner row1-->
  <div class="row-fluid">
      <div class="heading gradient_deepgrey">
        <h3>Reservation</h3>
      </div>
  </div>
  <!--/inner row1-->
  
  <!--inner row2-->
  <div class="row-fluid">
      <div class="container-fluid action_panel gradient_milkywhite">
        <div class="row-fluid">
          <div class="mid_main_head">
              <span>Contacts :
              	<font class="submenu">
                <?php ! empty($menu_bread_crumb) ? print $menu_bread_crumb : ''  ?>
                </font>
              </span>
              <span class="pull-right">
              	<input type="button" class="btn btn-inverse <?php if(isset($frm_validation_err) && $frm_validation_err) echo 'hide'?>" value="Add Contact">
              </span>
          </div>
        </div>
        
        <!-- operation tab -->
        <div class="row-fluid padd_row <?php isset($frm_validation_err) && $frm_validation_err ? print 'no_disp' : ''?>" id="id_div_table">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>LOCATION</th>
                        <th>CONTACT NAME</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(empty($contact_list))
                    {
                    ?>
                        <tr><td colspan="3">No Data Found</td></tr>
                    <?php
                    }
                    else
                    {
                        foreach($contact_list as $contact)
                        {
                    ?>
                    <tr>
                        <td><?=$contact->city?></td>
                        <td><?=$contact->name?></td>
                        <td>
                            <img class="padd_right img_edit" src="<?=$RPath?>pics/site/edit.png" height="16" width="16" title="Edit" alt="Edit" id="edit_distributor_id_<?=$contact->id?>"/>|
                            <img class="img_del padd_left padd_right" src="<?=$RPath?>pics/site/delete.png" height="16" width="16" title="Delete" alt="Delete" id="del_distributor_id_<?=$contact->id?>"/>|
                            <img class="img_stat padd_left padd_right <?='status_'.$contact->status?>" id="stat_distributor_id_<?=$contact->id?>" height="16" width="16" title="Status" alt=""/>
                        </td>
                    </tr>
                    <?php
                        }	// end of foreach
                    }	// end of else
                    ?>
                </tbody>
            </table>
		</div>
        <!-- /operation tab -->
        
        <!-- content tab -->
        <div class="row-fluid <?php isset($frm_validation_err) && $frm_validation_err ? '' : print 'no_disp'?>" id="id_div_contact">
            <div class="div_border">
                    <?php
					$attributes = array('class' => 'form-horizontal', 'id' => 'frm_menu_page');
                    echo form_open(site_url("admin/contacts/{$option_sel}"), $attributes);
					echo form_hidden('edit_contact_id', $edit_contact_id);
					echo form_hidden('del_contact_id', $del_contact_id);
					?>
                        <div class="inner_head gradient_grey">
                          <div id="inner_head">Add Contact</div>
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
                            <label class="control-label">State</label>
                            <div class="controls">
                                <select class="input-xlarge" name="sel_state" id="sel_state">
                                    <option value=""></option>
                                    <?php
                                    $state_selected = null;
                                    foreach($state_list as $state)
                                    {
                                    ?>
                                      <option value="<?=$state['id']?>" <?=set_select('sel_state', $state['id']);?>><?=$state['name']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?=form_error('sel_state','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">City</label>
                            <div class="controls">
                                <select class="input-xlarge" name="sel_city" id="sel_city">
                                  <option value=""></option>
                                  <?php
                                  if(isset($city_list) && ! empty($city_list))
                                  {
                                    foreach($city_list as $city)
                                    {
                                  ?>
                                    <option value="<?=$city['id']?>" <?=set_select('sel_city', $city['id']);?>><?=$city['name']?></option>
                                  <?php
                                    }
                                  }
                                  ?>
                                </select>
                                <?php isset($city_list) && ! empty($city_list) ? print form_error('sel_city','<div class="error">*','</div>') : '';?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_name">Contact Person</label>
                            <div class="controls">
                                <input id="txt_name" name="txt_name" type="text" class="input-xlarge" placeholder="Contact Person" 
                                maxlength="50" value="<?=set_value('txt_name');?>">
								<?=form_error('txt_name','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Address</label>
                            <div class="controls">
                                <textarea rows="3" class="input-xlarge" placeholder="Address" name="txt_address" id="txt_address"><?=set_value('txt_address');?></textarea>
                                 <?=form_error('txt_address','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="">Phone</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-signal"></i></span>
                                    <input type="text" maxlength="50" placeholder="Phone" class="input-xlarge" name="txt_phone" id="txt_phone" value="<?=set_value('txt_phone');?>">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="">Mobile</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-signal"></i></span>
                                    <input type="text" maxlength="50" placeholder="Mobile" class="input-xlarge" name="txt_mobile" id="txt_mobile" value="<?=set_value('txt_mobile');?>">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="">Fax</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-print"></i></span>
                                    <input type="text" maxlength="50" placeholder="Fax" class="input-xlarge" name="txt_fax" id="txt_fax" value="<?=set_value('txt_fax');?>">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="">Email</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-envelope"></i></span>
                                    <input type="text" maxlength="50" placeholder="Email" class="input-xlarge" name="txt_email" id="txt_email" value="<?=set_value('txt_email');?>">
                                </div>
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
<script type="text/javascript">
// Change state AJAX call to get city list
function getCityList(state_id, city_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/contacts/getCityList')?>",
							type: "POST",
							data: {state_id : state_id},
							dataType: "json"
						});
	request.done(function(msg) {
		if(msg.length>0)
		{
			$("#sel_city").append('<option value=""></option>');
		}
		for(var i=0;i<msg.length;i++)
		{
			$("#sel_city").append('<option value="'+msg[i].id+'">'+msg[i].name+'</option>');
		}
		if(i==msg.length)
		{
			$('#sel_city').val(city_id);
		}
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
function fetchData(sel_contact_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/contacts/fetch')?>",
							type: "POST",
							data: {career_id : sel_contact_id},
							dataType: "json"
						});
	request.done(function(msg) {
		$('#sel_type').val(msg.type);
		$('#txt_name').val(msg.name);
		$('#txt_address').text(msg.address);
		$('#txt_phone').val(msg.phone);
		$('#txt_fax').val(msg.fax);
		$('#txt_mobile').val(msg.mobile);
		$('#txt_email').val(msg.email);
		$('#sel_state').val(msg.state_id);
		$('#sel_city').find('option').remove();
		getCityList(msg.state_id, msg.city_id);
	});
	request.fail(function(jqXHR, textStatus) {
		$('#flash_popup').on('show', function () {
				$('.modal-header h3').html('Request Failed');
				$('.modal-body p').html(textStatus);
			});
		$('#flash_popup').modal('show');
	});
}


// Change status of contact
function changeStatus(sel_contact_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/contacts/changeStatus')?>",
							type: "POST",
							data: {contact_id : sel_contact_id},
							dataType: "json"
						});
	request.done(function(msg) {
		if(msg.cur_stat == 'active')
		{
			$('#stat_distributor_id_'+sel_contact_id).removeClass('status_inactive').addClass('status_active');
		}
		else
		{
			$('#stat_distributor_id_'+sel_contact_id).removeClass('status_active').addClass('status_inactive');
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
$(':button[value="Add Contact"]').click( function() {
	$('#frm_menu_page').attr('action',"<?=site_url('admin/contacts/save')?>");
	$('.error').remove();
	$('#inner_head').text('Add Contact');
	$(':button[value="update"]').hide();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').show();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_contact').fadeIn('slow');
		$(':button[value="Add Contact"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Edit Option Clicked
$('.img_edit').click( function() {
	var sel_contact_id = $(this).attr('id').split('_')[3];
	fetchData(sel_contact_id);	// AJAX function to retrive data from page table
	$('input[name=edit_contact_id]').val(sel_contact_id);
	$('#frm_menu_page').attr('action',"<?=site_url('admin/contacts/update')?>");
	$('.error').remove();
	$('#inner_head').text('Edit Contact');
	$(':button[value="update"]').show();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_contact').fadeIn('slow');
		$(':button[value="Add Contact"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Delete Option Clicked
$('.img_del').click( function() {
	var sel_contact_id = $(this).attr('id').split('_')[3];
	fetchData(sel_contact_id);	// AJAX function to retrive data from page table
	$('input[name=del_contact_id]').val(sel_contact_id);
	$('#frm_menu_page').attr('action',"<?=site_url('admin/contacts/delete')?>");
	$('.error').remove();
	$('#inner_head').text('Delete Contact');
	$(':button[value="update"]').hide();
	$(':button[value="delete"]').show();
	$(':button[value="save"]').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_contact').fadeIn('slow');
		$(':button[value="Add Contact"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Cancel Button Clicked
$(':button[value="cancel"]').click( function() {
	$('#id_div_contact').fadeOut('slow', function() {
		$('#id_div_table').fadeIn('slow');
		$(':button[value="Add Contact"]').fadeIn();
		$('.alert').hide();
		$(window).height() <= 480 ? $(document).scrollTop($('.heading').offset().top-5) : $(document).scrollTop(0);
	});
});


// Status contact option clicked
$('.img_stat').click(function() {
	var sel_contact_id = $(this).attr('id').split('_')[3];
	changeStatus(sel_contact_id);	// AJAX function to retrive data from page table
});


// Change state name
$('#sel_state').change(function() {
	var state_id = $(this).val();
	$('#sel_city').find('option').remove();
	state_id != '' ? getCityList(state_id, null) : '';
});
</script>