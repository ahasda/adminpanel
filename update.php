<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <?php
    session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'personal') or die();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $user = mysqli_query($conn, "SELECT * FROM `person_data` WHERE id = $id");
        foreach ($user->fetch_array() as $k => $v) {
            $meta[$k] = $v;
        }
    }

    foreach ($user as $key => $value) {
        $meta[$key] = $value;
    }

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <h1 class="text-center">Update Page Form Data</h1>


                <form class="row g-3 needs-validation" novalidate method="post" >
                    <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : '' ?>">

                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="validationCustom01" value="<?php echo $meta['name']; ?>" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="validationCustom02" value="<?php echo $meta['email']; ?>" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustomUsername" class="form-label">Password</label>
                        <div class="input-group has-validation">
                            <input type="password" class="form-control" id="validationCustomUsername" name="pass" value="<?php echo $meta['pass']; ?>" required>
                            <span class="input-group-text" id="toggle-password">
                                <i class="fa-solid fa-eye" id="password-icon"></i>
                            </span>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#toggle-password').on('click', function() {
                                const passwordInput = $('#validationCustomUsername');
                                const passwordIcon = $('#password-icon');

                                if (passwordInput.attr('type') === 'password') {
                                    passwordInput.attr('type', 'text');
                                    passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                                } else {
                                    passwordInput.attr('type', 'password');
                                    passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                                }
                            });
                        });
                    </script>

                    <div class="col-md-6">
                        <label for="validationCustom03" class="form-label">City</label>
                        <input type="text" name="city" class="form-control" id="validationCustom03" value="<?php echo $meta['city']; ?>" required>
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="file" class="form-label">Upload New Image</label>
                        <input type="file" name="file" class="form-control" id="file">
                        <?php if (!empty($meta['image'])) : ?>
                            <div class="mt-2">
                                <img src="uploads/<?php echo $meta['image']; ?>" alt="Current Image" width="150" class="img-thumbnail">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
// session_start();
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

</body>

</html>