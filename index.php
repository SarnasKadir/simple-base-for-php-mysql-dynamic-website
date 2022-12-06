<?php 

// this page head meta
$row = array(
	"page_title"=>"Home, a simple dynaic website",
	"page_description"=>"A simple php mysql dynamic website!",
	"page_keywords"=>"website, php, mysql, dynamic!.",
	"page_author"=>"Sarnas Kadir, www.zazakicomputer.com",
	);
	
include "functions.php";
 
get_html_part("head");
 
?>
 
<h1><?php echo $row["page_title"];?></h1>
<main>
<h3>Page title</h3>
<ol>
<?php all_links();?>
</ol>
</main>
<?php get_html_part("footer");?> 

 