<?php $cont = $this->router->fetch_class(); ?>   <!-- shop area start-->
        <div class="page-contentArea seller-page"  >
        <div class="container">
            <div class="row">
               
                <div class="col-xs-12 col-sm-12 col-md-12" >
                    

    
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <a id="stars" class="btn btn-danger"  href="#tab1" data-toggle="tab"><i class="fa fa-th-large" aria-hidden="true"></i>
                <div class="hidden-xs">المنتجات</div>
            </a>
        </div>
        <div class="btn-group" role="group">
            <a  id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><i class="fa fa-tag" aria-hidden="true"></i>
                <div class="hidden-xs">الطلبات</div>
            </a>
        </div>
        <div class="btn-group" role="group">
            <a  id="promotion" class="btn btn-default" href="#tab3" data-toggle="tab"><i class="fa fa-bullhorn" aria-hidden="true"></i>

                <div class="hidden-xs">الترويج</div>
            </a>
        </div>
        <div class="btn-group" role="group">
            <a  id="reports" class="btn btn-default" href="#tab4" data-toggle="tab"><i class="fa fa-area-chart" aria-hidden="true"></i>

                <div class="hidden-xs">التقارير</div>
            </a>
        </div>
        
    </div>

        <div class="well">
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab1">
            
            <h2><?=$edit?"تعديل منتج":"منتجات معروضة للبيع"?></h2>
          <div class="container">
	<div class="row">
	<div>
    
        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div class="row">
                                    
                                    <?php if(!$edit){$this->shop->productList($rows, true);} ?>
                                    
                                </div>
             </div>
        </div>
	<button class="btn btn-default" onclick="$('#addProd').slideToggle('fast');">أضف منتج جديد </button>
<div class="clearfix"></div>
<?php //print_r($row);
if ($uploads_error) {
    if (is_array($uploads_error)) {
	echo '<div class="alert alert-danger fade in">
			    <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>';
	foreach ($uploads_error as $e)
	    echo "{$e}<br />";
	echo '</div>';
    } else {
	echo '<div class="alert alert-danger fade in">
			    <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>' . $uploads_error . '</div>';
    }
}

if (count($error)) {
    echo '<div class="alert alert-danger fade in">
		    <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>' .
    implode("", $error) . '</div>';
}


if (validation_errors()) {
    echo '<div class="alert alert-danger fade in">
		    <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>' .
    validation_errors() . '</div>';
}
if ($duplicated) {
    echo '<div class="alert alert-danger fade in">
		    <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
		    هذا الصفحة موجود من قبل</div>';
}
if ($id) {
    echo '<div class="alert alert-success fade in">
		    <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
		    تمت إضافة منتج
		    </div>';
}
if ($updated) {
    echo '<div class="alert alert-success fade in">
		    <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
		    تم تعديل المنتج</div>';
}
?>
<div id="addProd" class="<?php if(!$edit) {echo "hiddenElement";}?>">
     
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#product-data" aria-controls="product-data" role="tab" data-toggle="tab">بيانات المنتج</a></li>
    <li role="presentation"><a href="#more-details" aria-controls="more-details" role="tab" data-toggle="tab">تفاصيل اكثر عن المنتج</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">سعر المنتج</a></li>
    <li role="presentation"><a href="#image" aria-controls="image" role="tab" data-toggle="tab">الصور</a></li>
  </ul>

  <!-- Tab panes -->
  <?php
