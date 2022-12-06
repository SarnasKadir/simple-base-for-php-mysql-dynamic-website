<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> <?php echo $row["page_title"]; ?></title>
<meta name="description" content="<?php echo $row["page_description"]; ?>">
<meta name="keywords" content="<?php echo $row["page_keywords"]; ?>">
<meta name="author" content="<?php echo $row["page_author"]; ?>">
 
<style><?php include "style.css";?></style> 
</head>
<body>
<div class="website_wrapper">
<ul>
<li><a href="<?php echo base_url?>index.php">Home</a></li>
<li><a href="<?php echo base_url?>create_page/create.php"> Craete New Page</a></li>
</ul>

 
