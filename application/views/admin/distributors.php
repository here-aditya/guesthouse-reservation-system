<?php
$option_sel = $this->uri->segment(3); // check which operation performed (save/update)
?>
<!-- Main Inner Container -->
<div class="span9">
	<!--inner row1-->
    <div class="row-fluid">
        <div class="span12">
            <div class="heading gradient_deepgrey">
              <h3>Distributor</h3>
            </div>
        </div>
    </div>
    <!--/inner row1-->
    
    <!--inner row2-->
    <div class="row-fluid">
        <div class="container-fluid action_panel gradient_milkywhite">
            <div class="row-fluid mid_main_head">
                <div class="span12">
                    <span>Distributors : </span>
                    <input type="button" class="btn btn-inverse pull-right <?php if(isset($frm_validation_err) && $frm_validation_err) echo 'hide'?>" value="Add Distributor" id="id_btn_addimg">
                </div>
            </div>
            
            <!-- operation tab -->
            <div class="row-fluid padd_row <?php isset($frm_validation_err) && $frm_validation_err ? print 'no_disp' : ''?>" id="id_div_table">
            	<div class="div_border">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>DISTRIBUTOR</th>
                                <th>LOCATION</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if( ! empty($distributors_list))
                            {
                                foreach($distributors_list as $distributor)
                                {
                            ?>
                            <tr>
                                <td><?=$distributor->name?></td>
                                <td><?=$distributor->state.' - '.$distributor->city?></td>
                                <td>
                                    <img class="padd_right img_edit" src="<?=$RPath?>pics/site/edit.png" height="16" width="16" title="Edit" alt="Edit" id="edit_distributor_id_<?=$distributor->id?>"/>|
                                    <img class="img_del padd_left padd_right" src="<?=$RPath?>pics/site/delete.png" height="16" width="16" title="Delete" alt="Delete" id="del_distributor_id_<?=$distributor->id?>"/>|
                                    <img class="img_stat padd_left padd_right <?='status_'.$distributor->status?>" id="stat_distributor_id_<?=$distributor->id?>" height="16" width="16" title="Status" alt=""/>
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
            </div>
            <!-- /operation tab -->
            
            <!-- image tab1 -->
            <div class="row-fluid <?php isset($frm_validation_err) && $frm_validation_err ? '' : print 'no_disp'?>" id="id_adddistributor_div">
                <div class="div_border">
                    <ul class="nav nav-tabs" id="id_addcareer_tab">
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
							$attributes = array('class' => 'form-horizontal', 'id' => 'frm_career_single');
                   		 	echo form_open_multipart(site_url("admin/distributors/{$option_sel}"), $attributes);
							echo form_hidden('edit_distributor_id', $edit_distributor_id);
							echo form_hidden('del_distributor_id', $del_distributor_id);
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
                                <label class="control-label">Distributor Name</label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge" id="txt_distributor" name="txt_distributor" value="<?=set_value('txt_distributor');?>" placeholder="Distributor Name" maxlength="50">
                                    <?=form_error('txt_distributor','<div class="error">*','</div>'); ?>
                                </div>
                            </div>
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
                                <label class="control-label">Contact Detais</label>
                                <div class="controls">
                                    <textarea rows="3" class="input-xlarge" placeholder="Contact Detais" name="txt_contact" id="txt_contact"><?=set_value('txt_contact');?></textarea>
									<?=form_error('txt_contact','<div class="error">*','</div>'); ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address</label>
                                <div class="controls">
                                    <textarea rows="8" class="input-xlarge" placeholder="Address" name="txt_address" id="txt_address"><?=set_value('txt_address');?></textarea>
                                     <?=form_error('txt_address','<div class="error">*','</div>'); ?>
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
                        </div>
                        <div class="tab-pane <?php isset($tab_sel) && $tab_sel == 'multi' ? print 'active' : '';?>" id="bulk_up">
							<?php
                            $attributes = array('class' => 'form-horizontal');
                            echo form_open_multipart(site_url("admin/pages/saveMultiOpening"), $attributes);
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
                            <div class="control-group">
                            	<label class="control-label">Download CSV Format</label>
                            	<div class="controls">
                                	<button class="btn btn-link" type="button" name="generate" value="Generate">Generate</button>
                                </div>
							</div>
                            <div class="control-group">
                            	<label class="control-label">Upload CSV</label>
                            	<div class="controls">
                                	<input type="file">
                                </div>
                            </div>
                            <div class="control-group">
                            	<div class="controls">
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
// Retrieve Data for Editing
function fetchData(sel_distributor_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/distributors/fetch')?>",
							type: "POST",
							data: {distributor_id : sel_distributor_id},
							dataType: "json"
						});
	request.done(function(msg) {
		$('#txt_distributor').val(msg.distributor);
		$('#txt_contact').text(msg.contact);
		$('#txt_address').text(msg.address);
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


// Change status of image
function changeStatus(sel_distributor_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/distributors/changeStatus')?>",
							type: "POST",
							data: {distributor_id : sel_distributor_id},
							dataType: "json"
						});
	request.done(function(msg) {
		if(msg.cur_stat == 'active')
		{
			$('#stat_distributor_id_'+sel_distributor_id).removeClass('status_inactive').addClass('status_active');
		}
		else
		{
			$('#stat_distributor_id_'+sel_distributor_id).removeClass('status_active').addClass('status_inactive');
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


// Change state AJAX call to get city list
function getCityList(state_id, city_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/distributors/getCityList')?>",
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


// Add Distributor button clicked
$(':button[value="Add Distributor"]').click(function(){
	$('#frm_career_single').attr('action',"<?=site_url('admin/distributors/save')?>");
	$(':button[value="update"]').hide();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').show();
	$('#img_prev').attr('src', '');
	$('a[href="#bulk_up"]').show();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_adddistributor_div').fadeIn('slow');
		$(':button[value="Add Distributor"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Edit image option clicked
$('.img_edit').click(function() {
	var sel_distributor_id = $(this).attr('id').split('_')[3];
	fetchData(sel_distributor_id);	// AJAX function to retrive data from page table
	$('input[name=edit_distributor_id]').val(sel_distributor_id);
	$('#frm_career_single').attr('action',"<?=site_url('admin/distributors/update')?>");
	$(':button[value="update"]').show();
	$(':button[value="delete"]').hide();
	$(':button[value="save"]').hide();
	$('a[href="#bulk_up"]').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_adddistributor_div').fadeIn('slow');
		$(':button[value="Add Distributor"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Delete image option clicked
$('.img_del').click(function() {
	$('#frm_career_single').attr('action',"<?=site_url('admin/distributors/delete')?>");
	var sel_distributor_id = $(this).attr('id').split('_')[3];
	fetchData(sel_distributor_id);	// AJAX function to retrive data from page table
	$('input[name=del_distributor_id]').val(sel_distributor_id);
	$(':button[value="delete"]').show();
	$(':button[value="update"]').hide();
	$(':button[value="save"]').hide();
	$('a[href="#bulk_up"]').hide();
	$('#sel_img').hide();
	$('#id_div_table').fadeOut('slow', function() {
		$('#id_adddistributor_div').fadeIn('slow');
		$(':button[value="Add Distributor"]').fadeOut();
		$(document).scrollTop($('.heading').offset().top-5);
	});
});


// Status image option clicked
$('.img_stat').click(function() {
	var sel_distributor_id = $(this).attr('id').split('_')[3];
	changeStatus(sel_distributor_id);	// AJAX function to retrive data from page table
});


// Cancel button clicked 
$(':button[value="cancel"], :button[value="multi_cancel"]').click(function(){
	$('.error').remove();
	$('#img_prev').attr('src','');
	$('#sel_img').show();
	$('#id_adddistributor_div').fadeOut('slow', function() {
		$('#id_div_table').fadeIn('slow');
		$(':button[value="Add Distributor"]').fadeIn();
		$('.alert').hide();
		$(window).height() <= 480 ? $(document).scrollTop($('.heading').offset().top-5) : $(document).scrollTop(0);
	});
});


// Toggle tab on tab click
$('#id_addcareer_tab a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})


// Change state name
$('#sel_state').change(function() {
	var state_id = $(this).val();
	$('#sel_city').find('option').remove();
	state_id != '' ? getCityList(state_id, null) : '';
});
</script>