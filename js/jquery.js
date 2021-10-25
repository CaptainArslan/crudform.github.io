var nameErr = emailErr = passwordErr = confirmErr = addressErr = phoneErr = courseErr = genderErr = disableErr = true;

    $(document).ready(function () {
        $('#submit').click(function (e) {
            //e.preventDefault();
            
            var nameval= $('#username').val();
            var emailval =$('#useremail').val();
            var phoneval = $('#userphone').val();
            var passwordval = $('#userpassword').val();
            var confirmval = $('#Cpass').val();
            var addressval = $('#address').val();
            var courseval = $('#usercourse').val();
            var genderval = $('[name=gender]').val();
            var disableval = $('[name=disable]').val();

            console.log(nameval);
            console.log(emailval);
            console.log(phoneval);
            console.log(passwordval);
            console.log(confirmval);
            console.log(addressval);
            console.log(courseval);
            console.log(genderval);
            console.log(disableval);


            //Regular Expressions
            var nameReg = /^[a-zA-Z ]{2,30}$/;
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var phoneReg = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
                

            if(nameval==="")
            {
                $('#username').parent().addClass("error");
                $("#nameErr").html("* This Field is required!");
                nameErr = false;
            }
            else if(nameval.length <3 )
            {
                $('#username').parent().addClass("error");
                $("#nameErr").html("* Name must be at least 3 character!");
                nameErr = false;
            }
            else if(!nameReg.test(nameval))
            {
                $('#username').parent().addClass("error");
                $("#nameErr").html("* Only character are allowed!");
                nameErr = false;
            }
            else
            {
                $('#username').parent().removeClass("error").addClass("success");
                $('#nameErr').html("");
            }


            //Email validation  
            if(emailval==="")
            {
                $('#useremail').parent().addClass("error");
                $('#emailErr').html("* This field is required jquery");
                emailErr = false;
            }
            else if(!emailReg.test(emailval))
            {
                $('#useremail').parent().addClass("error");
                $('#emailErr').html("* Invalid Email format");
                emailErr = false;
            }
            else
            {
                $('#useremail').parent().removeClass("error").addClass("success");
                $('#emailErr').html("");
            }


            //Passwor Validation
            if(passwordval === ""){
                $('#userpassword').parent().addClass("error");
                $('#passwordErr').html("* This field is required!");
                passwordErr = false;
            }
            else if(passwordval.length <8 )
            {
                $('#userpassword').parent().addClass("error");
                $('#passwordErr').html("* Minimum 8 character!");
                passwordErr = false;
            }
            else
            {
                $('#userpassword').parent().removeClass("error").addClass("success");
                $('#userpassword').html("");
            }

            //Confirm Passwor Validation
            if(confirmval === "")
            {
                $('#Cpass').parent().addClass("error");
                $('#confirm_passErr').html("* This Field is required!");
                confirmErr = false;
            }
            else if(passwordval != confirmval)
            {
                $('#Cpass').parent().addClass("error");
                $('#confirm_passErr').html("* Password Not Matched!");
               
                confirmErr = false;
            }
            else
            {
                $('#Cpass').parent().removeClass("error").addClass("success");
                $('#Cpass').html("");
            }



            //Phone validation
            if(phoneval==="")
            {
                $('#userphone').parent().addClass("error");
                $('#phoneErr').html("* This Field is required!");
                phoneErr = false;
            }
            else if(!phoneReg.test(phoneval))
            {
                $('#userphone').parent().addClass("error");
                $('#phoneErr').html("* Invalid phone Format! Correct is = 03123456789");
                phoneErr = false;
            }
            else
            {
                $('#userphone').parent().removeClass("error").addClass("success");
                $('#userphone').html("");
            }


            //Address Validation
            if(addressval==="")
            {
                $('#address').parent().addClass("error");
                $('#addressErr').html("* This Field is required!");
                addressErr = false;
            }
            else
            {
                $('#address').parent().removeClass("error").addClass("success");
                $('#addressErr').html("");
            }

            //Gender Validation
            if(genderval==="")
            {
                $('#genderclass').addClass("error");
                $('#genderErr').html("* This Field is required!");
                addressErr = false;
            }
            else
            {
                $('#genderclass').parent().removeClass("error").addClass("success");
                $('#genderErr').html("");
            }

            //Course Validation
            if(courseval === "" || courseval == 0){
                $('#usercourse').parent().addClass("error");
                $('#courseErr').html("* This Field is required!");
                addressErr = false;
            }else{
                $('#usercourse').parent().removeClass("error").addClass("success");
                $('#courseErr').html("");
            }
        
        
            console.log(nameErr);
            console.log(emailErr);
            console.log(phoneErr);
            console.log(courseErr);
            console.log(passwordErr);
            console.log(confirmErr);
            console.log(addressErr);
            console.log(genderErr);
        
        
            //Main validate all the 
            if( (nameErr && emailErr && phoneErr && courseErr && passwordErr && confirmErr && addressErr && genderErr) == false)
            {
                return false;
            }
            else
            {
                return true;
            }


        });
    });

