<?php 

// this page head meta

$row = array(
	"page_title"=>"Page pre View",
	"page_description"=>"A simple php mysql dynamic website!",
	"page_keywords"=>"website, php, mysql, dynamic!.",
	"page_author"=>"Sarnas Kadir, www.zazakicomputer.com",
	);
	
include "../functions.php";
 
get_html_part("head");
 
?>
 

<?php
if(isset($_GET["page"]) && !empty(trim($_GET["page"]))){
    $sql = "SELECT * FROM pages WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":id", $param_id);
        $param_id = trim($_GET["page"]);
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 
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
} else{
    header("location:". base_url. "error.php");
    exit();
}
?>
<h1><?php echo $row["page_title"];?></h1>
<main>

<div class="holdRow"><span class="holdRowTitle">Page ID:</span> <?php echo $row['id'];?></div> 
<div class="holdRow"><span class="holdRowTitle">Page description:</span> <?php echo $row['page_description'];?></div> 
<div class="holdRow"><span class="holdRowTitle">Page keywords:</span> <?php echo $row['page_keywords'];?></div> 
<div class="holdRow"><span class="holdRowTitle">Page author:</span> <?php echo $row['page_author'];?></div> 
<div class="holdRow"><span class="holdRowTitle">Page page_title:</span> <?php echo $row['page_title'];?></div> 
<div class="holdRow"><span class="holdRowTitle">Page content:</span> <?php echo $row['page_content'];?></div> 
<hr/>
<?php 
echo '<p><a href="'. base_url .'create_page/update.php?page='. $row['id'] .'">Update<br></a></p>';
echo '<p><a href="'. base_url .'create_page/delete.php?page='. $row['id'] .'">Delete</br></a></p>';
?> 
 
</main>
<?php get_html_part("footer");?>   

 