<div class="mobile-version" id="navbarResponsive">
	<div class="menu-mobile navbar">
		<div class="mm-wrapper">
			<div class="nav-collapse is-mobile-nav">
				<ul class="main-nav">
					<li class="mobile-layout-bar">
						<div class="m-block-icons list-inline">
							<div class="m-customer-account text-center">
								<a href="/login" title="حسابي">
									<i class="demo-icon icon-electro-user-icon"></i>
								</a>
							</div>
						</div>
					</li>
					<li class="dropdown">
						<div class="dropdown-inner">
							<a href="#" class="dropdown-link">
								<span>المنتجات</span>

							</a>
							<span class="expand"></span>
						</div>

						<ul class="dropdown-menu">
							<li class="back-prev-menu"><span class="expand back">إنهاء</span></li>
							<?php foreach ( $this->shop->getHomeCats() as $row) { ?>
							<li><a tabindex="-1" href="<?=base_url($row->ID)?>"><span><?=$row->title?></span></a></li>
							<?php } ?>
						</ul>
					</li>
					
							<?php foreach ($this->core_model->menu([], 1000, 0, 'menu_order', 'ASC')
								as $menu) {
								if (str_replace(
									"**",
									base_url(),
									$menu->url
								) != base_url()) {
							?>
									<li>
										<a href="<?php
															echo
															str_replace(
																"**",
																base_url(),
																$menu->url
															) ?>">
											<?= $menu->title ?>
										</a>
									</li>
							<?php }
							} ?>
						
					
				</ul>
				<div class="row">
					<div class="col-12">
						<ul class="list-inline" id="mobileMenuSocial">
							<?php $this->core_model->get_all_social('text-center text-muted"'); ?>
						</ul>
					</div>
					<div class="col-12">
						<ul class="list-inline" id="mobileMenuBottomLinks">
							<?php if ($_SESSION['i']) { ?>
								<li><a class="account" href="<?= base_url() ?>logout">تسجيل الخروج</a></li>
								<li><a class="account" href="<?= base_url() ?>profile">عضويتك</a></li>
							<?php } else { ?><li>
									<a class="account" href="<?= base_url() ?>login">تسجيل الدخول</a>
								</li>
							<?php } ?>
							<li>
								<a class="wishlist" href="<?= base_url() ?>profile">مشترياتي</a>
							</li>
							<li>
								<a class="Shopping cart" href="<?= base_url() ?>cart">سلة التسوق</a>
							</li>
						</ul>
					</div><!-- / .col-12 -->
				</div><!-- / .row -->
			</div>
		</div>
	</div>
</div>