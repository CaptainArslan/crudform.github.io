<?php
session_start();
//echo(phpversion());
include("database.php");
$obj = new database();


//variables for the database values if have
$id =  $name = $email = $password = $confirm_pass = $phone = $address = $course = $gender = $disable  = "";

//Variables To show Erros
$nameErr = $emailErr = $passwordErr = $confirmErr = $phoneErr = $addressErr = $courseErr = $genderErr = $disableErr  = "";

$error = true;
$css_class= "";

//get data from database
if (isset($_GET['id']) && $_GET['id'] != "") {
    $id = $_GET['id'];
    
    $data = $obj->select($id);
    //print_r($data);
    $userid = $data['0']['id'];
    $name = $data['0']['user_firstname'];
    $email = $data['0']['user_email'];
    $password = $data['0']['user_password'];
    $confirm_pass = $data['0']['user_confirm_pass'];
    $phone = $data['0']['user_phone'];
    $address = $data['0']['user_address'];
    $course = $data['0']['user_course'];
    $gender = $data['0']['user_gender'];
    $disable = $data['0']['user_disable'];
}

//CHECK THE NETURN IF ID IS VALID OR NOT
if(isset($_GET['id'])){
    if (!$getuserid = $obj->select($id))
    {
        ?>
            <script>
                alert("* invalid Entry!");
            </script>
        <?php     
    }
}



// PHP VALIDATION FUNCTIONS
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


