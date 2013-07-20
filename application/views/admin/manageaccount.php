<?php
$option_sel = $this->uri->segment(3); // check which operation performed (save/update)
?>
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
              <span>Manage Account :
              	<font class="submenu">
                <?php ! empty($menu_bread_crumb) ? print $menu_bread_crumb : ''  ?>
                </font>
              </span>
              <span class="pull-right">
              	<input type="button" class="btn btn-inverse <?php if(isset($frm_validation_err) && $frm_validation_err) echo 'hide'?>" value="Add Account">
              </span>
          </div>
        </div>
        
        <!-- operation tab -->
        <div class="row-fluid padd_row <?php isset($frm_validation_err) && $frm_validation_err ? print 'no_disp' : ''?>" id="id_div_table">
            <table class="table table-bordered table-striped table-hover tbl_account">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>TYPE</th>
                        <th>EMAIL</th>
                        <th>LAST LOGIN</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(empty($account_list))
                    {
                    ?>
                        <tr><td colspan="5">No Data Found</td></tr>
                    <?php
                    }
                    else
                    {
                        foreach($account_list as $account)
                        {
                            if($this->session->userdata['usr_type'] == 'admin')
                    ?>
                    <tr>
                        <td><?=$account->name?></td>
                        <td>
                        <?php
                        switch($account->type)
                        {
                            case 'su': print 'Super User'; break;
                            case 'admin': print 'Administrator'; break;
                        }
                        ?>
                        </td>
                        <td><?=$account->email?></td>
                        <td><?=$account->last_log_time?></td>
                        <td>
                            
                            <img class="padd_right img_edit" src="<?=$RPath?>pics/site/edit.png" height="16" width="16" title="Edit" alt="Edit" id="edit_distributor_id_<?=$account->id?>"/>
                            <?php if($this->session->userdata['usr_type'] == 'su') {?>|
                            <img class="img_del padd_left padd_right" src="<?=$RPath?>pics/site/delete.png" height="16" width="16" title="Delete" alt="Delete" id="del_distributor_id_<?=$account->id?>"/>|
                            <img class="img_stat padd_left padd_right <?='status_'.$account->status?>" id="stat_distributor_id_<?=$account->id?>" height="16" width="16" title="Status" alt=""/>
                             <?php }?>
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
        <div class="row-fluid <?php isset($frm_validation_err) && $frm_validation_err ? '' : print 'no_disp'?>" id="id_div_account">
            <div class="div_border">
                    <?php
					$attributes = array('class' => 'form-horizontal', 'id' => 'frm_account_page');
                    echo form_open(site_url("admin/manageaccount/{$option_sel}"), $attributes);
					echo form_hidden('edit_account_id', $edit_account_id);
					echo form_hidden('del_account_id', $del_account_id);
					?>
                        <div class="inner_head gradient_grey">
                          <div id="inner_head">Add Account</div>
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
                            <label class="control-label" for="txt_name">Administrator Name</label>
                            <div class="controls">
                                <input id="txt_name" name="txt_name" type="text" class="input-xlarge" placeholder="Administrator Name" maxlength="50" value="<?=set_value('txt_name');?>">
                                <?=form_error('txt_name','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_email">Email</label>
                            <div class="controls">
                                <input id="txt_email" name="txt_email" type="text" class="input-xlarge" placeholder="Email" maxlength="50" value="<?=set_value('txt_email');?>">
								<?=form_error('txt_email','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_pswd">Password</label>
                            <div class="controls">
                                <input id="txt_pswd" name="txt_pswd" type="password" class="input-xlarge" placeholder="Password" maxlength="12">
								<?=form_error('txt_pswd','<div class="error">*','</div>'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_conf_pswd">Confirm Password</label>
                            <div class="controls">
                                <input id="txt_conf_pswd" name="txt_conf_pswd" type="password" class="input-xlarge" placeholder="Password" maxlength="12">
								<?=form_error('txt_conf_pswd','<div class="error">*','</div>'); ?>
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
// Retrieve Data for Editing
function fetchData(sel_account_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/manageaccount/fetch')?>",
							type: "POST",
							data: {account_id : sel_account_id},
							dataType: "json"
						});
	request.done(function(msg) {
		$('#txt_name').val(msg.name);
		$('#txt_email').val(msg.email);
		$('#txt_pswd').val(msg.pswd);
	});
	request.fail(function(jqXHR, textStatus) {
		$('#flash_popup').on('show', function () {
				$('.modal-header h3').html('Request Failed');
				$('.modal-body p').html(textStatus);
			});
		$('#flash_popup').modal('show');
	});
}


// Change status of image
function changeStatus(sel_account_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/manageaccount/changeStatus')?>",
							type: "POST",
							data: {account_id : sel_account_id},
							dataType: "json"
						});
	request.done(function(msg) {
		if(msg.cur_stat == 'active')
		{
			$('#stat_distributor_id_'+sel_account_id).removeClass('status_inactive').addClass('status_active');
		}
		else
		{
			$('#stat_distributor_id_'+sel_account_id).removeClass('status_active').addClass('status_inactive');
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
$(':button[value="Add Account"]').click( function() {
	$('#frm_account_page').attr('action',"<?=site_url('admin/manageaccount/save')?>");
	$('.error').remove();
	$('#inner_head').text('Add Account');
	$(':button[value="update"]').hide();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').show();
	$('form input').each(function(){
		$(this).val('');
	});
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_account').fadeIn('slow');
		$(':button[value="Add Account"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Edit Option Clicked
$('.img_edit').click( function() {
	var sel_account_id = $(this).attr('id').split('_')[3];
	fetchData(sel_account_id);	// AJAX function to retrive data from page table
	$('input[name=edit_account_id]').val(sel_account_id);
	$('#frm_account_page').attr('action',"<?=site_url('admin/manageaccount/update')?>");
	$('.error').remove();
	$('#inner_head').text('Edit Account');
	$(':button[value="update"]').show();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_account').fadeIn('slow');
		$(':button[value="Add Account"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Delete Option Clicked
$('.img_del').click( function() {
	var sel_account_id = $(this).attr('id').split('_')[3];
	fetchData(sel_account_id);	// AJAX function to retrive data from page table
	$('input[name=del_account_id]').val(sel_account_id);
	$('#frm_account_page').attr('action',"<?=site_url('admin/manageaccount/delete')?>");
	$('.error').remove();
	$('#inner_head').text('Delete Account');
	$(':button[value="update"]').hide();
	$(':button[value="delete"]').show();
	$(':button[value="save"]').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_div_account').fadeIn('slow');
		$(':button[value="Add Account"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Cancel Button Clicked
$(':button[value="cancel"]').click( function() {
	$('#id_div_account').fadeOut('slow', function() {
		$('#id_div_table').fadeIn('slow');
		$(':button[value="Add Account"]').fadeIn();
		$('.alert').hide();
		$(window).height() <= 480 ? $(document).scrollTop($('.heading').offset().top-5) : $(document).scrollTop(0);
	});
});


// Status image option clicked
$('.img_stat').click(function() {
	var sel_account_id = $(this).attr('id').split('_')[3];
	changeStatus(sel_account_id);	// AJAX function to retrive data from page table
});
</script>