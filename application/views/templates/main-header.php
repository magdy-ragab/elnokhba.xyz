<div class="table-row">
											<div class="navbar navbar-responsive-menu d-lg-none">
												<div class="responsive-menu"
												data-toggle="collapse">
													<span class="bar"></span>
													<span class="bar"></span>
													<span class="bar"></span>
												</div>
											</div>
											<div class="m-cart-icon cart-target d-lg-none">
												<a href="<?=base_url()?>cart.html" class="mobile-basket" title="cart">
													<i class="demo-icon icon-electro-cart-icon"></i>
													<span class="number"><span class="n-item" id="cart_qty_top">0</span>
													<span class="cart-prices"></span> جنيه </span>
												</a>
											</div>
											<div class="header-logo">
												<a href="<?=base_url()?>" title="Rawajcart SHop" class="logo-site waiting lazyloaded">
													<img class=" lazyloaded"
														alt="Rawajcart SHop"
							src="<?= base_url("uploads/site/" .
								$this->core_model->get_settings('site_image') );?>">
												</a>
											</div>
											<div class="searchbox d-none d-lg-block">
												<form id="search" class="navbar-form search"
													action="<?= base_url(); ?>search" method="get">
													<input id="bc-product-search" type="text" name="mix_search"
														class="form-control bc-product-search"
														value="<?php if (isset($_GET['search'])) {echo $_GET['search'];}?>"
														placeholder="ابحث عن منتجات" autocomplete="off">
													<button type="submit" class="search-icon">
														<span>
															<i class="demo-icon icon-electro-search-icon"></i>
														</span>
													</button>
												</form>
												<div id="result-ajax-search" class="result-ajax-search">
													<ul class="search-results"></ul>
												</div>
											</div>
											<div class="header-icons d-none d-lg-block">
												<ul class="list-inline">
													<li class="top-cart-holder hover-dropdown">
														<div class="cart-target">
															<a href="javascript:void(0)" class="basket dropdown-toggle" title="cart">
																<i class="demo-icon icon-electro-cart-icon"></i>
																<span class="number"><span class="n-item">0</span>
																<span class="cart-prices"></span> جنيه </span>
															</a>
															<div class="cart-dd">
																<div id="cart-info">
																	<div id="cart-content" class="cart-content">
																		<div class="cart-item-empty">
																			<p>عربة التسوق فارغة</p>
																		</div>
																	</div>
																	<div class="cart-button">
																		<a href="<?= base_url() ?>cart.html">
																			عربة التسوق
																			<i class="fa fa-angle-left"></i>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>