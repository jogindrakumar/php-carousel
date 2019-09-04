<?php 
$conn = mysqli_connect('localhost','root','','slider');
if(!$conn){
    echo "not connected".mysqli_error($conn);
    
}
?>
<?php
$msg = '';
if(isset($_POST['submit'])){
    
    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    
    move_uploaded_file($tmp_image,"images/$image");
    
    $query = "INSERT INTO slide (img) VALUES ('$image')";
    $query_result = mysqli_query($conn,$query);
    
    if($query_result){
        $msg = 'image upload successfully!';
    }else{
        $msg = 'error'.mysqli_error($conn);
    }
}

$query = "SELECT * FROM slide";
$result = mysqli_query($conn,$query);

$rowcount = mysqli_num_rows($result);

?>

<?php 


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>php slider</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div class="container-fluid">
      <div class="row bg-dark">
          <div class="col-sm-12">
              
              <h3 class="text-center text-success">PHP carousel</h3>
          </div>
          
          
      </div>
      
      
  </div>
   <div class="container-fluid">
       <div class="row">
           <div class="col-sm-12">
               <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
   <?php
       for($i=1;$i<=$rowcount;$i++)
       {
           $row = mysqli_fetch_array($result);
       
          if($i==1){
      
      
      ?>
    <div class="carousel-item active">
      <img src="images/<?php echo $row['img'];?>" class="d-block w-100" alt="..." width="100%" height="400px">
    </div>
    
    <?php }else{
        ?>
    <div class="carousel-item">
      <img src="images/<?php echo $row['img'];?>" class="d-block w-100" alt="..." width="100%" height="400px">
    </div><?php } ?>
    <?php }  ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
               
               
           </div>
       </div>
       
       
       
   </div> 
    <br>
    
    <br>
    <div class="container-fluid">
        <div class="row justify-content-center">
           
            <div class="col-sm-4 bg-dark">
                <h5 class="text-center text-success"><?php echo $msg; ?></h5>
               <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="image" class="text-success">image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group  bg-dark">
                    <input type="submit" name="submit" value="upload" class="form-control btn btn-success">
                </div>
                   
               </form>
                
            </div>
        </div>
        
    </div>
    
    
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
</body>
</html>