<?php
class Core_model extends CI_Model
{

	
	function ytid(string $url) : string
	{
		$video_id = explode("?v=", $url); // For videos like http://www.youtube.com/watch?v=...
		if (empty($video_id[1])) {
			$video_id = explode("/v/", $url);
		}
		// For videos like http://www.youtube.com/watch/v/..

		if (isset($video_id[1])) {
			$video_id = explode("&", $video_id[1]); // Deleting any other params
			$video_id = $video_id[0];

			if ($video_id) {
				return $video_id;
			}
		}

		$out=preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?".
			"\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
		// var_dump($matches); die;
		if($out) return $matches[1]; else return "";
	}


    public function getSubCats($cont,$parent_id,$admin_dir)
    {
	foreach ($this->pages(array("module"=>$cont,"parent_id"=>$parent_id)) as $row)
	{
	?>
	<tr>
	    <td class="text-left"> -&raquo; </td>
		<td>
		&nbsp;&nbsp;&nbsp;
		<span class="gray glyphicon glyphicon-eye-<?php echo($row->active=='Y')?"open":"close";?>"></span>
		<a class="gray" href="javascript:;" onclick="$('#input_<?php echo $row->ID?>').slideToggle('fast')"><span class="glyphicon glyphicon-link"></span></a>
		<a class="gray" href="<?php echo base_url(). $cont .'/'.$row->ID ?>" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a>

		<b><?php echo $row->title;?></b>

		<p><small class="text-muted"><?php echo mb_substr( strip_tags($row->content), 0,50,"utf-8");?></small></p>
		<p class="myhidden ltr" id="input_<?php echo $row->ID?>"><input type="text" class="form-control" value="<?php echo site_url().$cont.'/'.$row->ID ?>" /></p>
		</td>
		<td><?php echo $row->view?>
		</td>
		<td class="text-center">
			<div class="btn-group">
			<a href="<?php echo $admin_dir; ?>/<?php echo $cont?>/edit/<?php echo $row->ID ?>" role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span> تعديل</a>
			<button type="button" data-controller="<?php echo $cont?>" class="delCat btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel" data-id="<?php echo $row->ID?>" data-title="<?php echo $row->title?>"><span class="glyphicon glyphicon-trash"></span> حذف</button>
			</div>
		</td>
	</tr>
	<?php
	    $this->getSubCats($cont,$row->ID,$admin_dir);
	}

    }

    function str_split_unicode($str, $l = 0) {
    if ($l > 0) {
        $ret = array();
        $len = mb_strlen($str, "UTF-8");
        for ($i = 0; $i < $len; $i += $l) {
            $ret[] = mb_substr($str, $i, $l, "UTF-8");
        }
        return $ret;
    }
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}

    function product_data($id)
    {
	$ar= $ar2= $ar3= array();
	$query= $this->db->get_where("pages", "`ID`='{$id}'");
	/*if($query->num_rows() > 0)
	{*/
	    $ar= $query->row_array();

	    $ar4= array();
	    $ar['pic_path']= (isset($ar['pic']) && $ar['pic']) ? base_url()."uploads/products/".$ar['pic'] : "";
	    $ar['thumbnail_path']= (isset($ar['thumbnail']) && $ar['thumbnail']) ? base_url()."uploads/products/".$ar['thumbnail'] : "";
		$ar['url']= $this->shop->productURL($id);

	    foreach( $this->db->where(array("product_id"=>$id))->get("product")->result_array() as $row )
	    {
			$result = json_decode($row['value']);
			if(! is_array($result)){ $result= $row['value']; }
			$ar2[$row['input_id']]= $result;
	    }

	    foreach( $this->db->where(array("parent_id"=>$id, "module"=>"products_pic"))->get("pages")->result_array() as $row )
	    {
				$meta = json_decode($row['meta']);
				$ar3['pics'][$row['p_order']]['id']= $row['ID'];
				$ar3['pics'][$row['p_order']]['pic']= $row['pic'];
				$ar3['pics'][$row['p_order']]['pic_path']= base_url()."uploads/products/".$row['pic'];
				$ar3['pics'][$row['p_order']]['thumbnail']= $row['thumbnail'];
				$ar3['pics'][$row['p_order']]['thumbnail_path']= base_url()."uploads/products/".$row['thumbnail'];
				$ar3['pics'][$row['p_order']]['country']= $row['country'];
				$ar3['pics'][$row['p_order']]['meta']= (array) $meta;
	    }
	    $cat= $this->db->where(array("id"=>$ar['parent_id'], "module"=>"category"))->get("pages")->row_array();
	    $ar= array_merge($ar, array('cat'=>array(
		'id'=>$cat['ID'],
		"title"=>$cat['title'],
		'url'=> base_url().$cat['ID'] ,
		'price'=> $cat['price']
	    )));
	    return array_merge($ar,$ar2,$ar3,$ar4);
	/*}else{
		show_404();
	}*/
	}


    function getParentCat(int $productId)
    {
		$ret= $this->db->get_where("pages", "`ID`='{$productId}'");
		if ( $ret->num_rows() > 0 ) {
			$query= $ret->row();
			if( $query->parent_id  <> 0 ) {
				return $this->getParentCat( $query->parent_id );
			}
			else {
				return $query->ID;
			}
		}
		else{
			return FALSE;
		}
    }

