<div class="row-fluid">
	<div class="span10 offset1">
		<div class="html_border">
			<div id="html_container">
				<div class="row-fluid">
					<h2><?=$page_data->head?></h2>
					<p class="paddrow"><?=$page_data->content?></p>
                    <?php
					/*$CI =& get_instance();
					$CI->load->model('cities');
					$city_list = $CI->cities->getCityList(1);
					print_r($city_list);*/
					?>
				</div>
                <div class="row-fluid">
                    <div class="paddrow small_block rooms_cont offset1 span10">
                        <p><strong>Fill this Form to contact us.</strong></p>
                        <div class="alert alert-block hide">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <p></p>
                        </div>
                        <?php
                        $attributes = array('class' => 'form-horizontal');
                        echo form_open('', $attributes);
                        ?>
                        <div class="control-group">
                            <label for="txt_pg_title" class="control-label">Your Name</label>
                            <div class="controls">
                                <input type="text" placeholder="Name" class="input-xlarge" id="txt_name" maxlength="100">
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="txt_pg_title" class="control-label">Your Email</label>
                            <div class="controls">
                                <input type="text" placeholder="Email" class="input-xlarge" id="txt_email" maxlength="100">
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="txt_pg_title" class="control-label">Message Subject</label>
                            <div class="controls">
                                <input type="text" placeholder="Message Subject" class="input-xlarge" id="txt_subj" maxlength="100">
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="txt_pg_title" class="control-label">Feedback / Query</label>
                            <div class="controls">
                                <textarea class="input-xlarge" id="txt_feedback" placeholder="Feedback / Query" rows="8"></textarea>
                            </div>
                        </div>
                        <div class="control-group">  
                              <div class="controls">
                                <button value="save" name="save" type="button" class="btn btn-primary">Send</button>
                                <button value="cancel" name="cancel" type="reset" class="btn">Reset</button>
                              </div>
                        </div>
                        <?=form_close()?>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$('form input, form textarea').click(function(){
	$(this).css({ 'background-color': '#FFFFFF', 'border-color': '' });
})


$('button[name=save]').click(function(){
	var txt_name = $.trim($('#txt_name').val());
	var txt_email = $.trim($('#txt_email').val());
	var txt_subj = $.trim($('#txt_subj').val());
	var txt_feedback = $.trim($('#txt_feedback').val());
	
	if(validateForm(txt_name, txt_email, txt_subj, txt_feedback))
	{
		saveData(txt_name, txt_email, txt_subj, txt_feedback);
	}
	else
	{
		return false;
	}
});


function validateForm(txt_name, txt_email, txt_subj, txt_feedback)
{
	var valid = true;
	$('form input, form textarea').each(function(){
		// check for blank
		if($.trim($(this).val()) == '')
		{
			$(this).css({ 'background-color': '#F2DEDE', 'border-color': '#FF0000' });
			valid = false;
		}
	});
	if(valid)
	{
		// check for valid email
		var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
		if( ! emailRegex.test(txt_email))
	    {
	    	$('#txt_email').css({ 'background-color': '#F2DEDE', 'border-color': '#FF0000' });
	    	valid = false;	
	    }
	}
	return valid ? true : false;
}


function saveData(txt_name, txt_email, txt_subj, txt_feedback)
{
	var request = $.ajax({
							url: "<?=site_url('index/sendFeedback')?>",
							type: "POST",
							data: {txt_name : txt_name, txt_email: txt_email, txt_subj: txt_subj, txt_feedback: txt_feedback},
							dataType: "json"
						});
	request.done(function(msg) {
		if(msg.frm_validation_err)
		{
			$('.alert-block p').html(msg.ErrMsg);
			$('.alert-block').removeClass('alert-success').addClass('alert-error').show();
		}
		else
		{
			$('.alert-block p').html('<p>Your message has sent successfully.</p>');
			$('.alert-block').removeClass('alert-error').addClass('alert-success').show();
			$('form input, form textarea').each(function(){
				$(this).val('');
			});
		}
	});
	request.fail(function(jqXHR, textStatus) {
		$('.alert-block p').html(textStatus);
		$('.alert-block').removeClass('alert-success').addClass('alert-error').show();
	});
}

$("button[type=reset]").bind("click", function() {
  $('form input, form textarea').each(function(){
	$(this).css({ 'background-color': '#FFFFFF', 'border-color': '' });
  })
});
</script>