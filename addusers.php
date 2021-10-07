<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Registeration form</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Registeration Form</h2>
        </div>

        <!-- Call  Comfirm function here -->
        
        <form class="form" action="index.php" id="form" name="form" onsubmit=" return Validate() ">
            <!-- User Name -->
            <div class="form-control">
                <label for="user Name"> Name </label>
                <input type="text" name="name" id="username" placeholder="Enter Your Full Name" autocomplete="off" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error Message</small>
            </div>

            <!-- User Email -->
            <div class="form-control">
                <label for="Email">Use Email </label>
                <input type="text" id="useremail" placeholder="Enter Your Email" autocomplete="off" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error Message</small>
            </div>

            <!-- User Phone Number -->
            <div class="form-control">
                <label for="user Phone">Use Phone </label>
                <input type="text" id="userphone" placeholder="Enter Your Phone Number" autocomplete="off" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error Message</small>
            </div>

                        <!-- Password -->
                        <div class="form-control">
                            <label for="Password">Password </label>
                            <input type="password" id="userpassword" placeholder="Enter Your Password" autocomplete="off" />
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error Message</small>
                        </div>
            
                        <!-- Confirm Password -->
                        <div class="form-control">
                            <label for="confirm Password">Confirm Password </label>
                            <input type="password" id="userconfirmpassword" placeholder="Confirm Password" autocomplete="off" />
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error Message</small>
                        </div>
                        



            <!-- Course Select tag -->
            <div class="form-control">
                <label for="Course">Use Course </label>
                <!-- <input type="text" id="username" placeholder="Enter Your Full Name"> -->
                <select name="course" id="usercourse">
                    <option value="0">Select Course</option>
                    <option value="1">HTML</option>
                    <option value="2">CSS</option>
                    <option value="3">JAVASCRIPT</option>
                    <option value="4">MYSQL</option>
                    <option value="5">PHP</option>
                </select>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error Message</small>
            </div>

            <!-- submit button -->
            <input type="submit" id="submit" name="submit" class="btn" placeholder="submit" />

        </form>
    </div>


    <!-- Javascript -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/Javascript">
        const submit = document.getElementById('submit');
        const form = document.getElementById('form');
        const name = document.getElementById('username');
        const email = document.getElementById('useremail');
        const phone = document.getElementById('userphone');
        const course = document.getElementById('usercourse');
        const password = document.getElementById('userpassword');
        const confirm = document.getElementById('userconfirmpassword');




        //Define Validate Function

        function Validate() {
            const nameval= username.value.trim();
            const emailval = useremail.value.trim();
            const phoneval = userphone.value.trim();
            const courseval = usercourse.value.trim();
            const passwordval = userpassword.value.trim();
            const confirmval = userconfirmpassword.value.trim();
            


            var nameErr = emailErr = phoneErr = courseErr = passwordErr = confirmErr =  true;

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
                setErrorMsg(email, "* Invali Email! ");
                emailErr = false;
            }else{
                setSuccessMsg(email);
            } 

            //validate Phone
            if(phoneval === ""){
                setErrorMsg(phone, "* Phone Can't be blank!");
                phoneErr = false;
            }else if(!isPhone(phoneval)){
                setErrorMsg(phone, "* Phone number length must be 10 digits and only numbers a re allowed");
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
                setErrorMsg(confirm, "*Confirm Password Can't be blank!");
                confirmErr = false;
            }else if(confirmval != passwordval){
                setErrorMsg(confirm, "* Password Does not matched");
                confirmErr = false;
            }else{
                setSuccessMsg(confirm);
            }
            


                        //validate Course
            if(courseval === "" || courseval == 0){
                setErrorMsg(course, "* You must have to Select one Course!");
                courseErr = false;
            }else{
                setSuccessMsg(course);
            }
            
            //successMsg(nameval);
            if( (nameErr && emailErr && phoneErr && courseErr && passwordErr && confirmErr ) == false){
                return false;
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


    function myfunction(){
        confirm("* Are you sure to save this record!");
    }
    </script>
</body>

</html>