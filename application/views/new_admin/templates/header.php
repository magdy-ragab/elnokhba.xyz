<?php
defined('BASEPATH') or exit('No direct script access allowed');
$cont = $this->router->fetch_class();
$user = $this->core_model->current_admin();
if (!$this->session->userdata('user')) {
	redirect($this->core_model->admin_dir() . '/home');
	die;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php echo strip_tags($page_title); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-rtl.min.css" />
	<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>assets/css/admin.css" />

	<!-- jQuery library -->
	<script src="<? echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="<? echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?= base_url("assets/js/swipe.js") ?>"></script>
	<script src="<? echo base_url(); ?>assets/js/jquery.form-validator.min.js"></script>
	<script>
		var _report_upload_error = 1;
		var base_url = '<?= base_url() ?>';
		var _admin = '<?php echo base_url() . $this->core_model->admin_dir(); ?>/';
		var _site = '<?php echo base_url() ?>';
		var _user = '<?php echo $this->session->user ?>';

		function panel_fullWidth(elm) {
			el = $("#" + elm);
			if (el.hasClass('col-md-4')) {
				el.removeClass('col-md-4');
				el.addClass('col-md-12');
				$("#" + elm + " img").css('height', 'inherit');
			} else {
				el.removeClass('col-md-12');
				el.addClass('col-md-4');
				$("#" + elm + " img").css('height', '');
			}
		}
	</script>
	<script src="<? echo base_url(); ?>assets/js/admin/admin_panel.js"></script>
	<script src="<? echo base_url(); ?>assets/js/admin/admin.js"></script>
	<?php if ($cont == 'admin_index') { ?>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<?php } ?>

	<style>
		.mt {
			margin-top: 4rem;
		}

		.mb {
			margin-bottom: 4rem;
		}

		.mr {
			margin-right: 4rem;
		}

		.ml {
			margin-left: 4rem;
		}

		.mt-5 {
			margin-top: 5rem;
		}

		.mt-4 {
			margin-top: 4rem;
		}

		.mt-3 {
			margin-top: 3rem;
		}

		.mt-2 {
			margin-top: 2rem;
		}

		.mt-1 {
			margin-top: 1rem;
		}

		.mb-5 {
			margin-bottom: 5rem;
		}

		.mb-4 {
			margin-bottom: 4rem;
		}

		.mb-3 {
			margin-bottom: 3rem;
		}

		.mb-2 {
			margin-bottom: 2rem;
		}

		.mb-1 {
			margin-bottom: 1rem;
		}

		.mr-5 {
			margin-right: 5rem;
		}

		.mr-4 {
			margin-right: 4rem;
		}

		.mr-3 {
			margin-right: 3rem;
		}

		.mr-2 {
			margin-right: 2rem;
		}

		.mr-1 {
			margin-right: 1rem;
		}

		.ml-5 {
			margin-left: 5rem;
		}

		.ml-4 {
			margin-left: 4rem;
		}

		.ml-3 {
			margin-left: 3rem;
		}

		.ml-2 {
			margin-left: 2rem;
		}

		.ml-1 {
			margin-left: 1rem;
		}

		.mx-5 {
			margin-left: 5rem;
			margin-right: 5rem;
		}

		.mx-4 {
			margin-left: 4rem;
			margin-right: 4rem;
		}

		.mx-3 {
			margin-left: 3rem;
			margin-right: 3rem;
		}

		.mx-2 {
			margin-left: 2rem;
			margin-right: 2rem;
		}

		.mx-1 {
			margin-left: 1rem;
			margin-right: 1rem;
		}

		.my-5 {
			margin-top: 5rem;
			margin-bottom: 5rem;
		}

		.my-4 {
			margin-top: 4rem;
			margin-bottom: 4rem;
		}

		.my-3 {
			margin-top: 3rem;
			margin-bottom: 3rem;
		}

		.my-2 {
			margin-top: 2rem;
			margin-bottom: 2rem;
		}

		.my-1 {
			margin-top: 1rem;
			margin-bottom: 1rem;
		}

		.my--1 {
			margin-top: -8px;
			margin-bottom: -8px;
		}

		.pt {
			padding-top: 4rem;
		}

		.pb {
			padding-bottom: 4rem;
		}

		.pr {
			padding-right: 4rem;
		}

		.pl {
			padding-left: 4rem;
		}

		.pt-5 {
			padding-top: 5rem;
		}

		.pt-4 {
			padding-top: 4rem;
		}

		.pt-3 {
			padding-top: 3rem;
		}

		.pt-2 {
			padding-top: 2rem;
		}

		.pt-1 {
			padding-top: 1rem;
		}

		.pb-5 {
			padding-bottom: 5rem;
		}

		.pb-4 {
			padding-bottom: 4rem;
		}

		.pb-3 {
			padding-bottom: 3rem;
		}

		.pb-2 {
			padding-bottom: 2rem;
		}

		.pb-1 {
			padding-bottom: 1rem;
		}

		.pr-5 {
			padding-right: 5rem;
		}

		.pr-4 {
			padding-right: 4rem;
		}

		.pr-3 {
			padding-right: 3rem;
		}

		.pr-2 {
			padding-right: 2rem;
		}

		.pr-1 {
			padding-right: 1rem;
		}

		.pl-5 {
			padding-left: 5rem;
		}

		.pl-4 {
			padding-left: 4rem;
		}

		.pl-3 {
			padding-left: 3rem;
		}

		.pl-2 {
			padding-left: 2rem;
		}

		.pl-1 {
			padding-left: 1rem;
		}

		.px-5 {
			padding-left: 5rem;
			padding-right: 5rem;
		}

		.px-4 {
			padding-left: 4rem;
			padding-right: 4rem;
		}

		.px-3 {
			padding-left: 3rem;
			padding-right: 3rem;
		}

		.px-2 {
			padding-left: 2rem;
			padding-right: 2rem;
		}

		.px-1 {
			padding-left: 1rem;
			padding-right: 1rem;
		}

		.py-5 {
			padding-top: 5rem;
			padding-bottom: 5rem;
		}

		.py-4 {
			padding-top: 4rem;
			padding-bottom: 4rem;
		}

		.py-3 {
			padding-top: 3rem;
			padding-bottom: 3rem;
		}

		.py-2 {
			padding-top: 2rem;
			padding-bottom: 2rem;
		}

		.py-1 {
			padding-top: 1rem;
			padding-bottom: 1rem;
		}

		.pt-1_5 {
			padding-top: 1.5rem;
		}

		.border-right {
			border-right: 1px solid #ccc;
		}

		.border-left {
			border-left: 1px solid #ccc;
		}

		.border-top {
			border-top: 1px solid #ccc;
		}

		.border-bottom {
			border-bottom: 1px solid #ccc;
		}

		.border-y {
			border-right: 1px solid #ccc;
			border-left: 1px solid #ccc;
		}

		.border-x {
			border-top: 1px solid #ccc;
			border-bottom: 1px solid #ccc;
		}

		.border-right-2 {
			border-right-width: 2px
		}

		.border-left-2 {
			border-left-width: 2px;
		}

		.border-top-2 {
			border-top-width: 2px;
		}

		.border-bottom-2 {
			border-bottom-width: 2px;
		}

		.border-y-2 {
			border-right-width: 2px;
			border-left-width: 2px;
		}

		.border-x-2 {
			border-top-width: 2px;
			border-bottom-width: 2px;
		}

		.border-right-3 {
			border-right-width: 3px
		}

		.border-left-3 {
			border-left-width: 3px;
		}

		.border-top-3 {
			border-top-width: 3px;
		}

		.border-bottom-3 {
			border-bottom-width: 3px;
		}

		.border-y-3 {
			border-right-width: 3px;
			border-left-width: 3px;
		}

		.border-x-3 {
			border-top-width: 3px;
			border-bottom-width: 3px;
		}

		.border-right-4 {
			border-right-width: 4px
		}

		.border-left-4 {
			border-left-width: 4px;
		}

		.border-top-4 {
			border-top-width: 4px;
		}

		.border-bottom-4 {
			border-bottom-width: 4px;
		}

		.border-y-4 {
			border-right-width: 4px;
			border-left-width: 4px;
		}

		.border-x-4 {
			border-top-width: 4px;
			border-bottom-width: 4px;
		}

		.border-right-5 {
			border-right-width: 5px
		}

		.border-left-5 {
			border-left-width: 5px;
		}

		.border-top-5 {
			border-top-width: 5px;
		}

		.border-bottom-5 {
			border-bottom-width: 5px;
		}

		.border-y-5 {
			border-right-width: 5px;
			border-left-width: 5px;
		}

		.border-x-5 {
			border-top-width: 5px;
			border-bottom-width: 5px;
		}

		.h5em {
			height: 5rem;
		}

		.ov {
			overflow: hidden;
		}

		.theme_color_select {
			display: inline-block;
			border: 1px solid #ccc;
			width: 40px;
			height: 20px;
			content: "";
			position: relative;
			top: 5px
		}
	</style>


</head>

<body>

	<header id="top-bar">
		<div class="col-xs-3" id="header-right">
			<div class="col-lg-1 text-center" id="logo"><a href="<?php echo base_url() . $this->core_model->admin_dir() . '/admin_index'; ?>"><img src="<?php echo base_url() ?>assets/img/admin/logo-20.png" /></a></div>
			<div class="col-lg-9 hidden-xs hidden-md  d" id="right_title"><a href="<?php echo base_url() . $this->core_model->admin_dir() . '/admin_index'; ?>">لوحة التحكم</a></div>
		</div>
		<div class="col-xs-9 no-pad" id="left-header">
			<div class="col-xs-2 hidden-md hidden-lg hidden-xl text-right no-pad">
				<a href="#" id="sidebar-toggle">
					<span class="glyphicon glyphicon-menu-hamburger"></span>
				</a>
			</div>
			<div class="col-xs-10 col-lg-12 no-pad">
				<div class="col-md-12 text-left" id="new-messages-bar">

					<a data-toggle="tooltip" title="الواجهة الرئيسية للموقع" data-placement="bottom" href="<?php echo base_url() ?>" target="_blank"><span class="glyphicon glyphicon-home"></span></a>
					<?php if ($this->core_model->admin_can('contacts')) { ?><a data-toggle="tooltip" title="رسائل اتصل بنا" data-placement="bottom" href="<?php echo base_url() . $this->core_model->admin_dir() ?>/contacts">
							<span class="glyphicon glyphicon-envelope" data-toggle="tooltip" title="رسائل اتصل بنا" data-placement="bottom"></span>
							<span class="label label-danger contact_count" data-toggle="tooltip" data-placement="bottom" title="رسائل اتصل بنا"><?php echo $this->core_model->contact_unread_count(); ?></span></a><?php } ?>
					<?php if ($this->core_model->admin_can('settings')) { ?><a data-toggle="tooltip" title="إعدادات و خصائص الموقع" href="<?php echo base_url() . $this->core_model->admin_dir() ?>/settings"><span class="glyphicon glyphicon-cog"></span></a><?php } ?>
					<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/admins/mydata" data-toggle="tooltip" data-placement="bottom" title="بياناتي"><i class="glyphicon glyphicon-user"></i></a>

					<a data-toggle="tooltip" title="تغيير كلمة المرور" data-placement="bottom" href="<?php echo base_url() . $this->core_model->admin_dir() ?>/mypasswod"><span class="glyphicon glyphicon-lock"></span></a>
					<a data-toggle="tooltip" title="خروج من لوحة التحكم" href="<?php echo base_url() . $this->core_model->admin_dir() ?>/logout"><span class="glyphicon glyphicon-off"></span></a>
				</div>
			</div>
		</div>
	</header>

	<nav class="col-xs-3 no-pad menu-mobile" id="right-nev" data-is_hidden="yes">
		<div class="row hidden" id="hiddenShowMenu">
			<div class="col-md-6 col-md-offset-6">
				<a href="#" role=button class="btn btn-link btn-xs" id="hideMenu">
					<span class="glyphicon glyphicon-chevron-right"></span> إخفاء
				</a>
			</div>
		</div>
		<ul id="nav-right-ul">
			<li <?php if ($cont == 'admin_index') echo ' class="active"'; ?> data-menuid=<?= ++$menuIndex ?>>
				<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/admin_index"><span class="glyphicon glyphicon-home"></span> <span class="menu-title d">الرئيسية</span> </a>
			</li>


			<?php if ($this->core_model->admin_can('products')) { ?><li<?php if ($cont == 'products') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
					<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/products/view"><span class="glyphicon glyphicon-tags"></span>
						<span class="menu-title d">المنتجات</span> <span class="label label-warning"><?php echo $this->core_model->pages_count(array("module" => 'products')) ?></span></a>
					<ul class="subnav">
						<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/products/add">إضافة منتجات</a></li>
						<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/products/view">عرض منتجات</a></li>
						<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/products/view">منتجات غير مفعلة</a></li>
					</ul>
					</li><?php } ?>

				<?php if ($this->core_model->admin_can('category')) { ?>
					<li <?php if ($cont == 'category') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
						<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/category/view"><span class="glyphicon glyphicon-duplicate"></span>
							<span class="menu-title d">الاقسام</span></a>
						<ul class="subnav">
							<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/category/add">إضافة قسم</a></li>
							<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/category/view">عرض الاقسام</a></li>
						</ul>
					</li><?php } ?>


				<?php /*if ($this->core_model->admin_can('ads')) { ?>
					<li <?php if ($cont == 'ads') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
						<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/ads/view"><span class="glyphicon glyphicon-flag"></span>
							<span class="menu-title d">الإعلانات</span> <span class="label label-warning"><?php echo $this->core_model->pages_count(array("module" => 'ads')) ?></span></a>
						<ul class="subnav">
							<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/ads/add">إضافة إعلان</a></li>
							<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/ads/view">عرض الإعلانات</a></li>
							<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/ads/customize">تخصيص الإعلانات</a></li>
						</ul>
					</li><?php }*/ ?>


				<?php /* if ($this->core_model->admin_can('qr')) { ?><li<?php if ($cont == 'qr') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
    		    <a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/qr/view"><span class="glyphicon glyphicon-duplicate"></span>
		    <span class="menu-title d">الفواتير</span></a>
    		</li><?php } */ ?>




				<?php /*if ($this->core_model->admin_can('discountCodes')) { ?><li<?php if ($cont == 'discountCodes') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
						<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/discountCodes/view"><span class="glyphicon glyphicon-duplicate"></span>
							<span class="menu-title d">اكود الخصومات</span> <span class="label label-warning"><?php echo $this->core_model->pages_count(array("module" => 'pages')) ?></span></a>
						<ul class="subnav">
							<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/discountCodes/add">اضافة كود</a></li>
							<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/discountCodes/view">عرض الاكواد</a></li>
						</ul>
						</li><?php } ?>

					<?php if ($this->core_model->admin_can('brands')) { ?><li<?php if ($cont == 'brands') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
							<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/brands/view"><span class="glyphicon glyphicon-flag"></span>
								<span class="menu-title d">الماركات</span> <span class="label label-warning"><?php echo $this->core_model->pages_count(array("module" => 'brands')) ?></span></a>
							<ul class="subnav">
								<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/brands/add">إضافة ماركة</a></li>
								<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/brands/view">عرض الماركات</a></li>
							</ul>
							</li><?php } ?>

						<?php /*if ($this->core_model->admin_can('promotion')) { ?><li<?php if ($cont == 'promotion') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
    		    <a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/promotion/view"><span class="glyphicon glyphicon-flag"></span>
    			<span class="menu-title d">الترويج</span> <span class="label label-warning"><?php echo $this->core_model->pages_count(array("module" => 'promotion')) ?></span></a>
    		    <ul class="subnav">
    			<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/promotion/add">اضافة ترويج</a></li>
    			<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/promotion/view">عروض ترويج سابقة</a></li>
    		    </ul>
    		</li><?php }*/ ?>




				<?php /* if($this->core_model->admin_can('country')){ ?><li<?php if($cont=='country') echo ' class="active"';?> class="has_sub" data-menuid=<?=++$menuIndex?>>
		  <a href="<?php echo base_url().$this->core_model->admin_dir() ?>/country/view"><span class="glyphicon glyphicon-flag"></span>
		  <span class="menu-title d">الدول و المدن</span> <span class="label label-warning"><?php echo $this->core_model->pages_count(array("module"=>'country')) ?></span></a>
		  <ul class="subnav">
		  <li><a href="<?php echo base_url().$this->core_model->admin_dir() ?>/country/add">إضافة الدول و المدن</a></li>
		  <li><a href="<?php echo base_url().$this->core_model->admin_dir() ?>/country/view">عرض الدول</a></li>
		  </ul>
		  </li><?php  } */ ?>





				<?php /*if ($this->core_model->admin_can('earnings')) { ?><li<?php if ($cont == 'earnings') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
								<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/earnings/view"><span class="glyphicon glyphicon-tags"></span>
									<span class="menu-title d">الارباح</span> </a>
								<ul class="subnav">
									<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/earnings/view">عرض الارباح</a></li>
									<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/earnings/packages">الصفقات</a></li>
								</ul>
								</li><?php } ?>

							<?php if ($this->core_model->admin_can('comments')) { ?><li<?php if ($cont == 'comments') echo ' class="active"'; ?>data-menuid=<?= ++$menuIndex ?>>
									<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/comments/view"><span class="glyphicon glyphicon-tags"></span>
										<span class="menu-title d">التعليقات</span> </a>
									</li><?php }*/ ?>


				<?php if ($this->core_model->admin_can('pages')) { ?><li<?php if ($cont == 'pages') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
						<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/pages/view"><span class="glyphicon glyphicon-duplicate"></span>
							<span class="menu-title d">الصفحات</span> <span class="label label-warning"><?php echo $this->core_model->pages_count(array("module" => 'pages')) ?></span></a>
						<ul class="subnav">
							<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/pages/add">إضافة صفحة</a></li>
							<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/pages/view">عرض الصفحات</a></li>
						</ul>
						</li><?php } ?>

					<?php if ($this->core_model->admin_can('news')) { ?><li<?php if ($cont == 'news') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
							<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/news/view"><span class="glyphicon glyphicon-pushpin"></span>
								<span class="menu-title d">الأخبار</span> <span class="label label-warning"><?php echo $this->core_model->pages_count(array("module" => 'news')) ?></span></a>
							<ul class="subnav">
								<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/news/add">إضافة خبر</a></li>
								<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/news/view">عرض الاخبار</a></li>
							</ul>
							</li><?php } ?>

						<?php /* if ($this->core_model->admin_can('gallery')) { ?><li<?php if ($cont == 'gallery') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
    		    <a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/gallery/view"><span class="glyphicon glyphicon-th-large"></span>
    			<span class="menu-title d">الجاليري</span> <span class="label label-warning"><?php echo $this->core_model->pages_count(array("module" => 'gallery')) ?></span></a>
    		    <ul class="subnav">
    			<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/gallery/add">إضافة صورة</a></li>
    			<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/gallery/view">عرض الصور</a></li>
    		    </ul>
    		</li><?php } */ ?>


						<?php if ($this->core_model->admin_can('slider')) { ?><li<?php if ($cont == 'slider') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
								<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/slider/view"><span class="glyphicon glyphicon-picture"></span>
									<span class="menu-title d">الاسلايدر</span> <span class="label label-info"><?php echo $this->core_model->slider_count() ?></span></a>
								<ul class="subnav">
									<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/slider/add">إضافة صورة</a></li>
									<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/slider/view">عرض الصور</a></li>
								</ul>
								</li><?php } ?>



							<?php if ($this->core_model->admin_can('menu')) { ?><li<?php if ($cont == 'menu') echo ' class="active"'; ?> class="has_sub" data-menuid=<?= ++$menuIndex ?>>
									<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/menu/view"><span class="glyphicon glyphicon-th-list"></span>
										<span class="menu-title d">القائمة</span> <span class="label label-info"><?php echo $this->core_model->menu_count() ?></span></a>
									<ul class="subnav">
										<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/menu/add">إضافة عنصر للقائمة</a></li>
										<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/menu/view">عرض القائمة</a></li>
									</ul>
									</li><?php } ?>

								<?php if ($this->core_model->admin_can('contacts')) { ?><li data-menuid=<?= ++$menuIndex ?><?php if ($cont == 'contacts') echo ' class="active"'; ?> class="has_sub">
										<a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/contacts"><span class="glyphicon glyphicon-envelope"></span> <span class="menu-title d">اتصل بنا</span><span class="label label-danger"><?php echo $this->core_model->contact_unread_count(); ?></span></a>
										<ul class="subnav">
											<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/contacts">عرض الرسائل</a></li>
											<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/contacts/settings">إعدادات صفحة اتصل بنا</a></li>
											<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/contacts/mailsettings">إعدادات خادم الرسائل</a></li>

										</ul>
									</li><?php } ?>

								<?php if ($this->core_model->admin_can('social')) { ?><li data-menuid=<?= ++$menuIndex ?><?php if ($cont == 'social') echo ' class="active"'; ?>><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/social"><span class="glyphicon glyphicon-share-alt"></span> <span class="menu-title d">وسائل التواصل</span></a></li><?php } ?>
								<?php if ($this->core_model->admin_can('admins')) { ?><li data-menuid=<?= ++$menuIndex ?><?php if ($cont == 'admins') echo ' class="active"'; ?> class="has_sub"><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/admins/view"><span class="glyphicon glyphicon-user"></span> <span class="menu-title d">المشرفين</span></a>
										<ul class="subnav">
											<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/admins/add">إضافة مشرفين</a></li>
											<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/admins/view">عرض المشرفين</a></li>
										</ul>
									</li><?php } ?>

								<?php /*if ($this->core_model->admin_can('users')) { ?><li data-menuid=<?= ++$menuIndex ?><?php if ($cont == 'users') echo ' class="active"'; ?> class="has_sub"><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/users/view"><span class="glyphicon glyphicon-user"></span> <span class="menu-title d">الأعضاء</span></a>
										<ul class="subnav">
											<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/users/view">عرض الأعضاء</a></li>
											<!-- <li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/users/sellers">عرض البائعين</a></li> -->
										</ul>
									</li><?php }*/ ?>

								<?php if ($this->core_model->admin_can('settings')) { ?>
									<li data-menuid=<?= ++$menuIndex ?> class="has_sub<?php if ($cont == 'settings') echo ' active'; ?>"><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/settings"><span class="glyphicon glyphicon-cog"></span> <span class="menu-title d">خصائص الموقع</span></a>
										<ul class="subnav">
											<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/settings">إعدادات الموقع</a></li>
											<li><a href="<?php echo base_url() . $this->core_model->admin_dir() ?>/settings/catSettings">إعدادات الاقسام</a></li>
										</ul>
									</li>

								<?php } ?>
		</ul>
	</nav>

	<div class="col-xs-9 no-pad" id="left-content">
		<div class="container-fluid">