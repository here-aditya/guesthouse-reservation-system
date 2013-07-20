			</div><!-- /Middle Row-->
        </div><!-- /Page Middle Container -->   
    </div><!-- /Page Wrapper-->
    
    
    <!-- Page Footer starts -->
    <div class="footer gradient_grey">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span4 offset3">
                    <p class="credit">&copy; 2012 Somany Foam Limited. All Rights Reserved.</p>
                </div>
                <div class="span2">
                    <p class="credit" id="scr_val">Version 1.0.0</p>
                </div>
            </div>
        </div>
    </div>
	<!-- Page Footer ends -->
    
    <!-- Popup Box -->
    <div class="modal hide fade" id="flash_popup">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Modal header</h3>
        </div>
        <div class="modal-body">
        	<p>One fine body</p>
        </div>
        <div class="modal-footer">
            <a class="btn btn-inverse" data-dismiss="modal">Ok</a>
        </div>
    </div>
	<!-- /Popup Box -->

    <!-- BootStrap JS -->
    <script src="<?=$RPath?>js/bootstrap/bootstrap.js"></script>
    <!-- Clock JS-->
    <script src="<?=$RPath?>js/clock.js"></script>
    
    <!-- Common part to focus heading part -->
    <script type="text/javascript">
    $(document).ready(function() {
		if('.heading')
		{
			$(window).height() <= 480 ? $(document).scrollTop($('.heading').offset().top + 15) : '';
		}
	});
	</script>
    
    <!-- Flash data status -->
    <script>
	$(document).ready(function(e) {
		<?php
		$flash_op_stat = $this->session->flashdata('flash_op_stat');
		if(! empty($flash_op_stat))
		{
		?>
			$('#flash_popup').on('show', function () {
				$('.modal-header h3').html('<?=$flash_op_stat['head']?>');
				$('.modal-body p').html('<?=$flash_op_stat['body']?>');
			});
			$('#flash_popup').modal('show');
		<?php
		}
		?>
	});
	</script>
    
    <!-- Delete Later -->
    <script type="text/javascript">
    function showValue() {
		/*
		$('#scr_val').text(window.innerWidth+'X'+window.innerHeight);	   // max - 1920 X 977
        $('#scr_val').text(window.outerWidth+'X'+window.outerHeight);	  // max - 1936 X 1056
		$('#scr_val').text(screen.width+'X'+screen.height);			     // max - 1920 X 1080
		$('#scr_val').text(screen.availWidth+'X'+screen.availHeight);   // max - 1920 X 1040
		*/
		//$('#scr_val').text(window.innerWidth+'X'+window.outerHeight); // 1920 X 1056
		//$('#scr_val').text(document.body.clientWidth+'X'+document.body.clientHeight); // 1920 X 915
		//$('#scr_val').text(document.body.offsetWidth+'X'+document.body.offsetHeight); // 1920 X 915
		$('#scr_val').text($(window).width()+'X'+$(window).height()); // 1920 X 977
    }
    </script>
</body>

</html>