if ($edit) {
    echo form_open_multipart(base_url()  . $cont . "/edit/" . $edit);
} else {
    echo form_open_multipart(base_url()  . $cont . "/addProduct");
}
if ($edit) {
    echo '<input type="hidden" name="id" value="' . $edit . '" />';
}
?>
<input type="hidden" name="meta[price]" id="meta_price" value="" />
<input type="hidden" name="meta[discount]" id="meta_discount" value="" />
<input type="hidden" name="meta[parent_id]" id="meta_parent_cat" value="" />
<input type="hidden" name="content" id="content" value="<?=$row['ID']?>" />
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="product-data">
        
        
        
                        
                                    <label>اسم المنتج </label>
				    <input type="text" placeholder="اسم المنتج" name="title" id="title" data-validation="required" data-validation-error-msg="هذا الحقل مطلوب" value="<?=$row['title']?>">
                                        <div class="clearfix"></div>
                                        <label>وصف المنتج </label>
                                        <textarea class="form-control" rows="3" name="content" id="content" placeholder="من فضلك ادخل وصف المنتج بالتفصيل" data-validation="required" data-validation-error-msg="هذا الحقل مطلوب"><?=$row['content']?></textarea>
                                        
           
					<button name="<?php if ($edit) {echo 'edit_news';}else {echo 'add_news';}?>" value="1" id="add_news" class="btn btn-danger float-left">اضافة منتج</button>
            
            
                        
      </div>
    <div role="tabpanel" class="tab-pane" id="more-details">
                    <label> الفئة </label>
                        <div class="form-group">
                 
                    <select id="cat" name="cat" class="form-control" data-validation="required" data-validation-error-msg="هذا الحقل مطلوب">
                        <option value="" selected="selected">( من فضلك اختر الفئة)</option>
                        <?php echo $this->core_model->catList($row['parent_id']) ?>
                        
                    </select>
                </div> 
        
            <label> الماركة </label>
                        <div class="form-group">
                 
                    <select id="brand" name="brand" class="form-control" data-validation="required" data-validation-error-msg="هذا الحقل مطلوب">
                        <option value="" selected="selected">( من فضلك اختر الماركة)</option>
                        <?php foreach ($this->core_model->pages(array("module" => 'brands')) as $brand) { ?>
    			<option value="<?php echo $brand->ID; ?>"<?php if($brand->ID ==$row['brand']['ID']) echo " selected"; ?>><?php echo $brand->title ?></option>
			<?php } ?>
                        
                    </select>
                </div> 
	    <div id="custom_fields"></div>
        </div>
    <div role="tabpanel" class="tab-pane" id="messages">
            <label> سعر المنتج </label>
            <input type="text" name="meta[price]" id="price" placeholder="سعر المنتج " value="<?=$row['price']?>" data-validation="required" data-validation-error-msg="هذا الحقل مطلوب">
	    <label>  السعر بعد الخصم </label>
            <input type="text" name="meta[discount]" id="discount" value="<?=$row['discount']?>" placeholder=" الخصم ">
            <div class="clearfix" id="priceSum"></div>
            
        
        
      </div>
      
    <div role="tabpanel" class="tab-pane" id="image">

	<br />
        <?php
if (isset($row['pic'])) {
    ?>
    	    <div class="row">
    		<div class="form-group col-md-3 col-md-push-3">
    		    <img src="<?= $row['pic_path'] ?>" class="img-responsive img-rounded img-thumbnail" />
    		</div>
    	    </div>
    <?php
}
?>

	    <div class="row">
		<div class="form-group">
		    <label for="pic" class="col-md-3">الصورة الرئيسية</label>
		    <input type="file" name="pic" class="col-md-9 form-control" id="pic">
		</div>
	    </div>

<?php
for ($i = 1; $i <= 4; $i++) {
    if (isset($row['pics'][$i]['pic'])) {
	?>
		    <div class="row">
			<div class="form-group col-md-3 col-md-push-3">
			    <img src="<?= $row['pics'][$i]['pic_path'] ?>" class="img-responsive img-rounded img-thumbnail" />
			</div>
		    </div>
	<?php
    }
    ?>
    	    <div class="row">
    		<div class="form-group">
    		    <label for="pics_<?= $i ?>" class="col-md-3">صورة #<?= $i ?></label>
    		    <input type="file" name="pics_<?= $i ?>" class="col-md-9 form-control" id="pics_<?= $i ?>">
    		</div>
    	    </div>
    <?php
}
?>
        
      </div>
  </div>
<?php echo form_close(); ?>
</div>    
</div>
	</div>
