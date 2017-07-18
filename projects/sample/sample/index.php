<?php
$conn=mysqli_connect("localhost","95abc95","95abc95","95abc");
$result=mysqli_query($conn,"select * from users");
if(mysqli_num_rows($result)){
   while($row=mysqli_fetch_array($result)){
       echo $row["name"]."<br>";
   }
}
?>