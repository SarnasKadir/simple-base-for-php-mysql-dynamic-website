<?php
include "config.php";
 
function all_links(){

 global $pdo ;
$sql = "SELECT * FROM pages";
$result = $pdo->query($sql);
    foreach($result as $row ){
		echo '<li><a href="'. base_url.'page.php?page='. $row['id'] .'" title="'.$row['page_title'] .'">'. $row['page_title'].'</a></li>';
	}
} 
 

$defined_path = dirname(substr( __FILE__, strlen( $_SERVER[ 'DOCUMENT_ROOT' ] ) ));
define('base_url', $defined_path."/" );

 

function get_html_part($part){
global $row;	
 ob_start();
		include "html_parts/$part.php";		 
	ob_get_flush();
}
 

?>
