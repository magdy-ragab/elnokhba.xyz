<!-- shop area start-->
        <div class="page-contentArea adresses-page"  >
        <div class="container">
            <div class="row">
               
                <div class="col-xs-12 col-sm-12 col-md-12" >
                    

<!-- nav bar -->
<div class="container">
<div class="row">
    <div class="col-sm-3 ">
            <ul class="nav-email shadow mb-20">
                <li>
                    <a href="<?=base_url()?>profile">
                        <i class="fa fa-th-large"></i> مشترياتي  
                    </a>
                </li>
                
                <li>
                    <a href="<?=base_url()?>wishlist"><i class="fa fa-heart"></i> المفضلة</a>
                </li>
                <li>
                    <a href="<?=base_url()?>compare"><i class="fa fa-exchange"></i> المقارنات</a>
                </li>
                <li  class="active">
                    <a href="<?=base_url()?>last"><i class="fa fa-tag"></i> الاحدث زيارة</a>
                </li>
                <li>
                    <a href="<?=base_url()?>setting">
                        <i class="fa fa-cog"></i> اعدادات الحساب 
                    </a>
                </li>
            </ul><!-- /.nav -->
        </div>
    
    <div class="col-sm-9 ">
        
        <!-- resumt -->
        
         <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div class="row">
                                    <?php $this->shop->productList($rows); ?>
                                </div>
             </div>
        </div>
        
        </div>
        
        <!-- resume -->

    </div>
</div>

                
                </div><!--conten Coloumn-->
                
            </div><!--Main row-->
        </div><!--container-->
    </div><!--page-contentArea-->