//SUBMIT FORM PROCESS
if (isset($_POST['submit'])) 
{
    if (empty($_POST['name'])) 
    {
        $nameErr = "* Please Enter Your Name!";
        $error = false;
    } 
    else 
    {
        /* ucfirst() function is use to make the first letter captal*/
        $name = ucfirst(test_input($_POST["name"]));
        if (!preg_match("/^[a-zA-Z ]+$/", $name)) 
        {
            $nameErr = "* Only Letter, Words and white spaces are Allowed!";
            $error = false;
        } 
        else if (strlen($name) <= 2) 
        {
            $nameErr = "* Name Must be greater than 3 Character!";
            $error = false;
        } 
        else 
        {
            $name = ucfirst(test_input($_POST["name"]));
        }
    }

    //PHP Email Validation
    if (empty($_POST['email'])) 
    {
        $emailErr = "* Please Enter Your Email!";
        $error = false;
    } 
    else 
    {
        /*strtolower() function is use to make the string to lower case*/
        $email = strtolower(test_input($_POST["email"])) ;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $emailErr = "* Invalid Email Format";
            $error = false;
        } 
        else 
        {
            $email = strtolower(test_input($_POST["email"]));
        }
    }

    //PHP Password Validation
    if (empty($_POST['password'])) 
    {
        $passwordErr = "* Please Enter Password!";
        $error = false;
    } 
    else 
    {
        $password = test_input($_POST["password"]);
        if (strlen($password) <= 3) 
        {
            $passwordErr = "* Password Must be greater than 3!";
            $error = false;
        } 
        else 
        {
            $password = test_input($_POST["password"]);
        }
    }



    //PHP Confirm Password Validation
    if (empty($_POST['confirm_pass'])) 
    {
        $confirmErr = "* Please Confirm Your Password";
        $error = false;
    } 
    else 
    {
        $confirm_pass = test_input($_POST["confirm_pass"]);
        if ($password != $confirm_pass) 
        {
            $confirmErr = "* Password not Matched";
            $error = false;
        }
        else 
        {
            $confirm_pass = test_input($_POST["confirm_pass"]);
        }
    }

    //PHP Phone Validation
    if (empty($_POST['phone'])) 
    {
        $phoneErr = "* Please Enter Your Phone";
        $error = false;
    } 
    else 
    {
        $phone = test_input($_POST['phone']);
        if (strlen($phone) < 10) 
        {
            $phoneErr = "* Phone Must be greater than 11 Character";
            $error = false;
        } 
        else 
        {
            $phone = test_input($_POST['phone']);
        }
    }

    //PHP Address Validation
    if (empty($_POST['address'])) 
    {
        $addressErr = "* Please Enter Your Address";
        $error = false;
    } 
    else 
    {
        $address = test_input($_POST['address']);
    }

    //PHP Gender Validation
    if (empty($_POST['gender'])) 
    {
        $genderErr = "* Please Select Gender";
        $error = false;
    } 
    else 
    {
        $gender = test_input($_POST['gender']);
    }

    //PHP Course Validation
    if (empty($_POST['course'])) 
    {
        $courseErr = "* Please Enter Gender";
        $error = false;
    } 
    else 
    {
        $course = test_input($_POST['course']);
    }
    
    //PHP Disable check
    if (empty($_POST['disable'])) 
    {
        $disable = "";
    } 
    else 
    {
        $disable = test_input($_POST['disable']);
    }

    $conditional_array = array('user_firstname' => $name, 'user_email' => $email, 'user_password' => $password, 'user_confirm_pass' => $confirm_pass, 'user_phone' => $phone, 'user_address' => $address, 'user_gender' => $gender, 'user_course' => $course, 'user_disable' => $disable);

    //print_r($conditional_array);
    if ($error == true) 
    {
        if ($id == "") 
        {
            $emailcheck = $obj->duplication($email);
            if($emailcheck)
            {
                $emailErr = "* Email Already Registered!";
            }
            else
            {
                $insert =  $obj->insert($conditional_array);
                if ($insert) 
                {
                        ?>
                            <script>
                                <?php $_SESSION['message'] = "* Record Inserted Successfully! "; ?>
                                window.location.href = "http://localhost/crudop/index.php";
                            </script>
                        <?php
                }
                else
                {
                     $css_class = "alert-danger";
                    ?>
                        <script>
                            alert("* Error Occured while Insertion");
                        </script>
                    <?php
                }
            }
        }
        else 
        {
            $id = $_GET['id'];
            //print_r($emailcheck);
                $emailcheck = $obj->duplication($email, $id);
                if($emailcheck)
                {
                    $emailErr = "* Email Already Registeresd!";
                }
                else
                {
                    $update = $obj->update($conditional_array, $id);
                    if ($update) 
                    {
                        ?>
                            <script>
                               //alert("* Data Updated Successfully!");
                               <?php $_SESSION['message'] = "* Record Updated Successfully! ";?>
                               window.location.href = "http://localhost/crudop/index.php";
                            </script>
                        <?php
                    }
                    else
                    {
                         $css_class = "alert-danger";
                        ?>
                            <script>
                                alert("* Error Occured While Updating Record");
                            </script>
                        <?php
    
                    }
                }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Registeration form</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" type="image" href="reg.png"/>
</head>

<body>   
    <div class="container">
        <div class="header">
            <h2> Manage User</h2>
        </div>

        <!-- Call  Comfirm function here -->

        <form class="form" action="" id="form" name="form" method="POST" onsubmit="return confirm('* Are you sure you wan to submit it?')">
            <!-- User Name -->
            <div class="form-control" id ="jqnameerror" >
                <label for="user Name"> Name </label>
                <input type="text" name="name" id="username" placeholder="Enter Your Full Name" autocomplete="off" value="<?php echo $name; ?>" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small id ="nameErr" ></small>
                <span style="float: right; color: red;"><?php echo $nameErr; ?></span>
            </div>

            <!-- User Email -->
            <div class="form-control" id="jqemailerror">
                <label for="Email">Email </label>
                <input type="hidden" name="email_check" id="useremail_check" value="<?php echo $email; ?>"/>
                <input type="email" name="email" id="useremail" placeholder="Enter Your Email" autocomplete="off" value="<?php echo $email; ?>" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small id="emailErr"></small>
                <span style="float: right; color: red;"  id="emailduperror"><?php echo $emailErr; ?></span>
            </div>

            <!-- Password -->
            <div class="form-control"  id="jqpasserror" >
            
                <label for="Password">Password </label>
                <input type="password" id="userpassword" name="password" placeholder="Enter Your Password" autocomplete="off" value="<?php echo $password; ?>" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <i class="fas fa-eye"></i>
                    <i class="fas fa-eye-slash"></i>
                </div>
                <small id="passwordErr" ></small>
                <span style="float: right; color: red;"><?php echo $passwordErr; ?></span>
            </div>

            <!-- Confirm Password -->
            <div class="form-control" id="jqcpasserror" >
                <label for="Verify Password">Confirm Password </label>
                <input type="password" id="Cpass" name="confirm_pass" placeholder="Password" autocomplete="off" value="<?php echo $confirm_pass; ?>" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small id="confirm_passErr" ></small>
                <span style="float: right; color: red;"><?php echo $confirmErr; ?></span>
            </div>
                
            <div class="form-control" >
                <label for="ShowPassword"> Show Password <input type="checkbox" id="ShowPassword" onclick="showPassword()" /></label>
            </div>
            
            <!-- User Phone Number -->
            <div class="form-control" id="jqphonerror" >
                <label for="user Phone">Use Phone </label>
                <input type="hidden" name="phone_check" id="userphone_check" value="<?php echo $phone; ?>"/>
                <input type="text" id="userphone" name="phone" placeholder="Enter Your Phone Number" autocomplete="off" value="<?php echo $phone; ?>" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small id="phoneErr" ></small>
                <span style="float: right; color: red;" id="phoneErr"><?php echo $phoneErr; ?></span>
            </div>

            <!-- Address -->
            <div class="form-control" id="jqaddresserror" >
                <label for="Address">Address</label>
                <input type="text" id="address" name="address" placeholder="Enter Your Address" autocomplete="off" value="<?php echo $address; ?>" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small id="addressErr"></small>
                <span style="float: right; color: red;"><?php echo $addressErr; ?></span>
            </div>

            <!-- Gender -->
            <div class="form-control " id="genderclass" >
                <label for="Gender">Gender : </label>
                <label for="Male"><input type="radio" name="gender" value="Male" id="Male" <?php if ($gender == 'Male') echo 'Checked'; ?> />Male</label>
                <label for="Female"><input type="radio" name="gender" value="Female" id="Female" <?php if ($gender == 'Female') echo 'Checked'; ?> />Female</label>
                <label for="Other"><input type="radio" name="gender" value="Other" id="Other" <?php if ($gender == 'Other') echo 'Checked'; ?> />Other</label>
                <i class="fas fa-check-circle gendererror"></i>
                <i class="fas fa-exclamation-circle gendererror"></i>
                <small id="genderErr"></small>
                <span style=" color: red;"><?php echo $genderErr; ?></span>
            </div>


            <!-- Course Select tag -->
            <div class="form-control" id="jqcourseerror" >
                <label for="Course">Use Course </label>
                <!-- <input type="text" id="username" placeholder="Enter Your Full Name"> -->
                <select name="course" id="usercourse">
                    <option value="0">Select Course</option>
                    <option value="HTML" <?php if ($course == 'HTML') echo 'selected'; ?>>HTML</option>
                    <option value="CSS" <?php if ($course == 'CSS') echo 'selected'; ?>>CSS</option>
                    <option value="JAVASCRIPT" <?php if ($course == 'JAVASCRIPT') echo 'selected'; ?>>JAVASCRIPT</option>
                    <option value="MYSQL" <?php if ($course == 'MYSQL') echo 'selected'; ?>>MYSQL</option>
                    <option value="PHP" <?php if ($course == 'PHP') echo 'selected'; ?>>PHP</option>
                </select>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small id="courseErr" ></small>
                <span style="float: right; color: red;"><?php echo $courseErr; ?></span>
            </div>

            <!-- Disable -->
            <div class="form-control ">
                <label for="disable">Disable : </label>
                <label for="disable"><input type="checkbox" name="disable" value="disable" id="disable" <?php if ($disable == "disable") echo 'checked'; ?> /></label>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small id="disableErr"></small>
            </div>

            <!-- submit button -->
            <div class="btns">
            <?php 
                if(isset($_GET['id']) && $_GET['id'] != "")
                {
                    $id = $_GET['id'];
                    if($obj->select($id))
                    {
                        ?><input type="submit" id="submit" name="submit" class="btn" placeholder="Update" value="Update" onclick="return Validate()" /><?php
                    }
                }
                else
                {
                    ?><input type="submit" id="submit" name="submit" class="btn" placeholder="submit" value="Submit" onclick="return Validate()" /><?php
                }
            ?>
                <!--<button id="submit" name="submit" class="btn submit_btn">Submit</button>-->
                <a href="index.php" class="btn">Back</a>
            </div>
        </form>
    </div>


                                                    <!-- Javascript -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/Javascript">
        
    function showPassword()
    {
        var x = document.getElementById('userpassword');
        var y = document.getElementById('Cpass');
        console.log()
          if (x.type === "password" || y.type === "password") 
          {
            x.type = "text";
            y.type = "text"
          } 
          else
          {
            x.type = "password";
            y.type = "Password"
          }
    }
    
   // EMAIL AVAILABLITY CHECK BY AJAX JQUERY
        $(document).ready(function()
        {
            $('#useremail').blur(function()
            {
                var email = $('#useremail').val();
                var email_hidden_check = $('#useremail_check').val();
                //to check the values of the variables
                console.log(email_hidden_check);
                console.log(email);
                if(email != email_hidden_check)
                {
                    $.ajax(
                    {
                        type: "POST",
                        url: "checking.php",
                        data: 'email='+email,
                        success: function (response) 
                        {
                            if(response == "true")
                            {
                                // $('#emailErr').html(data);
                                $('#emailduperror').html("* Email Already Registered!");
                                $('#submit').attr('disabled', true);
                            }
                            else
                            {
                                $('#emailduperror').html("");
                                $('#submit').attr('disabled',false);
                            }
                        }
                    });
                }
            });
        });
    </script>
    <script src="js/jquery.js"></script>
</body>

</html>