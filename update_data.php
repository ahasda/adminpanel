

// session_start();

// $conn = mysqli_connect('localhost', 'root', '', 'personal') or die();
// if(isset($_GET['id'])){

//     $id = $_GET['id'];

// $name = $_POST['name'];
// $email = $_POST['email'];
// $pass = $_POST['pass'];

// $query = mysqli_query($conn, "UPDATE `person_data` SET `name`='$name',`email`='$email',`pass`='$pass',`city`='$city' WHERE id = '$id' ");

// if ($query) {
//     echo "The data will submit Successfully Submit";
// } else {
//     echo "Somthing Went Wrong";
// }

// }

<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'personal') or die("Database connection failed");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM person_data WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $meta = mysqli_fetch_assoc($result);
    } else {
        die("Record not found");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $city = $_POST['city'];
    $image = $_FILES['file'];

    // Handle image upload
    if ($image['name']) {
        $targetDir = "upload/";
        $targetFile = $targetDir . basename($image['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validate image type
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            die("Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.");
        }

        // Move uploaded file to target directory
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            // Delete old image if a new one is uploaded
            if (!empty($meta['image']) && file_exists("uploads/" . $meta['image'])) {
                unlink("upload/" . $meta['image']);
            }

            $updateImage = "image = '$image[name]',";
        } else {
            die("Failed to upload image.");
        }
    } else {
        $updateImage = ""; // Keep old image if no new image is uploaded
    }

    // Update the database
    $updateQuery = "UPDATE person_data SET 
        name = '$name',
        email = '$email',
        pass = '$pass',
        city = '$city',
        $updateImage
        updated_at = NOW()
        WHERE id = $id";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Record updated successfully'); window.location.href = 'index.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>