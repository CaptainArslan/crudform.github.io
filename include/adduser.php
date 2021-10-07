<?php include("include/header.php"); ?>
<?php
include("dbcon.php");
$nameErr = $emailErr = $phoneErr = $passwordErr = $cpasswordErr = $courseErr = "";
$name = $email = $phone = $password = $cpassword = $cources = "";

    if(isset($_POST['submit'])){
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }

          if (empty($_POST["name"])) {
            $nameErr = "Name is required";
          } else {
            $name = test_input($_POST["name"]);
          }
          
          if (empty($_POST["email"])) {
            $emailErr = "Email is required";
          } else {
            $email = test_input($_POST["email"]);
          }
          
          if (empty($_POST["phone"])) {
            $phoneErr = "Phone is required";
          } else {
            $phone = test_input($_POST["phone"]);
          }

          if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
          } else {
            $password = test_input($_POST["password"]);
          }


          if (empty($_POST["cources"])) {
            $courseErr = "Please Select Cources";
          } else {
            $cources = test_input($_POST["cources"]);
          }
          

        
                    $insert = mysqli_query($con, "INSERT INTO `user_info`( `user_name`, `user_email`, `user_phone`,
                     `user_pass`, `user_compass`, `user_course`) VALUES ('$name','$email','$phone','$password','$cpassword', '$cources'");
                    
                         echo " <script>
                                    alert('Inserted Successfully');
                                </script>  ";
                    
          



    }
   
?>
<div class="container m-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Register Now</h4>
                </div>
                <div class="card-body ">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <div class="mb-3">
                            <label for="Name" class="form-label">Name</label>
                            <input type="name" class="form-control" name="name" <?php echo $name; ?>>
                            <small class="error" style="color: red;" id="nameErr"><?php echo $nameErr; ?> </small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                            <small class="error" style="color: red;" id="emailErr"><?php echo $emailErr; ?> </small>
                        </div>
                        <div class="mb-3">
                            <label for="Phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" name="phone" value="<?php echo $phone; ?>">
                            <small class="error" style="color: red;" id="phoneErr"><?php echo $phoneErr; ?> </small>
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                            <small class="error" style="color: red;" id="passwordErr"><?php echo $phoneErr; ?> </small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="Select" class="form-label">Cources</label>
                            <select name="" id="" class="form-control" name="cources" <?php echo $cources ; ?>>
                                <option value="0">Select</option>
                                <option value="1">HTML</option>
                                <option value="2">CSS</option>
                                <option value="3">JAVASCRIPT</option>
                                <option value="4">MYSQL</option>
                            </select>
                            <small class="error" style="color: red;" id="courseErr"><?php echo $courseErr; ?> </small>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <a href="index.php" type="submit" class="btn btn-warning">Cancel </a >
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include("include/footer.php"); ?>