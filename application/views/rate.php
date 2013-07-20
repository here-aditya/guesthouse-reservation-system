<div class="row-fluid">
	<div class="span10 offset1">
		<div class="html_border">
			<div id="html_container">
				<div class="row-fluid">
					<h2><?=$page_data->head?></h2>
					<p class="paddrow"><?=$page_data->content?></p>
				</div>
                                
                <div class="rooms_cont">
                	<div class="well well-small">
						<span>Room's Category : &nbsp;</span>
                        <select class="input-xlarge" id="room_catg">
                        	<option></option>
                        	<?php 
							if( ! empty($rooms_catg_details))
							{
								foreach($rooms_catg_details as $rooms_catg)
								{
							?>
                            <option value="<?=$rooms_catg->id?>" <?php $rooms_catg->id == $sel_catg_id ? print 'selected' : ''?>><?=$rooms_catg->name?></option>
                            <?php
								}
							}
							?>
                        </select>
                    </div>
                    <div class="yellow_gradient">
                        <table class="table table-bordered table-striped table-hover tbl_room_rates">
                            <thead>
                                <tr>
                                    <th>Room No.</th>
                                    <th>Features</th>
                                    <th>Seasonal Donation</th>
                                    <th>Off Season Donation</th>
                                    <th>Maintenance</th>
                                    <th>Season Rate</th>
                                    <th>Off-Season Rate</th>
                                    <th>Beds / Persons</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr><td colspan="8">Data is not available</td></tr>
                            </tbody>
                        </table>
                    </div>
				</div>
               
            </div>
		</div>
	</div>
</div>



<script>
function fetchRoomDetails(catg_id)
{
	var request = $.ajax({
							url: "<?=site_url('index/fetchRoomDetails')?>",
							type: "POST",
							data: {catg_id : catg_id},
							dataType: "json"
						});
	request.done(function(msg) {
		if(msg == null || msg == '')
		{
			$('.tbl_room_rates tbody tr').remove();
			$('.tbl_room_rates tbody').append('<tr><td colspan="8">Data is not available</td></tr>'); 
			return false;
		}
		var row = '';
		for(var i=0;i<msg.length;i++)
		{
			row+='<tr>';
			row+='<td>'+msg[i].room_no+'</td><td>'+msg[i].description+'</td><td>'+msg[i].ses_donation+'</td><td>'+msg[i].off_ses_donation+'</td><td>'+msg[i].maintenance+'</td>';
			row+='<td>'+parseInt(parseInt(msg[i].ses_donation)+parseInt(msg[i].maintenance))+'</td><td>'+parseInt(parseInt(msg[i].off_ses_donation)+parseInt(msg[i].maintenance))+'</td>';
			row+='<td>single bed:'+msg[i].single_bed+',<br> double bed:'+msg[i].double_bed+',<br> sofa cum bed:'+msg[i].sofa_cum_bed+'</td>';
			row+='</tr>';
		}
		$('.tbl_room_rates tbody').append(row);
	});
	request.fail(function(jqXHR, textStatus) {
		$('.tbl_room_rates tbody').append('<tr><td colspan="8">Data is not available</td></tr>');
	});
}

$('#room_catg').change(function(){
	$('.tbl_room_rates tbody tr').remove();
	fetchRoomDetails($(this).val());
});

<?php
if( ! empty($sel_catg_id) )
{
?>
$('.tbl_room_rates tbody tr').remove();
fetchRoomDetails(<?=$sel_catg_id?>);
<?php
}
?>
</script>