
<!--=======Page Content Area=========-->   
<main id="pageContentArea">
    <header class="page-head text-center">
        <div class="blog-main-slider" style="background-image:url('../assets/img/b16.jpg'); no-repeat">
            <div class="overlay"></div>
            <div class="container">
                <h2>اضف منتج </h2>
                <p>من هنا يمكنك اضافة منتج جديد</p>
            </div>
        </div>
    </header>
 
<!--========================================
add products content
===========================================-->
     
    <div class="page-contentArea adresses-page pt-50 pb-50"  >
        <div class="container">
            <div class="row">
               
                <div class="col-xs-12 col-sm-12 col-md-12" >
                    

<!-- nav bar -->
<div class="container">
<div class="row">
    <div class="col-sm-3 col-sm-push-9">
            <ul class="nav-email shadow mb-20">
		<li class="active">
                    <a href="<?=base_url()?>productcp/index"><i class="fa fa-user"></i> بياناتي </a>
                </li>
                <li>
                    <a href="<?=base_url()?>sell/view">
                        <i class="fa fa-th-large"></i> منتجاتي  
                    </a>
                </li>
               
             
                <li>
                    <a href="<?=base_url()?>sell/index"><i class="fa fa-tag"></i> اضف منتج</a>
                </li>
               
            </ul><!-- /.nav -->
        </div>
    
        <div class="col-sm-9 col-sm-pull-3">
        
        <!-- resume -->
        <div class="panel panel-default">
               <div class="panel-heading resume-heading">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="col-xs-12 col-sm-4">
			   <?php if($user->pic){ ?>
                           <figure>
                              <img class="img-circle img-responsive profile-img" alt="<?="{$user->fname} {$user->lname}";?>" src="<?=base_url()."uploads/user/{$user->pic}"?>">
                           </figure>
			   <?php } ?>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                           <ul class="list-group">
                              <li class="list-group-item"><i class="fa fa-user"></i> <?php echo "{$user->fname} {$user->lname}"; ?></li>
                              <li class="list-group-item"><i class="fa fa-flag"></i> <?php echo $user->country ?></li>
                              <li class="list-group-item"><i class="fa fa-map-marker"></i> <?php echo nl2br($user->address); ?></li>
                              <li class="list-group-item"><i class="fa fa-phone"></i> <?php echo $user->tel?> </li>
                              <li class="list-group-item"><i class="fa fa-envelope"></i> <?php echo $user->email ?></li>
                           </ul>
			    <p class="text-left"><a href="<?=base_url()?>sellerData/index">تغيير بياناتك</a></p>
                        </div>
                     </div>
                  </div>
               </div>
                   
                    
                            
                                                           
            
                    </div>
                    
        
        </div>
        
        <!-- resume -->

    </div>

                
                </div><!--conten Coloumn-->
                
            </div><!--Main row-->
        </div><!--container-->
    </div><!--page-contentArea-->
</main></div>