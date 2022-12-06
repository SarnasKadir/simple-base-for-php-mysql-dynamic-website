<?php 

// this page head meta
$row = array(
	"page_title"=>"Delete this page?",
	"page_description"=>"A simple php mysql dynamic website!",
	"page_keywords"=>"website, php, mysql, dynamic!.",
	"page_author"=>"Sarnas Kadir, www.zazakicomputer.com",
	);
	
include "../functions.php";
 
get_html_part("head");
 
?>

 
<?php
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    require_once "../config.php";
    $sql = "DELETE FROM pages WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":id", $param_id);
        $param_id = trim($_POST["id"]);
        if($stmt->execute()){
            header("location:". base_url. "index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    unset($stmt);
    unset($pdo);
} else{
    if(empty(trim($_GET["page"]))){
        header("location:". base_url. "error.php");
        exit();
    }
}
?>
<h1><?php echo $row["page_title"];?></h1>
<main>
 
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
 
<input type="hidden" name="id" value="<?php echo trim($_GET["page"]); ?>"/>
<p>Are you sure you want to delete this employee record?</p> 
<p><input type="submit" value="Yes" ></p>
<p><?php echo ' <a href="'. base_url.'page.php?page='. trim($_GET["page"]) .'" title="No back to ">No, back to the page view</a> ';?> </p> 
</form>

</main>
<?php get_html_part("footer");?> 
