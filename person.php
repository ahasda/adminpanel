<?php 

$conn = mysqli_connect('localhost','root','','personal') or die();

$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$city = $_POST['city'];

$query = mysqli_query($conn , "INSERT INTO `person_data`( `name`, `email`, `pass`, `city`) 
                                VALUES ('{$name}','{$email}','{$pass}','{$city}')");

                        if($query){
                            echo "The data will submit Successfully Submit";
                        }else{
                            echo "Somthing Went Wrong";
                        }

?>