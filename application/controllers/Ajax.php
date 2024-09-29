<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax extends CI_Controller
{
	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->database();
	    $this->load->model('core_model');
	    $this->load->library(array('session')) ;
	}


	function getSKUvalues()
	{
	    $this->ajaxHeaders();
	    $r=$this->db->query("select min(`price`) `min_price` , max(`price`) max_price from _d_pages where module='products' and `SKU`='". strtolower($_POST['sku']) ."'" )->row();
	    echo "{$r->min_price},{$r->max_price}";
	}

	function updateActiveState()
	{
	    $this->ajaxHeaders();
	    if( $_POST['currentstate']!= 'true' ){ $v='N';} else{ $v='Y';}
	    $uid= $this->shop->seller2uid();
	    $row= $this->core_model->product_data( $_POST['id'] );
	    if( $row['uid'] == $uid )
	    {
		$this->db->where("ID='{$_POST['id']}'")->update("pages", array("active"=>$v)) ;
	    }
	    echo 1;
	}

	function comment()
	{
	    $this->ajaxHeaders();

	    if( $this->db->where(["uid"=>$_SESSION['i'],"module"=>"comment","parent_id"=>$_POST['product']])->get("pages")->num_rows() > 0 )
	    {
		echo 'عفواً لقد قمت بالتعليق مسبقا';
	    }else{

	    $this->db->insert("pages", array(
		"module"=>'comment',
		"parent_id"=> $_POST['product'],
		"content"=>$_POST['comment'],
		"uid"=>$_SESSION['i'],
		"meta"=> $_POST['rate']
	    ));
	    $this->db->query("update _d_pages set "
		    . "`votes`=`votes`+".$_POST['rate']
		    . " , `voters`=`voters`+1"
		    . " , `rate`= (`votes`/`voters`) "
		    . " where `ID`='{$_POST['product']}'");
	    echo 1;
	    }
	}

	public function states($module)
	{
		$this->ajaxHeaders();
	}


         public function getFields($catid, $product_id=0)
        {
             $this->ajaxHeaders();
                $fields= $this->core_model->fieldList($catid);
                $ar= array();
                if( is_array( $fields ) )
                {
                    foreach( $fields as $field )
                    {
                        $ar[] = $this->core_model->gentrateFieldTag( $field,$product_id );
                    }
                    $ar[]= '<script>$.validate({modules : \'date\'});</script>';
                    echo implode("", $ar);

                }else{
                    echo '' ;
                }

        }


	public function updateCart($product)
	{
	    list($id, $price,$type)= explode("-",$product) ;
	    $this->ajaxHeaders();
	    $cart=$_SESSION[$type];
	    if( !is_array( $cart ) ) { $_SESSION[$type] = $cart =array() ; }
	    if( isset($cart[$id]['count']) )
	    {
		$cart[$id]['count']= $cart[$id]['count']+1;
	    }
	    else{
		$row= $this->core_model->product_data($id);
		$cart[$id]= array("count"=>1, "id"=>$id, "title"=>$row['title'], "price"=>$row['price']);
	    }
	    $_SESSION[$type]= $cart;
	    echo $this->updateCartPrices();
	}

	public function updateCartCount($id, $count)
	{
	    $_SESSION['cart'][$id]['count']=$count;
	    echo 1;
	}

	public function delCart($id)
	{
	    unset($_SESSION['cart'][$id]);
	    echo 1;
	}

	public function updateCartPrice()
	{
	    $price=0;
	    if( isset($_SESSION['cart']) &&  is_array($_SESSION['cart']) )
	    {
		foreach($_SESSION['cart'] as $id=>$v)
		{
		    $price += $_SESSION['cart'][$id]['count']*$_SESSION['cart'][$id]['price'];
		}
	    }
	    echo $price;
	}

	public function updateCartPrices()
	{
		// print_r($_SESSION);
	    $price=0;
	    $output= '<ol class="new-list">';
	    if(isset($_SESSION['cart']) && is_array($_SESSION['cart']) )
	    {
		$cart=$_SESSION['cart'] ;
		foreach ( $cart as $id=>$v )
		{
		    $row= $this->core_model->product_data($id);
		    if($row['ID'])
		    {
					$singlePrice = ($row['discount'])?$row['discount']: $row['price'];
		    $price+= ($v['count']?($v['count']*$singlePrice): $singlePrice);
		    $output.= '<li class="wimix_area cartRow_'.$row['ID'].'">
			<a class="pix_product" href="#">
			    <img alt="" src="'.$row['thumbnail_path'].'">
			</a>
			<div class="product-details">
			    <a href="'.$row['url'].'">'. $row['title'] .'</a>
			    <span class="sig-price">'.$cart[$id]['count'].'× '.$singlePrice.' جنيه</span>
			</div>
			<div class="cart-remove">
			    <a class="action" href="#" onclick="delCart(\''.$row['ID'].'\')">
				<i class="fa fa-close"></i>
			    </a>
			</div>
		    </li>';

		}
		}
		if(count($cart)){
		$output .= '</ol><div class="top-subtotal">الاجمالي:
		    <span class="sig-price">'.$price.' جنيه</span>
		</div>';
		}else{
		    $cart=array();
		    $output .= '</ol><div class="top-subtotal">الاجمالي:
		    <span class="sig-price">0 جنيه</span>
		    </div>';
		}
		echo json_encode( array($output,count($cart), "price"=>$price) );
	    }else{
		echo json_encode( array('',0, "price"=>0) );
	    }
	}

	private function ajaxHeaders()
	{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
	}


	public function add2WishList($product)
	{
	    if(!$_SESSION['wishlist']){ $_SESSION['wishlist']= array(); }
	    if( !in_array($product,$_SESSION['wishlist']) )
	    {
		$_SESSION['wishlist'][]=$product;
	    }
	    if( $_SESSION['i'] )
	    {
		if( $this->db->where("uid='{$_SESSION['i']}' and `item_id`='{$product}'")->get("wishlist")->num_rows() == 0 )
		{
		    $this->db->insert("wishlist", array("uid"=>$_SESSION['i'],"item_id"=>$product));
		}
	    }
	    echo 1;
	}


	public function add2compare($product)
	{
	    if(!$_SESSION['compare']){ $_SESSION['compare']= array(); }
	    if( !in_array($product,$_SESSION['compare']) )
	    {
		$_SESSION['compare'][]=$product;
	    }
	    if( $_SESSION['i'] )
	    {
		if( $this->db->where("uid='{$_SESSION['i']}' and `item_id`='{$product}'")->get("compare")->num_rows() == 0 )
		{
		    $this->db->insert("compare", array("uid"=>$_SESSION['i'],"item_id"=>$product));
		}
	    }
	    echo 1;
	}
}
