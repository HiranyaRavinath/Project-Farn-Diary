<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="css/mapoutstyles.css" rel="stylesheet" type="text/css" >
<!-- bootstrap -->
<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<!-- added styles from home page -->

<link href="fontawesome-free-5.12.0-web/css/all.css" rel="stylesheet">
<link rel="shortcut icon" href="img/icon.png" />


</head>


<body>

<?php include 'dbconnect.php'; ?>





<h1 class=wed style=" height: 50%;
    margin-top: 20%;
    margin-bottom: 20%;">welcome to keels</h1>


<div class="row" style="
    background-color: seagreen;
">



<div class="container-fluid">
  

<div>


<div id="googleMap" style="width:100%;height:1200px;"></div>

<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(7.0840,80.0098),
  zoom:15,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);





<?php

$sql = "SELECT * FROM `product`";
$result = mysqli_query($con, $sql);

?>






var markerinfo = [
        <?php if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){ 
                echo '["'.$row['pid'].'", '.$row['latitude'].', '.$row['longitude'].', "'.$row['price'].'", "'.$row['image'].'", "'.$row['description'].'", "'.$row['datetime'].'"],'; 
            } 
        } 
        ?>
    ];




  for( i = 0; i < markerinfo.length; i++ ) {
        
        var pp = new google.maps.LatLng(markerinfo[i][1], markerinfo[i][2]);
        var marker2 = new google.maps.Marker({position:pp,icon:'images/markerico3.png',animation:google.maps.Animation.BOUNCE});
			  marker2.setMap(map);
        var path = "uploads/";
        var imagename = markerinfo[i][4];
        var disname = path.concat(imagename);
        var descr = markerinfo[i][5];
        var infowindow = new google.maps.InfoWindow({
        content:'<div class=infow><img src="'+disname+'" width="100" height="100"> </br>' + markerinfo[i][0]+"<br>price per Kg-"+ markerinfo[i][3]+"</div> <button type='button' class='btn btn-outline-success'    data-bs-toggle='collapse' data-bs-target='#collapseExample' aria-expanded='false' aria-controls='collapseExample'  onclick='createcontentcollapse("+markerinfo[i][0]+")'                     >more</button>"
        });
        //infoWindow.setContent(html);
       /* infowindow2 = new google.maps.InfoWindow({
       content:"",
        });



        marker2.addListener("click", () => {
        infowindow2.open(map, marker);
        });*/
        infowindow.open(map,marker2);


}        



        }



</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBheNEtrngM3cbowGS3tLPwoBXlswmmSb0&callback=myMap"></script>

</div>






</div>




<div class="container">
   
   
  <div class="container" style="  animation: 3s ease-out 0s 1 slideInFromLeft; border-radius: 25px;
    background: #FFFFFF;     margin-top: 10%; margin-bottom: 10%;" >
  
  <form action="/action_page.php"  >
  <div class="card card-body" style="
    border: white;">  
<label id="demo1"></label>

<div class="container">
<div class="row">
<script>


function createcontentcollapse(productid) {

//alert(productid);
var productidvar = productid;
//document.getElementById("demo1").innerHTML = productid;
document.cookie = "myJavascriptVar=" + productidvar; 
window.location.reload();
}
</script>

 <?php
$myPhpVar= $_COOKIE['myJavascriptVar'];

//setting default
if(is_null($myPhpVar)==1)
{$myPhpVar=1;
}


$sql = "SELECT * FROM `product` where pid=$myPhpVar";
$result = mysqli_query($con, $sql);
//setcookie("myJavascriptVar","");
if (mysqli_num_rows($result) > 0)
 {
  // output data of each row
  while($row = mysqli_fetch_assoc($result))
   {
    ?>
  <div class="card" style="width:auto; border: white;">
  <img class="card-img-top" style="width: 40%;" src="uploads\<?php echo $row['image']; ?>" alt="Card image cap">
  <div class="card-body">

   <h1><?php 
   
   
   if($row['type']==1){
    echo "fruit";
   }
   
   
    ?></h1> 
  <?php
      echo $row["datetime"];
      echo $row["senderid"];
      echo $row["price"];
      ?>
    <h1 class=cardprice>price  1Kg <?php echo +$row['price']; ?>  lkr</h1> 
    <p class="card-text"><?php echo $row['description']; ?></p>
  </div>


</div>


<br>

<?php




$senderrr=$row["senderid"];








    }} ?>

<?php





?>
  </div>
</div>


   <?php

$sql2 = "SELECT * FROM `farmer` where fid=$senderrr";
$result2 = mysqli_query($con, $sql2);
//setcookie("myJavascriptVar","");
if (mysqli_num_rows($result2) > 0)
 {
  // output data of each row
  while($row = mysqli_fetch_assoc($result2))
   {
    ?>
  <div>
  <h1>
  <?php
      echo $row["fcontact"]; ?>&nbsp;
   <?php   echo $row["femail"]; ?> &nbsp;
     <?php echo $row["ffirstname"]; ?>&nbsp;
     
    </h1>
  </div>
  <label for="lname">message:</label><br>
  <input type="text" id="lname" name="lname" value="enter your message here"><br><br>
  <input type="submit" value="send">
</div>

<?php

}} ?>
<br>

 
  </form>


</div>






<?php

mysqli_close($con);



?>





  </div>
  </div>
  </div>
<div class="div-1" style="background-color: black;  height: 300px;"> I love HTML </br> I love HTML</br> I love HTML


</body>
</html>