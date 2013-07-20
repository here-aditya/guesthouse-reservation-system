		<div class="row-fluid paddrow">
            <div class="footer">
                <div class="container-fluid">
                    <div class="offset3 reserve">
                        <p class="credit muted">
                            &copy; <?=$site['site_title']?>. All rights reserved.
                            <small><a href="#">Disclaimer</a> | <a href="#">Copyright</a> | <a href="#">Site Map</a></small>
                        </p>
                        <div id="res"></div>
                    </div>
                </div>
            </div>
    	</div>
        
        </div><!-- main_container End -->
 	</div><!-- container End -->


<!-- Header Slider JS -->
<script src="<?=$RPath?>js/js-image-slider.js"></script>
<script>
/*
$(document).ready(function(){
	var request = $.ajax({
							url: "<?=site_url('index/getImages')?>",
							type: "POST",
							dataType: "json"
						});
						
	request.done(function(images) {
		  $('#main_loader').hide();
		  $('.slider_container img#slider_img').attr('src', images[0]);
          var myVar=setInterval(function(){slideImage(images)}, 5000);
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);
	});
});

function slideImage(img)
{
	img_no = getRandomInt(0, img.length-1); 
	$('.slider_container img#slider_img').fadeOut('slow', function(){
		$('.slider_container img#slider_img').attr('src', img[img_no]).fadeIn('slow');
	});
}

function getRandomInt (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}*/
</script>

<!-- Header click redirection -->
<script type="text/javascript">
	$('#header h1').click(function(){
		window.location = '<?=site_url('index/home')?>';
	});
    function showRes() {
		$('#res').text($(window).innerWidth()+'X'+$(window).height()); // 1920 X 977
    }
</script>    