$(document).ready(function() {
    $('#submit').click(function(e) {
        //e.preventDefault();

        var nameErr = emailErr = passwordErr = confirmErr = phoneErr = addressErr = genderErr = courseErr = disableErr = true;

        var nameval = $('#username').val();
        var emailval = $('#useremail').val();
        var phoneval = $('#userphone').val();
        var passwordval = $('#userpassword').val();
        var confirmval = $('#Cpass').val();
        var addressval = $('#address').val();
        var courseval = $('#usercourse').val();
        var genderval = $("input[type='radio']:checked").val();


        //Regular Expressions
        var nameReg = /^[a-zA-Z ]{2,30}$/;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var phoneReg = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;


        if (nameval === "") {
            $('#username').parent().addClass("error");
            $("#nameErr").html("* This Field is required!");
            nameErr = false;
        } else if (nameval.length < 3) {
            $('#username').parent().removeClass("success").addClass("error");
            $("#nameErr").html("* Name must be at least 3 character!");
            nameErr = false;
        } else if (!nameReg.test(nameval)) {
            $('#username').parent().removeClass("success").addClass("error");
            $("#nameErr").html("* Only character are allowed!");
            nameErr = false;
        } else {
            $('#username').parent().removeClass("error").addClass("success");
            $('#nameErr').html("");
        }


        //Email validation  
        if (emailval === "") {
            $('#useremail').parent().addClass("error");
            $('#emailErr').html("* This field is required");
            emailErr = false;
        } else if (!emailReg.test(emailval)) {
            $('#useremail').parent().removeClass("success").addClass("error");
            $('#emailErr').html("* Invalid Email format");
            emailErr = false;
        } else {
            $('#useremail').parent().removeClass("error").addClass("success");
            $('#emailErr').html("");
        }


        //Passwor Validation
        if (passwordval === "") {
            $('#userpassword').parent().addClass("error");
            $('#passwordErr').html("* This field is required!");
            passwordErr = false;
        } else if (passwordval.length < 8) {
            $('#userpassword').parent().removeClass("success").addClass("error");
            $('#passwordErr').html("* Minimum 8 character!");
            passwordErr = false;
        } else {
            $('#userpassword').parent().removeClass("error").addClass("success");
            $('#userpassword').html("");
        }


        //Confirm Passwor Validation
        if (confirmval === "") {
            $('#Cpass').parent().addClass("error");
            $('#confirm_passErr').html("* This Field is required!");
            confirmErr = false;
        } else if (passwordval != confirmval) {
            $('#Cpass').parent().removeClass("success").addClass("error");
            $('#confirm_passErr').html("* Password Not Matched!");
            confirmErr = false;
        } else {
            $('#Cpass').parent().removeClass("error").addClass("success");
            $('#Cpass').html("");
        }



        //Phone validation
        if (phoneval === "") {
            $('#userphone').parent().addClass("error");
            $('#phoneErr').html("* This Field is required!");
            phoneErr = false;
        } else if (phoneval.length < 11 || phoneval.length > 13) {
            $('#userphone').parent().removeClass("success").addClass("error");
            $('#phoneErr').html("* Invalid phone length must be 11");
            phoneErr = false
        } else if (!phoneReg.test(phoneval)) {
            $('#userphone').parent().removeClass("success").addClass("error");
            $('#phoneErr').html("* Invalid phone Format! Correct is = 03123456789");
            phoneErr = false;
        } else {
            $('#userphone').parent().removeClass("error").addClass("success");
            $('#userphone').html("");
        }


        //Address Validation
        if (addressval === "") {
            $('#address').parent().addClass("error");
            $('#addressErr').html("* This Field is required!");
            addressErr = false;
        } else {
            $('#address').parent().removeClass("error").addClass("success");
            $('#addressErr').html("");
        }

        //Gender Validation
        if (genderval === "Male") {
            $('#genderclass').removeClass("error").addClass("success");
            $('#genderErr').html("");
        } else if (genderval === "Female") {
            $('#genderclass').removeClass("error").addClass("success");
            $('#genderErr').html("");
        } else if (genderval === "Other") {
            $('#genderclass').removeClass("error").addClass("success");
            $('#genderErr').html("");
        } else {
            $('#genderclass').addClass("error");
            $('#genderErr').html("* This Field is required!");
            genderErr = false;

        }

        //Course Validation
        if (courseval === "" || courseval == 0) {
            $('#usercourse').parent().addClass("error");
            $('#courseErr').html("* This Field is required!");
            courseErr = false;
        } else {
            $('#usercourse').parent().removeClass("error").addClass("success");
            $('#courseErr').html("");
        }

        //Main validate all the 
        if ((nameErr && emailErr && phoneErr && courseErr && passwordErr && confirmErr && addressErr && genderErr) == false) {
            return false;
        } else {
            return true;
        }


    });
});