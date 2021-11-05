<?php 
session_start();

if(isset($_SESSION['email'])){
  header("location: indextbl.php");
}

//echo(phpversion());
include("database.php");
$obj = new database();

// PHP VALIDATION FUNCTIONS
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$error = true;
$emailErr = $passErr = $loginmsg = "";

if($_SERVER['REQUEST_METHOD']=="POST")
{
  if(isset($_POST['submit']))
  {
    //Email PHP Validation
      if(empty($_POST['email']))
      {
        $emailErr = "* Email Can't be blank php! ";
        $error = false;
      }
      else
      {
        $email = test_input($_POST['email']);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
          $emailErr = "* Invalid Email Format php! ";
            $error = false;
        }
        else
        {
          $email = strtolower(test_input($_POST["email"]));
        }
      }

      //Password Validation

      if(empty($_POST['password']))
      {
        $passErr = "* Password cant be blank php!";
        $error = false;
      }
      else
      {
        $password = test_input($_POST["password"]);
        if (strlen($password) <= 3) 
        {
            $passwordErr = "* Password Must be greater than 3 php!";
            $error = false;
        } 
        else 
        {
            $password = test_input($_POST["password"]);
        }
      }



      if($error == true)
      {
        $result = $obj->login($email, $password );
        if($result)
        { 
          header("location: indextbl.php");
        }
        else
        {
          $loginmsg = "* Email or Password is incorrect!";
        }
      }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="js/sweetalert.min.js"></script>
    <script src="js/jquerylib.js"></script>
    <title>Login Crudop</title>
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Login In</h5>
            <form action="" method="POST">

              <!-- Alert Message -->
             <?php 
                if(!empty($loginmsg))
                {
                  ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="fas fa-exclamation-triangle bi flex-shrink-0 me-2 fs-5" font ></i>
                      <?php echo $loginmsg; ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php
                }
             ?>
              

         
              <!-- Alert Message Ends -->

              <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="useremail" placeholder="Enter Your Email" value="<?php if(isset($_COOKIE['EmailCookie'])) { echo $_COOKIE['EmailCookie']; } ?>" autocomplete="off"  placeholder="name@example.com" >
                <label for="email">Email address</label>
                <small id="emailError" ></small>
                <span id="phperror"><?php echo $emailErr; ?></span>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter Your Password" value="<?php if(isset($_COOKIE['PasswordCookie'])) { echo $_COOKIE['PasswordCookie']; } ?>" autocomplete="off"  placeholder="Password" >
                <label for="password">Password</label>
                <small id="passwordError" ></small>
                <span id="phperror"><?php echo $passErr; ?></span>
              </div>

              <div class="form-check mb-3">
                <label class="form-check-label"  for="show">
                  <input class="form-check-input" type="checkbox" name="remember_me" value="" id="show" onclick="showPass()" >
                  Show Password
                </label>
              </div>
              <div class="d-grid">
                <input type="submit" name="submit"  class="btn btn-primary btn-login text-uppercase fw-bold"  value="Submit" onclick="return Validate()"  >
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  
    <script type="text/Javascript">

        function  showPass(){
          var pass = document.getElementById('userpassword');

          if(pass.type === "password" )
          {
            pass.type = "text";
          }
          else
          {
            pass.type = "password";
          }
        }


        var email = document.getElementById('useremail');
        var password = document.getElementById('userpassword');

    function Validate(){

        var emailErr = passErr = true;
        var emailval = document.getElementById('useremail').value.trim();
        var passwordval = document.getElementById('userpassword').value.trim();

        //Validate Email
        if (emailval === "") {
            setErrorMsg(email, "* Email Cant be blank!");
            emailErr = false;
        }
        else if (!isEmail(emailval)) {
            setErrorMsg(email, "* Invalid Email! ");
            emailErr = false;
        }
        else {
            setSuccessMsg(email);
        }


            //validate password
        if (passwordval === "") 
        {
            setErrorMsg(password, "* Password Can't be blank!");
            passErr = false;
        } else if (passwordval.length < 8) 
        {
            setErrorMsg(password, "* Password must be greater than 8 digits");
            passErr = false;
        }
        else 
        {
            setSuccessMsg(password);
        }

        // console.log(emailErr);
        // console.log(passErr);

        if ( (emailErr && passErr ) == false) 
        {
            return false;
        } 
        else
        {
            return true;
        }

    }

    //Email validate function
    const isEmail = (emailval) =>
    {
        var atSymbol = emailval.indexOf("@");
        var emailpattern = /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/;
        if (atSymbol < 1)
            return false;
        var dot = emailval.lastIndexOf(".");
        if (dot <= atSymbol + 3) return false;
        if (dot === emailval.length - 1) return false;
        if (!emailpattern.test(emailval)) return false;
        return true;
    }

    //set error message function 
    function setErrorMsg(input, errormsgs) 
    {
        //take the div (form-control) that show error
        const formControl = input.parentElement;
        const small = formControl.querySelector('small');
        formControl.className = "form-floating error mb-3";
        small.innerHTML = errormsgs;
    }

    //set Success Message
    function setSuccessMsg(input) 
    {
        const formControl = input.parentElement;
        const small = formControl.querySelector('small');
        formControl.className = "form-floating success mb-3";
        small.innerHTML = "";
    }

</script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>