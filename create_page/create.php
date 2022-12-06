<?php 

// this page head meta
$row = array(
	"page_title"=>"Update the page",
	"page_description"=>"A simple php mysql dynamic website!",
	"page_keywords"=>"website, php, mysql, dynamic!.",
	"page_author"=>"Sarnas Kadir, www.zazakicomputer.com",
	);
	
include "../functions.php";
 
get_html_part("head");
 
?>
<?php

$page_title = $page_content = $page_description = $page_keywords = $page_author = "";
$page_title_err = $page_content_err = $page_description_err = $page_keywords_err = $page_author_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
	$input_page_title = trim($_POST["page_title"]);
    
	if(empty($input_page_title)){
        $page_title_err = "Please enter a page_title.";    
    } else{
        $page_title = $input_page_title;
    }
    
	$input_page_content = trim($_POST["page_content"]);
    if(empty($input_page_content)){
        $page_content_err = "Please enter an page_content.";     
    } else{
        $page_content = $input_page_content;
    }
    
	$input_page_description = trim($_POST["page_description"]);
    if(empty($input_page_description)){
        $page_description_err = "Please enter the page_description .";     
     
    } else{
        $page_description = $input_page_description;
    }
	
	$input_page_keywords = trim($_POST["page_keywords"]);
    if(empty($input_page_keywords)){
        $page_keywords_err = "Please enter the page_keywords .";     
     
    } else{
        $page_keywords = $input_page_keywords;
    }


	$input_page_author = trim($_POST["page_author"]);
    if(empty($input_page_author)){
        
		$page_author_err = "Please enter the page_author .";     
     
    } else{
        $page_author = $input_page_author;
    }	
	
	
    if(empty($page_title_err) && 
		empty($page_content_err) && 
		empty($page_description_err) && 
		empty($page_author_err) && 
		empty($page_keywords_err) && 
		empty($page_author_err) 
		){
        
		$sql = "INSERT INTO pages (page_title, page_content, page_description, page_keywords, page_author) VALUES (:page_title, :page_content, :page_description, :page_keywords, :page_author)";
 
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":page_title", $param_page_title);
            $stmt->bindParam(":page_content", $param_page_content);
            $stmt->bindParam(":page_description", $param_page_description);
            $stmt->bindParam(":page_keywords", $param_page_keywords);
			$stmt->bindParam(":page_author", $param_page_author);
			
			$param_page_title = $page_title;
            $param_page_content = $page_content;
            $param_page_description = $page_description;
            $param_page_keywords = $page_keywords;
			$param_page_author = $page_author;
			
			if($stmt->execute()){				  
				
				$lastID =$pdo-> lastinsertId();				
                header("location:". base_url."create_page/pagepreview.php?page=".$lastID);
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        unset($stmt);
    }
    unset($pdo);
}
?>
 
<?php 
echo get_html_part("head");
?>
 
<h1><?php echo $row["page_title"];?></h1> 

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<p>page title<br><input type="text" name="page_title" value="<?php echo $page_title;?>"><?php echo $page_title_err;?></p>

<p>page description<br><input type="text" name="page_description" value="<?php echo $page_description; ?>"><?php echo $page_description_err;?></p>

<p>page keywords<br><input type="text" name="page_keywords" value="<?php echo $page_keywords; ?>"><?php echo $page_keywords_err;?></p>

<p>page author<br><input type="text" name="page_author" value="<?php echo $page_author; ?>"><?php echo $page_author_err;?></p>

<p>page content<br><textarea name="page_content"><?php echo $page_content; ?></textarea><?php echo $page_content_err;?></p>

<p><input type="submit" value="Submit"></p>
<p><a href="<?php echo base_url?>index.php" >Cancel</a></p>
</form>
<?php get_html_part("footer");?>