    function catList( $select_id='', $where= array(), $parent_id=0, $level=0,$prevOptions='', $old='')
    {
        $output= array();
        $where= array("parent_id"=>$parent_id,"module"=>"category");
        $this->db->where($where);
        $query= $this->db->get("pages");
        if( $query->num_rows() > 0 )
        {
            foreach( $query->result() as $row )
            {
                $option  = "<option value='";
                if(!empty($old)) $data_id = "{$old}-{$row->ID}"; else $data_id=$row->ID;
                $id= $row->ID;
                $option.= $id ;
                $option.= "' data-id='".$data_id."' data-percent='".$row->price."'";
                if( $row->ID == $select_id ) $option.= " selected";
                $option .= ">". str_repeat("—•", $level) ." {$row->title}</option>" ;
                $where= array("parent_id"=>$row->ID,"module"=>"category");
                $this->db->where($where);
                $query2= $this->db->get("pages");
                if( $query2->num_rows() > 0 )
                {
                    $option.= "\r\n". $this->catList( $select_id, $where, $row->ID, ($level+1) , $prevOptions , $data_id) ;
                }
                $output[]= $option;
            }
            return implode("\r\n", $output);
            //$this->catList($select_id, $where, $row->parent_id, ($level+1) ,$prevOptions)
        }else{
            return $prevOptions;
        }
    }


    private function generateFieldValdition($field)
    {
        $req= array();
        switch( $field->input_type )
        {
            case "numbers" :
                if($field->input_required == 'Y') $req[]= "data-validation='number' data-validation-allowing='float'";
                if($field->number_min && $field->number_max) $req[]= "data-validation-allowing='range[{$field->number_min};{$field->number_max}]'";
                if($field->error_msg) $req[]= "data-validation-error-msg=\"".$field->error_msg ."\"";
                if($field->input_required == 'Y' && $field->error_msg=='') $req[]= "data-validation-error-msg=\"هذه الحقل مطلوب\"";
                break;
            case "text" :
            case "pic":
            case "color":
            case "textarea":
            case "editor":
                if($field->input_required == 'Y') $req[]= "data-validation='required'";
                if($field->error_msg) $req[]= "data-validation-error-msg=\"".$field->error_msg ."\"";
                if($field->input_required == 'Y' && $field->error_msg=='') $req[]= "data-validation-error-msg=\"هذه الحقل مطلوب\"";
                break;
            case "date":
                if($field->input_required == 'Y') $req[]= "data-validation='date'";
                if($field->error_msg) $req[]= "data-validation-error-msg=\"".$field->error_msg ."\"";
                if($field->input_required == 'Y' && $field->error_msg=='') $req[]= "data-validation-error-msg=\"هذه الحقل مطلوب\"";
                break;

        }
        return implode(" ", $req);
    }

