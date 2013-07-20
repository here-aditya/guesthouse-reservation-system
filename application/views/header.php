<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title><?=$site['site_title']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?=$site['meta_desc']?>">
<meta name="keywords" content="<?php echo $site['meta_keyword'] . ','; isset($page_data->meta_keyword) ? print $page_data->meta_keyword : ''?>">
<meta name="author" content="">
    
<!-- Bootstrap CSS -->
<link href="<?=$RPath?>css/bootstrap/bootstrap.css" rel="stylesheet">
<!-- Custom Style for Site-->
<link href="<?=$RPath?>css/front_custom_style.css" rel="stylesheet"> 
<!-- Bootstrap Responsive CSS -->
<link href="<?=$RPath?>css/bootstrap/bootstrap-responsive.css" rel="stylesheet">
<!-- Header Slider CSS -->
<link href="<?=$RPath?>css/js-image-slider.css" rel="stylesheet">

<!-- jQuery JS -->
<script src="<?=$RPath?>js/jquery-1.8.3.min.js"></script>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- BootStrap JS -->
<script src="<?=$RPath?>js/bootstrap/bootstrap.js"></script>
    
<!-- Fav and touch icons -->
<link rel="shortcut icon" href="../assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
	
<body onResize="showRes()">

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a href="<?=site_url('index/home')?>" class="brand" style="display: none"><?=$site['site_title']?></a>
                <a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div style="height: 0px;" class="nav-collapse collapse">
                    <ul class="nav" role="navigation">
                    	<?php
						if(is_array($front_menu))
						{
							$arr_main_menu = getMenu($front_menu); // main menu
							$colps_id = 1; // collapse id for accordion
							foreach($arr_main_menu as $main_menu) 
							{
								if($main_menu->status == 'active' && $main_menu->menu_name != 'HOME')
								{
	                    ?>	
                        <li class="dropdown">
                        	
                        	<?php
							$arr_menu = getMenu($front_menu, $main_menu->id); // inner menu
							$arr_menu_id = array();
							$drop_id = 1;
							foreach($arr_menu as $menu)
							{
								$arr_menu_id[] = $menu->menu_name;
							}	// inner foreach
							?>
                        	<a href="<?=site_url('index/'.strtolower( str_replace(' ', '', $main_menu->menu_name) ) ) ?>" style="<?php count($arr_menu_id) > 0 ? print 'display:inline-block' : ''?>">
                        		<?=ucwords(strtolower($main_menu->menu_name))?>
                        	</a>
                        	
                        	<?php 
                        	if(count($arr_menu_id) > 0 && $menu->menu_id != 5)
							{
							?>
							<a data-toggle="dropdown" class="dropdown-toggle" role="button" id="drop<?=$drop_id?>" style="<?php count($arr_menu_id) > 0 ? print 'display:inline-block' : ''?>">
								<b class="caret"></b>
							</a>
                        	<ul aria-labelledby="drop<?=$drop_id?>" role="menu" class="dropdown-menu">
                        		<?php
                        		foreach($arr_menu_id as $menu)
								{
								?>
		                        <li>
		                        	<a href="<?=site_url('index/'.strtolower(str_replace(' ', '', $menu)))?>" tabindex="-1">
		                        	<?=ucwords(strtolower($menu))?>
		                        	</a>
		                        </li>
		                        <?php
								}
		                        ?>
                      		</ul>
                      		<?php
							}	// inner if
							?>
                      		
                        </li>
                        <li class="divider-vertical"></li>
                        <?php
                        		$drop_id++;
                        		} // if active
                    		}	// outer foreach
						}	// outer if
						else
						{
							echo 'No Menu Defined';
						}
	                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
	
	<div class="container-fluid"><!-- container start -->
    	<div class="main_container"><!-- main_container start -->
        	<div class="row-fluid main_header"><!-- header start -->
                <div class="">
					<div class="slider_container">
						<!--<img id="slider_img"/>
						<img src="<?=$RPath?>pics/site/loading_big.gif" class="offset5" id="main_loader" />-->
                        <img id="slider_img" src="<?=$RPath?>pics/image_gallery/bdd80c3076727a61f0e7ebf972a4df50.jpg">
					</div>
				</div>
             </div><!-- header end -->
             
             <div class="" id="header">
					<h1 style="cursor: pointer"><?=$site['site_title']?></h1>
			 </div>