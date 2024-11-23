<?php 

$conn = mysqli_connect('localhost','root','','personal') or die();

$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pass'];

$img = $_FILES['file'];

$img_name = $_FILES['file']['name'];
$img_typ = $_FILES['file']['type'];
$img_temp = $_FILES['file']['tmp_name'];

$city = $_POST['city'];

$location = "upload/";

$finalImage = $location.$img_name;

// echo $finalImage;
// die();
move_uploaded_file($img_temp,$finalImage);

$query = mysqli_query($conn , "INSERT INTO `person_data`( `name`, `email`, `pass`,img, `city`) 
                                VALUES ('{$name}','{$email}','{$pass}','{$finalImage}','{$city}')");

                        if($query){
                            echo "The data will submit Successfully Submit";
                        }else{
                            echo "Somthing Went Wrong";
                        }

?>