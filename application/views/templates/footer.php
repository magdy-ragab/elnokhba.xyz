</main>
	<!-- /main -->
		
	<footer class="revealed mt-1">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-3" id="footer-logo">
					<div class="text-center"><a href="<?=base_url()?>">
						<img
							src="<?=base_url("theme/icons/icon-logo.png")?>"
							width="256"
							height="256"
							alt="<?=$this->core_model->get_settings('title');?>"
							class="img-responsive"
							loading=lazy>
					</a></div>
					<div class="text-center">
						الرياض للمفروشات
					</div>
				</div><!-- / .col-md-6 col-lg-3 -->
				<div class="col-md-6 col-lg-3">
					<h3 data-target="#collapse_1">القائمة</h3>
					<div class="collapse dont-collapse-sm links" id="collapse_1">
						<ul>
							<?php $this->load->view("templates/menu", ["parent_id"=>0,"get_subs"=>false]);?>
						</ul>
					</div>
				</div><!-- ./ col-md-6 col-lg-3 -->
				<div class="col-md-6 col-lg-3">
					<h3 data-target="#collapse_3">اتصل بنا</h3>
					<div class="collapse dont-collapse-sm contacts" id="collapse_3">
						<ul>
							<li class="text-bold">الرقم الاساسي</li>
							<li>
								<a href="https://wa.me/966592951043">
									<span class="fa fa-whatsapp"></span> 966592951043
								</a>
							</li>
							<li>
								<a href="tel:966510087865">
									<span class="fa fa-phone"></span> 966510087865
								</a>
							</li>
							<li class="text-bold">رقم المشاريع</li>
							<li>
								<a href="https://wa.me/966592951043">
									<span class="fa fa-whatsapp"></span> 966592951043
								</a>
							</li>
							<li>
								<a href="tel:966592951043">
									<span class="fa fa-phone"></span> 966592951043
								</a>
							</li>
						</ul>
					</div>
				</div><!-- ./ col-md-6 col-lg-3 -->
				<div class="col-md-6 col-lg-3 text-white">
					<h3 data-target="#collapse_4">العنوان</h3>
						<p class="m-md-t-2">
							الرياض المنفوحه حراج بن قاسم القديم سوق العرب الدولي	
						</p>
						<ul class="social"><?php echo $this->core_model->get_all_social();?>
						<!--<li><a href="#" class="tiktok social-icon">
							<img src="<?=base_url('theme/img/tiktok.png')?>" class="img-fluid">
						</a></li> -->

					</ul>
				</div><!-- ./ col-md-6 col-lg-3 -->
			</div>
			<!-- /row-->
			<hr>
			<div class="row add_bottom_25">
				<div class="col-lg-12 text-center text-white">
					powered by
					<a href="//horusxteam.com" target="_blank">
						<b>horusxteam.com</b>
					</a>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->
	</div>
	<!-- page -->
	
	<div id="toTop"></div><!-- Back to top button -->
	<div id="whatsapp_icon">
		<div class="whatsapp-row">
			<div id="whatsapp_icon_close">
				<span class="fa fa-close"></span>
			</div>
			<div class="whatsapp-col">
				<a href="https://wa.me/966592951043">
					<img
						src="<?=base_url("theme/icons/whatsapp.png")?>"
						alt="whatsapp"
						width="64"
						height="68"
						loading=lazy>
					<span>966592951043</span>
				</a>
			</div><!-- / .whatsapp-col -->
			<div class="whatsapp-col">
				<a href="https://wa.me/966510087865">
					<img
						src="<?=base_url("theme/icons/whatsapp.png")?>"
						alt="whatsapp"
						width="64"
						height="68"
						loading=lazy>
					<span>966510087865</span>
				</a>
			</div><!-- / .whatsapp-col -->
			<div class="whatsapp-col">
				<a href="https://wa.me/966575420360">
					<img
						src="<?=base_url("theme/icons/whatsapp.png")?>"
						alt="whatsapp"
						width="64"
						height="68"
						loading=lazy>
					<span>0575420360</span>
				</a>
			</div><!-- / .whatsapp-col -->
		</div><!-- / .whatsapp-row -->
		<div class="whatsapp-menu">
			<img
				src="<?=base_url("theme/icons/whatsapp.png")?>"
				alt="whatsapp"
				width="64"
				height="68"
				loading=lazy>
		</div>
	</div><!-- / #whatsapp-icon -->
	<!-- COMMON SCRIPTS -->
    <script src="<?=base_url("theme/js/")?>common_scripts.min.js"></script>
    <script src="<?=base_url("theme/js/")?>main.js"></script>
	
	<!-- SPECIFIC SCRIPTS -->
	<script src="<?=base_url("theme/js/")?>carousel-home.min.js"></script>

	<script>
		$(function() {
			// click (touch) whatsapp icon (mobile)
			$(".whatsapp-menu img") . click( function () {
				$(".whatsapp-row") . toggle();return false;
			});

			// click whatsapp close button (mobile)
			$('#whatsapp_icon_close'). click ( function () {
				$(".whatsapp-row") . hide();return false;
			});
		});
	</script>
	<?php if (isset($lightbox) && $lightbox == true) {?>
		<!-- lightbox -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/lightbox/lightbox.min.css">
		<script src="<?=base_url()?>assets/js/lightbox/lightbox-plus-jquery.min.js"></script>
		<script>
		lightbox.option({
			'resizeDuration': 200,
			'wrapAround': true,
			alwaysShowNavOnTouchDevices: true ,
			albumLabel: "صورة %1 من %2",
			wrapAround: true
		})

		$("#lightboxOpen") . click ( function () {
			$("#pic_0") . trigger ( 'click' );
			return false;
		} )
		</script>
<!-- / lightbox -->
<?php }?>

<!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16544950222"></script>
<script>
	window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-16544950222');
</script>
</body>
</html>