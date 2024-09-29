<!-- shop area start-->
        <div class="shop_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="shop_menu">
                            <ul class="cramb_area cramb_area_5">
                                <li><a href="index.html">الرئيسية /</a></li>
                                <li class="br-active"><a href="#">المنتجات</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                  <div class="row brand-head">
                    <div class="col-md-4">
			<?php if($brand->pic){ ?><img src="<?=base_url()."uploads/brands/".$brand->pic?>" class="img-responsive img-center" alt="<?=$brand->title?>"><?php } ?>
                    </div>
                    <div class="col-md-8">
                        <h1><?=$brand->title?></h1>
                        <?=$brand->content?>
                    </div>
                  </div>
                <!--bar area start-->
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="bar">
                            <div class="bar_box pull-left">
                                    <select id="sortProducts">
                                        <option value="default">الترتيب الافتراضي</option>
                                        <option value="popularity">ترتيب حسب الاكثر شراءا</option>
                                        <option value="rating">ترتيب حسب الاعلى تقييما</option>
                                        <option value="newest">الترتيب حسب الاحدث</option>
                                        <option value="price-height-low">ترتيب حسب السعر : الاعلى الى الاقل</option>
                                        <option value="price-low-height">ترتيب حسب السعر: من الاقل الى الاعلى</option>
                                    </select>
                            </div>
                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div class="row" id="">
                                    <?php $this->shop->productList($rows); ?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <?=$this->pagination->create_links();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <!--shop area end-->
