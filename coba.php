<?php
session_start();
  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoping_cart";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Pembayaran</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="page_plant.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">GotoGo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="coba.php">Tiket</a>
        </li>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql); 
while($row = mysqli_fetch_assoc($result)) {
// echo $row['id'] ." ". $row['name'] ." ". $row['image'] ." ". $row['price']."<br>";
?>
    <div class="card">
      <div class="row g-0">
        <div class="col-md-4">
        <img src="img/product/<?php echo $row['image']?>" alt="">
        </div>

        <div class="col-md-8">
          <div class="card-body" style="align-items: left;" >
        <h2><?php echo $row['name']?></h2>
            <p class="text-decoration-line-through small" >Rp 1500000</p>
            <h4>Rp. <?php echo $row['price']?></h4>

          </div>
          <div class="form-group text-center col-md-2">
          <label>Pilih Banyak Tiket:</label>  
          <select class="form-control" id="quantity<?php echo $row['id']?>">
            <center>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>

            </center>
          </select>
          <input type="hidden" id="name<?php echo $row['id']?>" value='<?php echo $row['name']?>'>
          <input type="hidden" id="price<?php echo $row['id']?>" value='<?php echo $row['price']?>'>
          </div>
          
          <div class="tombol"> 
            <button type="button" class="btn btn-primary add" data-id="<?php echo $row['id']?>"><i class="fa fa-shopping-cart"></i> Beli Tiket</button>
          </div>
    </div>
    <?php
    }
  ?>

</div>


<script>
$(document).ready(function() {
     alldeleteBtn = document.querySelectorAll('.delete')
     alldeleteBtn.forEach(onebyone => {
        onebyone.addEventListener('click',deleteINsession)
     })

function deleteINsession(){
removable_id = this.id;
$.ajax({
            url:'cart.php',
            method:'POST',
            dataType:'json',
            data:{ 
                  id_to_remove:removable_id,
                  action:'remove' 
            },
            success:function(data){
                    $('#displayCheckout').html(data);
       alldeleteBtn = document.querySelectorAll('.delete')
     alldeleteBtn.forEach(onebyone => {
        onebyone.addEventListener('click',deleteINsession)
     })
                  }
          }).fail( function(xhr, textStatus, errorThrown) {
    alert(xhr.responseText);
});

}


    $('.add').click(function() { 
        id = $(this).data('id');
        name = $('#name' + id).val();
        price = $('#price' + id).val();
        quantity = $('#quantity' + id).val();
          $.ajax({
            url:'cart.php',
            method:'POST',
            dataType:'json',
            data:{
                  cart_id : id,
                  cart_name : name,
                  cart_price : price,
                  cart_quantity : quantity,
                  action:'add' 
            },
            success:function(data){
                    alert("Tiket sudah ada di keranjang")
                    window.location='cobakeranjang.php'
                    $('#displayCheckout').html(data);
                    alldeleteBtn = document.querySelectorAll('.delete')
     alldeleteBtn.forEach(onebyone => {
        onebyone.addEventListener('click',deleteINsession)
     })
                  }
          })
    
    })

    $('.beli').click(function() { 
        id = $(this).data('id');
        name = $('#name' + id).val();
        price = $('#price' + id).val();
        quantity = $('#quantity' + id).val();
          $.ajax({
            url:'cart.php',
            method:'POST',
            dataType:'json',
            data:{
                  cart_id : id,
                  cart_name : name,
                  cart_price : price,
                  cart_quantity : quantity,
                  action:'beli' 
            },
            success:function(data){
              window.location='checkout.php'
                    $('#displayCheckout').html(data);
                    alldeleteBtn = document.querySelectorAll('.delete')
     alldeleteBtn.forEach(onebyone => {
        onebyone.addEventListener('click',deleteINsession)
     })
                  }
          })
    
    })

    
})
</script>
    

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>

  