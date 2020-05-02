<?php


$hostname='127.0.0.1';
$username='root';
$dbname='ekengelectronics';
$password='';


  $conn= mysqli_connect($hostname,$username,$password,$dbname);

  if($conn){
  	echo "";
  }else{
  	die();
  }






?>