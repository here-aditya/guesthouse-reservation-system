<body onLoad="showValue()">
    <div class="container">
    
    	<div class="row-fluid">
        	<div class="span12">
            	<div class="span9 offset3"><!--span1-->
                <?php
				$attributes = array('class' => 'form-signin gradient_milkywhite form-horizontal', 'id' => 'frm_login');
				echo form_open(site_url("admin/login/validateLogin"), $attributes);
                ?>
                <fieldset>
                    <div class="login_divider">
                        <h2 class="form-signin-heading">
                            <img src="<?=$RPath?>pics/site/login.png" title="secure" alt="secure">Login
                        </h2>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_email">Email Address</label>
                        <div class="controls">
                            <input type="text" name="txt_email" id="txt_email" placeholder="Email address" class="input-xlarge">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_pswd">Password</label>
                        <div class="controls">
                            <input type="password" name="txt_pswd" id="txt_pswd" placeholder="Password" class="input-xlarge">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <input class="pull-left" type="checkbox" name="sel_rem" value="remember">
                            <label class="pull-left padd_left">Remember Me</label>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                        	<div class="alert alert-block no_disp">
                                <div id="alert_msg"></div>
                            </div>
                            <button type="button" class="btn btn-primary btn-small" id="btn_login">Sign in</button>
                        </div>
                    </div>
                </fieldset>
                </form>
            </div><!--/span1-->
            </div>
        </div><!--/row-->
        
		<div class="row-fluid">   
            <div class="span12">
            	<div class="span9 offset3 form-compinfo"><!--span2-->
                    <ul class="responsive-utilities-test">
                        <li>Phone<span class="visible-phone">&#10004; Phone</span></li>
                        <li>Tablet<span class="visible-tablet">&#10004; Tablet</span></li>
                        <li>Desktop<span class="visible-desktop" >&#10004; Desktop</span></li>
                    </ul>
                    <div>
                        <p class="muted" id="scr_val"></p>
                    </div>
				</div>
            </div>
		</div><!--/row--> 
        
	</div><!--/container-->
    
<!-- BootStrap JS -->
<script src="<?=$RPath?>js/bootstrap/bootstrap.js"></script>

<!-- Internal Page JS -->
<script>
$(document).ready(function(){
	$('form input').bind('keypress', function(e){
		e.keyCode == 13 ? $('#btn_login').click() : '';
	});
});
// Validate Login Data
function validateLogin(email, pswd)
{
    var request = $.ajax({
                            url: "<?=site_url('admin/login/validateLogin')?>",
                            type: "POST",
                            data: {txt_email : email, txt_pswd: pswd},
                            dataType: "json"
                        });
    request.done(function(msg) {
		if(msg)
		{
			$('#btn_login').removeClass('disabled');
			if(msg.Err)
			{
				$('.alert').removeClass('alert-success').addClass('alert-error').fadeIn('slow');
			}
			else
			{
				$('.alert').removeClass('alert-error').addClass('alert-success').fadeIn('slow').delay(5000, function(){
				window.location.href = '<?=site_url('admin/admin')?>';
				});
			}
			$('#alert_msg').html(msg.ErrMsg);
		}
	});
    request.fail(function(jqXHR, textStatus) {
        $('.alert').removeClass('alert-success').addClass('alert-error').fadeIn('slow');
		$('#alert_msg').html('Error Occured: '+textStatus);
		$('#btn_login').removeClass('disabled');
    });
}

$('#btn_login').click(function() {
	$(this).addClass('disabled');
	var email = $.trim($('#txt_email').val());
	var pswd = $.trim($('#txt_pswd').val());
	validateLogin(email, pswd);
});
</script>

<!-- Delete Later -->
<script type="text/javascript">
function showValue() {
    $('#scr_val').text('Screen Resolution - '+$(window).width()+' X '+$(window).height()); // 1920 X 977
}
</script>
</body>