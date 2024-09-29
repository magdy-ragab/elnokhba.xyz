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
		<th>تاريخ العملية</th>
		<th>المنتج</th>
		<th>السعر</th>
		<th>الكمية</th>
		<th>الاجمالي</th>
		<!-- <th>ربح الموقع</th>
		<th>ربح البائع</th> -->
		<th>العرض</th>
	    </tr>
	</thead>
	<tbody>
	    <?php $i=1;
	    foreach( $this->db->get("cart_items")->result() as $row ) :
		$prod= $this->core_model->product_data($row->product_item);
		?>
	    <tr>
    		<td><?php echo $i; ?></td>
    		<td><?php echo $row->dateline?></td>
		<td><a href="<?=$prod['url']?>" target="_blank"><?=$row->product_title?></a></td>
    		<td><?php if($row->discount):
		    echo "<del class='red'>{$row->price}</del><br />";
		    $price= $row->discount;
		else:
		    $price= $row->price;
		endif;
		echo $price;
		?></td>
    		<td><?php echo $row->count ?></td>
    		<td><?php echo $row->count*$price; ?></td>
    		<!-- <td><?php echo $earning=($price/100)*($row->count*$prod['cat']['price']) ." ({$prod['cat']['price']}%) "; ?></td>
    		<td><?php echo ($row->count*$price)-$earning; ?></td> -->
		<td>
		    <a href="<?=base_url()."new_admin/earnings/details/{$row->ID}"?>" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> التفاصيل</a>
		</td>
    	    </tr>
	    <?php $i++;
	    endforeach; ?>
	</tbody>
    </table>
</div>
