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
    <h1 class="text-center">Here Show All Data </h1>
    <div class="d-flex">
        <a href="insert.php" class="btn btn-warning justify-content-center">Add Data</a>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">City</th>
                            <th scope="col" colspan="2">Status</th>
                            
                        </tr>
                    </thead>
                    <?php

                    $conn = mysqli_connect('localhost', 'root', '', 'personal') or die();

                    $query = mysqli_query($conn, "SELECT * FROM `person_data`");

                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {


                    ?>
                            <tbody>
                                <tr>
                                    <th><?= $row['id']; ?></th>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><img src="<?= $row['img']; ?>" alt="" class="img-fluid" style="height: 100px; width: 100px;"></td>
                                    <td><?= $row['city']; ?></td>

                                    <td><a href="update.php?id=<?php echo $row['id']; ?>" style="color: green;"><i class="fa-solid fa-wrench"></i></a></td>
                                    <td> <a href="delete.php?id=<?php echo $row['id']; ?>" style="color: red;"><i class="fa-solid fa-trash"></i></a></td>

                                </tr>
                            </tbody>

                    <?php
                        }
                    }
                    ?>
                </table>

            </div>
        </div>
    </div>
</body>

</html>