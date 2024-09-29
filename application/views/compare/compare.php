<!-- shop area start-->
<div class="page-contentArea adresses-page">
    <div class="container">
	<div class="row">

	    <div class="col-xs-12 col-sm-12 col-md-12" >


		<!-- nav bar -->
		<div class="container">
		    <div class="row">
			<div class="col-sm-3 ">
			    <ul class="nav-email shadow mb-20">
				<li>
				    <a href="<?= base_url() ?>profile">
					<i class="fa fa-th-large"></i> مشترياتي  
				    </a>
				</li>
				<li>
				    <a href="<?= base_url() ?>wishlist"><i class="fa fa-heart"></i> المفضلة</a>
				</li>
				<li  class="active">
				    <a href="<?= base_url() ?>compare"><i class="fa fa-exchange"></i> المقارنات</a>
				</li>
				<li>
				    <a href="<?= base_url() ?>last"><i class="fa fa-tag"></i> الاحدث زيارة</a>
				</li>
				<li>
				    <a href="<?= base_url() ?>setting">
					<i class="fa fa-cog"></i> اعدادات الحساب 
				    </a>
				</li>
			    </ul><!-- /.nav -->
			</div>

			<div class="col-sm-9 ">

			    <!-- resumt -->

			    <div class="row">
				<?php 
				if($_SESSION['compare']){
				$row= $title= $fields=$fields_names= array(); 
				$i=0;
				foreach($_SESSION['compare'] as $id){
				    $rows[$i]= $this->core_model->product_data($id);
				    $title[]= $rows[$i]['title'];
				    foreach($rows[$i]['flat_data'] as $flat=>$v)
				    {
					if(!in_array($flat,$fields_names)){
					    $fields_names[]= $flat;
					}
					$value[$i][$flat]=array($flat, ($v[0])?$v[0]:'-',$v[1],$v[2] );
				    }
				    $i++;
				}
				//echo "<pre dir=ltr align=left>";print_r($rows[0]['ID']);echo "</pre>";?>
				<div class="span12">
				    <div class="table-responsive">
					<table class="table table-condensed table-hover col-md-12">
					    <thead>
						<tr>
						    <th class="text-right">المواصفات</th>
						    <?php foreach($title as $g){ ?>
							<th class="text-right"><?=$g?></th>
						    <?php }?>
						</tr>
					    </thead>
					    <tbody>
						<?php
						$i=0;
						if(count($fields_names)){
						foreach($fields_names as $field){
						?>
						<tr>
    						    <td><?=$field;?></td>
    						    <?php
						    for($j=0;$j<count($title);$j++)
						    {
							if($value[$j][$field][2]== 'color')
							{
							    if($value[$j][$field][1]!='-')
							    {
								echo "<td><span class=\"colorSpan\" style=\"background-color:{$value[$j][$field][1]};\"></span> </td>";
							    }else{
								echo '<td>-</td>';
							    }
							}else
							{
							    echo "<td>{$value[$j][$field][1]}</td>";
							}
						    }
						    ?>
    						</tr>
						<?php
						$i++;
						
						} 
						}?>
						

						<tr>
						    <td> </td>
						    <?php for($j=0;$j<count($title);$j++){?>
						    <td><a class="btn btn-danger" href="<?=$this->shop->productURL($rows[$j]['ID'])?>"><i class="icon-shopping-cart icon-white"></i> عرض »</a></td>
						    <?php }?>
						</tr>
					    </tbody>
					</table>
				    </div>
				</div>
				<?php }else{
				    $this->shop->alert('سلة المقارنات فارغة','error');
				} ?>
			    </div>

			</div>

			<!-- resume -->

		    </div>
		</div>


	    </div><!--conten Coloumn-->

	</div><!--Main row-->
    </div><!--container-->
</div><!--page-contentArea-->
