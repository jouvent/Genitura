<?php
/*
 * Created on Apr 10, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

function basket(){

    i_am_logged();

    $dbh = get_dbh();
    $session = get_session();
    $lang = $_COOKIE['deb_lang'];
    $str = '';

    if ($lang == 'en'){
        $words = array('Name', 'Description', 'Price', 'How many?', 'Add', 'Checkout', 'Product may differ from actual photo');
    } else {
        $words = array('Nom', 'D&eacute;scription', 'Prix', 'Combien?', 'Ajouter', 'Acheter', 'le produit peut diff&eacute;rer de la photo');
    }

    $stmt = $dbh->execute("SELECT * FROM products");
    $str .= '<div align="center" id="basket">';
    $str .= '<br /><form name="basket">';

    $str .= '<table width="80%" align="center"><tr>';
    $str .= '<td width="10%">'.$words[0].'</td>';
    $str .= '<td width="15%">'.$words[1].'</td>';
    $str .= '<td width="5%">'.$words[2].'</td>';
    $str .= '<td width="15%"></td>';
    $str .= '<td width="20%"></td>';

    while ($row = $stmt->fetch_assoc()){
        if ($lang == 'en'){
            $name = $row['name_en'];
            $desc = $row['description_en'];
        } else {
            $name = $row['name'];
            $desc = $row['description'];
        }
        $text = 'text'.$row['id'];
        $button = 'text'.$row['id'];
        $str .= '</tr><tr>';
        $str .= '<td>'.$name.'</td>';
        $str .= '<td>'.$desc.'</td>';
        $str .= '<td align="right">'.number_format($row['price'], 2, '.', '').'</td>';
        //echo '<td>'.$words[3].'</td>';
        $str .= '<td align="right"><input type="text" name="'.$text.'" id="'.$text.'" value="1" size="3"></td>';
        $str .= '<td><input type="button" name="'.$button.'" id="'.$button.'" value="'.$words[4].'" onclick="add_to_cart(\''.$text.'\', \'iframe_basket\');"></td>';
    }

    $str .= '</tr><tr><td colspan="3"><b><div>'.$words[6].'</div></b></td>';

    $str .= '</tr></table>';

    $str .= '<iframe id="iframe_basket" name="iframe_basket" frameborder=0 height="400" width="700" src="./o/basket.php"></iframe></form>';

    $str .= '<table><tr><td><form action="/purchase/checkout" method="post"><input type="submit" name="submit" value="'.$words[5].'" border="0" align="top"></form></td></tr></table>';

    $str .= '</div><br /><br />';

    return render('basket.tpl', compact('str'));

}

function success(){
	i_am_logged();
	$session = get_session();
	$dbh = get_dbh();
	$lang = $_COOKIE['deb_lang'];

	$str = '';

	if ($lang == 'fr'){
		$words = array('Merci. Votre commande a &eacute;t&eacute; confirm&eacute;');
	} else {
		$words = array('Thank you. Your order has been processed.');
	}

	$str .= '<br /><br /><table width="100%"><tr><td align="center">'.$words[0].'</td></tr></table>';

	$dbh->execute("UPDATE orders SET confirmed = 'yes' WHERE fk_user_id = '".$session->user_id."'");

	return render('basket.tpl', compact('str'));
}

function fail(){
	i_am_logged();
	$session = get_session();
	$dbh = get_dbh();
	$lang = $_COOKIE['deb_lang'];

	$str = '';

	if ($lang == 'fr'){
		$words = array('Votre commande a &eacute;t&eacute; annul&eacute;');
	} else {
		$words = array('Your order has been cancelled. No payment has been processed');
	}

	$str .= '<br /><br /><table width="100%"><tr><td align="center">'.$words[0].'</td></tr></table>';

	return render('basket.tpl', compact('str'));


}

function checkout(){
	i_am_logged();
	$session = get_session();
	$dbh = get_dbh();
	$lang = $_COOKIE['deb_lang'];

    if ($lang == 'en'){
        $words = array('To checkout, please click on the Paypal button', 'Shopping Cart', 'Item', 'Quantity', 'Total Price', 'Checkout', 'name_en', 'Return to basket');
    } else {
        $words = array('Pour proc&eacute;der, svp cliquez sur le bouton Paypal', 'Panier', 'Item', 'Quantit&eacute;', 'Prix Total', 'Payer', 'name', 'Retourner au panier');
    }

	$stmt = $dbh->execute("SELECT * FROM basket WHERE fk_user_id = '".$session->user_id."'");
	list($id, $ip, $fk_user_id, $fk_product_id, $quantity, $create_date, $mod_date) = $stmt->fetch_array();

	$dbh->execute("INSERT INTO orders SET fk_user_id = '".$fk_user_id."', items = '".$fk_product_id."', quantity = '".$quantity."', total_price = '".$session->Payment_Amount."', order_date=NOW()");

	$item_arr = explode("//", $fk_product_id);
	$quantity_arr = explode("//", $quantity);

	$str = '';

	$str .= '<table width="75%"><tr><td><h3>'.$words[1].'</h3></td></tr>';
	$str .= '<tr><td>'.$words[2].'</td><td align="right">'.$words[3].'</td></tr>';

	foreach ($item_arr as $key => $value){
		$stmt2 = $dbh->execute("SELECT ".$words[6]." FROM products WHERE id = '".$value."'");
		list($name) = $stmt2->fetch_array();
		$str .= '<tr><td>'.$name.'</td><td align="right">'.$quantity_arr[$key].'</td></tr>';
	}

	$str .= '<br /><br />';
	$str .= '<tr><td><br />'.$words[4].'</td><td align="right">'.$_SESSION['Payment_Amount'].'</td></tr>';

	$str .= '<tr><td><a href="/purchase">'.$words[7].'</a></td><td align="center">';

	//dynamically create paypal button
	$str .= '<table><tr><td><form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
			 <input type="hidden" name="cmd" value="_cart">
			 <input type="hidden" name="currency_code" value="CAD">
			 <input type="hidden" name="upload" value="1">
			 <input type="hidden" name="return" value="http://70.25.126.201/purchase/success">
			 <input type="hidden" name="cancel_return" value="http://70.25.126.201/purchase/fail">
			 <input type="hidden" name="business" value="paypal@dinerenblanc.info">';


	foreach ($item_arr as $key => $value){
		$item_query = $dbh->execute("SELECT ".$words[6].", price FROM products WHERE id = '".$value."'");
		list($name, $price) = $item_query->fetch_array();
		$item_num = $key+1;
		$str .= '<input type="hidden" name="item_name_'.$item_num.'" value="'.$name.'">';
		$str .= '<input type="hidden" name="amount_'.$item_num.'" value="'.$price.'">';
		$str .= '<input type="hidden" name="quantity_'.$item_num.'" value="'.$quantity_arr[$key].'">';
	}

	//$str .= '<input type="submit" value="PayPal"></form>';
	$str .= '<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit">';

	$str.= '</td></tr></table></tr></td>';
	$str .= '</table>';

	return render('basket.tpl', compact('str'));

}

?>
