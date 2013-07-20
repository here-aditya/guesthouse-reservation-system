<!DOCTYPE html>
<html lang="en" debug="true">

<!-- Page Header starts -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Admin-Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  
  <!-- Bootstrap CSS -->
  <link href="<?=$RPath?>css/bootstrap/bootstrap.css" rel="stylesheet">
  <link href="<?=$RPath?>css/bootstrap/bootstrap-responsive.css" rel="stylesheet">
  <!-- Custom Style for Site-->
  <link href="<?=$RPath?>css/custom_style.css" rel="stylesheet">      

  <!-- jQuery JS -->
  <script src="<?=$RPath?>js/jquery-1.8.3.min.js"></script>
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="shortcut icon" href="../assets/ico/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
</head>


<body onResize="showValue()">
	<!-- Page Wrapper -->
    <div class="wrap">
        <!-- Navbar start --> 
        <div class="navbar navbar-top">
            <div class="custom_deepgrey_shadow gradient_deepblue">
                <div class="container-fluid">
                    <a class="brand" href="<?=site_url("admin")?>" title="Home">
                        <div class="" style="background:#FFFFFF">
                            <img src="<?=$RPath?>pics/site/logo.jpg" alt="" class="img-polaroid" style="min-height: 70px; max-width: 250px">
                        </div>
                    </a>
                    <div class="pull-right block_rtop">
                        <p><span id="disp_clock"></span></p>
                        <p><span>Last login: <?=$this->session->userdata('usr_last_log_time')?></span></p>
                        <p><span>Last login IP: <?=$this->session->userdata('usr_prev_ip_add')?></span></p>
                        <p><span>Logged Since: <?=$this->session->userdata('usr_cur_log_time')?></span></p>
                        <?php $usr_fname = explode(' ',$this->session->userdata('usr_name')) ?>
                        <p>Welcome <span><b><?=$usr_fname[0]?>, <?=anchor('admin/login/logout',' Logout')?></b></span></p>
                    </div>
                </div>
            </div>
        </div><!--/Navbar ends -->