</div>
        </div>
        <div class="tab-pane fade in" id="tab2">
            <h2> الطلبات </h2>
	    <div id="balance_req" class="text-center">
		رصيدك الحالي
		<span class="badge badge-info"><?=intval($amount);?></span> جنيه
		<a href="#" id="balance_req_toggle" >سحب الرصيد</a>
	    </div>
	    <div id="balance_req_div" class="text-center hiddenElement">
		<?php echo form_open(base_url().'profile/req_balance') ?>
		<label for="amount_req">قيمة المبلغ </label>
		<input type="text" name="amount_req" id="amount_req" />
		<input type="text" name="req" value="سحب" class="btn btn-default" />
		<?php echo form_close(); ?>
	    </div>
	    <br>
            <div class="table-responsive">
            <table class="table">
            <tr>
		<th> كود الطلب</th>
                <th> اسم العميل </th>
                <th> حالة الطلب</th>
		<th> المنتج</th>
                <th> اجمالي المبلغ</th>
		<th>الربح</th>
                <th> تاريخ الاضافة</th>
                <th> الاجراء المتخذ</th>
            </tr>
	    <?php foreach ($this->db->where("uid='{$_SESSION['i']}'")->get("cart_items")->result() as $row){
		$row1=$this->core_model->product_data($row->product_item);
		$cart= $this->db->where("cart_id='{$row->cart_id}'")->get("cart_cache")->row();
	    ?>
            <tr>
                <td><?=$row->ID;?></td>
                <td><?=$cart->fname." ".$cart->lname;?></td>
		<td><?=$this->shop->order_status($cart->status)?></td>
		<td><a href="<?=$row1['url']?>"><?=$row1['title']?></a></td>
                <td><?=$row->price;?></td>
                <td><?php $price=$row->price;
		if($price<5000) $p= '3.5'; else $p=3;
		echo $price-round(($p/$price)*100,2);
		?></td>
                <td><?=$cart->dateline;?></td>
                <td>
                    <a class="btn btn-default"><i class="fa fa-chevron-left" aria-hidden="true"></i> عرض التفاصيل</a>
                </td>
            </tr>
	    <?php } ?>
        
        </table>
            
        </div>
        </div>
        <div class="tab-pane fade in" id="tab3">
            
              <button class="btn btn-default">
                                <i class="fa fa-plus" aria-hidden="true"></i> اضافة كود الخصم
                            </button>
                      <div class="table-responsive">  
            <table class="table">
            <tr>
            <th>
                
                
                    كود الخصم
                </th>
                <th>
                   الكمية
                </th>
                <th>
                    قيمة الخصم
                </th>
                
                <th>
                    تاريخ البدء
                </th>
                <th>
                    تاريخ الانتهاء
                </th>
                 <th>
                    الاجراء المتخذ
                </th>
            </tr>
            <tr>
                <td>
                       3991
                    
                
                </td>
                  <td>
                       10
                    
                
                </td>
                  <td>
                       100 جنيه
                    
                
                </td>
                
                  <td>
                       1/6/2017
                    
                
                </td>
                  <td>
                       1/6/2017
                    
                
                </td>
                <td>
                    <form>
                            <button class="btn btn-default">
                                <i class="fa fa-times" aria-hidden="true"></i> حذف
                            </button>
                        <button class="btn btn-default">
                                <i class="fa fa-pencil" aria-hidden="true"></i> تعديل
                            </button>
                       
                           
                        
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                       3991
                    
                
                </td>
                  <td>
                       10
                    
                
                </td>
                  <td>
                       100 جنيه
                    
                
                </td>
                
                  <td>
                       1/6/2017
                    
                
                </td>
                  <td>
                       1/6/2017
                    
                
                </td>
                <td>
                    <form>
                            <button class="btn btn-default">
                                <i class="fa fa-times" aria-hidden="true"></i> حذف
                            </button>
                        <button class="btn btn-default">
                                <i class="fa fa-pencil" aria-hidden="true"></i> تعديل
                            </button>
                       
                           
                        
                    </form>
                </td>
            </tr>
        
        </table>
        </div>
        </div>
        <div class="tab-pane fade in" id="tab4">
          <div class="col-md-12 column">
    <div class="row clearfix">
        <div class="col-md-3 column">
            <div class="panel panel-default">
                <div class="panel-heading libreStatsPanelHeading">
                    <div class="panel-title">
                        <span>الزوار</span>
                        <a class="fa fa-caret-down pull-right libreStatsPanelHeadingIcon" href="#uniqueVisitor"
                           data-toggle="collapse"></a>
                    </div>
                </div>
                <div class="panel-body libreStatsPanelBody collapse in" id="uniqueVisitor">
                    <div class="row clearfix libreStatsPanelRow">
                        <div class="col-md-8 column libreStatsPanelValueColumn">
                            <p class="libreStatsCount">10</p>
                            <small>زائر فريد</small>
                        </div>
                        <div class="col-md-4 column">
                            <span class="pull-right fa fa-user fa-5x libreStatsIcon"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 column">
            <div class="panel panel-default">
                <div class="panel-heading libreStatsPanelHeading">
                    <div class="panel-title">
                        <span>الانشطة</span>
                        <a class="fa fa-caret-down pull-right libreStatsPanelHeadingIcon" href="#activity"
                           data-toggle="collapse"></a>
                    </div>
                </div>
                <div class="panel-body libreStatsPanelBody collapse in" id="activity">
                    <div class="row clearfix libreStatsPanelRow">
                        <div class="col-md-8 column libreStatsPanelValueColumn">
                            <p class="libreStatsCount">320</p>
                            <small>تعليق جديد</small>
                        </div>
                        <div class="col-md-4 column">
                            <span class="pull-right fa fa-comments-o fa-5x libreStatsIcon"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 column">
            <div class="panel panel-default">
                <div class="panel-heading libreStatsPanelHeading">
                    <div class="panel-title">
                        <span>مشتري</span>
                        <a class="fa fa-caret-down pull-right libreStatsPanelHeadingIcon" href="#user"
                           data-toggle="collapse"></a>
                    </div>
                </div>
                <div class="panel-body libreStatsPanelBody collapse in" id="user">
                    <div class="row clearfix libreStatsPanelRow">
                        <div class="col-md-8 column libreStatsPanelValueColumn">
                            <p class="libreStatsCount">190</p>
                            <small> مشتري جديد</small>
                        </div>
                        <div class="col-md-4 column">
                            <span class="pull-right fa fa-users fa-5x libreStatsIcon"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 column">
            <div class="panel panel-default">
                <div class="panel-heading libreStatsPanelHeading">
                    <div class="panel-title">
                        <span>المبيعات</span>
                        <a class="fa fa-caret-down pull-right libreStatsPanelHeadingIcon" href="#sales"
                           data-toggle="collapse"></a>
                    </div>
                </div>
                <div class="panel-body libreStatsPanelBody collapse in" id="sales">
                    <div class="row clearfix libreStatsPanelRow">
                        <div class="col-md-8 column libreStatsPanelValueColumn">
                            <p class="libreStatsCount">23,145</p>
                            <small>جنيه</small>
                        </div>
                        <div class="col-md-4 column">
                            <span class="pull-right fa fa-dollar fa-5x libreStatsIcon"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
        
      </div>
    </div>
    
            
    
                    
                    

                
                </div><!--conten Coloumn-->
                
            </div><!--Main row-->
        </div><!--container-->
    </div><!--page-contentArea-->
     
    
    
