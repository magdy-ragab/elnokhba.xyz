<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid whitebg">
<div class="page-header droid col-md-12">
	<h1> <?php echo $this->core_model->text2title($page['title']);?> </h1>
</div>

<?php
if($page['pic'])
{
	?><div class="col-md-12"><img src="<?php echo base_url()."uploads/news/".$page['pic'] ?>" alt="<?php echo $page['title']?>" class="img-bordered img-rounded img-responsive" /></div><?php
} 
echo $page['content']; ?>
</div>