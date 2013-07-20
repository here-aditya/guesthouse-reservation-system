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
              <span>Cancellation :</span>
          </div>
        </div>
        
        <!-- operation tab -->
        <div class="row-fluid padd_row <?php isset($frm_validation_err) && $frm_validation_err ? print 'no_disp' : ''?>" id="id_div_table">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>REQUESTED BY</th>
                        <th>BOOKING ID</th>
                        <th>ROOM NO(s).</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(empty($canc_list))
                    {
                    ?>
                        <tr><td colspan="5">No Data Found</td></tr>
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
                        	<img class="img_edit" src="<?=$RPath?>pics/site/edit.png" height="16" width="16" title="Details" alt="Details" id="edit_distributor_id_<?=$canc_list->id?>"/>
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
</script>