<script>
    $(function () {
        ch();
        $("#country").change(function () {
            ch();
        });
        $("#price, #discount").keyup(function () {
            ch();
        });
    });

    var ch = function ()
    {
        /*$("#coinName").html('');
        $("#priceLocalCointoUSDValue,#discountLocalCointoUSDValue").html('');
        var _o = $("#country option:selected");
        var _coin = _o.data('currencyname');
        var _coinCode = _o.data('currency');
        var _v = _o.data('usd');
        $("#coinName").html(_coin);
        $("#coin_value").html("$1=<code>" + _v + "</code> " + _coin);
        if ($("#price").val())
        {
            var p = parseFloat($("#price").val());
            $("#meta_price").val(parseFloat(p / _v).toFixed(2));
            $("#priceLocalCointoUSDValue").html(parseFloat(p / _v).toFixed(2));
        }
        if ($("#discount").val())
        {
            var p = parseFloat($("#discount").val());
            $("#discountLocalCointoUSDValue").html(parseFloat(p / _v).toFixed(2));
            $("#meta_discount").val(parseFloat(p / _v).toFixed(2));
        }*/
    }


    $("#cat").change(function () {
        var _data = $("#cat option:selected").data('id');
        if (!/\-/.test(_data))
        {
            var _id = _data;
        } else {
            var _ids = (_data).split("-");
            var _id = _ids[0];
        }
        $("#meta_parent_cat").val(_id);
        $.ajax({
            url: "<?php echo base_url() . "Ajax/getFields/" ?>" + _id + "/<?= $edit ?>",
            success: function (ret)
            {
                $("#custom_fields").html(ret);
            }
        });
    });


    $("#cat").trigger('change');
</script>