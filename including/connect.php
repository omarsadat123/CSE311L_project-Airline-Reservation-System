<?php
$con=mysqli_connect('localhost:3307','root','','ticket_management');
if(!$con){
    die(mysqli_error($con));
}
?> 