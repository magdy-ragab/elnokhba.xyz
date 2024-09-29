<!-- banner1 -->
	<div class="banner1">
		<div class="container">
		<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo base_url();?>">الرئيسية</a></li>
	<li class="breadcrumb-item active">قائمة الطعام</li>
</ol>
		</div>
		
	</div>
<!-- //banner1 -->


<div class="container single">




<div class="row1" style="margin-bottom: 30px;">
	<h1 class="animated fadeInLeftBig titles" data-wow-duration="1000ms" data-wow-delay="300ms">قائمة الطعام</h1>
</div>

<section class="content portfolio medium-images">
	<div class="row sub_content">
		<div class="row1">
			
			
<div class="container" id="gallery-show">
<div class="gallery-row">
<?php 
foreach ( $this->core_model->gallery_mini(array('module'=>'gallery', 'active'=>'Y')) as $row ){
?>
<div class="col-md-4 gallery-grids grid">
        <figure class="effect-ming wow zoomIn animated" data-wow-delay=".5s"> 
        <a href="<?php echo base_url()."gallery/". $row['ID'] ; ?>">
			<img src="<?php echo base_url()."uploads/gallery/". $row['thumbnail'] ; ?>" alt="" class="img-responsive" />

          <figcaption>
            <h5><?php echo $row['title'];?></h5>
          </figcaption>
          </a>
          <span class="price"><?php echo $row['price']?></span>
          </figure>
      </div>
<?php }?>	

</div>
</div>
</section>
</div>
