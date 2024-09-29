<?php
class Shop extends CI_Model
{

	public function getSimilarProducts(string $title, int $id) : object{
		$rows= $this->db->
			limit(12)->
			select("ID,title,thumbnail,parent_id")->
			order_by("RAND()")->
			like("title", $title)->
			where(["module"=>"products", "active"=>"Y"])->
			get("pages")->
			result();
		// echo $this->db->last_query(); die;
		return (object) ($rows?$rows:[]);
	}
	# ##########################################################
	
	public function getNextProduct(int $id) : object{
		$row= $this->db->
			select("ID,title,parent_id")->
			order_by("ID ASC")->
			where(["module"=>"products", "ID > "=>$id])->
			get("pages")->
			row();
		return (object) ($row?$row:[]);
	}
	# ##########################################################
	
	public function getPrevProduct(int $id) : object{
		$row = $this->db->
			select("ID,title,parent_id")->
			order_by("ID DESC")->
			where(["module"=>"products", "ID < "=>$id])->
			get("pages")->
			row();
		return (object) ($row?$row:[]);
	}
	# ##########################################################
	
	
	public function shop_img(string $pic_src='',string $default_img="theme/default_img.jpg") {
		return ($pic_src!='' && is_file($pic_src)) ?
			base_url($pic_src) :
			base_url($default_img) ;
	}

	# ##########################################################
	public function getShippingPrice(int $id)
	{
		if ($id == 0)  $field =  "shipping_size_0";
		if ($id == 1)  $field =  "shipping_size_1";
		if ($id == 2)  $field =  "shipping_size_2";
		return $this->db->select($field)->get("settings")->row()->$field;
	}

