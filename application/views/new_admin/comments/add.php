<?php $cont = $this->router->fetch_class(); ?><div class="page-header"><h1><?php echo $page_title ?></h1></div>
<div class="row">
    <div class="col-md-10">
	<ul class="breadcrumb">
	    <li><a href="<?php echo $admin_dir ?>/admin_index">الرئيسية</a></li>
	    <li>إضافة منتج</li>
	</ul>
    </div>
    <div class="col-md-2 hidden-xs">
	<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle" data-toggle="dropdown"><?php echo $titles[0] ?> <span class="caret"></span></a>
	<ul class="dropdown-menu">
	    <li class="disabled"><a href="<?php echo "{$admin_dir}/{$cont}/add"; ?>" class="disabled"><?php echo $titles[0] ?></a></li>
	    <li><a href="<?php echo "{$admin_dir}/{$cont}/view"; ?>"><?php echo $titles[1] ?></a></li>
	</ul>
    </div>
</div>

<?php
if ($edit) {
    echo form_open_multipart($this->core_model->admin_dir() . "/" . $cont . "/edit/" . $edit);
} else {
    echo form_open_multipart($this->core_model->admin_dir() . "/" . $cont . "/add");
}
if ($edit) {
    echo '<input type="hidden" name="id" value="' . $edit . '" />';
}
?>
<input type="hidden" name="meta[price]" id="meta_price" value="" />
<input type="hidden" name="meta[discount]" id="meta_discount" value="" />
<input type="hidden" name="meta[parent_id]" id="meta_parent_cat" value="" />
<input type="hidden" name="content" id="content" value="<?=$row['content']?>" />
<input type="hidden" name="cat_chain" id="cat_chain" value="<?=$row['cat_chain']?>" />
<div class="panel panel-default">
    <div class="panel-heading">
	<h4 class="panel-title"><?php echo $page_title ?></h4>
    </div>
    <div class="panel-body">
	<div class="container-fluid">
	    <?php
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
	    <div class="row">
		<div class="form-group">
		    <label for="title" class="col-md-3">اسم المنتج</label>
		    <input type="text" class="form-control col-md-9" name="title" id="title" value="<?php echo $row['title'] ?>" data-validation="required" data-validation-error-msg="اسم المنتج" />
		</div>
	    </div>
	    
	    <div class="row">
		<label class="col-md-3">SKU (كود التخزين التعريفي)</label>
		<input type="text" class="form-control col-md-9"
		placeholder="كود التخزين التعريفي" name="SKU" id="SKU" data-validation="required" data-validation-error-msg="هذا الحقل مطلوب" value="<?= $row['SKU'] ?>">
	    </div>
	    
	    <div class="row">
		<label class="col-md-3">خيارات المراجعة</label>
		<select class="form-control col-md-9"
		name="availble" id="availble">
		    <option value="Y"<?php if($row['availble']=='Y') echo " selected"; ?>>تمت الموافقة عليه</option>
		    <option value="N"<?php if($row['availble']=='N') echo " selected"; ?>>مرفوض</option>
		    <option value=""<?php if($row['availble']=='') echo " selected"; ?>>قيد المراجعة</option>
		</select>
	    </div>
					    
	    <div class="row">
		<div class="form-group">
		    <label for="code" class="col-md-3">كود المنتج</label>
		    <input type="text" class="form-control col-md-9" name="code" id="code" value="<?php echo $row['code'] ?>" />
		</div>
	    </div>


	    <div class="row">
		<div class="form-group">
		    <label for="content" class="col-md-3">وصف مختصر للمنتج</label>
		    <div class="col-md-9 no-pad"><div class="summernote" id="summernote"><?=$row['content'];?></div></div>
		</div>
	    </div>

	    <div class="row">
		<div class="form-group">
		    <label for="delivery" class="col-md-3">موعد التسليم بالايام</label>
		    <select class="form-control col-md-9" name="delivery" id="delivery">
			<?php for ($i = 1; $i <= 90; $i++) { ?><option value="<?php echo $i ?>"><?php echo $i; ?></option><?php } ?>
		    </select>
		</div>
	    </div>

	    
	    <div class="row">
		<div class="form-group">
		    <label for="availble" class="col-md-3">عروض خاصة</label>
		    <div class="col-md-9"><input type="checkbox" name="star" id="star" value="Y"<?php
			if ($row['star'] == 'Y') {
			    echo " checked";
			}
			?>></div>
		</div>
	    </div>
	    
	    <div class="row">
		<div class="form-group">
		    <label for="availble" class="col-md-3">المنتج متاح للشراء</label>
		    <div class="col-md-9"><input type="checkbox" name="availble" id="availble" value="Y"<?php
			if ($row['availble'] == 'Y') {
			    echo " checked";
			}
			?>></div>
		</div>
	    </div>

	    <div class="row">
		<div class="form-group">
		    <label for="international_shipping" class="col-md-3">شحن دولي</label>
		    <div class="col-md-9"><input type="checkbox" name="international_shipping" id="international_shipping" value="Y"<?php
			if ($row['international_shipping'] == 'Y') {
			    echo " checked";
			}
			?>></div>
		</div>
	    </div>

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

	    <div class="row">
		<div class="form-group">
		    <label for="price" class="col-md-3">السعر</label>
		    <input type="text" class="form-control col-md-9" name="meta[price]" id="price" value="<?php echo $row['price'] ?>" data-validation="required" data-validation-error-msg="السعر مطلوب" />
		</div>
	    </div>
	    <div class="row">
		<div class="form-group">
		    <label for="discount" class="col-md-3">السعر بعد الخصم</label>
		    <input type="text" class="form-control col-md-9" name="meta[discount]" id="discount" value="<?php echo $row['discount'] ?>" />
		</div>
	    </div>
	    <div class="row">
		<div class="form-group">
		    <label for="active" class="col-md-3">تفعيل</label>
		    <select name="active" id="active" class="form-control col-md-9">
			<option value="Y"<?php if ($row['active'] == 'Y') echo ' selected'; ?>>نعم</option>
			<option value="N"<?php if ($row['active'] == 'N') echo ' selected'; ?>>لا</option>
		    </select>
		</div>
	    </div>
	    <div class="row">
		<div class="form-group">
		    <label for="cat" class="col-md-3">القسم</label>
		    <select name="cat" id="cat" class="form-control col-md-9">
		    <?php echo $this->core_model->catList($row['parent_id']) ?>
		    </select>
		</div>
	    </div>
	    <div class="row">
		<div class="form-group">
		    <label for="brand" class="col-md-3">الماركة</label>
		    <select name="brand" id="brand" class="form-control col-md-9">
<?php foreach ($this->core_model->pages(array("module" => 'brands')) as $brand) { ?>
    			<option value="<?php echo $brand->ID; ?>"><?php echo $brand->title ?></option>
<?php } ?>
		    </select>
		</div>
	    </div>

	    <div id="custom_fields"></div>
	</div>
    </div>
    <div class="panel-footer">
	<button class="btn btn-primary fl" name="<?php if ($edit)
    echo 'edit_news';
else
    echo 'add_news';
?>" value="1"> <span class="glyphicon glyphicon-check"></span> <?php if ($edit)
    echo 'تـعديــل';
else
    echo 'إضـافــة';
?></button>
    </div>
</div>
<?php form_close(); ?>


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
	$("input#cat_chain").val( _data );
        if (!/\-/.test(_data))
        {
            var _id = _data;
        } else {
            var _ids = (_data).split("-");
            var _id = _ids[0];
        }
        $("#meta_parent_cat").val(_id);
        $.ajax({
            url: "<?php echo base_url() . "new_admin/Ajax/getFields/" ?>" + _id + "/<?= $edit ?>",
            success: function (ret)
            {
                $("#custom_fields").html(ret);
            }
        });
    });


    $("#cat").trigger('change');
</script>