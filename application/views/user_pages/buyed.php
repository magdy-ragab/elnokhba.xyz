<main id="pageContentArea">
<!--========================================
Page Head
===========================================-->
    <div class="blog-main-slider color-white text-center" style="">
        <div class="overlay"></div>
        <div class="container">
            <h2>مشترياتك</h2>
        </div>
    </div>

<div class="container">
    <div class="table-responsive">
        <h1 class="titles">سابقة مشترياتك</h1>
        <table class="mytable table table-striped col-md-12 table-hover table-condensed">
            <thead>
                <tr>
                    <th class="col-md-1">رقم المنتج</th>
                    <th class="col-md-5">المنتج</th>
                    <th class="col-md-2">السعر</th>
                    <th class="col-md-2">الكمية</th>
                    <th class="col-md-1">الاجمالي</th>
                    <th class="col-md-1">التاريخ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach( $cart as $row)
                {
    ?>
                <tr>
                    <td>#<?=$row->product_item?></td>
                    <td><a href="<?=$this->shop->productURL($row->product_item)?>"><?=$row->product_title?></a></td>
                    <td><?php if($row->discount) {
                        $price=$row->discount;echo "<del>{$row->price}</del> {$row->discount}"; 
                        }else{
                            $price=$row->price;echo $row->price;
                        } ?></td>
                    <td><?=$row->count?></td>
                    <td><?=$price*$row->count;?></td>
                    <td><?=$row->dateline?></td>
                </tr>
    <?php

                }
                ?>
            </tbody>
        </table>
    </div>

</div></main>