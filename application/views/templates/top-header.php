<div class="top-bar border-top-false d-none d-lg-block">
									<div class="container">
										<div class="table-row">
											<div class="header-contact-box">
												<ul class="list-inline social-icons">
													<?php $this->core_model->get_all_social();?>
												</ul>
											</div>
											<div class="top-bar-right">
												<ul class="list-inline">
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
											</div>
										</div>
									</div>
								</div>