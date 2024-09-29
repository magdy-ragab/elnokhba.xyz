<?php
$theme_color=$this->core_model->get_settings("color_theme");
// $theme_color="red";
?><!DOCTYPE html>
<html lang="ar_SA" dir=rtl>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
	<title><?php echo ($page_title) ? $page_title : $this->core_model->get_settings('title'); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>uploads/site/favicon.png">
	<meta name="keywords" content="<?=$page_keywords?>">
	<meta name="description" content="<?=$page_description?>">
	<meta property="og:site_name" content="<?php echo $this->core_model->get_settings('title');?>">
	<meta property="og:title" content="<?php echo ($page_title) ?
		$page_title :
		$this->core_model->get_settings('title'); ?>">
	<meta property="og:description" content="<?=$page_description?>">
	<meta property="og:image" content="<?=(isset($share_img)?$share_img:base_url("assets/share.jpg"))?>">
	<meta property="og:url"
		content="<?php echo $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].
			"{$_SERVER['REQUEST_URI']}"?>">
	<meta property="og:locale" content="ar" />
	<meta property="og:locale:alternate" content="ar" />
	<meta property="og:type" content="website"/>
	<meta name="theme-color" content="#444">
	<meta name="twitter:title" content="<?php echo ($page_title) ?
		$page_title :
		$this->core_model->get_settings('title'); ?>">
	<meta name="twitter:description" content="<?=$page_description?>">
	<meta name="twitter:image" content="<?=(isset($share_img)?$share_img:base_url("assets/share.jpg"))?>">
	<meta name="twitter:image:alt" content="<?php echo ($page_title) ?
		$page_title :
		$this->core_model->get_settings('title'); ?>">

	<link rel="alternate" type="application/rss+xml" title="<?=$seo->seo_title?>" 
	href="<?=base_url( "sitemap.xml" )?>" />
	
    <!-- Favicons-->
    <link rel="shortcut icon" href="<?=base_url("theme/img/")?>favicon.ico" type="<?=base_url("theme/image/")?>x-icon">
    <link rel="apple-touch-icon" type="<?=base_url("theme/image/")?>x-icon" href="<?=base_url("theme/img/")?>apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="<?=base_url("theme/image/")?>x-icon" sizes="72x72" href="<?=base_url("theme/img/")?>apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="<?=base_url("theme/image/")?>x-icon" sizes="114x114" href="<?=base_url("theme/img/")?>apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="<?=base_url("theme/image/")?>x-icon" sizes="144x144" href="<?=base_url("theme/img/")?>apple-touch-icon-144x144-precomposed.png">
	
    <!-- BASE CSS -->
    <link href="<?=base_url("theme/css/")?>bootstrap.custom.min.css" rel="stylesheet">
    <link href="<?=base_url("theme/css/{$theme_color}/")?>style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="<?=base_url("theme/css/{$theme_color}/")?>home_1.css" rel="stylesheet">

	<!-- FONTAWSOME -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">
    <!-- YOUR CUSTOM CSS -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Tajawal:400,700&subset=arabic">

    <link href="<?=base_url("theme/css/{$theme_color}/")?>custom.css" rel="stylesheet">
    <link href="<?=base_url("theme/css/{$theme_color}/")?>new.css" rel="stylesheet">
    <link href="<?=base_url("theme/css/{$theme_color}/")?>custom-responsive.css" rel="stylesheet">

	<!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script> -->
	<script src="<?=base_url("assets/js/jquery.js")?>"></script>

</head>

