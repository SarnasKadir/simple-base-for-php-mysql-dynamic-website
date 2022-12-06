<?php 

// this page head meta
$row = array(
	"page_title"=>"Update this page?",
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

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
	$id = $_POST["id"];
    
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
        $page_description_err = "Please enter the page_description  .";     
    
    } else{
        $page_description = $input_page_description;
    }
    
	$input_page_keywords = trim($_POST["page_keywords"]);
    if(empty($input_page_keywords)){
        $page_keywords_err = "Please enter the page_keywords  .";     
    
    } else{
        $page_keywords = $input_page_keywords;
    }    
	
	$input_page_author = trim($_POST["page_author"]);
    if(empty($input_page_author)){
        $page_author_err = "Please enter the page_author  .";     
    
    } else{
        $page_author = $input_page_author;
    }
	
	
	
	if(	empty($page_title_err) && 
		empty($page_content_err) && 
		empty($page_description_err) && 
		empty($page_keywords_err) && 
		empty($page_author_err) 
		){
        
		$sql = "UPDATE pages SET page_title=:page_title, page_content=:page_content, page_description=:page_description, page_keywords=:page_keywords, page_author=:page_author WHERE id=:id";
 
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":page_title", $param_page_title);
            $stmt->bindParam(":page_content", $param_page_content);
            $stmt->bindParam(":page_description", $param_page_description);
			$stmt->bindParam(":page_keywords", $param_page_keywords);
			$stmt->bindParam(":page_author", $param_page_author);
            $stmt->bindParam(":id", $param_id);
            
			
			
			
			
			$param_page_title = $page_title;
            $param_page_content = $page_content;
            $param_page_description = $page_description;
			$param_page_keywords = $page_keywords;
			$param_page_author = $page_author;
            $param_id = $id;
            
			
			if($stmt->execute()){
			    $lastID = $id;				
                header("location:". base_url."create_page/pagepreview.php?page=".$lastID);
                
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        unset($stmt);
    }
    unset($pdo);
} else{
    if(isset($_GET["page"]) && !empty(trim($_GET["page"]))){
        $id =  trim($_GET["page"]);
        $sql = "SELECT * FROM pages WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":id", $param_id);
            $param_id = $id;
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $page_title = $row["page_title"];
                    $page_content = $row["page_content"];
                    $page_description = $row["page_description"];
					$page_keywords = $row["page_keywords"];
					$page_author = $row["page_author"];
                } else{
                     header("location:". base_url. "error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        unset($stmt);
        unset($pdo);
    }  else{
        header("location:". base_url. "error.php");
        exit();
    }
}
?>
 
 
<h1><?php echo $row["page_title"];?></h1>
<main>


<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

<p>Page title<br><input type="text" name="page_title" value="<?php echo $page_title; ?>"><br><?php echo $page_title_err;?></p>

<p>Page description<br><input type="text" name="page_description" value="<?php echo $page_description; ?>"><br><?php echo $page_description_err;?></p>

<p>Page keywords<br><input type="text" name="page_keywords" value="<?php echo $page_keywords; ?>"><br><?php echo $page_keywords_err;?></p>

<p>Page author<br><input type="text" name="page_author" value="<?php echo $page_author; ?>"><br><?php echo $page_author_err;?></p>

<p>Page content<br><textarea name="page_content"><?php echo $page_content; ?></textarea><br><?php echo $page_content_err;?></p>

<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<p><input type="submit" value="Submit"></p>
<p><a href="<?php echo base_url?>index.php" >Cancel</a></p>
</form>
<?php get_html_part("footer");?>                 

</main>