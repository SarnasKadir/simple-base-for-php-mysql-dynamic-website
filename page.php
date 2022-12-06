<?php 
include "functions.php";
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
<?php get_html_part("head");?>
<h1><?php echo $row["page_title"];?></h1>
<main>
 
<?php echo $row['page_content'];?> 
 
<?php 
echo '<p><a href="'. base_url .'create_page/update.php?page='. $row['id'] .'">Update<br></a></p>';
echo '<p><a href="'. base_url .'create_page/delete.php?page='. $row['id'] .'">Delete</br></a></p>';
?> 
</main>
<?php get_html_part("footer");?>   

 