<body>
	
	<div id="page">
		
	<header class="version_1">
		<div class="layer"></div><!-- Mobile menu overlay mask -->
		<div id="header_1">
			<div class="row">
				<div class="col-6">
					<span class="d-block d-md-inline d-lg-inline text-sm-center">
						الرقم الاساسي
					</span><!-- / .d-dm-block -->
					<span class="d-block d-md-inline d-lg-inline text-sm-center">
						<a href="tel:966592951043" class="d-sm-block d-md-block text-sm-center">
							<span class="fa fa-phone"></span>
							966592951043
						</a>
						<a href="https://wa.me/966592951043" class="d-sm-block d-md-block text-sm-center">
							<span class="fa fa-whatsapp"></span>
							966592951043
						</a>
					</span>
				</div><!-- / .col-6 -->
				<div class="col-6 text-left">
					<span class="d-block d-md-inline d-lg-inline text-sm-center">
						رقم المشاريع
					</span>
					<span class="d-block d-md-inline d-lg-inline text-sm-center">
						<a href="tel:966575420360" class="d-sm-block d-md-block text-sm-center">
							<span class="fa fa-phone"></span>
							966575420360
						</a>
						<a href="https://wa.me/966592951043" class="d-sm-block d-md-block text-sm-center">
							<span class="fa fa-whatsapp"></span>
							966592951043
						</a>
					</span>
				</div><!-- / .col-6 -->
			</div><!-- / .row -->
		</div>
		<div id="header_2">
			<div class="row">
				<div class="col-12 col-md-6 col-lg-4 text-sm-center">
					<ul class="mt-2 social">
						<?php echo $this->core_model->get_all_social();?>
					</ul>
				</div><!-- / .col-lg-4 -->
				<div class="col-12 col-md-6 col-lg-4 text-center brand-logo">
					<a href="<?=base_url()?>">
						<img
							class="m-md-t-1"
							alt="<?=$this->core_model->get_settings('title');?>"
							width="180"
							height="66"
							loading=lazy
							src="<?=base_url("theme/logo.png")?>">
					</a>
				</div><!-- / .col-lg-4 -->
				<div class="col-lg-4 text-sm-center">
					<?php echo form_open(base_url("search")) ;?>
						<div class="custom-search-input mt-2">
							<input
								type="text" name="q"  value="<?=$this->input->post('q')?>"
								id="seach_lg" placeholder="بحث في منتجات الموقع">
							<button type="submit"><i class="header-icon_search_custom"></i></button>
						</div>
					<?php echo form_close();?>
				</div><!-- / .col-lg-4 -->
			</div><!-- / .row -->
		</div><!-- / #header-2 -->
		<div class="main_header Sticky">
			<div class="container">
				<div class="row small-gutters">
					<nav class="col-xl-12">
						<a class="open_close" href="javascript:void(0);">
							<div class="hamburger hamburger--spin">
								<div class="hamburger-box">
									<div class="hamburger-inner"></div>
								</div>
							</div>
						</a>
						<!-- Mobile menu button -->
						<div class="main-menu">
							<div id="header_menu">
								<a href="<?=base_url()?>">
									<img src="<?=base_url("theme/logo.png")?>"
										alt="<?php echo $this->core_model->get_settings('title')?>"
										width="100"
										height="35">
									</a>
								<a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
							</div>
							<ul>
								
							<?php $this->load->view("templates/menu", ["parent_id"=>0]);?>
							</ul>
						</div>
						<!--/main-menu -->
					</nav>
				</div>
				<!-- /row -->
			</div>
		</div>
		<!-- /main_header -->

		<?php /*<div class="main_nav" dir=ltr>
			<div class="container">
				<div class="row small-gutters">
					<div class="col-xl-3 col-lg-3 col-md-3">
						<nav class="categories">
							<ul class="clearfix">
								<li><span>
										<a href="tel:966592951043">
											<span class="fa fa-phone"></span>
											966592951043
										</a>
									</span>
								</li>
								<li><span>
										<a href="https://wa.me/966592951043">
											<span class="fa fa-whatsapp"></span>
											966592951043
										</a>
									</span>
								</li>
							</ul>
						</nav>
					</div>
					<div class="col-xl-9 col-lg-9 col-md-9 d-none d-md-block">
						<?php echo form_open(base_url("search")) ;?>
						<div class="custom-search-input">
							<input
								type="text" name="q"  value="<?=$this->input->post('q')?>"
								id="seach_lg" placeholder="بحث في منتجات الموقع">
							<button type="submit"><i class="header-icon_search_custom"></i></button>
						</div>
						<?php echo form_close();?>
					</div>
				</div>
				<!-- /row -->
			</div>
			<div class="search_mob_wp">
				<?php echo form_open(base_url("search")) ;?>
				<input
					type="text" name="q" value="<?=$this->input->post('q')?>"
					id="seach_sm" class="form-control" placeholder="بحث في منتجات الموقع">
				<input type="submit" class="btn_1 full-width" value="Search">
				<?php echo form_close();?>
			</div>
			<!-- /search_mobile -->
		</div>
		<!-- /main_nav --> */ ?>
	</header>
	<!-- /header -->
		
	<main>