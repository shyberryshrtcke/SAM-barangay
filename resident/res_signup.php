<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- CSS link -->
    <link rel="stylesheet" href="css/res_signup.css">
    <!-- Google Fonts API link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    include('../dbconfig.php');

    if(isset($_POST['sign-up'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];
        $role_id = 3;
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $res_firstname = $_POST['f-name'];
        $res_middlename = $_POST['md-name'];
        $res_lastname = $_POST['l-name'];
        $birthdate = $_POST['birthdate'];
        $address = $_POST['address'];

        
        // create a DateTime object from the birthdate string
        $birthday = new DateTime($birthdate);

        // get the current date
        $today = new DateTime(date('m.d.y'));

        // calculate the difference between the birthdate and the current date
        $diff = $today->diff($birthday);

        // get the age in years
        $age = $diff->y;
        
        if ($age < 18){
            echo "<script>alert('You must be at least 18 years old to create an account.');</script>";
        } else if($password == $rpassword) {
            // Call the stored procedure
            $stmt = $conn->prepare("CALL SP_ADD_RESIDENT(?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssisssss', $email, $hash, $role_id, $res_firstname, $res_middlename, $res_lastname, $birthdate, $address);
            try{ 
                $stmt->execute();
    
                // Check for errors
                if ($stmt->errno) {
                    echo "<script>alert('An account with that email already exists. Please try another one.');</script>";
                    die('Failed to call stored procedure: ' . $stmt->error);
                } else {
                    echo "<script>alert('Your account has been created successfully!'); window.location.href = 'res_login.php';</script>";
                    // header("Location:res_login.php"); 
                    // echo "<script>alert('Your account has been created successfully!');</script>";
                    exit();
                }

            } catch (mysqli_sql_exception $e) {
                echo "<script>alert('An account with that email already exists. Please try another one.');</script>";
            }
            // Close the statement and the connection
            $stmt->close();
            $conn->close();
        } else {
            echo "<script>alert('Passwords do not match');history.go(-1);</script>";
        }
    }

    ?>
    <div class="container-fluid d-flex justify-content-center p-0">
        <div class="main-container d-flex align-items-center">
            <div class="signup-form row d-flex justify-content-center rounded-4 p-0 m-0">
                <span class="mt-5 d-flex justify-content-center text-center fw-light description">To chat with SAM, you need to make an account first. Fill up</span>
                <span class="d-flex justify-content-center text-center fw-light description">this Sign-up form to get started.</span>
                <h1 class="fw-bold d-flex justify-content-center sam-title mt-2 p-0">SAM</h1>
                <h2 class="fw-semibold d-flex justify-content-center text-center mamamayan-signup mb-3 p-0">Mamamayan Sign-up</h2>
                <div class="col-9 p-0">
                    <form action="" method="post">
                        <!-- Name field -->
                        <div class="row d-flex justify-content-between">
                            <div class="form-outline col-4 mb-3 ps-0">
                                <input type="text" name="f-name" id="f-name" class="form-control border-0 rounded-1" placeholder="First Name" required="required">
                            </div>
                            <div class="form-outline col-4 mb-3 ps-0">
                                <input type="text" name="md-name" id="md-name" class="form-control border-0 rounded-1" placeholder="Middle Name">
                            </div>
                            <div class="form-outline col-4 mb-3 px-0">
                                <input type="text" name="l-name" id="l-name" class="form-control border-0 rounded-1" placeholder="Last Name" required="required">
                            </div>
                        </div>
                        <!-- Email field -->
                        <div class="form-outline row mb-3">
                            <input type="email" name="email" id="email" class="form-control-md border-0 rounded-1" placeholder="E-mail" required="required">
                        </div>
                        <!-- Birthdate field -->
                        <div class="d-flex">
                            <label for="birthdate" class="bdate-label">Birthdate</label>
                            <div class="form-outline col-4 mb-3 ms-3">
                                <input type="date" name="birthdate" id="birthdate" class="form-control border-0 rounded-1" required="required">
                            </div>
                        </div>
                        <!-- Address field -->
                        <div class="form-outline row mb-3">
                            <input type="text" name="address" id="address" class="form-control-md border-0 rounded-1" placeholder="Address" required="required">
                        </div>
                        <!-- Password field -->
                        <div class="form-outline row mb-3">
                            <input type="password" name="password" id="password" class="form-control-md border-0 rounded-1" placeholder="Password" autocomplete="off" required="required">
                        </div>
                        <!-- Password field -->
                        <div class="form-outline row mb-3">
                            <input type="password" name="rpassword" id="rpassword" class="form-control-md border-0 rounded-1" placeholder="Repeat Password" autocomplete="off" required="required">
                        </div>
                        <!-- <div class="row">
                            <a href="" class="text-end text-decoration-none forgot-password p-0 mb-3">Forgot Password</a>
                        </div> -->
                        <!-- Submit button -->
                        <div class="text-center row justify-content-end mb-4">
                            <input type="submit" value="Sign-up" name="sign-up" class="login-button border-0 rounded-3 fw-light text-light p-0">
                        </div>
                    </form>
                    <div class="container p-0 mb-3">
                        <span class="fw-light login-account p-0">Already have an account?</span>
                        <a href="./res_login.php" class="text-decoration-none p-0 sign-in">Sign-in</a>
                    </div>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn border-0 mb-5 w-50 tnc" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Terms and Conditions
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Terms and Conditions</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>