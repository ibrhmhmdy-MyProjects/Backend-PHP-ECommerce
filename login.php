<?php
include "header.php";
include "navbar.php";
include "dbConnection.php";

if(isset($_POST['login'])){
  extract($_POST);
  // Check Form Validation 
  $errors = [];
  // Email => [required - email - Check Valid]
  if($email == ""){
    $errors[] = "Please Email Address is Required";
  }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors[] = "Please Email Address is Not Valid";
  }else{
    $query = "SELECT email FROM users WHERE email = '$email'";
    $check_email = mysqli_query($conn,$query);
    $result = mysqli_num_rows($check_email);
    if(!$result > 0){
      $errors[] = "Email Address is not Exists";
    }
  }
  // Password => [required - Min 4 - Check Valid]
  if($password == ""){
    $errors[] = "Please Password is Required";
  }elseif(strlen($password) < 4){
    $errors[] = "Please Password Must be 4 Chars or More";
  }else{
    $query = "SELECT * FROM users WHERE email = '$email'";
    $check_password = mysqli_query($conn,$query);
    $rows = mysqli_fetch_all($check_password);
    foreach($rows as $row){
      $hash_password = $row['password'];
      echo $hash_password;
    }
    if(!password_verify($password,$hash_password)){
      $errors[] = "Password is invalid";
    }
  }

  // Check and Show Messages
  if(!empty($errors)){
    // Show Errors
    foreach($errors as $error){
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' >
        $error
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
  }else{
    header("location: index.php");
  }
}
?>

<div class="card-body px-5 py-5" style="background-color:darkgray;">



            
              
                <h3 class="card-title text-left mb-3">Login</h3>
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                  <div class="form-group">
                    <label>email *</label>
                    <input type="email" name="email" class="form-control p_input" >
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="text" name="password" class="form-control p_input" >
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="forgetPassword.php" class="forgot-pass">Forgot password</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="login" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook me-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="signup.php"> Sign Up</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <?php include "footer.php" ?>


    //table user, product, cart ,, review comment , rating  = session