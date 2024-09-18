<?php
	class Cart {
		// url where the Cart folder was installed
	    protected $baseURL;
	    public $database_connection;
	    public $paypal_email;
	    public $paypal_color;
	    public $no_shipping;
	    public $return_url;
	    public $cancel_url;
	
	    public function __construct(){
	        $this->baseURL = (strpos($_SERVER['SERVER_PROTOCOL'], "HTTPS") === false ? "http" : "https")."://".$_SERVER['SERVER_NAME'].str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);
			//$this->public_var = "";
	    }
	    
	    public function cart() {
	    	return "<div id=\"cart\" class=\"cart\">".$this->cart_inner()."</div>";
	    }
	    
	    public function cart_inner() {
	    	$cart =
			"<div class=\"cart_title_div\">
				CART&nbsp;&nbsp;&nbsp;<i class=\"fa fa-shopping-cart\"></i>&nbsp;&nbsp;&nbsp;
				<span id=\"cart_loading_span\" class=\"cart_loading_span\">Loading&nbsp;<i class=\"fa fa-spinner\"></i></span>
				<div style=\"float:right; cursor:pointer;\" onclick=\"toggle_cart();\"><i class=\"fa fa-times-circle\"></i></div>
			</div>";
			session_start();
			//$_SESSION['cart_items'] = '[{"id":1,"quantity":1,"type":"test"},{"id":2,"quantity":1,"type":""}]';
			if(isset($_SESSION['cart_items'])) {
			    $cart_items = json_decode($_SESSION['cart_items'], true);
			    $query = "SELECT * FROM `products`";
			    $ids = array();
			    for($i = 0; $i < count($cart_items); $i++) {
			    	$cart_item = $cart_items[$i];
			    	array_push($ids, "id = ".$cart_item["id"]);
			    }
			    if(count($cart_items) > 0) {
				    $query .= " WHERE ".implode(" OR ", $ids);
				} else {
					$query .= " WHERE id=0";
					$cart .= "<div class=\"cart_item_table\"><i>No items in cart.</i></div>";
				}
				$total = 0.00;
				$result = mysqli_query($this->database_connection, $query) or die(mysqli_error());
				while($product = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
					$index = 0;
					foreach($cart_items as $key => $cart_item)
				    {
				    	if($cart_item["id"] == $product['id']) {
					    	$index = $key;
				    	}
				    }
				    $type = "";
				    if(($product["type1"] <> "" && $product["type1"] <> "none") || ($product["type2"] <> "" && $product["type2"] <> "none") || ($product["type3"] <> "" && $product["type3"] <> "none") || ($product["type4"] <> "" && $product["type4"] <> "none") ||
				       ($product["type5"] <> "" && $product["type5"] <> "none") || ($product["type6"] <> "" && $product["type6"] <> "none") || ($product["type7"] <> "" && $product["type7"] <> "none") || ($product["type8"] <> "" && $product["type8"] <> "none")) {
					    $type =
					    "<select id=\"cart_item_type_".$product["id"]."\" class=\"cart_item_type\" onchange=\"update_cart_item(".$product['id'].");\">
							".($product["type1"] <> "" && $product["type1"] <> "none" ? "<option value=\"".$product["type1"]."\" ".($product["type1"] == $cart_items[$index]["type"] ? "selected" : "").">".$product["type1"]."&nbsp;&#9660;</option>" : "")."
							".($product["type2"] <> "" && $product["type2"] <> "none" ? "<option value=\"".$product["type2"]."\" ".($product["type2"] == $cart_items[$index]["type"] ? "selected" : "").">".$product["type2"]."&nbsp;&#9660;</option>" : "")."
							".($product["type3"] <> "" && $product["type3"] <> "none" ? "<option value=\"".$product["type3"]."\" ".($product["type3"] == $cart_items[$index]["type"] ? "selected" : "").">".$product["type3"]."&nbsp;&#9660;</option>" : "")."
							".($product["type4"] <> "" && $product["type4"] <> "none" ? "<option value=\"".$product["type4"]."\" ".($product["type4"] == $cart_items[$index]["type"] ? "selected" : "").">".$product["type4"]."&nbsp;&#9660;</option>" : "")."
							".($product["type5"] <> "" && $product["type5"] <> "none" ? "<option value=\"".$product["type5"]."\" ".($product["type5"] == $cart_items[$index]["type"] ? "selected" : "").">".$product["type5"]."&nbsp;&#9660;</option>" : "")."
							".($product["type6"] <> "" && $product["type6"] <> "none" ? "<option value=\"".$product["type6"]."\" ".($product["type6"] == $cart_items[$index]["type"] ? "selected" : "").">".$product["type6"]."&nbsp;&#9660;</option>" : "")."
							".($product["type7"] <> "" && $product["type7"] <> "none" ? "<option value=\"".$product["type7"]."\" ".($product["type7"] == $cart_items[$index]["type"] ? "selected" : "").">".$product["type7"]."&nbsp;&#9660;</option>" : "")."
							".($product["type8"] <> "" && $product["type8"] <> "none" ? "<option value=\"".$product["type8"]."\" ".($product["type8"] == $cart_items[$index]["type"] ? "selected" : "").">".$product["type8"]."&nbsp;&#9660;</option>" : "")."
						</select>";
					}
					$cart .= 
					"<table class=\"cart_item_table\">
						<tr>
							<td class=\"cart_item_img_td\" style=\"background-image:url('http://".$_SERVER['SERVER_NAME'].$product['image1']."');\"></td>
							<td class=\"cart_item_info_td\">
								<input id=\"cart_item_quantity_".$product["id"]."\" class=\"cart_item_quantity\" onkeydown=\"highlight_cart_item_update_td(".$product['id'].");\" type=\"text\" value=\"".$cart_items[$index]["quantity"]."\" /> x <i>".$product['title']."</i><br />
								$".(($product['on_sale'] == "no" ? $product['price'] : $product['sale_price']) * $cart_items[$index]["quantity"])."	".($type <> "" ? " &middot; ".$type : "")."
							</td>
							<td id=\"cart_item_update_td_".$product["id"]."\" class=\"cart_item_update_td\" onclick=\"update_cart_item(".$product['id'].");\"><i class=\"fa fa-retweet\"></i></td>
							<td class=\"cart_item_remove_td\" onclick=\"remove_cart_item(".$product['id'].");\"><i class=\"fa fa-times\"></i></td>
						</tr>
					</table>";
					$form_items .= 
							  "<input type=\"hidden\" name=\"item_number_".($index + 1)."\" value=\"".$product['id']."\">
						       <input type=\"hidden\" name=\"item_name_".($index + 1)."\" value=\"".$product["title"]." ".($cart_items[$index]["type"] <> "" && $cart_items[$index]["type"] <> "none" ? "(".$cart_items[$index]["type"].")" : "")."\">
						       <input type=\"hidden\" name=\"amount_".($index + 1)."\" value=\"".($product['on_sale'] == "no" ? $product['price'] : $product['sale_price'])."\">
						       <input type=\"hidden\" name=\"quantity_".($index + 1)."\" value=\"".$cart_items[$index]["quantity"]."\">";
				    if($product['on_sale'] == "no") {
						$total = $total + $product["price"] * $cart_items[$index]["quantity"];
					} else {
						$total = $total + $product["sale_price"] * $cart_items[$index]["quantity"];
					}
				}
				if(count($cart_items) > 0) {
					$cart .= 
					"<div class=\"cart_total_div\">
						SUB-TOTAL
						<div style=\"float:right;\">$".round($total, 2)."</div>
					</div>
					<form name=\"_xclick\" target=\"paypal\" action=\"https://www.paypal.com/uk/cgi-bin/webscr\" method=\"post\">
						<input type=\"hidden\" name=\"cmd\" value=\"_cart\">
						".$form_items."
						<input type=\"hidden\" name=\"upload\" value=\"1\" />
						<input type=\"hidden\" name=\"currency_code\" value=\"USD\">
						<input type=\"hidden\" name=\"no_shipping\" value=\"".$this->no_shipping."\">
						<input type=\"hidden\" name=\"return\" value=\"".$this->return_url."?status=paid\">
						<input type=\"hidden\" name=\"cancel_return\" value=\"".$this->cancel_url."\">
						<input type=\"hidden\" name=\"business\" value=\"".$this->paypal_email."\">
						<input type=\"hidden\" name=\"cpp_cart_border_color\" value=\"".$this->paypal_color."\">
						<input type=\"submit\" value=\"CHECKOUT\" class=\"cart_checkout_button\">
					</form>";
				}
			} else {
				$cart .= "<div class=\"cart_item_div\"><i>No items in cart.</i></div>";
			}
			return $cart;
	    }
	    
	    public function shopping_cart_icon() {
		    return "<i class=\"fa fa-shopping-cart\" onclick=\"toggle_cart();\"></i>";
	    }
	    
	    public function shopping_cart_button($class, $text) {
		    return "<button class=\"".$class."\" onclick=\"toggle_cart();\">".$text."</button>";
	    }
	    
	    public function add_to_cart_button($product_id, $quantity, $type, $text, $class) {
		    return "<button class=\"".$class."\" onclick=\"add_cart_item(".$product_id.", ".$quantity.", '".$type."');\">
				".$text."
			</button>";
	    }
	    
	    public function details_button($text, $class, $url) {
		    return "<button class=\"".$class."\" onclick=\"location.href='".$url."';\">
				".$text."
			</button>";
	    }
	    
	    public function URL() {
	    	return str_replace("{baseURL}", $this->baseURL, "{baseURL}/submit.php");
	    }
	    
	    public function styles() {
	    	$styles = <<< EOF
	    		<link href="{baseURL}/css/main.css" rel="stylesheet" type="text/css">
EOF;
			return str_replace("{baseURL}", $this->baseURL, $styles);
	    }
	    
	    public function scripts() {
	    	$scripts = <<< EOF
				<script src="{baseURL}/js/main.js"></script>
				<script>
					function toggle_cart() {
						$("#cart").toggle();
					}
					
					function add_cart_item(product_id, quantity, type) {
						$("#cart_loading_span").show();
						$.post( "{baseURL}/add_cart_item.php", { product_id: product_id, quantity: quantity, type: type } )
							.done(function( data ) {
								$("#cart").html( data );
							})
							.fail(function() {
								alert("There was an network error. Please try again.");
							})
							.always(function() {
								$("#cart_loading_span").hide();
							});
						$("#cart").show();
					}
					
					function remove_cart_item(product_id) {
						$("#cart_loading_span").show();
						$.post( "{baseURL}/remove_cart_item.php", { product_id: product_id } )
							.done(function( data ) {
								$("#cart").html( data );
							})
							.fail(function() {
								alert("There was an network error. Please try again.");
							})
							.always(function() {
								$("#cart_loading_span").hide();
							});
					}
					
					function update_cart_item(product_id) {
						$("#cart_loading_span").show();
						var quantity = $("#cart_item_quantity_" + product_id).val();
						var type = $("#cart_item_type_" + product_id).val(); if(!type) { type = ""; }
						add_cart_item(product_id, quantity, type);
					}
					
					function highlight_cart_item_update_td(product_id) {
						$("#cart_item_update_td_" + product_id).attr('class', 'cart_item_update_td_highlighted');
					}
				</script>
EOF;
			return str_replace("{baseURL}", $this->baseURL, $scripts);
	    } 
	    
	}
?>