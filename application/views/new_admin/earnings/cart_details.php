<?php 
$cont= $this->router->fetch_class();
?><div class="clearfix">
    <a href="javascript:window.print();" class="print_hidden"><span class="glyphicon glyphicon-print"></span></a>
    
    <div class="row">
	<h2 class="title titles">عرض تفاصيل الصفقة</h2>
	<div class="col-md-8">
	    <div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
		    <tr>
			<th>رقم المنتج</th>
			<td colspan="3">:<?=$row->product_item?></td>
		    </tr>
		    <tr>
			<th>المنتج</th>
			<td colspan="3">:<?=$row->product_title;?> 
			    <span class="btn group">
				<a target="_blank" href="<?=$prod['url']?>"><span class="glyphicon glyphicon-link"></span></a>
			    </span>
			</td>
		    </tr>
		    <tr>
			<th>عدد الوحدات</th>
			<td colspan="3">:<?=$row->count?></td>
		    </tr>
		    <tr>
			<th>السعر</th>
			<td>:<?=$row->price?></td>
			<th>الخصم</th>
			<td>:<?=$row->discount?></td>
		    </tr>
		    <tr>
			<th>الإجمالي</th>
			<td colspan="3" class="text-center">
			    <?="{$row->count}x{$price} = " .$row->count*$price?>
			</td>
		    </tr>
		    <!-- <tr>
			<th>ربح الموقع</th>
			<td>:<?=$earning=($price/100)*($row->count*$prod['cat']['price']) ." ({$prod['cat']['price']}%) "?></td>
			<th>ربح البائع</th>
			<td>:<?=($row->count*$price)-$earning?></td>
		    </tr> -->
		    <tr>
			<th>حالة الطلب</th>
			<td colspan="3">:
			<?php 
			echo $this->shop->order_status($row->order_status);?>
			&nbsp;&nbsp;&nbsp;&nbsp;    
			<select id="changeOrderStatus" data-id="<?=$id?>">
			    <option value="standby">تم تلق الطلب</option>
			    <option value="collectinCenter">مركز تجميع الطلبات</option>
			    <option value="sent">تم الإرسال</option>
			</select>
			</td>
		    </tr>
		</table>
	    </div>
	    
	    <div class="table-responsive">
		<h3>بيانات المشتري</h3>
		<table class="table table-striped table-bordered table-hover">
		    <tr>
			<th>الاسم الأول</th>
			<td><?php echo $cart_data->fname ?></td>
		    </tr>
		    <tr>
			<th>اللقب</th>
			<td><?php echo $cart_data->lname ?></td>
		    </tr>
		    <tr>
			<th>البريد الإلكتروني</th>
			<td><?php echo $cart_data->email?></td>
		    </tr>
		    <tr>
			<th>العنوان</th>
			<td><?php echo nl2br($cart_data->address);?></td>
		    </tr>
		    <tr>
			<th>المدينة</th>
			<td><?php echo $cart_data->city?></td>
		    </tr>
		    <tr>
			<th>ملاحظات</th>
			<td><?php echo nl2br($cart_data->notes);?></td>
		    </tr>
		    <tr>
			<th>الهاتف</th>
			<td><?php echo $cart_data->phone;?></td>
		    </tr>
		</table>
	    </div>
	    
	</div>
	
	<div class="col-md-4">
	    <h3>منتجات في نفس الطلبية</h3>
	    <div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
		<?php $total=0;
		foreach( $this->shop->fullCart($row->cart_id) as $row ):
		    //var_dump($row);
		    ?>
		    <tr>
			<th><a href="<?=base_url()."new_admin/earnings/details/{$row['cart']['ID']}";?>"><?=mb_substr($row['cart']['product_title'],0,20,"utf-8")?></a><br />
			</th>
			<td class="ltr"><?php if($row['cart']['discount'])
			    {
					$price=$row['cart']['discount'] ;
					echo "<del class=\"red\">{$row['cart']['price']}</del><br />";
			    }else{
					$price=$row['cart']['price'];
			    }
			    	echo "{$price}x{$row['cart']['count']} = ". ($price*$row['cart']['count']);
			    	$total += ($price*$row['cart']['count']);
			    ?></td>
    		    </tr>
		    <tr>
			<td colspan="2" class="text-left text-muted"><?php echo $this->shop->order_status($row['cart']['order_status']); ?></td>
    		    </tr>
		    <?php
		endforeach;
		?>
		    <tr>
			<td colspan="2" class="text-left"><strong><?=$total;?></strong></td>
		    </tr>
		</table>
	    </div>
	    
	    <?php /* <h3>بيانات البائع</h3>
	    <div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
		    <tr>
			<th>الاسم</th>
			<td><?=$user->username;?></td>
		    </tr>
		    <tr>
			<th>الموبايل</th>
			<td><?=$user->email;?></td>
		    </tr>
		    <tr>
			<th>الاسم الاول</th>
			<td><?=$user->fname;?></td>
		    </tr>
		    <tr>
			<th>اللقب</th>
			<td><?=$user->lname;?></td>
		    </tr>
		    <tr>
			<th>الهاتف</th>
			<td><?=$user->tel;?></td>
		    </tr>
		</table>
	    </div> */ ?>
	</div>
    </div>
    
    
</div>