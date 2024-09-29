<?php $cont = $this->router->fetch_class(); ?> <!-- shop area start-->
<div class="page-contentArea adresses-page"  >
    <div class="container">
	<div class="row">

	    <div class="col-xs-12 col-sm-12 col-md-12" >


		<!-- nav bar -->
		<div class="container">
		    <div class="row">
			<div class="col-sm-3 ">
			    <ul class="nav-email shadow mb-20">
				<?php if($_SESSION['type']=='seller'){ ?>
				<li <?php
				if ($cont == 'profile') {
				    echo ' class="active"';
				}
				?>>
				    <a href="<?= base_url(); ?>profile/addProduct">
					<i class="fa fa-th-large"></i>  اضافة منتج
				    </a>
				</li>
				<li <?php
				if ($cont == 'profile') {
				    echo ' class="active"';
				}
				?>>
				    <a href="<?= base_url(); ?>profile/viewProducts">
					<i class="fa fa-th-large"></i>  عرض منتج
				    </a>
				</li>
				<?php }else{ ?>
				<li <?php
				if ($cont == 'profile') {
				    echo ' class="active"';
				}
				?>>
				    <a href="<?= base_url(); ?>profile/myorders">
					<i class="fa fa-th-large"></i> مشترياتي
				    </a>
				</li>
				<?php } ?>
				<?php /* <li>
				    <a href="<?=base_url()?>wishlist"><i class="fa fa-heart"></i> المفضلة</a>
				</li>
				<?php /*<li>
				    <a href="<?= base_url(); ?>compare"><i class="fa fa-balance-scale"></i> المقارنات</a>
				</li>
				<li>
				    <a href="<?= base_url(); ?>last"><i class="fa fa-tag"></i> الاحدث زيارة</a>
				</li>*/ ?>
				<li>
				    <a href="<?= base_url(); ?>setting">
					<i class="fa fa-cog"></i> اعدادات الحساب
				    </a>
				</li>
			    </ul><!-- /.nav -->
			</div>

			<div class="col-sm-9 ">

			    <!-- oy last order -->
			    <?php foreach ($this->db->where("`uid`='{$_SESSION['i']}'")->get('cart_cache')->result() as $row) { ?>
    			    <div class="table-responsive myorderlist">
    				<div class="row">
    				    <h3><strong class="text-muted">رقم الطلب</strong> #<?= $row->ID; ?></h3>
    				</div>
    				<div class="row"><div class="col-md-9">
    					<table class="mytable">
    					    <thead>
    						<tr>
    						    <th>المنتج</th>
    						    <th>الكمية</th>
    						    <th>السعر</th>
    						    <th>الشحن</th>
    						    <th>الاجمالي</th>
    						</tr>
    					    </thead>
    					    <tbody>
						    <?php
						    $total= 0;
						    foreach ($this->db->where("cart_id='{$row->cart_id}'")->get("cart_items")->result() as $items) {
								// var_dump($items);
							$id= $items->ID;
							$back_requested= $items->back_requested;
							$back= $items->back;
							$item = $this->core_model->product_data($items->product_item);
							if ($item['ID']) {
							    ?>
	    						<tr>
	    						    <td class="text-right">
								<?php /* <span class="dropdown">
								    <button class="btn btn-primary btn-xs dropdown-toggle<?php if($back=='Y') echo " disabled" ?>" type="button" id="dropdownMenu<?=$row->ID?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<?php
									if($back_requested=='Y'){
									    if($back=='Y'){
										echo "تم الإرجاع";
									    }else{
										echo "إرجاع المنتج";
									    }
									}else{
									echo "المنتج";
									}
									?>
								      <span class="caret"></span>
								    </button>
								    <?php if($back!='Y'){ ?><ul class="dropdown-menu" aria-labelledby="dropdownMenudropdownMenu<?=$row->ID?>">
								      <li><a href="<?=$item['url']?>#comment">تقييم المنتج</a></li>
								      <li><a href="<?=base_url()."profile/sellback/{$id}"?>">إرجاع المنتج</a></li>
								    </ul><?php } ?>
								</span> */ ?>
								<a href="<?= $item['url'];?>"><?php
								if($item['back']=='Y') echo "<del class=red>";
								echo $items->product_title;
								if($item['back']=='Y') echo "</del>";?></a>
							    </td>
							    <td class="text-right"><?=($items->count?$items->count:1); ?></td>
	    						    <td class="text-right"><?php
							    if($back!='Y')
							    {
								if ($items->discount)
								{
								    echo "<del class='old-price'>{$items->price}</del> {$items->discount}";
								    $price = $items->discount;
								} else {
								    echo $items->price;
								    $price = $items->price;
								}
								$total+= $items->shipping_price+($price*$items->count);
								echo " جنيه ";
							    }
									?>  </td>
								<td><?=$items->shipping_price?></td>
							    <td class="text-right"><?php
							    if($back!='Y')
							    {
								echo $items->shipping_price+($price*$items->count)." جنيه ";
							    } else{
								echo "<del class=red>". $items->shipping_price+($price*$items->count) ." جنيه </del>";

							    }  ?> </td>
	    						</tr>
	<?php }
    } ?>
    					    </tbody>
    					</table>
    				    </div>
				    <div class="col-md-3 text-center">
					<h1>الإجمالي</h1>
					<h3><?=$total;?> جنيه</h3>
				    </div>
    				</div>
    			    </div>
    			    <hr>
<?php } ?>
			</div>

			<!-- resume -->

		    </div>
		</div>


	    </div><!--conten Coloumn-->

	</div><!--Main row-->
    </div><!--container-->
</div><!--page-contentArea-->
