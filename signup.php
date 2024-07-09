<?php
include "header.php";
include "navbar.php";
include "dbConnection.php";

if(isset($_POST['signup'])){
  extract($_POST);
  // Store Errors Messages
  $errors = [];
  // UserName => [required - String - Min 3]
  if($UserName == ""){
    $errors[] = "Please User Name is Required";  
  }elseif(!is_string($UserName)){
    $errors[] = "Please User Name must be String";  
  }elseif(strlen($UserName) < 3){
    $errors[] = "Please User Name must be More than 3 Chars";  
  }
  // Check Form Validation 
  // Email => [required - email - Unique]
  if($email == ""){
    $errors[] = "Please Email Address is Required";
  }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors[] = "Please Email Address is Not Valid";
  }else{
    $check_email = "SELECT email FROM users WHERE email = '$email'";
    $get_email = mysqli_query($conn, $check_email);
    $result = mysqli_num_rows($get_email);
    if($result > 0){
      $errors[] = "Email Address is Already Exists";
    }
  }
  // Password => [required - Min 4]
  if($password == ""){
    $errors[] = "Please Password is Required";
  }elseif(strlen($password) < 4){
    $errors[] = "Please Password Must be 4 Chars or More";
  }
  // Phone => [required - Number]
  if($phone == ""){
    $errors[] = "Please Phone is Required";
  }elseif(!is_numeric($phone)){
    $errors[] = "Please Phone Number must be Only Number";
  }
  // Address => [required]
  if($address == ""){
    $errors[] = "Please Address is Required";
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
    // Hash Password
    $hash_password = password_hash($password, PASSWORD_BCRYPT);
    // Insert Row Data
    $data_row = "INSERT INTO users(`name`,`email`,`password`,`phone`,`address`) 
                 VALUES ('$UserName', '$email', '$hash_password', '$phone', '$address')";
    $insert_row = mysqli_query($conn, $data_row);
    
    if($insert_row){
      header("location: login.php");
    }else{
      echo "Inserted Row Failed";
    }
  }
}
?>
          <div class="card-body p-5" style=" background-color:whitesmoke;">
            <h3 class="card-title text-left mb-3">Register</h3>
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control p_input" name="UserName" value="">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control p_input" name="email">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control p_input" name="password">
              </div>
              <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control p_input"name="phone">
              </div>
              <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control p_input" name="address">
              </div>
          
              <div class="form-group d-flex flex-column align-items-center justify-content-between py-3">
                <button type="submit" name="signup" class="btn btn-primary">Signup</button>
                <div class="d-flex">
                  <button class="btn btn-facebook col me-2">
                    <i class="mdi mdi-facebook"></i> Facebook </button>
                  <button class="btn btn-google col">
                    <i class="mdi mdi-google-plus"></i> Google plus </button>
                </div>
                <p class="sign-up text-center">Already have an Account?<a href="login.php"> Login</a></p>
                <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
              </div>
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


    <!-- regex 

  $regex = /^01[0,1,2,5][0-9]{8}$/

  preg_match($regex,) 
  
  -->