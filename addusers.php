<?php
session_start();
//echo(phpversion());
include("database.php");
$obj = new database();


//variables for the database values if have
$id = "";
$name = "";
$email = "";
$password = "";
$confirm_pass = "";
$phone = "";
$address = "";
$course = "";
$gender = "";
$disable  = "";

//Variables To show Erros
$nameErr = "";
$emailErr = "";
$passwordErr = "";
$confirmErr = "";
$phoneErr = "";
$addressErr = "";
$courseErr = "";
$genderErr = "";
$disableErr  = "";


if (isset($_GET['id']) && $_GET['id'] != "") {
    $id = $_GET['id'];
    
    $data = $obj->select($id);
    
    //print_r($data);
    $name = $data['0']['user_firstname'];
    $email = $data['0']['user_email'];
    $password = $data['0']['user_password'];
    $confirm_pass = $data['0']['user_confirm_pass'];
    $phone = $data['0']['user_phone'];
    $address = $data['0']['user_address'];
    $course = $data['0']['user_status'];
    $gender = $data['0']['user_gender'];
    $disable = $data['0']['user_disable'];
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if (isset($_POST['submit'])) {

    if (empty($_POST['name'])) {
        $nameErr = "* Please Enter Your Name!";
        $error = false;
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
            $nameErr = "* Only Letter, Words and white spaces are Allowed!";
            $error = false;
        } else if (strlen($name) <= 2) {
            $nameErr = "* Name Must be greater than 3 Character!";
            $error = false;
        } else {
            $name = test_input($_POST["name"]);
            $error = true;
        }
    }

    //PHP Email Validation
    if (empty($_POST['email'])) {
        $emailErr = "* Please Enter Your Email!";
        $error = false;
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "* Invalid Email Format";
            $error = false;
        } else {
            $email = test_input($_POST["email"]);
            $error = true;
        }
    }

    //PHP Password Validation
    if (empty($_POST['password'])) {
        $passwordErr = "* Please Enter Password!";
        $error = false;
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) <= 3) {
            $passwordErr = "* Password Must be greater than 3!";
            $error = false;
        } else if (strlen($password) > 10) {
            $passwordErr = "* Password Must be between 5 to 10 character!";
            $error = false;
        } else {
            $password = test_input($_POST["password"]);
            $error =  true;
        }
    }



    //PHP Confirm Password Validation
    if (empty($_POST['confirm_pass'])) {
        $confirmErr = "* Please Confirm Your Password";
        $error = false;
    } else {
        $confirm_pass = test_input($_POST["confirm_pass"]);
        if ($password != $confirm_pass) {
            $confirmErr = "* Password not Matched";
            $error = false;
        } else {
            $confirm_pass = test_input($_POST["confirm_pass"]);
            $error = true;
        }
    }

    //PHP Phone Validation
    if (empty($_POST['phone'])) {
        $phoneErr = "* Please Enter Your Phone";
        $error = false;
    } else {
        $phone = test_input($_POST['phone']);
        if (strlen($phone) < 10) {
            $phoneErr = "* Phone Must be greater than 11 Character";
            $error = false;
        } else {
            $phone = test_input($_POST['phone']);
            $error = true;
        }
    }

    //PHP Address Validation
    if (empty($_POST['address'])) {
        $addressErr = "* Please Enter Your Phone";
        $error = false;
    } else {
        $address = test_input($_POST['address']);
        $error = true;
    }

    //PHP Gender Validation
    if (empty($_POST['gender'])) {
        $genderErr = "* Please Select Gender";
        $error = false;
    } else {
        $gender = test_input($_POST['gender']);
    }

    //PHP Course Validation
    if (empty($_POST['course'])) {
        $courseErr = "* Please Enter Gender";
        $error = false;
    } else {
        $course = test_input($_POST['course']);
        $error = true;
    }
    
    //PHP Disable check
    if (empty($_POST['disable'])) {
        $disable = "";
    } else {
        $disable = test_input($_POST['disable']);
    }

    $conditional_array = array('user_firstname' => $name, 'user_email' => $email, 'user_password' => $password, 'user_confirm_pass' => $confirm_pass, 'user_phone' => $phone, 'user_address' => $address, 'user_gender' => $gender, 'user_status' => $course, 'user_disable' => $disable);

    //print_r($conditional_array);
    if ($error == true) {
        if ($id == "") {
            $emailcheck = $obj->duplication($email);
            if(isset($emailcheck['0']) > 0){
                $emailErr = "* Email Already present PHP!";
            }
            else{
                $insert =  $obj->insert($conditional_array);
                if ($insert) {
                        ?>
                            <script>
                                alert("* Data Inserted Successfully!");
                                <?php $_SESSION['message'] = "* Record Inserted Successfully! ";?>
                                window.location.href = "http://localhost/crudop/index.php";
                            </script>
                        <?php
                    }
                        /*?>
                        <script>
                                   window.location.href = "http://127.0.0.1:8080/crudop//index.php";
                        </script>
                    <?php*/
            }
        } else {
            $emailcheck = $obj->duplication($email);
            if(isset($emailcheck['0']) > 0){
                $emailErr = "* Email Already present PHP!";
            }else{
                $update = $obj->update($conditional_array, $id);
                if ($update) {
                ?>
                    <script>
                        alert("* Data Updated Successfully!");
                       <?php $_SESSION['message'] = "* Record Updated Successfully! ";?>
                        window.location.href = "http://localhost/crudop/index.php";
                    </script>
                <?php
                } else {
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
</head>

<body>
    <div class="container">
        <div class="header">
            <h2> Manage User</h2>
        </div>

        <!-- Call  Comfirm function here -->

        <form class="form" action="" id="form" name="form" method="POST" onsubmit="return confirm('* Are you sure to do this action!')">
            <!-- User Name -->
            <div class="form-control">
                <label for="user Name"> Name </label>
                <input type="text" name="name" id="username" placeholder="Enter Your Full Name" autocomplete="off" value="<?php echo $name; ?>" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error Message</small>
                <span style="float: right; color: red;"><?php echo $nameErr; ?></span>
            </div>

            <!-- User Email -->
            <div class="form-control">
                <label for="Email">Email </label>
                <input type="hidden" name="email_check" id="useremail_check" value="<?php echo $email; ?>"/>
                <input type="email" name="email" id="useremail" placeholder="Enter Your Email" autocomplete="off" value="<?php echo $email; ?>" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error Message</small>
                <span style="float: right; color: red;" id="emailErr"><?php echo $emailErr; ?></span>
            </div>

            <!-- Password -->
            <div class="form-control">
            
                <label for="Password">Password </label>
                <input type="password" id="userpassword" name="password" placeholder="Enter Your Password" autocomplete="off" value="<?php echo $password; ?>" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <i class="fas fa-eye"></i>
                    <i class="fas fa-eye-slash"></i>
                </div>
                <small>Error Message</small>
                <span style="float: right; color: red;"><?php echo $passwordErr; ?></span>
            </div>

            <!-- Confirm Password -->
            <div class="form-control">
                <label for="Verify Password">Confirm Password </label>
                <input type="password" id="Cpass" name="confirm_pass" placeholder="Password" autocomplete="off" value="<?php echo $confirm_pass; ?>" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error Message</small>
                <span style="float: right; color: red;"><?php echo $confirmErr; ?></span>
            </div>
                
            <div class="form-control">
                <label for="ShowPassword"> Show Password <input type="checkbox" id="ShowPassword" onclick="showPassword()" /></label>
            </div>
            
            <!-- User Phone Number -->
            <div class="form-control">
                <label for="user Phone">Use Phone </label>
                <input type="text" id="userphone" name="phone" placeholder="Enter Your Phone Number" autocomplete="off" value="<?php echo $phone; ?>" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error Message</small>
                <span style="float: right; color: red;" id="phoneErr"><?php echo $phoneErr; ?></span>
            </div>

            <!-- Address -->
            <div class="form-control">
                <label for="Address">Address</label>
                <input type="text" id="address" name="address" placeholder="Enter Your Address" autocomplete="off" value="<?php echo $address; ?>" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error Message</small>
                <span style="float: right; color: red;"><?php echo $addressErr; ?></span>
            </div>

            <!-- Gender -->
            <div class="form-control " id="genderclass">
                <label for="Gender">Gender : </label>
                <label for="Male"><input type="radio" name="gender" value="Male" id="Male" <?php if ($gender == 'Male') echo 'Checked'; ?> />Male</label>
                <label for="Female"><input type="radio" name="gender" value="Female" id="Female" <?php if ($gender == 'Female') echo 'Checked'; ?> />Female</label>
                <label for="Other"><input type="radio" name="gender" value="Other" id="Other" <?php if ($gender == 'Other') echo 'Checked'; ?> />Other</label>
                <i class="fas fa-check-circle gendererror"></i>
                <i class="fas fa-exclamation-circle gendererror"></i>
                <small id="genderErr">Error Message</small>
                <span style=" color: red;"><?php echo $genderErr; ?></span>
            </div>


            <!-- Course Select tag -->
            <div class="form-control">
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
                <small>Error Message</small>
                <span style="float: right; color: red;"><?php echo $courseErr; ?></span>
            </div>

            <!-- Disable -->
            <div class="form-control " id="genderclass">
                <label for="disable">Disable : </label>
                <label for="disable"><input type="checkbox" name="disable" value="disable" id="disable" <?php if ($disable == "disable") echo 'checked'; ?> /></label>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small id="disableErr">Error Message</small>
            </div>

            <!-- submit button -->
            <div class="btns">
            <?php 
                if(isset($_GET['id']) && $_GET['id'] != ""){
                    $update_data = $obj->select($id);
                    if($update_data){
                        ?><input type="submit" id="submit" name="submit" class="btn" placeholder="Update" value="Update" onclick="return Validate()" /><?php
                    }else{
                        ?>
                            <script>
                                alert("Invalid Entry");
                                window.location.href = "http://127.0.0.1:8080/crudop//index.php";
                            </script>
                        <?php
                    }
                    
                }else{
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
          if (x.type === "password" || y.type === "password") {
            x.type = "text";
            y.type = "text"
          } else {
            x.type = "password";
            y.type = "Password"
          }
    }
    
    //Email Availability check
        $(document).ready(function(){
            $('#useremail').blur(function(){
                var email = $('#useremail').val();
                var email_hidden_check = $('#useremail_check').val();
                //to check the values of the variables
                console.log(email_hidden_check);
                console.log(email);
                if(email != email_hidden_check){
                    $.ajax({
                        type: "POST",
                        url: "checking.php",
                        data: 'email='+email,
                        success: function (data) {
                            $('#emailErr').html(data);
                        },error:function(){
                        }
                    });
                    
                }else{
                    $('#emailErr').html("");
                    $('#submit').attr('disabled', false);
                }
            });
        });
        

        const form = document.getElementById('form');
        const name = document.getElementById('username');
        const email = document.getElementById('useremail');
        const phone = document.getElementById('userphone');
        const course = document.getElementById('usercourse');
        const password = document.getElementById('userpassword');
        const confirm_pass = document.getElementById('Cpass');
        const address = document.getElementById('address');

        const disable = document.form.disable;
        const gender = document.form.gender;

        //Define Validate Function starts from here
        function Validate() {
            const nameval= username.value.trim();
            const emailval = useremail.value.trim();
            const phoneval = userphone.value.trim();
            const courseval = usercourse.value.trim();
            const passwordval = userpassword.value.trim();
            const confirmval = Cpass.value.trim();
            const addressval = address.value.trim();

            const genderval = document.form.gender.value;
            const disableval = document.form.disable;


            var nameErr = emailErr = phoneErr = courseErr = passwordErr = confirmErr = addressErr = genderErr = disableErr = true;

            //validate username

            if(nameval === ""){
                setErrorMsg(name, "* Name Cant be blank!");
                nameErr = false;
            }else if(nameval.length <= 2){
                setErrorMsg(name, "* Name Must be greater than 2 Character!");
                nameErr = false;
            }else if (!isName(nameval)){
                setErrorMsg(name, "* Only Characters, Letters and White Spaces are Allowed! ");
                nameErr = false;
            }else{
                setSuccessMsg(name)
            }

            //Validate Email
            if(emailval === ""){
                setErrorMsg(email, "* Email Cant be blank!");
                emailErr = false;
            }else if(!isEmail(emailval)){
                setErrorMsg(email, "* Invalid Email! ");
                emailErr = false;
            }else{
                setSuccessMsg(email);
            } 

            //validate Phone
            if(phoneval === ""){
                setErrorMsg(phone, "* Phone Can't be blank!");
                phoneErr = false;
            }else if(!isPhone(phoneval)){
                setErrorMsg(phone, "* Phone number length must be 11 digits and only numbers a re allowed");
                phoneErr = false;
            }else{
                setSuccessMsg(phone);
            }
    
            //validate password
            if(passwordval === ""){
                setErrorMsg(password, "* Password Can't be blank!");
                passwordErr = false;
            }else if(passwordval.length < 8){
                setErrorMsg(password, "* Password must be greater than 8 digits");
                passwordErr = false;
            }else{
                setSuccessMsg(password);
            }

            //validate Confirm password
            if(confirmval === ""){
                setErrorMsg(confirm_pass, "*Confirm Password Can't be blank!");
                confirmErr = false;
            }else if(confirmval != passwordval){
                setErrorMsg(confirm_pass, "* Password Does not matched");
                confirmErr = false;
            }else{
                setSuccessMsg(confirm_pass);
            }
            
            //validate Address
            if(addressval === ""){
                 setErrorMsg(address, "*Please Enter Your Address!");
                 addressErr = false;
            }else{
                setSuccessMsg(address);
            }

            //validate Gender
            if(genderval === ""){
                //alert("Please Select Gender");
                //This below line is use to change the innerhtml of the small tag under the radio buttons
                document.getElementById("genderErr").innerHTML = "* Please select Gender!";
                //thie following is use to set the error class of readio buttons
                var elem  = document.getElementById("genderclass");
                elem.classList.add("error");
                genderErr = false;
            }else{
                document.getElementById("genderErr").innerHTML = "";
                var a = document.getElementById("genderclass");
                a.classList.remove("error");
                a.classList.add("success");
                genderErr = true;
            }
            
            //validate Course
            if(courseval === "" || courseval == 0){
                setErrorMsg(course, "* You must have to Select one Course!");
                courseErr = false;
            }else{
                setSuccessMsg(course);
            }
            
            //successMsg(nameval);
            if( (nameErr && emailErr && phoneErr && courseErr && passwordErr && confirmErr && addressErr && genderErr) == false){
                return false;
            }else{
                //swal("Good job!" + nameval, "All form is Validate", "success");
            }
        };

        //Name Validation for character and whitespaces
        const isName = (nameval) => {
            var namepattern = /^[a-zA-Z ]{2,30}$/ ;
            if (!namepattern.test(nameval)) return false;
            return true;
        }

        //Email validate function
        const isEmail = (emailval) =>{
            var atSymbol = emailval.indexOf("@");
            var emailpattern = /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/;
            if(atSymbol < 1)
                return false;
            var dot = emailval.lastIndexOf(".");
            if(dot <= atSymbol + 3  )return false;
            if(dot === emailval.length - 1)return false;
            if(!emailpattern.test(emailval)) return false;
            return true;
        }


        //validate phone number
        const isPhone = (phoneval) => {
            var phonePattern = /^[0-9]{11}$/;
            var onlyNumbers = /^[0-9]+$/;
            if(!phonePattern.test(phoneval)) return false;
            else if (!onlyNumbers.test(phoneval)) return false;
            return true;
        }

        //set error message function 
        function setErrorMsg(input, errormsgs){
            //take the div (form-control) that show error
            const formControl = input.parentElement;
            const small = formControl.querySelector('small');
            formControl.className = "form-control error ";
            small.innerHTML = errormsgs;
        }

        //set Success Message
        function setSuccessMsg(input){
            const formControl = input.parentElement;
            formControl.className = "form-control success";
        }



    </script>
</body>

</html>