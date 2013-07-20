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
              <h3>Reservation</h3>
            </div>
        </div>
    </div>
    <!--/inner row1-->
    
    <!--inner row2-->
    <div class="row-fluid">
        <div class="container-fluid action_panel gradient_milkywhite">
            <div class="row-fluid mid_main_head">
                <div class="span12">
                    <span>Booking :</span>
                </div>
            </div>
                        
            <div class="row-fluid">
				<ul class="nav nav-tabs" id="id_addimg_tab">
                    <li class="active">
                        <a href="#status">Booking Status</a>
                    </li>
                    <li>
                        <a href="#booking">New Booking</a>
                    </li>
                </ul>
                <div class="tab-content">
                	<!--/tab pane left-->
                    <div class="tab-pane active" id="status">
                        <div class="hero-unit gradient_extrawhite login_divider div_border">
                            <div class="row-fluid">
                                <div class="span4">
                                    <select class="input-xlarge" id="id_room_catg2">
                                        <option value="">Select Room Category</option>
                                        <option value="all">All</option>
                                        <?php 
                                        if( ! empty($rooms_catg_details))
                                        {
                                            foreach($rooms_catg_details as $rooms_catg)
                                            {
                                        ?>
                                        <option value="<?=$rooms_catg->id?>"><?=$rooms_catg->name?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="span2 hide" id="div_sel_room">
                                	<select class="input-medium" multiple="multiple" size="2"></select>
                                </div>
                                <div class="span3 hide">
                                    <div class="input-prepend">
                                        <span class="add-on">From :</span>
                                        <input class="input-medium datepicker" type="text" placeholder="From Date"  id="frm_date2" value="<?=date('d F Y')?>" readonly="readonly">
                                    </div>
                               </div>
                               <div class="span3 hide">
                                    <div class="input-prepend">
                                        <span class="add-on">To :</span>
                                        <input class="input-medium datepicker" type="text" placeholder="To Date" id="to_date2" value="<?=date('d F Y')?>" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Table of Rooms -->
                        <div class="well well-small hide form_box" id="tbl_room_book_details">
                        	<div class="login_divider">
                            	<button class="close pull-right" type="button" id="btn_booking_details">&times;</button>
                                <h3>Booking Details :</h3>
                            </div>
                            <div class="row-fluid" id="div_book_details"></div>
                            <div class="row-fluid">
                            	<div class="form-actions gradient_grey span10 offset1">
                                    <label class="checkbox"><input type="checkbox" id="id_chk_cancel_booking"/>Cancel Booking</label>
                                    <div class="hide well well-small" id="div_cancel_booking">
                                    	<p id="lbl_chk_roomno" class="form-inline">Select Room No(s). for Cancellation of Booking : </p>
                                    	<a id="btn_cancel_booking" class="btn btn-primary btn-small hide">Cancel Booking</a>
                                        <a class="btn btn-small" id="btn_reset_booking">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /Table of Rooms -->
                        <!-- Table of Rooms -->
                        <div class="well well-small hide" id="tbl_room_book_stat">
                            <div class="row-fluid"></div>
                        </div><!-- /Table of Rooms -->
                        
                        <!-- Error Status -->
                        <div class="row-fluid hide" id="div_error_status2">
                            <div class="span6">
                                <div class="alert">
                                    <p></p>
                                </div>
                            </div>
                        </div><!-- /Error Status -->
                    </div><!--/tab pane left-->
                    
                    
                    
                    
                    <!--tab pane right-->
                    <div class="tab-pane" id="booking">
                        <div class="hero-unit gradient_extrawhite login_divider div_border">
                            <div class="row-fluid">
                                    <div class="span4">
                                        <select class="input-xlarge" id="id_room_catg">
                                            <option value="">Select Room Category</option>
                                            <option value="all">All</option>
                                            <?php 
                                            if( ! empty($rooms_catg_details))
                                            {
                                                foreach($rooms_catg_details as $rooms_catg)
                                                {
                                            ?>
                                            <option value="<?=$rooms_catg->id?>"><?=$rooms_catg->name?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="span3">
                                        <div class="input-prepend">
                                            <span class="add-on">From :</span>
                                            <input class="input-medium datepicker" type="text" placeholder="From Date"  id="frm_date" value="<?=date('d F Y')?>" readonly="readonly">
                                        </div>
                                   </div>
                                   <div class="span3">
                                        <div class="input-prepend">
                                            <span class="add-on">To :</span>
                                            <input class="input-medium datepicker" type="text" placeholder="To Date" id="to_date" value="<?=date('d F Y')?>" readonly="readonly">
                                        </div>
                                    </div>
                            </div>
                        </div> 
                        
                        <!-- Table of Rooms -->
                        <div class="well well-small">
                            <div class="row-fluid">
                                <div class="span12">
                                    <table class="table table-bordered table-striped tbl_booking table-hover" id="tbl_new_booking">
                                        <thead>
                                            <tr>
                                                <th>Rooms</th>
                                                <th>Beds / Persons</th>
                                                <th>Season Donation</th>
                                                <th>Off Season Donation</th>
                                                <th>Maintenance</th>
                                                <th>Season Charge</th>
                                                <th>Off Season Charge</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="8">Data is not available</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- /Table of Rooms -->
                        
                        <!-- Booking Form -->
                        <div id="frm_booking" class="well well-small form_box hide">
                            <div class="login_divider">
                                <h3>Fill The Form for Booking:</h3>
                            </div>
                            <div class="row-fluid">
                                    <div class="span6 form-actions">
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Booked By</label>
                                            <div class="controls">
                                                <input type="text" readonly="readonly" class="input-xlarge" value="<?=$this->session->userdata('usr_name')?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Booking Date</label>
                                            <div class="controls">
                                                <input type="text" value="<?=date('d-F-Y')?>" readonly="readonly" class="input-medium" id="book_date" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Room No(s).</label>
                                            <div class="controls">
                                                <input type="text" readonly="readonly" class="input-xlarge" id="book_roomno" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">From Date</label>
                                            <div class="controls">
                                                <input type="text" value="<?=date('d F Y')?>" readonly="readonly" class="input-medium" id="book_from_date" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">To Date</label>
                                            <div class="controls">
                                                <input type="text" value="<?=date('d F Y')?>" readonly="readonly" class="input-medium" id="book_to_date" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Total Days</label>
                                            <div class="controls">
                                                <input type="text" readonly="readonly" class="input-small" id="book_total_days" value="1"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Select Charge Type</label>
                                            <div class="controls">
                                                <select class="input-large" id="charge_type">
                                                    <option value=""></option>
                                                    <option value="sess">Session</option>
                                                    <option value="offsess">Off Session</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Total Amount</label>
                                            <div class="controls">
                                                <div class="input-prepend">
                                                    <span class="add-on">Rs.</span>
                                                    <input type="text" readonly="readonly" class="input-medium" id="book_total_amount" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6 form-actions">
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Guest Name</label>
                                            <div class="controls">
                                                <input type="text" class="input-xlarge" id="guest_name">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Guest Address 1</label>
                                            <div class="controls">
                                               <textarea class="input-xlarge" rows="4" id="guest_add1"></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Guest Address 2</label>
                                            <div class="controls">
                                               <textarea class="input-xlarge" rows="4" id="guest_add2"></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Guest Phone</label>
                                            <div class="controls">
                                               <input type="text" class="input-xlarge" id="guest_phone">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Guest Mobile</label>
                                            <div class="controls">
                                               <input type="text" class="input-xlarge" id="guest_mobile">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Guest Email</label>
                                            <div class="controls">
                                               <input type="text" class="input-xlarge" id="guest_email">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Receipt No.</label>
                                            <div class="controls">
                                               <input type="text" class="input-xlarge" id="guest_rcptno">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row-fluid">
                                <div class="form-actions gradient_grey">
                                            <a class="btn btn-inverse" id="btn_confirm">Confirm Booking</a>
                                            <a class="btn" id="btn_cancel">Reset All</a>
                                </div>
                            </div>
                        </div><!-- /Booking Form -->
                        
                        <!-- Error Status -->
                        <div class="row-fluid">
                            <div class="hide" id="div_error_status">
                                <div class="span6">
                                    <div class="alert">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /Error Status -->
                        
					</div><!--/tab pane right-->
                 </div><!--/tab content-->
			</div>
            
		</div>
    </div><!--/inner row2-->
</div>
<!-- /Main Inner Container -->


<!-- For UI Calendar -->
<link rel="stylesheet" href="<?=$RPath?>jq_ui/css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="<?=$RPath?>jq_ui/js/jquery-ui-1.10.0.custom.js"></script>

<!-- Internal Page JS -->
<script>
/* ************************ For Booking Tab Pane ******************************** */
// Retrieve Room Details
function fetchRoomDetails(catg_id, frm_date, to_date)
{
	if(catg_id == '' || frm_date == '' ||  to_date == '')
	{
		return false;
	}
	var request = $.ajax({
							url: "<?=site_url('admin/booking/fetchRoomDetails')?>",
							type: "POST",
							data: {catg_id : catg_id, frm_date: frm_date, to_date: to_date},
							dataType: "json"
						});
	request.done(function(msg) {
		$('.tbl_booking tbody tr').remove();
		if(msg == null || msg == '')
		{
			$('.tbl_booking tbody').append('<tr><td colspan="8">Data is not available</td></tr>'); 
			return false;
		}
		var row = '';
		for(var i=0;i<msg.length;i++)
		{
			var sess_charge = parseInt(parseInt(msg[i].ses_donation)+parseInt(msg[i].maintenance));
			var offsess_charge = parseInt(parseInt(msg[i].off_ses_donation)+parseInt(msg[i].maintenance));
			row+='<tr>';
			if(msg[i].book_status == 'Available')
			{
				row+='<td><label class="checkbox inline"><input type="checkbox" value="'+sess_charge+'_'+offsess_charge+'" /><span>'+msg[i].room_no+'</span></label></td>';
			}
			else if(msg[i].book_status == 'Booked')
			{
				row+='<td>'+msg[i].room_no+'</td>';
			}
			row+='<td>single bed:'+msg[i].single_bed+',<br> double bed:'+msg[i].double_bed+',<br> sofa cum bed:'+msg[i].sofa_cum_bed+'</td>';
			row+='<td>'+msg[i].ses_donation+'</td><td>'+msg[i].off_ses_donation+'</td><td>'+msg[i].maintenance+'</td>';
			row+='<td>'+sess_charge+'</td><td>'+offsess_charge+'</td>';
			row+= msg[i].book_status == 'Booked' ? '<td><a href="#" class="room_booked" id="room_'+msg[i].room_no+'">'+msg[i].book_status+'</a></td>' : '<td><span class="room_available">'+msg[i].book_status+'</span></td>';
			row+='</tr>';
		}
		$('.tbl_booking tbody').append(row);
	});
	request.fail(function(jqXHR, textStatus) {
		$('.tbl_booking tbody').append('<tr><td colspan="8">Data is not available</td></tr>');
	});
}

function saveBookingData()
{
	var request = $.ajax({
							url: "<?=site_url('admin/booking/saveBookingData')?>",
							type: "POST",
							data: {
								   book_from_date : $('#book_from_date').val(), 
								   book_to_date: $('#book_to_date').val(), 
								   arr_roomno: arr_seleted_rooms,
								   guest_name: $('#guest_name').val(),
								   guest_add1: $('#guest_add1').val(),
								   guest_add2: $('#guest_add2').val(),
								   guest_phone: $('#guest_phone').val(),
								   guest_mobile: $('#guest_mobile').val(),
								   guest_email: $('#guest_email').val(),
								   guest_rcptno: $('#guest_rcptno').val(),
								   booking_amount: $('#book_total_amount').val(),
								   charge_type: $('#charge_type').val()
								   },
							dataType: "json"
						});
	request.done(function(msg) {
		if(msg.error)
		{
			$('#div_error_status .alert').removeClass('alert-success').addClass('alert-error');
		}
		else
		{
			$('#div_error_status .alert').removeClass('alert-error').addClass('alert-success');
		}
		$('#div_error_status .alert p').html(msg.message);
		resetAll();
		$('#div_error_status').show();
		$('#id_room_catg').val('');
	});
	request.fail(function(jqXHR, textStatus) {
		$('#div_error_status .alert').removeClass('alert-success').addClass('alert-error');
		$('#div_error_status .alert p').html(textStatus);
		resetAll();
		$('#div_error_status').show();
		$('#id_room_catg').val('');
	});
}

function resetAll()
{
	arr_seleted_rooms = Array();
	$('#div_error_status').hide();
	$('#frm_booking').hide();
	$('.tbl_booking tbody tr').remove();
	$('.tbl_booking tbody').append('<tr><td colspan="8">Data is not available</td></tr>');
	$('#guest_name, #guest_name, #guest_add1, #guest_add2, #guest_phone, #guest_mobile, #guest_email, #guest_rcptno, #charge_type, #book_total_amount').val('');
}

function validFormFields()
{
	var error = true;
	if($.trim($('#guest_add1').val()) == '')
	{
		$('#guest_add1').css({'border': '1px red solid', 'background-color': 'rgb(242, 222, 222)'});
		error = false;
	}
	if($.trim($('#charge_type').val()) == '')
	{
		$('#charge_type').css({'border': '1px red solid', 'background-color': 'rgb(242, 222, 222)'});
		error = false;
	}
	$('#frm_booking input[type=text]').each(function()
	{
		if($.trim($(this).val()) == '')
		{
			$(this).css({'border': '1px red solid', 'background-color': 'rgb(242, 222, 222)'});
			error = false;
		}
		else
		{
			$(this).css({'border': '', 'background-color': ''});
		}
	});
	var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
	var txt_email = $('#guest_email').val();
	if( ! emailRegex.test(txt_email))
	{
	    $('#guest_email').css({'border': '1px red solid', 'background-color': 'rgb(242, 222, 222)'});
	    error = false;	
	}
	else
	{
		$('#guest_email').css({'border': '', 'background-color': ''});
	}
	return error;
}

function calcNoOfDates(fromdt, todt)
{
	var d1 = new Date(fromdt);
	var d2 = new Date(todt);
	var diff = new Date(d2 - d1);
    var days = diff/1000/60/60/24; 
	$('#book_total_days').val(days+1);
}

function calcTotalAmount()
{
	$('#book_total_amount').val('');
	if($.trim($('#charge_type').val()) == '' || arr_seleted_rooms.length == 0)
	{
		return false;
	}
	var roomno, totalamount = 0;
	$('.tbl_booking input[type=checkbox]:checked').each(function()
	{
		roomno = $.trim($(this).next().html());
		charge = $(this).attr('value').split('_');
		totalamount+= $('#charge_type').val() == 'sess' ? parseInt(charge[0]) : parseInt(charge[1]);
	});
	var actualamount = totalamount * parseInt($('#book_total_days').val());
	$('#book_total_amount').val(actualamount);
}

// DatePicker
$( "#frm_date").datepicker({
	dateFormat: "d MM yy",
	onSelect: function(){
							$('#book_from_date').val(this.value);
							calcNoOfDates(this.value, $('#to_date').val());
							resetAll();
							fetchRoomDetails($('#id_room_catg').val(), this.value, $('#to_date').val());
						}
});

$('#to_date').datepicker({
	dateFormat: "d MM yy",
	onSelect: function(){
							$('#book_to_date').val(this.value);
							calcNoOfDates($('#frm_date').val(), this.value);
							resetAll();
							fetchRoomDetails($('#id_room_catg').val(), $('#frm_date').val(), this.value);
						}
});

$('#charge_type').change(function()
{
	calcTotalAmount();
});
		
// Toggle tab on tab click
$('#id_addimg_tab a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})

$('#frm_booking input[type=text], #frm_booking textarea, #charge_type').click(function() {
	$(this).css({'border': '', 'background-color': ''});
});

$('#id_room_catg').change(function(){
	$('#div_error_status').hide();
	resetAll();
	fetchRoomDetails($(this).val(), $('#frm_date').val(), $('#to_date').val());
});

var arr_seleted_rooms = Array();
$('#tbl_new_booking input[type=checkbox]').live("click", function()
{
	var roomno = $.trim($(this).next().html());
	var pos = $.inArray(roomno, arr_seleted_rooms);
	if($(this).attr('checked'))
	{
		pos == -1 ? arr_seleted_rooms.push(roomno) : '';
	}
	else
	{
		pos != -1 ? arr_seleted_rooms.splice(pos, 1) : '';
	}
	$('#book_roomno').val(arr_seleted_rooms.toString());
	$('#book_total_amount, #charge_type').val('');
	arr_seleted_rooms.length > 0 ? $('#frm_booking').slideDown('slow') : $('#frm_booking').slideUp('slow');
});

$("#btn_confirm").click(function()
{
	validFormFields() ? $("#btn_confirm").popover('show') : ''; 
});

$('#btn_cancel').click(function()
{
	resetAll();
	$('#id_room_catg').val('');
});

$('#btn_confirm_cancel').live('click', function() 
{
	$("#btn_confirm").popover('hide');
});

$('#btn_confirm_ok').live('click', function() 
{
	$("#btn_confirm").popover('hide');
	validFormFields() ? saveBookingData() : '';
});
	
$(document).ready(function()
{
	$("#btn_confirm").popover({
		trigger: 'manual',
		html: true,
		title: 'Confirm Booking ?', 
		content: '<a class="btn btn-primary" id="btn_confirm_ok">Ok</a>&nbsp;&nbsp;<a class="btn" id="btn_confirm_cancel">Cancel</a>',
		placement: 'top'
	});	
});



/* ************************ For Status Tab Pane ******************************** */
function fetchRoomBookStatus(arr_room_no)
{
	var request = $.ajax({
							url: "<?=site_url('admin/booking/fetchRoomBookStatus')?>",
							type: "POST",
							data: {arr_room_no: arr_room_no, frm_dt: $('#frm_date2').val(), to_dt: $('#to_date2').val()},
							dataType: "json"
						});
	request.done(function(msg) {
		if(msg.length > 0)
		{
			var container = $('#tbl_room_book_stat div');
			$('#tbl_room_book_stat div div').remove();
			var div_room = '';
			$.each(msg, function()
			{
				//alert(this.room_no);
				div_room += '<div class="span3 div_roomcontainer">';
				div_room += '<div class="row-fluid head1"><div class="span12"><strong>Room No - '+this.room_no+'</strong></div></div>';
				div_room += '<div class="row-fluid head2"><div class="span6"><strong>Date</strong></div><div class="span6"><strong>Status</strong></div></div>';
				var booking_details = this.booking_details;
				$.each(booking_details, function()
				{
					div_room += '<div class="row-fluid data_cont">';
					div_room += '<div class="span6 div_boxy">'+this.dt+'</div>';
					if(this.status == 'Booked')
					{
						div_room += '<div class="span6 room_booked div_boxy">'+this.status+' <a class="booking_info" id="booking_info_'+this.id+'"><i class="icon-tags"></i></a></div>';
					}
					else
					{
						div_room += '<div class="span6 room_available div_boxy">'+this.status+'</div>';
					}
					div_room += '</div>';
				});
				div_room += '</div>';
			});
			container.append(div_room);
		}
	});
}

function fetchRoomsByCatg(sel_catg)
{
	var request = $.ajax({
							url: "<?=site_url('admin/booking/fetchRoomsByCatg')?>",
							type: "POST",
							data: {catg_id: sel_catg},
							dataType: "json"
						});
	request.done(function(msg) {
		$('#div_sel_room select option').remove();
		if(msg.length > 0)
		{
			var arr_room_no = Array();
			$('#div_sel_room select').append('<option value="">Select Room No.</option>');
			$.each(msg, function()
			{
				$('#div_sel_room select').append('<option>'+this.room_no+'</option>');
				arr_room_no.push(this.room_no);
			});
			fetchRoomBookStatus(arr_room_no);
			$('#div_sel_room').fadeIn('slow');
			$('.input-prepend').parent().fadeIn('show');
			$('#tbl_room_book_stat').slideDown('slow');
		}
	});
}

$('#div_sel_room select').live("change", function()
{
	$(this).val() != '' ? fetchRoomBookStatus($(this).val()) : '';
});

function fetchBookDetails(obj, booking_id)
{
	var request = $.ajax({
							url: "<?=site_url('admin/booking/fetchBookDetails')?>",
							type: "POST",
							data: {booking_id: booking_id},
							dataType: "json"
						});
	request.done(function(msg) {
		if(msg)
		{
			$('#div_book_details').html(msg.message_details);
			var roomnos = '';
			$.each(msg.roomnos, function() {
				roomnos += '<label class="checkbox"><input type="checkbox" value="'+this+'" />'+this+'</label>&nbsp;&nbsp;';
			});
			cancl_booking_id = msg.book_id;
			$('#lbl_chk_roomno label').remove();
			$('#lbl_chk_roomno').append(roomnos);
			popover = obj.popover({
						trigger: 'manual',
						html: true,
						title: '<strong>Booking Details</strong><button class="close btn_info pull-right">&times;</button>', 
						content: msg.message+'<div class="row-fluid"><a class="btn btn-info btn-small btn_details">Details</a></div>',
						placement: 'top'
					});	
			popover.popover('show');
		}
	});
}

function resetTable()
{
	$('#div_sel_room').fadeOut('slow');
	$('.input-prepend').parent().fadeOut('slow');
	$('#tbl_room_book_stat').slideUp('slow');
}

$( "#frm_date2").datepicker({
	dateFormat: "d MM yy",
	onSelect: function(){
							resetTable();
							fetchRoomsByCatg($('#id_room_catg2').val());
						}
});

$( "#to_date2").datepicker({
	dateFormat: "d MM yy",
	onSelect: function(){
							resetTable();
							fetchRoomsByCatg($('#id_room_catg2').val());
						}
});

$('#id_room_catg2').change(function()
{
	sel_catg  = $(this).val();
	resetTable();
	sel_catg != '' ? fetchRoomsByCatg(sel_catg) : '';
});

$('.btn_info').live('click', function(){
	popover.popover('destroy');
});

$('.booking_info').live('click', function(){
	popover ? popover.popover('destroy') : '';
	var booking_id = $(this).attr('id').split('_')[2];
	var obj_me = $(this);
	fetchBookDetails(obj_me, booking_id);
	$('#div_error_status2').hide();
});

var popover = null;

$('.btn_details').live("click", function() {
	popover.popover('destroy');
	$('#tbl_room_book_stat').slideUp('slow');
	$('#tbl_room_book_details').slideDown('slow');
});

$('#id_chk_cancel_booking').live("click", function() {
	$('#div_cancel_booking').toggle('slow');
});

var arr_selcancel_roomno = Array();
$('#lbl_chk_roomno input[type=checkbox]').live("click", function() {
	if($(this).attr('checked'))
	{
		arr_selcancel_roomno.push($(this).val());
	}
	else
	{
		var sel_roomno = $(this).val();
		var pos = $.inArray(sel_roomno, arr_selcancel_roomno);
		pos != -1 ? arr_selcancel_roomno.splice(pos, 1) : '';
	}
	arr_selcancel_roomno.length > 0 ? $('#btn_cancel_booking').removeClass('hide') :  $('#btn_cancel_booking').addClass('hide');
});

$('#btn_cancel_booking, #btn_reset_booking, #btn_booking_details').live("click", function() {
	$('#id_chk_cancel_booking').attr('checked', false);
	$('#div_cancel_booking').hide();
	$('#btn_cancel_booking').addClass('hide');
	$('#tbl_room_book_details').slideUp('slow');
	$('#tbl_room_book_stat').slideDown('slow');
	$(this).attr('id') !=  'btn_cancel_booking' ? arr_selcancel_roomno = Array() : '';
});

$('#id_room_catg2').change(function() {
	$('#id_chk_cancel_booking').attr('checked', false);
	$('#div_cancel_booking').hide();
	$('#btn_cancel_booking').addClass('hide');
	$('#tbl_room_book_details').slideUp('slow');
	$('#div_error_status2').hide();
	arr_selcancel_roomno = Array();
});

var cancl_booking_id;
$('#btn_cancel_booking').live("click", function() {
	var request = $.ajax({
							url: "<?=site_url('admin/booking/cancelBooking')?>",
							type: "POST",
							data: {cancl_booking_id: cancl_booking_id, cancl_roomno: arr_selcancel_roomno},
							dataType: "json"
						});
	request.done(function(msg) {
		if(msg.error)
		{
			$('#div_error_status2 .alert').removeClass('alert-success').addClass('alert-error');
		}
		else
		{
			$('#div_error_status2 .alert').removeClass('alert-error').addClass('alert-success');
		}
		$('#div_error_status2 .alert p').html(msg.message);
		$('#div_error_status2').show();
		arr_selcancel_roomno = Array();
	});
});
</script>