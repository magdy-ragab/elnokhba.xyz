<?php $cont = $this->router->fetch_class() ?><div class="page-header"><h1>الارباح</h1></div>
<div class="row">
    <div class="col-md-10">
	<ul class="breadcrumb">
	    <li><a href="<?php echo $admin_dir ?>/admin_index">الرئيسية</a></li>
	    <li>الارباح</li>
	</ul>
    </div>
    <div class="col-md-2 hidden-xs">
	<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle"
	   data-toggle="dropdown">الارباح <span class="caret"></span></a>
	<ul class="dropdown-menu">
	    <li><a href="<?php echo $admin_dir ?>/<?php echo $cont ?>/add">الارباح</a></li>
	    <li class="disabled"><a href="<?php echo $admin_dir ?>/<?php echo $cont ?>/user">ارباح الاعضاء</a></li>
	</ul>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
	<thead>
	    <tr>
		<th>#</th>
		<th>الزبون</th>
		<th>السعر</th>
		<th> بعد الخصم</th>
		<th>عدد القطع</th>
		<th>تاريخ الطلب</th>
		<th>التفاصيل</th>
	    </tr>
	</thead>
	<tbody>
	    <?php $i=1;
	    foreach( $this->db->get("cart_cache")->result() as $row ) :
		$items= $this->shop->cart_cache_data($row->cart_id);
		?>
	    <tr>
    		<td><?php echo $i; ?></td>
    		<td><?php echo "{$row->fname} {$row->lname}";?></td>
    		<td><?php echo $row->dateline?></td>
    		<td><?php echo $items['price'];?></td>
    		<td><?php echo $items['discount'];?></td>
    		<td><?php echo $items['count'];?></td>
		<td>
		    <a href="<?=base_url()."new_admin/earnings/cart_details/{$row->cart_id}"?>" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> التفاصيل</a>
		</td>
    	    </tr>
	    <?php $i++;
	    endforeach; ?>
	</tbody>
    </table>
</div>
