<?php

include "../include/common_function.php";
dbconn();

function get_slug($s){
	$slug = $s;
	$slug = preg_replace('/-+/', ' ', $slug);
	$slug = preg_replace('@[!-/:-\@\[-\^`{-~]+@', '', $slug);
	$slug = preg_replace('/\s+/', '-', $slug);
	$slug = trim($slug, '-');
	$slug = strtolower($slug);
	return $slug;
}

$aaa = zReadFile("ccc.txt");
$arr_t = explode("\n",$aaa);
$arr_rs = array();

foreach($arr_t as $t){
	$arr_s = explode("\t",$t);
	$arr_r = array();	
	foreach($arr_s as $s){
		$s = str_replace('"','',$s);
		$arr_r[] = $s;
	}
	$arr_rs[] = $arr_r;
}

$check_cat1  = '|';
$check_cat2  = '|';
$check_cat3  = '|';
$sql = " select max(term_id) from wp_terms ";
$term_id = $DB->GetOne($sql);

foreach($arr_rs as $r){

	list($cat1,$cat2,$cat3) = $r;

	$cat1 = str_replace("'","",$cat1);
	$cat2 = str_replace("'","",$cat2);
	$cat3 = str_replace("'","",$cat3);

	if(!stristr($check_cat1,'|'.$cat1.'|') && trim($cat1) ){
		$check_cat1 .= $cat1.'|';
		$name = $cat1;
		$slug = get_slug($cat1);
		$term_group = 0;
		$term_id = $term_id + 1;
		$term_id1 = $term_id;
		$sql = " INSERT INTO wp_terms (term_id, name, slug, term_group) VALUES ($term_id, '$name', '$slug', $term_group); ";
		echo $sql."\n";
		$sql = " INSERT INTO wp_term_taxonomy (term_id, taxonomy, description, parent, count) VALUES ($term_id, 'product_cat', '$cat1', 0, 0); ";
		echo $sql."\n";
//		$DB->query($sql);
		$sql = " INSERT INTO wp_woocommerce_termmeta (woocommerce_term_id, meta_key, meta_value) VALUES ($term_id, 'order', 0); ";
		echo $sql."\n";
//		$DB->query($sql);
		$sql = " INSERT INTO wp_woocommerce_termmeta (woocommerce_term_id, meta_key, meta_value) VALUES ($term_id, 'display_type', ''); ";
		echo $sql."\n";
//		$DB->query($sql);
		$sql = " INSERT INTO wp_woocommerce_termmeta (woocommerce_term_id, meta_key, meta_value) VALUES ($term_id, 'thumbnail_id', 0); ";
		echo $sql."\n";
//		$DB->query($sql);
//		echo "#";
	}

	if(!stristr($check_cat2,'|'.$cat1.'-'.$cat2.'|') && trim($cat2) ){
		$check_cat2 .= $cat1.'-'.$cat2.'|';
		$name = $cat2;
		$slug = get_slug($cat1.'-'.$cat2);
		$term_group = 0;
		$term_id = $term_id + 1;
		$term_id2 = $term_id;
		$sql = " INSERT INTO wp_terms (term_id, name, slug, term_group) VALUES ($term_id, '$name', '$slug', $term_group); ";
		echo $sql."\n";
		$sql = " INSERT INTO wp_term_taxonomy (term_id, taxonomy, description, parent, count) VALUES ($term_id, 'product_cat', '".$cat1."-".$cat2."', $term_id1, 0); ";
		echo $sql."\n";
//		$DB->query($sql);
		$sql = " INSERT INTO wp_woocommerce_termmeta (woocommerce_term_id, meta_key, meta_value) VALUES ($term_id, 'order', 0); ";
		echo $sql."\n";
//		$DB->query($sql);
		$sql = " INSERT INTO wp_woocommerce_termmeta (woocommerce_term_id, meta_key, meta_value) VALUES ($term_id, 'display_type', ''); ";
		echo $sql."\n";
//		$DB->query($sql);
		$sql = " INSERT INTO wp_woocommerce_termmeta (woocommerce_term_id, meta_key, meta_value) VALUES ($term_id, 'thumbnail_id', 0); ";
		echo $sql."\n";
//		$DB->query($sql);
//		echo "+";
	}

	if(!stristr($check_cat3,'|'.$cat1.'-'.$cat2.'-'.$cat3.'|') && trim($cat3) ){
		$check_cat3 .= $cat1.'-'.$cat2.'-'.$cat3.'|';
		$name = $cat3;
		$slug = get_slug($cat1.'-'.$cat2.'-'.$cat3);
		$term_group = 0;
//		$DB->query($sql);
		$term_id = $term_id + 1;
		$term_id3 = $term_id;
		$sql = " INSERT INTO wp_terms (term_id, name, slug, term_group) VALUES ($term_id, '$name', '$slug', $term_group); ";
		echo $sql."\n";
		$sql = " INSERT INTO wp_term_taxonomy (term_id, taxonomy, description, parent, count) VALUES ($term_id, 'product_cat', '".$cat1."-".$cat2."-".$cat3."', $term_id2, 0); ";
		echo $sql."\n";
//		$DB->query($sql);
		$sql = " INSERT INTO wp_woocommerce_termmeta (woocommerce_term_id, meta_key, meta_value) VALUES ($term_id, 'order', 0); ";
		echo $sql."\n";
//		$DB->query($sql);
		$sql = " INSERT INTO wp_woocommerce_termmeta (woocommerce_term_id, meta_key, meta_value) VALUES ($term_id, 'display_type', ''); ";
		echo $sql."\n";
//		$DB->query($sql);
		$sql = " INSERT INTO wp_woocommerce_termmeta (woocommerce_term_id, meta_key, meta_value) VALUES ($term_id, 'thumbnail_id', 0); ";
		echo $sql."\n";
//		$DB->query($sql);
//		echo "-";
	}

}

?>