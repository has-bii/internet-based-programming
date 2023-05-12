<?php

    $servername = "localhost";
    $username = "hasbii";
    $password = "d4rk4ng3l";
    $database = "students-database";

    $conn = new mysqli($servername, $username, $password, $database);

    if($conn === false){
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    $errorMessage = '';
    $successMessage = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
        // collect value of input field
        $fullName = $_REQUEST['full_name'];
        $email = $_REQUEST['email'];
        $gender = $_REQUEST['gender'];
     
        if (empty($fullName) || empty($email) || empty($gender)) {
            $errorMessage = 'Data didn`t store';
        }

        $sql = "INSERT INTO students (full_name, email, gender)  VALUES ('$fullName', '$email', '$gender')";

        if (mysqli_query($conn, $sql)) {
            $successMessage = "Data successfully added to database.";
        } else {
            $errorMessage = "Data failed stored to database.";
        }

        $fullName = '';
        $email = '';
        $gender = '';

        mysqli_close($conn);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <title>Students Database</title>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center my-5 align-items-center">
            <div class="col">
                <h1 class="mb-5">Create new student's data</h1>

                <?php 
                    if ($successMessage) {
                        echo '
                            <div class="alert alert-success mb-3 alert-dismissible fade show" role="alert">
                                ' . $successMessage . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
                    
                    if ($errorMessage) {
                        echo '
                            <div class="alert alert-danger mb-3 alert-dismissible fade show" role="alert">
                                ' . $errorMessage . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
                ?>

                <div class="card shadow">
                    <div class="card-body">
                        
                        <form action="add-student.php" method="post">
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Enter student's name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter student's email" required>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Male" id="genderMale" required>
                                <label class="form-check-label" for="genderMale">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Female" id="genderFemale" required>
                                <label class="form-check-label" for="genderFemale">
                                    Female
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Add Student</button>
                            <a type="button" href="index.php" class="btn btn-secondary mt-3">Go back</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>