	# ##########################################################
	/**
	 * calculate shipping prices
	 * حساب اسعار الشحن لكامل السلة
	 *
	 * @return Int
	 */
	public function getShippingPrices(): int
	{
		$shipping_price = [];
		if (isset($_SESSION['cart']) && is_array($_SESSION)) {
			foreach ($_SESSION['cart'] as $id => $v) {
				// if ()
				$row = $this->core_model->product_data($id);
				// var_dump($row) ;die;
				$shipping =  ($row['shipping_size'] ? $row['shipping_size'] : 1);
				$shipping_price[] = $this->getShippingPrice($shipping);
			}
			if ($shipping_price) {
				return array_sum($shipping_price);
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}

	# ##########################################################
	public function getHomeCats($limit=10, $order="ID desc")
	{
		$rows= $this->db->
			select("ID,title,thumbnail,pic")->
			where(['module' => 'category'])->
			limit($limit)->
			order_by($order)->
			get('pages')->
			result();
		return $rows;
	}

	# ##########################################################
	public function getHomeCatsByOrder()
	{
		$cats= [];
		$rows = unserialize(
				$this->db->where("option_name='main_cat_order'")->
				get("options")->
				row()->option_value
		);
		$cat_order= $rows['order'];
		foreach ( $cat_order as $k=>$cat_order ){
			$cats[$k]= $this->db->
				select("ID,title,thumbnail,pic")->
				where(['module'=>'category','ID'=>$k])->
				get('pages')->
				row();
			$cats[$k]->products = $this->getLastProducts(10,"ID DESC", $k) ;
		}
		return $cats;
	}
	# ##########################################################
	public function getProductList($where = [], int $limit = 10, $order = "ID DESC")
	{
		$w=["module" => 'products'];
		if ( $where ) $w= array_merge($where);
		$rows = $this->db->
			limit($limit)->
			order_by($order)->
			select("ID,title,module,star,pic,thumbnail,parent_id,content,stock,code,rate,
			(SELECT `value`
				FROM ". $this->db->dbprefix("product") ."
			WHERE
				product_id= ". $this->db->dbprefix('pages') .".ID AND
				input_id='discount'
			LIMIT 1) AS discount,
			(SELECT `value`
				FROM ". $this->db->dbprefix("product") ."
			WHERE
				product_id= ". $this->db->dbprefix('pages') .".ID AND
				input_id='price'
			LIMIT 1) AS price,
			concat(parent_id,'/',ID,'.html') as url")->
			where($w)->
			get('pages')->
			result();
		// echo $this->db->last_query(); die;
		return $rows;
	}

	# ##########################################################
	public function getStared(int $limit = 10, $order = "ID DESC")
	{
		return $this->getProductList(["module" => 'products', "star" => "Y"], $limit, $order);
	}
	# ##########################################################
	public function getLastProducts(int $limit = 10, $order = "ID DESC", $catid = 0)
	{
		$where = ["module" => 'products'];
		if ($catid != 0) $where['parent_id'] = $catid;
		return $this->getProductList($where, $limit, $order);
	}
	# ##########################################################


	function invoince($cart_id, $displayPrintButton = true)
	{
		$row = $this->db->where("`cart_id`='{$cart_id}'")->get("cart_cache")->row();
		$user = $this->getUserData($row->uid);
		$total = 0;
		$output = '<div class="clearfix"></div>'
			. (($displayPrintButton == true) ? '<a href=' . base_url() . "invoince/InvoincePrint/" . $cart_id . ' class="btn btn-primary" target=_blank><span class="glyphicon glyphicon-print"></span> طباعة</a>' : '')
			. '<br><br><table class="userinvoice no-border">
		    <tr>
			<td class="col-md-6 text-center"><img src="' . base_url() . 'assets/img/logo-pic/logo.png" class="img-responsive" /></td>
			<td class="col-md-3">&nbsp;</td>
			<td class="col-md-3 user-data">
			    <p><span class="text-muted">الاسم :  </span> ' . $row->fname . " " . $row->lname . '</p>
			    <p><span class="text-muted">الهاتف  : </span> ' . $row->phone . '</p>
			    <p><span class="text-muted">تاريخ الطباعة  : </span> ' . date('Y-m-d') . '</p>
			</td>
		    </tr>
		</table>
		<div class="clearfix"></div>'
			. '<table class="userinvoice no-border printfix">'
			. '<thead>
		    <tr>
			<th width=7% class="text-center">م</th>
			<th width=8% class="text-center">السعر</th>
			<th width=7% class="text-center">الكمية</th>
			<th width=70% class="note\">المنتج</th>
			<th width=8% class="text-center">الإجمالي</th>
		    </tr>
		</thead><tbody>';
		foreach ($this->db->where(array("cart_id" => $cart_id))->order_by("ID", "desc")->get("cart_items")->result() as $row) :
			$output .= "<tr class='toggle-gary withdraw-{$row->withdraw}'>"
				. "<td class=\"text-center\">" . ((++$i)) . ". </td>"
				. "<td class=\"text-center\">" . (($row->discount) ? $row->discount : $row->price) . "</td>"
				. "<td class=\"text-center\">" . $row->count . "</td>"
				. "<td>" . $row->product_title . "</td>"
				. "<td class=\"text-center\">" . $row->count * (($row->discount) ? $row->discount : $row->price) . "</td>"
				. "</tr>";
			$total += $row->count * (($row->discount) ? $row->discount : $row->price);
		endforeach;
		$output .= '<tr class="tfoot"><td colspan=4 class="text-left strong">المبلغ الكلي  &nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;</td><td class="text-center strong">' . $total . '</td></tr></tbody></table>';
		return $output;
	}


	function getDateFromDateline($dateline)
	{
		$dates = preg_match("/(([0-9]{4})\-([0-9]{2})\-([0-9]{2}))\ (([0-9]{2})\:([0-9]{2})\:([0-9]{2}))/", $dateline, $match);
		return (object) array('date' => $match[1], "time" => $match[5]);
	}

	public function userInvoice($id, $displayPrintButton = true)
	{
		$output = '<div class="clearfix">'
			. (($displayPrintButton == true) ? '<a href=' . base_url() . "invoinceuser/InvoinceuserPrint/" . $id . ' class="btn btn-primary" target=_blank><span class="glyphicon glyphicon-print"></span> طباعة</a>' : '')
			. '</div>'
			. '<div class="userinvoice">';
		foreach ($this->db->where(array("uid" => $id))->order_by("ID", "desc")->get("balance")->result() as $row) :
			$output .= "<div class='toggle-gary withdraw-{$row->withdraw}'>"
				. "<div class=\"col-md-1\">" . ((++$i)) . "</div>"
				. "<div class=\"col-md-2 text-center\">" . ((($row->withdraw == 'N') ? $row->balance . " جنيه " : '-')) . "</div>"
				. "<div class=\"col-md-2 text-center\">" . ((($row->withdraw == 'Y') ? $row->balance . " جنيه " : '-')) . "</div>"
				. "<div class=\"col-md-5 note\">" . $row->note . "</div>"
				. "<div class=\"col-md-2\">" . $this->getDateFromDateline($row->dateline)->date . "</div>"
				. "</div>";
		endforeach;
		$output .= '</div>';
		return $output;
	}

	public function userInvoice_table($id, $displayPrintButton = true)
	{
		$output = '<div class="clearfix">'
			. (($displayPrintButton == true) ? '<a href=' . base_url() . "invoinceuser/InvoinceuserPrint/" . $id . ' target=_blank><span class="glyphicon glyphicon-print"></span></a>' : '')
			. '</div>'
			. '<table class="userinvoice">';
		foreach ($this->db->where(array("uid" => $id))->order_by("ID", "desc")->get("balance")->result() as $row) :
			$output .= "<tr class='toggle-gary withdraw-{$row->withdraw}'>"
				. "<td class=\"col-md-1\">" . ((++$i)) . "</td>"
				. "<td class=\"col-md-2 text-center\">" . ((($row->withdraw == 'N') ? $row->balance . " جنيه " : '-')) . "</td>"
				. "<td class=\"col-md-2 text-center\">" . ((($row->withdraw == 'Y') ? $row->balance . " جنيه " : '-')) . "</td>"
				. "<td class=\"col-md-5 note\">" . $row->note . "</td>"
				. "<td class=\"col-md-2\">" . $this->getDateFromDateline($row->dateline)->date . "</td>"
				. "</tr>";
		endforeach;
		$output .= '</table>';
		return $output;
	}


	public function userList($where = '')
	{
		if ($where) $this->db->where($where);
		return $this->db->get("user")->result();
	}

	public function userBuyedValue($id)
	{
		$price = 0;
		$discount = 0;
		$count = 0;
		$lastPrice = 0;
		foreach ($this->db->where("`uid`='{$id}'")->get("cart_items")->result() as $row) :
			$price += $row->count * $row->price;
			$discount += $row->count * $row->discount;
			$count += $row->count;
			$lastPrice += $row->count * (($row->discount) ? $row->discount : $row->price);
		endforeach;
		return array("price" => $price, "discount" => $discount, "count" => $count, "lastPrice" => $lastPrice);
	}

	public function userSelledValue($id)
	{
		return $this->db->where("uid='{$id}'")->get("balance_history")->row()->balance;
	}


	public function userSelledValueAllTime($id)
	{
		$row = $this->db->query("select sum(`balance`) as `b` from `_d_balance` where `uid`='{$id}' and `withdraw`='N'")->row()->b;
		//echo $this->db->last_query();
		return $row;
	}

	public function cart_cache_data($cart_id)
	{
		$price = 0;
		$discount = 0;
		$count = 0;
		foreach ($this->db->where("`cart_id`='{$cart_id}'")->get("cart_items")->result() as $row) :
			$price += $row->count * $row->price;
			$discount += $row->count * $row->discount;
			$count += $row->count;
		endforeach;
		return ["price" => $price, "discount" => $discount, "count" => $count,
			"shipping_price"=>$row->shipping_price
		];
	}


	public function cart_data($cart_id)
	{
		return $this->db->where("`cart_id`='{$cart_id}'")->get("cart_cache")->row();
	}

	public function fullCart($cart_id)
	{
		$prod = array();
		foreach ($this->db->where("cart_id='{$cart_id}'")->get("cart_items")->result_array() as $row) :
			$prod[] = array("cart" => $row, "prod" => $this->core_model->product_data($row['product_item']));
		endforeach;
		return $prod;
	}


	public function order_status($order)
	{
		switch ($order) {
			case "standby":
			case "":
				$order = "تم تلقي الطلب";
				break;
			case "collectinCenter":
				$order = "تم الإرسال لمركز تجميع الطلبات";
				break;

			case "sent":
				$order = "تم تسليم الطلب";
				break;
		}
		return $order;
	}


	public function myproducts()
	{
		$ar = array();
		$rows = $this->db->where("uid='" . $this->seller2uid() . "' and `module`='products'")->get("pages")->result();
		foreach ($rows as $row) {
			$ar[] = $this->core_model->product_data($row->ID);
		}
		return $ar;
	}

	function sellerIdCheck($id)
	{
		$result = preg_match("/([0-9]{1,})+\@([0-9]{1,})+\/(.*)/", $id, $match);
		if ($result) {
			$id = $match[1];
			$salt = $match[2];
			$pwd = $match[3];
			$type = 'seller';
			$seller = $this->db->where("ID='{$id}' and `salt`='{$salt}' and `pwd`='{$pwd}' and `user_type`='{$type}'")->get("user")->row();
			//echo $this->db->last_query();
			if ($seller->ID) {
				return true;
			} else {
				return false;
			}
			//return $seller;
		} else {
			return false;
		}
	}

	function seller2uid()
	{
		$id = $_SESSION['seller'];
		$result = preg_match("/([0-9]{1,})+\@([0-9]{1,})+\/(.*)/", $id, $match);
		if ($result) {
			$id = $match[1];
			$salt = $match[2];
			$pwd = $match[3];
			$type = 'seller';
			$seller = $this->db->where("ID='{$id}' and `salt`='{$salt}' and `pwd`='{$pwd}' and `user_type`='{$type}'")->get("user")->row();
			//echo $this->db->last_query();
			if ($seller->ID) {
				return $seller->ID;
			} else {
				echo '<script>location.href="' . base_url() . "logout" . '";</script>';
			}
			//return $seller;
		} else {
			echo '<script>location.href="' . base_url() . "logout" . '";</script>';
		}
	}

	function homeCats($id)
	{
		$cat = $this->db->where("ID='{$id}'")->get("pages")->row();
?>
		<!--product area start-->
		<section class="product_area product_area_3">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="all_product animated fadeInUp">

							<div class="row">
								<div class="col-md-12">
									<div class="new_lt_right_side">

										<div class="tab-content">
											<div role="tabpanel" class="tab-pane active" id="mobiles">
												<div class="row">
													<div class="col-md-4">
														<img src="<?= base_url() . "uploads/category/" . $cat->pic ?>" class="category-img" alt="">
													</div>
													<div class="col-md-8">
														<?php foreach ($this->db->query("select * from _d_pages where `module`='products' and `cat_chain` regexp '^{$id}' and `active`='Y' order by rand() limit 6")->result()  as $row) {
															$row = $this->core_model->product_data($row->ID); ?>
															<div class="col-md-4 col-sm-6">
																<div class="all-pros  all-pros-4 all-pros-latest">
																	<?php if ($row['code']) { ?><div class="single_product single_product_2">
																			<span><?= $row['code'] ?></span>
																		</div> <?php } ?>
																	<?php if ($row['discount']) { ?><div class="single_product_3 ">
																			<span>خصم</span>
																		</div><?php } ?>
																	<div class="sinle_pic">
																		<a href="<?= $row['url'] ?>">
																			<img src="<?= base_url() . "thumb.php?file=uploads/products/" . $row['pic'] . "&w=450&h=295" ?>" alt="" />

																		</a>
																	</div>

																	<div class="product_content">
																		<div class="usal_pro">
																			<div class="product_name_2">
																				<h2>
																					<a href="<?= $row['url'] ?>"><?= mb_substr($row['title'], 0, 20, 'utf-8'); ?></a>
																				</h2>
																			</div>
																			<div class="product_price">

																			</div>
																			<div class="price_box">
																				<span class="spical-price"><?= $row['price'] ?> جنيه</span>
																			</div>

																		</div>
																	</div>
																</div>
															</div>

														<?php } ?>


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
			</div>
		</section>
		<!--product area end--> <?php
													}

													function getad($id)
													{
														$row = $this->db->where("`position`='{$id}'")->get("ads_positions")->row();
														$row->data = $this->db->where("`ID`='{$row->ad}'")->get("pages")->row();
														//var_dump($row);die;
														return $row;
													}

													function getCatIndexOrder()
													{
														$row = unserialize($this->db->where(array("option_name" => "main_cat_order"))->get("options")->row()->option_value);
														$r = array_flip($row['order']);
														ksort($r);
														$menu = array();
														foreach ($row['title'] as $k) {
															if (in_array($k, $r)) {
																$menu[] = $k;
															}
														}
														//print_r($menu);die;
														return $menu;
													}

													function countryList()
													{
														return $this->db->order_by("title", "asc")->where("module='country'")->get("pages")->result();
													}

													/*function order_status($i)
    {
	$output='';
	switch($i)
	{
	    case 0:
		$output="تم تلقي الطلب";
		break;
	    case 1:
		$output="تم شحن الطلب";
		break;
	    case 2;
		$output="تم توصيل الطلب الطلب";
		break;
	    case -1;
		$output="تم الغاء الطلب";
		break;
	}
	return $output;
    }*/

													function userData($id)
													{
														return $this->db->where("ID='{$id}'")->get("user")->row();
													}

													function cartDetails($id)
													{
														$cart = $this->db->where(array("ID" => $id))->get("cart_cache")->row();
														foreach ($this->db->where("cart_id='{$cart->cart_id}'")->get("cart_items")->result() as $row) {
															$row->details = $this->core_model->product_data($row->product_item);
															$cart->items[] = $row;
														}
														$cart->buyer = $this->db->where(array("ID" => $row->uid))->get("user")->row();
														return $cart;
													}

													function paypalPaymentStatus($status)
													{
														switch ($status):
															case "Canceled_Reversal":
																break;
															case "Completed":
																break;
															case "Created":
																break;
															case "Denied":
																break;
															case "Expired":
																break;
															case "Failed":
																break;
															case "Pending":
																break;
															case "Refunded":
																break;
															case "Reversed":
																break;
															case "Processed":
																break;
															case "Voided":
																break;
														endswitch;
													}

													function getCartCasheData($cartID)
													{
														$price = 0;
														$cart = $this->db->where("`cart_id`='{$cartID}'")->get("cart_cache")->row();
														foreach ($this->db->where("`cart_id`='{$cartID}'")->get("cart_items")->result() as $row) {
															$cart->items[] = $row;
															$price += $row->price;
														}
														$cart->price = $price;
														return $cart;
													}


													function getUserData($id)
													{
														return $this->db->where("`ID`='{$id}'")->get("user")->row();
													}

													function comments($id)
													{
														return $this->db->where("module='comment' and `parent_id`='{$id}' and `active`='Y'")->get("pages")->result();
													}


													function related($title, $id)
													{
														return $this->db->limit(8)->order_by("rand()")->where("`title` like binary('%{$title}%') and ID <>'{$id}' and module='products' and `active`='Y'")->get("pages")->result();
													}

													function alert($message, $type = 'success', $redir = '')
													{
														if ($type == 'success') $img = "check";
														else $img = "error";
														?><div class="notify <?= $type; ?>box text-center">
			<h1>تنبيه</h1>
			<span class="alerticon"><img src="<?= base_url() ?>assets/img/<?= $img ?>.png" alt="<?= $type; ?>" /></span>
			<p><?= $message ?></p>
		</div><?php
														if ($redir) {
															echo '<script>setTimeout( function(){location.href="' . $redir . '"}, 3000);</script>';
														}
													}

													function shopOptions($option = '')
													{
														return $this->db->where("`option_name`='{$option}'")->get("options")->row()->option_value;
													}

													function optionToArray($option)
													{
														$option = unserialize($this->shopOptions($option));
														if (!is_array($option)) return array();
														else return $option;
													}

													function shopTopMenu()
													{
														$o = array();
														$rows = $this->optionToArray('main_cat_order')[order];
														foreach ($rows as $k => $v) {
															$o[$v] = $k;
														}
														sort($o);
														foreach ($o as $k) {
															$row = $this->pageData($k);
															echo "<li class=\"home-dropdown\">
					<a href=\"" . $this->getCatUrl($k) . "\"><i class=\"glyphicon " . $row->icon . "\" aria-hidden=\"true\"></i>" . $row->title . "</a>";
															if ($this->hasChilds($k, 'category')) {
																echo "<ul class=\"text-right\">";
																foreach ($this->getChilds($k, 'category') as $child) {
																	echo "<li><a href=\"" . $this->getCatUrl($child->ID) . "\">" . $child->title . "</a></li>";
																}
																echo "</ul>";
															}
															echo "</li>";
														}
													}

													function getCatUrl($id)
													{
														return base_url() . get_cookie('country') . "/" . $id . "/";
													}

													function hasChilds($id, $module)
													{
														$rows = $this->db->where("parent_id='{$id}' and `module`='{$module}' and `active`='Y'")->get('pages')->num_rows();
														return $rows;
													}


													function getChilds($id, $module)
													{
														$rows = $this->db->where("parent_id='{$id}' and `module`='{$module}' and `active`='Y'")->get('pages')->result();
														return $rows;
													}


													function pageData($id)
													{
														return $this->db->where("ID='{$id}' and `active`='Y'")->get('pages')->row();
													}

													function getUserCountryData()
													{
														$row = $this->db->where("icon='" . strtolower(get_cookie("country")) . "'")->get('pages')->row();
														$meta = unserialize($row->meta);
														$country = array("title" => $row->title, "coinName" => $meta['coinName'], "coinCode" => $meta['coinCode'], "icon" => $row->icon);
														return $country;
													}

													function catHasSubCats($parent_id = 0)
													{
														return $this->db->where("parent_id='{$parent_id}' and `module`='category' and `active`='Y'")->get("pages")->num_rows();
													}

													function shopCats($parent_id = 0)
													{
														$ar = array();
														if ($this->catHasSubCats($parent_id)) {
															foreach ($this->db->where("parent_id='{$parent_id}' and `module`='category' and `active`='Y'")->get("pages")->result() as $row) {
																$meta = unserialize($row->meta);
																$row->meta = $meta;
																$ar[] = $row;
															}
														}
														return $ar;
													}

													function catList($catid = 0)
													{
					?>
		<div class="main-categories text-right">
			<div class="container">
				<div class="row">
					<?php
														foreach ($this->shopCats($catid) as $row) { ?>
						<div class="col-sm-3 col-lg-1 col-xs-4">
							<div class="category-bg">
								<a href="<?php echo $this->shop->getCatUrl($row->ID); ?>"><img src="<?php echo base_url() . "uploads/category/" . $row->thumbnail ?>" alt="<?php echo $row->title; ?>"></a>
								<h3 class="text-center"><a href="<?php echo $this->shop->getCatUrl($row->ID); ?>"><?php echo $row->title ?></a></h3>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php
													}

													private function id2country($id)
													{
														return ($this->db->where("`ID`='{$id}'")->get('pages')->row()->icon);
													}


													public function productURL($id)
													{
														$row = $this->db->where("`ID`='{$id}' and `module`='products'")->get('pages')->row();
														return base_url() . $row->parent_id . '/' . $row->ID . ".html";
													}


													public function catURL($id, $ar = array(), $old = '')
													{
														$row = $this->db->where("`ID`='{$id}' and `module`='category'")->get('pages')->row();
														if ($row->parent_id != 0) {
															if ($old2 != '') $old2 = "{$old}-{$row->ID}";
															else $old2 = $row->ID;
															echo $old2 . "\r\n";
															$this->catURL($row->parent_id, [], $old2);
														} else {
															return $old;
														}
													}


													public function displayStars($stars)
													{
														for ($i = 1; $i <= $stars; $i ++) {
															echo '<i class="fa fa-star" aria-hidden="true"></i>';
														}
														for ($j = $i; $j <= 5; $j ++) {
															echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
														}
													}

													function productList($rows, $display_method = 1)
													{
														if (count($rows)) {
															foreach ($rows as $row) {
																$row = $this->core_model->product_data($row->ID);
																$this->load->view("category/display-method-" . $display_method, ['row' => $row]);
															}
														} else {
															$this->shop->alert('لا يوجد اي منتجات لعرضها', 'error');
														}
													}


													function productListStatic($where, $start, $limit, $catID = 0)
													{
	?>
		<!--========================================
grid and list view
===========================================-->
		<div class="container">
			<div class="product-overview archive-page pt-50 pb-50">
				<div class="row">
					<?php $rows = $this->db->order_by("ID", "desc")->limit($limit, $start)->where("`module`='products' $where")->get('pages');
														if ($rows->num_rows()) {
					?>
						<div class="col-xs-12 col-sm-9">
							<div class="xv-product-slides grid-view products" data-thumbnail="figure .xv-superimage" data-product=".xv-product-unit">
								<div class="row">

									<?php
															foreach ($rows->result_array() as $row) {
																$row = $this->core_model->product_data($row['ID']);
																$url = $this->productURL($row['ID']);
									?>

										<div data-pid="<?= $row['ID'] ?>" data-name="<?= $row['title'] ?>" data-category="<?= $row['parent_id'] ?>" data-price="<?= $row['price'] ?>" class="xv-product-unit">
											<div class="xv-product mb-15 mt-15 shadow-around">
												<figure>
													<img class="xv-superimage" src="<?= $row['thumbnail_path'] ?>" alt="<?= $row['title'] ?>" />
												</figure>
												<div class="xv-product-content">
													<h3><a href="<?= $url ?>"><?= $row['title'] ?></a></h3>
													<p><?= mb_substr($row['content'], 0, 100, "utf-8"); ?></p>

													<div class="xv-rating stars-5"></div>
													<span class="xv-price" dir="rtl"><?= $row['price'] ?> </span>
												</div>
												<!--xv-product-content-->
											</div>
										</div>

									<?php }

									?>
								</div>
							</div>

						</div>
					<?php } else {
															$this->shop->alert('لاتوجد منتجات', 'error');
														}
					?>
				</div>
				<!--row-->
			</div>
			<!--product overview-->
		</div>
		<!--container-->
		<!--========================================
Custom Block
===========================================-->
<?php
													}
												}
