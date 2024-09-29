
<!-- shop area start-->
<div class="shop_area">
    <div class="container">
	<div class="row">
	    <div class="col-md-12">
		<div class="shop_menu">
		    <ul class="cramb_area cramb_area_2 ">
			<li><a href="index.html">الرئيسية /</a></li>
			<li><a href="#">تأكيد بيانات الدفع</a></li>
		    </ul>
		</div>
	    </div>
	</div>
    </div>
</div>
<!-- shop area end-->
<div class="shopping_cart">
    <div class="container shopping_cart_inner">
	<!--========================================
	Payment process
	===========================================-->  

	<?php
	if ($shipmentID) {
	    /*if( $post['paymethod']=='wire' || $post['paymethod']=='onhome')
	    {*/
		$url= base_url().'profile/myorders';
	    /*}else{*/
		//$url= base_url().'cart/checkOut';
	    /*}*/
	    $this->shop->alert('تم حفظ البيانات. سيتم الآن نقلك لآخر خطوة', 'success', $url);
	    unset($_SESSION['cart']);
	} else {

	    
	  echo form_open(base_url() . 'cart/saveShipmentData');
	    echo form_hidden('fname', $post['fname']);
	    echo form_hidden('lname', $post['lname']);
	    echo form_hidden('email', $post['email']);
	    echo form_hidden('address', $post['address']);
	    echo form_hidden('phone', $post['phone']);
	    echo form_hidden('city', $post['city']);
	    echo form_hidden('notes', $post['notes']);  
	    ?>
    	<div class="row">
    	    <div class="col-md-2 text-muted">الاسم الاول</div>
	    <div class="col-md-10">: <?= $post['fname'] ?></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-2 text-muted">اسم العائلة</div>
	    <div class="col-md-10">: <?= $post['lname'] ?></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-2 text-muted">البريد الالكتروني</div>
	    <div class="col-md-10">: <?= $post['email'] ?></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-2 text-muted">العنوان</div>
	    <div class="col-md-10">: <?= nl2br($post['address']); ?></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-2 text-muted">الهاتف</div>
	    <div class="col-md-10">: <?= $post['phone'] ?></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-2 text-muted">المدينة</div>
	    <div class="col-md-10">: <?= $post['city'] ?></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-2"> ملاحظات</div>
	    <div class="col-md-10 text-muted">: <?= nl2br($post['notes']) ?></div>
    	</div>
    	<div class="clearfix mt20">
    	    <div class="col-xs-6"><a class="col-md-4 btn btn-danger" href='<?= base_url()?>cart.html'> <i class="fa fa-shopping-cart"></i>عودة للسلة </a></div>
    	    <div class="col-xs-6 text-left">
		<button type="submit" name="acceptShipmenyData" value="1" class="col-md-4 btn btn-primary push-left"> <i class="fa fa-check"></i>تأكيد البيانات    </button></div>
    	</div>
	    <?php 
	    echo form_close();
	}
	?>

</div></div>