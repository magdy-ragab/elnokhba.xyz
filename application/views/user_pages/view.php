<main id="pageContentArea">
<!--========================================
Page Head
===========================================-->
    <div class="blog-main-slider color-white text-center" style="">
        <div class="overlay"></div>
        <div class="container">
            <h2>عرض منتجاتك</h2>
        </div>
    </div>
 <br>

<div class="container"> 

<div class="col-sm-3 col-sm-push-9">
            <ul class="nav-email shadow mb-20">
		<li>
                    <a href="<?=base_url()?>productcp/index"><i class="fa fa-user"></i> بياناتي </a>
                </li>
                <li class="active"><a href="<?=base_url()?>sell/view"><i class="fa fa-th-large"></i> منتجاتي </a></li>
               
             
                <li>
                    <a href="<?=base_url()?>sell/index"><i class="fa fa-tag"></i> اضف منتج</a>
                </li>
               
            </ul><!-- /.nav -->
        </div>
    
        <div class="col-sm-9 col-sm-pull-3"> 

    <div class="table-responsive">
        <h1 class="titles">المنتجات التي قمت بإضافتها من قبل</h1>
        <table class="mytable table table-striped col-md-12 table-hover table-condensed">
            <thead>
                <tr>
                    <th class="col-md-1">رقم المنتج</th>
                    <th class="col-md-5">المنتج</th>
                    <th class="col-md-2">السعر</th>
                    <th class="col-md-2">متاح؟</th>
                    <th class="col-md-1">تاريخ الاضافة</th>
                </tr>
            </thead>
            <tbody>
                <?php
		$rows= $this->db->where("`uid`='{$_SESSION['i']}' and `module`='products'")->get('pages')->result();
		if(count($rows))
		{
                foreach( $rows as $row)
                {
                    $url=$this->shop->productURL($row->ID);
                    $row= $this->core_model->product_data($row->ID);
    ?>
                <tr>
                    <td>#<?=$row[ID]?></td>
                    <td><a href="<?=$url?>"><?=$row[title]?></a></td>
                    <td><?php if($row[discount]) {
                        $price=$row[discount];echo "<del>{$row[price]}</del> {$row[discount]}"; 
                        }else{
                            $price=$row['price'];echo $row['price'];
                        } ?></td>
                    <td><a href="<?=base_url()?>sell/availble/<?="{$row['ID']}/{$row['availble']}"?>"><?php echo($row['availble']=='Y')?'نعم':'لا' ?></a></td>
                    <td><?=$row[dateline]?></td>
                </tr>
    <?php

                }
		}else{
		    ?><tr>
    		    	<td colspan="5" class="text-center text-muted">لا توجد منتجات متاحة</td>
    		    </tr><?php
		}
                ?>
            </tbody>
        </table>
    </div>
</div>
</div></main>