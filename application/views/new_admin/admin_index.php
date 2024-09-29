<?php $this->core_model->cover('welcome'); ?>
<div id="date_bar" class="text-left">
	<?php echo $this->Hijri->toArabicDateFull(date('Y-m-d')); ?>
</div>



<div class="container-fluid">
	<div class="row m15px">
		<div class="btn-group fr index_buttons">
			<a href="<?php echo base_url().$this->core_model->admin_dir() ?>/slider/view" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-picture"></i> الاسلايدر</a>
			<a href="<?php echo base_url().$this->core_model->admin_dir() ?>/menu/view" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-menu-hamburger"></i> القائمة</a>
			<a href="<?php echo base_url().$this->core_model->admin_dir() ?>/social" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-share-alt"></i> التواصل</a>
			<a href="<?php echo base_url().$this->core_model->admin_dir() ?>/admins/view" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-user"></i> المشرفين</a>
			<a href="<?php echo base_url().$this->core_model->admin_dir() ?>/settings" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-user"></i> خصائص الموقع</a>
		</div>
	</div>
</div>


<div id="summery" class="row cl">
   
        <div class="col-md-3 col-xs-6" id="news_summery">
           <div class="summery_item">
                <h1><a href="<?php echo base_url().$this->core_model->admin_dir()."/products/view" ?>">المنتجات</a></h1>
                <span><?php echo $this->core_model->pages_count(array("module"=>"products")) ?></span>
                <kbd class="kpd"><a href="<?php echo base_url().$this->core_model->admin_dir()."/products/view" ?>">عرض</a></kbd>
            </div>
        </div>
        
        <div class="col-md-3 col-xs-6" id="pages_summery">
           <div class="summery_item">
                <h1><a href="<?php echo base_url().$this->core_model->admin_dir()."/pages/view" ?>">الصفحات</a></h1>
                <span><?php echo $this->core_model->pages_count(array("module"=>"pages")) ?></span>
                <kbd class="kpd"><a href="<?php echo base_url().$this->core_model->admin_dir()."/pages/view" ?>">عرض</a></kbd>
            </div>
        </div>
        
        <div class="col-md-3 col-xs-6" id="gallery_summery">
            <div class="summery_item">
            <h1><a href="<?php echo base_url().$this->core_model->admin_dir()."/category/view" ?>">الاقسام</a></h1>
            <span></span>
            <kbd class="kpd"><a href="<?php echo base_url().$this->core_model->admin_dir()."category/view" ?>">عرض</a></kbd>
            </div>
        </div>
        <div class="col-md-3 col-xs-6" id="contacts_summery">
           <div class="summery_item">
            <h1><a href="<?php echo base_url().$this->core_model->admin_dir()."/contacts" ?>">اتصل بنا</a></h1>
            <span><?php echo $this->core_model->contact_count() ?></span>
            <kbd class="kpd"><a href="<?php echo base_url().$this->core_model->admin_dir()."/contacts" ?>">عرض</a></kbd>
            </div>
        </div>
    
</div>



<? /*<div class="">
        <div class="mywidget">
           <div class="widget_header">
                <div class="col-xs-12"><h3>الإحصائيات</h3></div>
           </div>
            <div class="cl widget_body">
                
                <ul class="nav nav-tabs">
                    <li><a data-toggle="tab" id="pages_most_viewed_href"  href="#pages_most_viewed">الصفحات الأكثر زيارة</a></li>
                    <li class="active"><a data-toggle="tab" href="#modules_most_viewed">إحصائيات الأقسام</a></li>
                </ul>

               
               <div class="tab-content">
                  <div id="pages_most_viewed" class="tab-pane fade in active">
                        <div id="chart_div" style="width: 100%; height:350px;"></div>
                   </div>
                   <div id="modules_most_viewed" class="tab-pane fade in active">
                        <div id="chart_modules_div" style="width: 100%; height:350px;"></div>
                   </div>
            </div>
        </div>
    </div>
</div>

<script>

google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic);

google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic2);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'الصفحات');
      data.addColumn('number', 'الزيارات');
      data.addColumn({type:'string', role: 'tooltip','p': {'html': true}});
    
    <?php $this->core_model->most_viewd_pages() ?>

    
      

      var options = {
          tooltip: {
              isHtml: true
          },
        hAxis: {
          title: 'الصفحات'
        },
        vAxis: {
          title: 'الزيارات'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }

function drawBasic2() {

      var data2 = new google.visualization.DataTable();
      data2.addColumn('string', 'القسم');
      data2.addColumn('number', 'الزيارات');
      data2.addColumn({type:'string', role: 'tooltip','p': {'html': true}});
    
    <?php $this->core_model->most_viewd_module() ?>

    
      

      var options2 = {
          tooltip: {
              isHtml: true
          },
        hAxis: {
          title: 'الاقسام'
        },
        vAxis: {
          title: 'الزيارات'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_modules_div'));

      chart.draw(data2, options2);
    $("#pages_most_viewed_href").trigger('click');
    }
</script>

<div class="row">
	<div class="col-lg-6 col-xs-12"><?php echo $this->core_model->index_table("pages", "الصفحات", "صفحة") ?></div>
	<div class="col-lg-6 col-xs-12"><?php echo $this->core_model->index_table("news", "الأخبار", "خبر") ?></div>
</div>

<div class="row">
	<div class="col-md-12"><?php echo $this->core_model->index_table2("gallery", "الجاليري", "صورة") ?></div>
</div>
<?*/ ?>

<script src="<?php echo base_url()?>assets/js/admin/index.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>/assets/css/custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>/assets/js/custom.js"></script>