    public function gentrateFieldTag($field,$product_id='')
    {
        switch( $field->input_type )
        {
            case "numbers" :
                return '<div class="row">
                    <div class="form-group">
                        <label for="'. $field->input_id .'" class="col-md-3">'. $field->title .'</label>
                        <input type="'. $field->input_type .'" class="form-control col-md-9" name="meta['. $field->input_id .']" id="'. $field->input_id .'"'. $this->generateFieldValdition($field) .' value="'. $this->getFieldValue($field->input_id,$product_id) .'" />
                    </div>
			    </div>'."\r\n";
                break;
            case "text" :
                return '<div class="row">
                    <div class="form-group">
                        <label for="'. $field->input_id .'" class="col-md-3">'. $field->title .'</label>
                        <input type="'. $field->input_type .'" class="form-control col-md-9" name="meta['. $field->input_id .']" id="'. $field->input_id .'"'. $this->generateFieldValdition($field) .' value="'. $this->getFieldValue($field->input_id,$product_id) .'" />
                    </div>
			    </div>'."\r\n";
                break;
            case "date":
                return '<div class="row">
                    <div class="form-group">
                        <label for="'. $field->input_id .'" class="col-md-3">'. $field->title .'</label>
                        <input type="'. $field->input_type .'" class="form-control col-md-9" name="meta['. $field->input_id .']" id="'. $field->input_id .'"'. $this->generateFieldValdition($field) .' value="'. $this->getFieldValue($field->input_id,$product_id) .'" />
                    </div>
			    </div>'."\r\n<script>$('input[type=date]').datepicker({format: 'yyyy-mm-dd'});</script>\r\n";
                break;
            /*case "pic":
                return '<div class="row">
                    <div class="form-group">
                        <label for="'. $field->input_id .'" class="col-md-3">'. $field->title .'</label>
                        <input type="file" class="form-control col-md-9" name="meta[upload]['. $field->input_id .']" id="'. $field->input_id .'" value="'. $this->getFieldValue($field->input_id,$product_id) .'"'. $this->generateFieldValdition($field) .' />
                    </div>
			    </div>'."\r\n";
                break;*/
            case "color":
                $output= '
                <div class="row">
				    <div class="form-group">
                        <label for="'. $field->input_id .'" class="col-md-3">'. $field->title .'</label>
                        <a class="form-control btn btn-info col-md-3" onclick="$(\'#'.$field->input_id.'\').slideToggle(\'fast\')">تحديد لون</a>
                        <select class="form-control hiddenElement col-md-5" name="meta['. $field->input_id .']';
                        if( $field->multi_color=='Y' ) $output .=  '[]';
                        $output .= '" id="'. $field->input_id .'"'. $this->generateFieldValdition($field) ;
                        if( $field->multi_color=='Y' ) $output .=  ' multiple=true';
                        $output .= '>';
                        foreach( $this->db->get('color_codes')->result() as $color)
                        {
                            $output .=  '<option value="'.$color->color.'" style="background-color:'.$color->color.'"';
                            if( $field->multi_color!='Y' &&  $this->getFieldValue($field->input_id,$product_id)==$color->color ) $output.=" selected";
                            else if( $field->multi_color=='Y' && is_array($this->getFieldValue($field->input_id,$product_id)) &&  in_array($color->color,$this->getFieldValue($field->input_id,$product_id)) ) $output.=" selected";
                            $output .=  '>'.$color->color.'</option>';
                        }
                        $output .=  '</select>

                    </div>
                </div>'."\r\n";
                return $output;
                break;
            case "editor":
                return '<div class="row">
				<div class="form-group">
					<label for="'. $field->input_id .'" class="col-md-3">'. $field->title .'</label>
					<div class="col-md-9 editorFix"><textarea class="editor" name="meta['. $field->input_id .']" id="'. $field->input_id .' '. $this->generateFieldValdition($field) .'">'. $this->getFieldValue($field->input_id,$product_id) .'</textarea></div>
				</div>
			</div><script>tinymce.init({ selector:\'textarea#'.$field->input_id.'\' });</script>'."\r\n";
                break;
            case "textarea":
                return '<div class="row">
				<div class="form-group">
					<label for="'. $field->input_id .'" class="col-md-3">'. $field->title .'</label>
					<textarea class="form-control col-md-9" name="meta['. $field->input_id .']" id="'. $field->input_id .' '. $this->generateFieldValdition($field) .'">'. $this->getFieldValue($field->input_id,$product_id) .'</textarea>
				</div>
			</div>'."\r\n";
                break;
            default:
                return '';
                break;
        }
    }


    function getFieldValue($input_id,$product_id='')
    {
        $ret=$this->db->where(array("input_id"=>$input_id,"product_id"=>$product_id))->get("product")->row()->value;
        $result = json_decode($ret);
        if(! is_array($result)) $result= $ret;
        return $result;
    }

    public function mailTemplate($title='', $body='' )
    {
        return "<!DOCTYPE html><html><head><meta charset='utf-8'>
        <style>
        body{background-color:#e6e6e6; padding:15px; font-family: tahoma; font-size:12px; direction:rtl; text-align: right;}
        table#mainTable{border-collapse: collapse;width:100%;}
        #mainTable th{background-color: #effeff;font-size: 18pt;text-align: center;border-bottom: 1px solid #74a0a4;line-height: 50px;border-top-right-radius: 5px;border-top-left-radius: 5px;}
        #mainTable td{background-color:#fff;padding:15px;border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;}
        </style></head><body>
        <table id='mainTable'>
            <thead>
                <tr><th>{$title}</th></tr>
            </thead>
            <tbody>
                <tr><td>{$body}</td></tr>
            </tbody>
        </table>
        </body></html>";
    }

    public function fieldList($id, $module='products')
    {
        return $this->db->where(array("parent_id"=>$id, "module"=>$module))->order_by("input_order","asc")->get("filed_input")->result();
    }

    public function field_translate_type($type)
    {
        $ar= array();
        $ar["text"]="مربع نصي";
        $ar["textarea"]="مربع نصي كبير";
        $ar["editor"]="محرر كامل";
        $ar["numbers"]="ارقام فقط";
        $ar["pic"]="صورة";
        $ar["date"]="تاريخ";
        $ar["color"]="لون";
        return $ar[$type] ;
    }

    function egp2usd()
    {
	$url= explode(",", file_get_contents("http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=EGPUSD=X"));
	return $url[1];
    }

    function coin2usd($coins= '' )
    {
        $ar= array();
        $file=  json_decode( json_encode(simplexml_load_string( file_get_contents("http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20({$coins})&env=store://datatables.org/alltableswithkeys") ) ), true );
        foreach( $file['results']['rate'] as $k )
        {
            $ar[ preg_replace("/USD\//" , "" , $k['Name']) ]= $k['Rate'] ;
        }
        return $ar;
    }

    function getActiveCurrencyToUSD($prefix='USD')
    {
        $ar= array();
        foreach($this->db->where(array("`module`"=>"country"))->get("pages")->result() as $row)
        {
            $meta= unserialize($row->meta);
            if( is_array($meta) && count($meta) && $meta['coinCode'] )
            $ar[]= "\"{$prefix}{$meta['coinCode']}\"";
        }
        $coins=implode(",", $ar);
        return $this->coin2usd($coins);
    }

    function getCurrency()
    {
        return $this->db->where(array("`module`"=>"currency"))->group_by("icon")->get("pages")->result();
    }

	public function assets($folder='')
	{
		echo base_url()."assets/{$folder}/";
	}

	public function menuabel()
	{
		return $this->db->order_by("m_order","asc")->get_where("modules",array("menuable"=>'Y'))->result();
	}

    public function most_viewd_pages()
    {
        $ar= array();
        foreach( $this->db->limit(30)->get('states')->result() as $row )
        {
            $ar[]= "['{$row->title}',{$row->visits}, '<p style=\"direction:rtl; text-align: right;padding:15px;\"><span style=\"color: red;\">". $row->title ." <sup>(".$row->visits.")</sup>"."</span><br /><span style=\"direction:ltr;\">".$row->url ."</span></p>']";
        }
        echo "data.addRows([\r\n". implode(",\r\n\t",$ar) ."\r\n])";
    }

    public function most_viewd_module()
    {
        $ar= array();
        $q= $this->db->query("SELECT COUNT(*) thecount, `module`, ( select sum(visits) from `_d_states` where `module`=s.module ) as c FROM _d_states s group by `module`;")->result();
        foreach( $q as $row )
        {
            $title= $this->translate($row->module);
            $ar[]= "['".$title."',{$row->c}, '<p style=\"direction:ltr; text-align: right;padding:15px;width:150px;\"><span style=\"color: red;font-weight:bold;\">". $title ."</span> <br />زيارة ".$row->c." "."</p>']";
        }
        echo "data2.addRows([\r\n". implode(",\r\n\t",$ar) ."\r\n])";
    }

    function translate($p)
    {
        switch($p)
        {
            case 'news':
                $out= "الأخبار";
                break;
            case 'gallery':
                $out= "الجاليري";
                break;
            case 'home':
                $out= "الرئيسية";
                break;
            case 'slider':
                $out= "سلايدر";
                break;
            case 'contacts':
                $out= "اتصل بنا";
                break;
            case 'pages':
                $out= "الصفحات";
                break;
            default:
                $out="مجهول";
                break;
        }
        return $out;
    }

    public function states($data='')
    {
        $this->load->library('session');
        $ip= $this->ip();
        if($data=='') $data=$this->get_settings('title');
        $json= json_decode( @file_get_contents( 'http://ip-api.com/json/'.$ip ) ) ;
        $country= ($json->countryCode)?$json->countryCode:'SA';
        $url= "**".$_SERVER['REQUEST_URI'];
        if(!$this->session->userdata('state'))
        {
            $this->session->set_userdata( array('state'=> md5(uniqid())) );
        }
        $row= ( $this->db->where(array("url"=>$url))->get("states") );
        if($row->result_id->num_rows == 0)
        {
            $this->db->insert("states", array("title"=>$data,"url"=>$url,"visits"=>1, "module"=>$this->router->fetch_class()));
        }else{
            $this->db->set("visits", "visits+1", FALSE)->update("states");
        }
        $this->db->insert("states_details", array("IP"=>$ip, "session_id"=>$this->session->userdata('state'), "country"=>$country,"title"=>$data, 'url'=>$url));
    }

    private function ip()
    {
        return rand(99,250).".".rand(99,250).".".rand(99,250).".".rand(99,250);
        return $_SERVER['REMOTE_ADDR'];
    }

    public function send_email($subject, $body)
    {
		$body='<!DOCTYPE <html>
			<html>
			<head><meta charset="utf-8" />
			<title>'. $subject .'</title>
			<style>body{direction: rtl; text-align: right;}</style>
			</head>
			<body>
				'. nl2br( $body ) .'
			</body>
			</html>
			</html>';

		if ( $this->config->item('send_mail_local') == 1 ) {
			file_put_contents(
				"tmp/mail_" . $data['row']->email .+ "-". date('Y-m-d-H_i_s').".html",
				$body
			);
		}else{
			$mailer = unserialize($this->get_settings('smtp'));
			$this->load->library('email');
			$config['smtp_host']= $mailer['host'];
			$config['smtp_user']= $mailer['user'];
			$config['smtp_pass']= $mailer['pass'];
			$config['smtp_port']= $mailer['port'];
			$config['charset']= 'utf-8';
			$config['mailtype']= 'html';
			$this->email->initialize($config);
			$this->email->from($mailer['from']);
			$this->email->to($data['row']->email);
			$this->email->subject($subject);

			$this->email->message($body);
			$this->email->send();
		}

        //echo $this->email->print_debugger();
    }


	public function index_table($module, $title, $title_single)
	{
		?>
		<div class="mywidget"><div class="widget_header">
			<div class="col-xs-6"><h3><?php echo $title ?></h3></div>
			<div class="col-xs-6 btn-group widget_btns">
				<div class="fl">
					<a href="<?php echo base_url().$this->admin_dir()."/".$module."/add"; ?>" class="btn btn-xs btn-primary">إضافة</a>
					<a href="<?php echo base_url().$this->admin_dir()."/".$module."/view"; ?>" class="btn btn-xs btn-primary">عرض</a>
				</div>
			</div>
		</div>
		<div class="cl widget_body">
			<div class="row widget_order">
				<label for="<?php echo $module?>" class="col-xs-4">ترتيب بحسب</label>
				<select class="form-control col-xs-7 select_order_by" id="<?php echo $module?>">
					<option value="view,asc">الأكثر قراءة</option>
					<option value="ID,asc">الأقدم</option>
					<option value="ID,desc">الأحدث</option>
				</select>
			</div>
			<div class="table-responsive dynamic_tables" data-module="<?php echo $module?>" id="table_<?php echo $module?>" data-order="view" data-limit=3 data-o="desc">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>العنوان</th>
							<th>التاريخ</th>
							<th>العرض</th>
							<th>تعديل</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="widget_stats text-center text-muted small"><i class="glyphicon glyphicon-stats"></i> لديك عدد  <?php echo $this->pages_count(array("module"=>$module))." {$title_single}. منها :".$this->pages_count(array("module"=>$module,"active"=>'Y'))." مفعل ".
			" و ".$this->pages_count(array("module"=>$module, "active"=>'N'))." غير مفعل" ?></div>
		</div></div><?php
	}

	public function index_table2($module, $title, $title_single)
	{
		?>
		<div class="mywidget dynamic_tables" data-module="<?php echo $module?>" id="table_<?php echo $module?>" data-order="view" data-limit=12 data-o="desc"><div class="widget_header">
			<div class="col-xs-6"><h3><?php echo $title ?></h3></div>
			<div class="col-xs-6 btn-group widget_btns">
				<div class="fl">
					<a href="<?php echo base_url().$this->admin_dir()."/".$module."/add"; ?>" class="btn btn-xs btn-primary">إضافة</a>
					<a href="<?php echo base_url().$this->admin_dir()."/".$module."/view"; ?>" class="btn btn-xs btn-primary">عرض</a>
				</div>
			</div>
		</div>
		<div class="cl widget_body">
			<div class="row widget_order">
				<label for="<?php echo $module?>" class="col-xs-4">ترتيب بحسب</label>
				<select class="form-control col-xs-7 select_order_by" id="<?php echo $module?>">
					<option value="ID,asc">الأقدم</option>
					<option value="ID,desc">الأحدث</option>
					<option value="pic_size,desc">الأكبر حجما</option>
					<option value="pic_size,asc">الاصغر حجما</option>
				</select>
			</div>
			<div class="widget_gallery">
			</div>
			<div class="widget_stats text-center text-muted small"><i class="glyphicon glyphicon-stats"></i> لديك عدد  <?php echo $this->pages_count(array("module"=>$module))." {$title_single}. منها :".$this->pages_count(array("module"=>$module,"active"=>'Y'))." مفعل ".
			" و ".$this->pages_count(array("module"=>$module, "active"=>'N'))." غير مفعل" ?></div>
		</div></div><?php
	}

	function cover($prefix='')
	{
		$row= $this->current_admin();
		?><div class="row mini_cover <?php echo $prefix; ?>" style="background-image: url('<?php echo base_url() ?>uploads/admins/<?php echo $row->cover;?>')">
				<div class="fl m15px none">
				    <a href="<?php echo base_url().$this->admin_dir() ?>/admins/mydata" class="btn btn-info"><i class="glyphicon glyphicon-fullscreen"></i> تغيير بياناتي</a>
				</div>
				<div class="userpic">
					<img src="<?php echo base_url();?>uploads/admins/<?php echo $row->pic; ?>" class="img-responsive" />
					<span class="username-cover"><?php echo $row->username; ?></span>
				</div>
			</div> <?php
	}

	function modules_list()
	{
		return $this->db->order_by('m_order', 'asc')->get("modules")->result();
	}

	function update_last_login()
	{
		$sess_id= $this->session->userdata('user');
		$this->db->query("update `".$this->db->dbprefix."admin` set `lastlogin`=now() where `hash`='{$sess_id}' ");
	}


	function admins()
	{
		return $this->db->order_by('ID', 'des')->get_where("admin", "ID<>1")->result();
	}


	function current_admin()
	{
		return $this->db->get_where("admin", "`hash`='{$_SESSION['user']}'")->row();
	}

	function check_permission()
	{
		$this->load->view( $this->core_model->admin_dir().'/templates/no_permisson');
	}
	function admin_can($class='')
	{
		if($class=='') $class=$this->router->fetch_class();
		$admin= $this->current_admin();
		if($admin->active=='N'){
			$this->load->helper('cookie');
			delete_cookie('user');
			return false;
		}else{
			if($admin->mode== 'super') return true;
			else if($admin->mode=='mod')
			{

				if( in_array($class, explode(",", $admin->modules)) )
				{
					return true ;
				}else{
					return false;
				}
		}
		}
	}




	function admin_data($id)
	{
		return $this->db->order_by('ID', 'des')->get_where("admin", "ID='{$id}'")->row();
	}

	function admin_data_by_hash($hash)
	{
		return $this->db->order_by('ID', 'des')->get_where("admin", "`hash`='{$hash}'")->row();
	}

	function is_admin_id($id)
	{
		return $this->db->get_where("admin", "ID='{$id}'")->row()->ID;
	}

	public function admin_dir() {
		return 'new_admin';
	}

	public function is_admin_email($email)
	{
		if( strpos("@",$email) ) {
			$field = "email" ;
		}else{
			$field = "username" ;
		}
		$ret=$this->db->order_by('ID', 'desc')->get_where("admin", array( $field => $email ));
		// var_dump($field,$email, $ret->num_rows()); die;
		$rows  = $ret->num_rows();
		if( $rows > 0 ) {
			$r=$ret->row();
			if($r->mode=='super')
			{
				return $rows;
			}else{
				if($r->active=='Y') {
					return $rows;
				} else
				{
					return 0;
				}
			}
		}
	}

	
	public function is_correct_pasword($email, $password)
	{
		if( strpos("@",$email) ) {
			$field = "email" ;
		}else{
			$field = "username" ;
		}
		$result= $this->db->get_where('admin', array( $field => strtolower($email) ))->row();
		//var_dump($result);
		$salt= $result->salt;
		$repeat= $result->salt_repeat;
		$salt_extra= $result->salt_extra;
		if( $this->mk_password($salt,$repeat,$salt_extra,$password) == $result->pwd)
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function mk_password($salt,$repeat,$salt_extra,$password)
	{
		$new_password= sha1(str_repeat($salt, $repeat) );
		$new_password= sha1($salt_extra.$new_password);
		$new_password= md5(substr($new_password, 1, 5));
		$new_password= md5($password.$new_password);
		return $new_password;
	}

	public function login_error($hash_shart)
	{
		$ip= $this->input->server('REMOTE_ADDR');
		$uniq= sha1($ip.",".$hash_shart);
		$query= $this->db->query("select * from `".$this->db->dbprefix."login_log` where `IP`='{$ip}' and `hash`='{$uniq}' and `last_try` < now()+interval 30 minute");
		$rows=$query->num_rows();
		if( $rows > 0 )
		{
			$row= $query->row();
			$this->db->update("login_log", array("tries"=> 1+intval($row->tries) ), array("ID"=>$row->ID));
		}else{
			$this->db->insert("login_log", array("IP"=>$ip, "hash"=>$uniq, "tries"=>1));
		}
	}

	public function get_login_tries($hash_shart)
	{
		$this->db->query("delete from `".$this->db->dbprefix."login_log` where `last_try` < now()-interval 30 minute");
		$ip= $this->input->server('REMOTE_ADDR');
		$uniq= sha1($ip.",".$hash_shart);
		$query= $this->db->get_where("login_log", array("IP"=>$ip, "hash"=>$uniq) );
		$row= $query->row();
		/*if($row->tries >= 6 )
		{
			$query= $this->db->get("settings" );
			$result= $query->row();
			$host=$this->input->server('HTTP_HOST');
			$this->load->library('email');
			$config['protocol'] = 'smtp' ;
			$config['mailpath'] = 'C:\work\xampp2\sendmail\sendmail.exe' ;
			$config['smtp_host'] = 'smtp.gmail.com' ;
			$config['smtp_user'] = 'developer.eye1@gmail.com' ;
			$config['smtp_pass'] = 'Horus@2014' ;
			$config['smtp_port'] = 465 ;
			$config['smtp_crypto'] = 'ssl';
			$config['smtp_keepalive'] = true;
			$config['mailtype'] = 'html';
			$config['charset'] = 'utf-8';
			$this->email->initialize($config);
			$this->email->from('no_reply@'.$host, 'no_reply');
			$this->email->to($result->master_email);
			$this->email->subject('تسجيل محاولة دخول مريبة');
			$this->email->message(' لقد تم تسجيل محاولة مريبة في الساعة '.date('Y-m-d H:i:s') .' بتوقيت السيرفر و قد تم منعها بعد ست محاولات خاطئة');
			$this->email->send();
		}*/
		return $row->tries;
	}

	public function create_strings($letters1, $letters2)
	{
		$st='0123456789abcdefghijklmnopqrstuvwxyz';
		$st= str_shuffle($st);
		$word= substr($st,1, $letters1)." " ;
		$st= str_shuffle($st);
		$word .= substr($st,1, $letters2) ;
		return $word;
	}

	public function create_strings2($letters1)
	{
		$st='0123456789abcdefghijklmnopqrstuvwxyz';
		$st= str_shuffle($st);
		$word= substr($st,1, $letters1) ;
		return $word;
	}


	public function captcha_img()
	{
		$vals = array(
			'word'			=> $this->create_strings(3, 4),
			'img_path'      => './tmp/',
        	'img_url'       => base_url()."/tmp/",
		    'font_path'     => 'assets/fonts/consolaz.ttf',
		    'img_width'     => '100',
		    'img_height'    => 35,
		    'expiration'    => 10,
		    'word_length'   => 8,
		    'font_size'     => 10,
		    'colors'        => array('text'=>array(0,70,99),'grid' => array(200, 200, 200)));
			return create_captcha($vals);
	}



	function is_tag($id)
	{
		$query= $this->db->get_where("tags", "`ID`='{$id}'");
		if($query->num_rows() > 0)
		{
			return true;
		}else{
			return false;
		}
	}

	function tag_data($id)
	{
		$query= $this->db->get_where("tags", "`ID`='{$id}'");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else{
			return false;
			//show_404();
		}
	}


	function tag_data_url($url)
	{
		$url= urldecode($url);
		$query= $this->db->get_where("tags", "`url`='{$url}'");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else{
			show_404();
		}
	}


	function news_data_url($url)
	{
		$url= urldecode($url);
		$query= $this->db->get_where("news", "`url`='{$url}'");
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else{
			show_404();
		}
	}


	function tag_count($id)
	{
		$query= $this->db->get_where("comics_tags", array("tag_id"=>$id));
		return $query->num_rows();
	}


	public function tags($ar= array())
	{
		$q=$this->db->get_where("tags",$ar);
		return $q->result();
	}




	public function tags_count($ar= array())
	{
		$q=$this->db->get_where("tags",$ar);
		return $q->num_rows();
	}

/* START NEWS */
	public function news_img($id='') {
		$q= $this->db->get_where("pages","ID='{$id}'");
		$row=$q->result();
		$pic=$row[0]->thumbnail;
		return ($pic)?base_url()."uploads/news/{$pic}":base_url()."uploads/site/".$this->get_settings('news_img') ;
	}
/* END NEWS */
/* START slider */
	public function sliders($ar= array(), $limit= 1000, $start=0, $oder_by_feild="ID", $order_desc_asc="desc")
	{
		$this->db->limit($limit,$start);
		$this->db->order_by($oder_by_feild, $order_desc_asc);
		$q=$this->db->get_where("slider",$ar);
		return $q->result();
	}

	function slider_data($id)
	{
		$query= $this->db->get_where("slider", "`ID`='{$id}'");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else{
			show_404();
		}
	}

	function is_slider($id)
	{
		$query= $this->db->get_where("slider", "`ID`='{$id}'");
		if($query->num_rows() > 0)
		{
			return true;
		}else{
			return false;
		}
	}


	public function slider_count($ar= array())
	{
		$q=$this->db->get_where("slider",$ar);
		return $q->num_rows();
	}
/* END slider */


/* START pages */
	function pages_data_url($url)
	{
		$url= urldecode($url);
		$query= $this->db->get_where("pages","`url`='$url' and `active`='Y'");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else{
			show_404();
		}
	}

	public function pages_count($ar= array())
	{
		$q=$this->db->get_where("pages",$ar);
		return $q->num_rows();
	}

	public function pages($ar= array(), $limit= 1000, $start=0, $oder_by_feild="ID", $order_desc_asc="desc")
	{
		$this->db->limit($limit,$start);
		$this->db->order_by($oder_by_feild, $order_desc_asc);
		$q=$this->db->get_where("pages",$ar);
		return $q->result();
	}




	public function pages_mini($ar= array(), $limit= 1000, $start=0, $oder_by_feild="ID", $order_desc_asc="desc")
	{
		$this->db->limit($limit,$start);
		$this->db->order_by($oder_by_feild, $order_desc_asc);
		$this->db->select(array("title",'ID','date_create', "view"));
		$q=$this->db->get_where("pages",$ar);
		return $q->result();
	}

	public function gallery_mini($ar= array(), $limit= 1000, $start=0, $oder_by_feild="ID", $order_desc_asc="desc")
	{
		$this->db->limit($limit,$start);
		$this->db->order_by($oder_by_feild, $order_desc_asc);
		$this->db->select(array("title",'ID', 'date_create', "view", "pic", "thumbnail", "meta","price"));
		$q=$this->db->get_where("pages",$ar);
		$ar= array();
		foreach($q->result() as $row)
		{
			$meta= unserialize($row->meta);
			//var_dump($meta);
			$ar[] = array("ID"=>$row->ID,"title"=>$row->title, "pic"=>$row->pic, "thumbnail"=>$row->thumbnail, "w"=>$meta['w'], "h"=>$meta['h'], "size"=>$meta['size'], "price"=>$row->price);
		}
		return $ar;
	}

	function is_pages($id)
	{
		$query= $this->db->get_where("pages", "`ID`='{$id}'");
		if($query->num_rows() > 0)
		{
			return true;
		}else{
			return false;
		}
	}


	function pages_data($id)
	{
		$query= $this->db->get_where("pages", "`ID`='{$id}'");
		/*if($query->num_rows() > 0)
		{*/
			return $query->row_array();
		/*}else{
			show_404();
		}*/
	}
/* END pages */


/* START menu */
	public function menu_count($ar= array())
	{
		$q=$this->db->get_where("menu",$ar);
		return $q->num_rows();
	}

	public function menu($ar= [], $limit= 1000, $start=0, $oder_by_feild="menu_order", $order_desc_asc="ASC")
	{
		$rows= $this->db->
			limit($limit,$start)->
			order_by($oder_by_feild, $order_desc_asc)->
			get_where("menu",$ar)->result();
		return $rows;
	}

	function is_menu($id)
	{
		$query= $this->db->get_where("menu", "`ID`='{$id}'");
		if($query->num_rows() > 0)
		{
			return true;
		}else{
			return false;
		}
	}


	function menu_data($id)
	{
		$query= $this->db->get_where("menu", "`ID`='{$id}'");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else{
			show_404();
		}
	}


	function menu_order()
	{
		$this->db->order_by("menu_order", "asc");
		$q=$this->db->get_where("menu",array("active"=>'Y'));
		return $q->result();
	}

	public function hasSubMenu(int $id){
		$row= $this->menu_data($id) ;
		return ( isset($row->has_subs) && $row->has_subs == 'Y')?TRUE:FALSE;
	}
/* get readable file size*/
	function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' kB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
	}

/* END menu */
	public function news($ar= array(), $limit= 1000, $start=0, $oder_by_feild="ID", $order_desc_asc="desc")
	{
		$w= ["module"=>"news"];
		if ( $ar ) $w= array_merge($ar, $w);
		$this->db->limit($limit,$start);
		$this->db->order_by($oder_by_feild, $order_desc_asc);
		$q=$this->db->get_where("pages",$w);
		// echo ( $this->db->last_query()); die;
		return $q->result();
	}

	function is_news($id)
	{
		$query= $this->db->get_where("news", "`ID`='{$id}'");
		if($query->num_rows() > 0)
		{
			return true;
		}else{
			return false;
		}
	}


	function news_data($id)
	{
		$query= $this->db->get_where("news", "`ID`='{$id}'");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else{
			show_404();
		}
	}

	public function imgFingerPrint($w,$h,$mime, $size)
	{
		return sha1($w.$h.$mime.$size);
	}


	public function comics_count($ar= array())
	{
		$q=$this->db->get_where("comics",$ar);
		return $q->num_rows();
	}

	public function comics($start=0, $ar= array(), $limit=50, $oder_by_feild="ID",$order_desc_asc="desc", $or_where=array())
	{
		$this->db->limit($limit,$start);
		$this->db->order_by($oder_by_feild, $order_desc_asc);
		/*if($ar) {
			foreach ($ar as $k=>$v){
				$this->db->where( "{$k}","{$v}" );
			}
		}*/
		if($or_where) {
			$this->db->group_start();
			$this->db->where($ar);
			$this->db->or_where("{$or_where}", null, false);
			$this->db->group_end();
		}else{
			$this->db->where($ar);
		}
		$q=$this->db->get("comics");
		//echo $this->db->last_query();//die;
		return $q->result();
	}


	public function cat_url($catid)
	{
		$cat= $this->cat_data($catid);
		$caturl= base_url()."comics/";
		if($cat['catid'] != 0){
			$cat_sub= $this->cat_data($cat['catid']);
			$caturl .= $cat_sub['url']."/";
		}
		$caturl .= $cat['url']."/";
		return $caturl;
	}
	public function tag_url($id)
	{
		$tag= $this->tag_data($id);
		return base_url()."tags/".$tag['url'];
	}

	function comic_data($id)
	{
		$query= $this->db->get_where("comics", "`ID`='{$id}'");
		if($query->num_rows() > 0)
		{
			return $query->row();
		}else{
			show_404();
		}
	}

	function comic_data_by_url($url)
	{
		$url=urldecode($url);
		$query= $this->db->get_where("comics", "`url`='{$url}'");
		if($query->num_rows() > 0)
		{
			return $query->row();
		}else{
			show_404();
		}
	}

	public function comic_url($id)
	{
		$comic= $this->comic_data($id);
		return $this->cat_url($comic->cat). $comic->url.".html";
	}




	public function comics_index_cats($comics_slider, $catID)
	{
		//var_dump($comics_slider);
		echo '<div class="list_carousel responsive wow '.$this->wow_rand().'"><ul id="slider_cat_' .$catID.'" class="list_carousel responsive">';
		foreach( $comics_slider as $row)
		{
			echo "<li><a href=\"". $this->comic_url($row->ID) ."\"><img class=\"img-reponsive\" src=\"".base_url()."uploads/comics/". $row->thumb ."\" alt=\"". $row->title ."\" /></a><a href=\"". $this->comic_url($row->ID) ."\" class=\"comic-slider-titles text-center\">".$row->title."</a></li>";
		}
		echo '</ul><div class="clearfix"></div></div>';
	}

	public function comics_index_cats_inner($comics_slider, $catID)
	{
		$cat= $this->cat_data($catID);
		echo '<div class="list_carousel responsive"><ul id="slider_cat_' .$catID.'" class="list_carousel list-inner responsive">';
		foreach( $comics_slider as $row)
		{
			echo "<li><a href=\"". $this->comic_url($row->ID) ."\"><img class=\"img-reponsive\" src=\"".base_url()."uploads/comics/". $row->thumb ."\" alt=\"". $row->title ."\" /></a><a href=\"". $this->comic_url($row->ID) ."\" class=\"comic-slider-titles text-center\">".$row->title."</a></li>";
		}
		echo '</ul><div class="text-left">
				<a href="'.base_url().'comics/'.$cat['url'].'" class="btn btn-primary"> عرض
				<span class="badge">'. $this->comics_count(array("cat"=>$catID, "active"=>'Y')) .'</span> كوميكس إضافية </a></div>
					<div class="clearfix"></div></div>';
	}

	public function comics_tags($comic_id, $id_only= false)
	{
		if($id_only)
		{
			return $this->db->get_where("comics_tags", "`comic_id`='{$comic_id}'")->result();
		}else{
			$ar=[];
			foreach($this->db->get_where("comics_tags", "`comic_id`='{$comic_id}'")->result() as $row)
			{
				$ar[]=$row->tag_id;
			}
			return $ar;
		}
	}



	public function comics_tags_rel($tag_id, $id_only= false)
	{
		if($id_only)
		{
			$ar=$this->db->get_where("comics_tags", "`tag_id`='{$tag_id}'")->result();
			return $ar;
		}else{
			$ar=[];
			foreach($this->db->get_where("comics_tags", "`tag_id`='{$tag_id}'")->result() as $row)
			{
				$ar[]=$row->comic_id;
			}
			return $ar;
		}
	}


	public function comics_tags_rel_first($tag_id)
	{
		$comic=$this->db->order_by("comic_id", "desc")->get_where("comics_tags", "`tag_id`='{$tag_id}'")->row()->comic_id;
		if($comic) return $this->db->get_where("comics", "`ID`='{$comic}'")->row(); else return ;
	}

	public function comics_news_rel($news_id, $id_only= false)
	{
		if($id_only)
		{
			$ar=$this->db->get_where("comics_news", "`news_id`='{$news_id}'")->result();
			//echo $this->db->last_query();die;
			return $ar;
		}else{
			$ar=[];
			foreach($this->db->get_where("comics_news", "`news_id`='{$news_id}'")->result() as $row)
			{
				$ar[]=$row->comic_id;
			}
			return $ar;
		}
	}


	public function comics_news_id($comic_id)
	{
		$q=$this->db->get_where("comics_news", "`comic_id`='{$comic_id}'")->row();
		return $q->news_id;
	}

	public function text2title($text)
	{
		$ar= array();
		$words= explode(" ", $text);
		$ar[]="<span>". $words[0] ."</span> ";
		array_shift($words);
		$ar[]= implode(" ", $words);
		return implode("", $ar);
	}

	public function contact_insert($post)
	{
        $settings= $this->get_settings();
        $subject=  $this->core_model->mailTemplate($this->input->post('subject'));
        $body=  $this->core_model->mailTemplate($this->input->post('message'));
        if( $settings->sendmail_settings==0 )
        {
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=utf-8';
            $headers[] = 'To: '. $settings->send_to ;
            @mail(@$settings->send_to,$subject, $this->core_model->mailTemplate($subject,$body) , implode("\r\n", $headers));
        }else{
                $mailer = unserialize($settings->smtp);
                $this->load->library('email');
                $config['smtp_host']= $mailer['host'];
                $config['smtp_user']= $mailer['user'];
                $config['smtp_pass']= $mailer['pass'];
                $config['smtp_port']= $mailer['port'];
                $config['charset']= 'utf-8';
                $config['mailtype']= 'html';
                $this->email->initialize($config);
                $this->email->from($mailer['from']);
                $this->email->to($data['row']->email);
                $this->email->subject($subject);
                $body='<!DOCTYPE <html>
                <html>
                <head><meta charset="utf-8" />
                <title>'. $subject .'</title>
                <style>body{direction: rtl; text-align: right;}</style>
                </head>
                <body>
                    '. nl2br( $body ) .'
                </body>
                </html>
                </html>';
                $this->email->message($body);
                $this->email->send();
        }
		$this->db->insert("contact", array(
				"name"=>$this->input->post('uname'),
				"email"=>$this->input->post('email'),
				"mobile"=>$this->input->post('mobile'),
				"subject"=>$this->input->post('subject'),
				"message"=>$this->input->post('message')
		));
	}


	public function contacts( $start=0)
	{
		$q= $this->db->get("contact");
		return $q->result();
	}

	public function contact_data($id)
	{
		$this->db->where(array("ID"=>$id));
		$this->db->update("contact", array("readed"=>'Y'));
		$q= $this->db->get_where("contact", array("ID"=>$id));
		return $q->row();
	}

	public function contact_unread_count($ar=array())
	{
		$q= $this->db->get_where("contact", array("readed"=>'N'));
		return $q->num_rows();
	}

    public function contact_count($ar=array())
	{
		$q= $this->db->get_where("contact", $ar );
		return $q->num_rows();
	}

	public function news_count()
	{
		$q= $this->db->get_where("news");
		return $q->num_rows();
	}

	public function wow_rand()
	{
		$ar= array('flipInX', 'rollIn', 'bounceInRight', 'bounceInLeft', 'shake', 'bounceInUp', 'pulse','lightSpeedIn', 'bounce', 'flip');
		return $ar[rand(0, count($ar))];
	}


	public function search_archive()
	{
		$q= $this->db->get("search");
		return $q->result();
	}

	public function get_settings( string $setting='')
	{
		$q= $this->db->get("settings");
		if($setting=='') {
			return $q->row();
		} else{
			$row= $q->row();
			return $row->$setting;
		}
	}


	public function get_social($social='')
	{
		$q= $this->db->get("social");
		if($social=='') return $q->row(); else return $q->row()->$social;
	}


	public function get_all_social($start='')
	{
		$ar= array('facebook', 'twitter','instagram', 'youtube', 'snapchat', 'linkedin', 'google-plus', 'tiktok');
		foreach($ar as $g)
		{
			/*
			<a class="facebook social-icon" href="#facebook" title="" target="_blank" data-original-title="Facebook">
												<i class="fa fa-facebook"></i>
											</a>**/
			if($this->get_social($g))
			{
				if($this->get_social($g) ) {
					echo "<li".( $start? " {$start}":"" )."><a href='". $this->get_social($g) ."'
					target=_blank class='{$g} social-icon'>";
					echo ($g=='tiktok') ?
						"<img src='".base_url('theme/img/tiktok.png')."' class='img-fluid'>" :
						"<i class='fa fa-{$g}'></i>";
					echo "</a></li> " ;
				}
			}
		}
	}
}
