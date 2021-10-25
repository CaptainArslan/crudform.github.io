
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
    const nameval = username.value.trim();
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

    if (nameval === "") {
        setErrorMsg(name, "* Name Cant be blank!");
        nameErr = false;
    }
    else if (nameval.length <= 2) {
        setErrorMsg(name, "* Name Must be greater than 2 Character!");
        nameErr = false;
    }
    else if (!isName(nameval)) {
        setErrorMsg(name, "* Only Characters, Letters and White Spaces are Allowed! ");
        nameErr = false;
    }
    else {
        setSuccessMsg(name)
    }

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

    //validate Phone
    if (phoneval === "") {
        setErrorMsg(phone, "* Phone Can't be blank!");
        phoneErr = false;
    }
    else if (!isPhone(phoneval)) {
        setErrorMsg(phone, "* Phone number length must be 11 digits and only numbers a re allowed");
        phoneErr = false;
    } else {
        setSuccessMsg(phone);
    }

    //validate password
    if (passwordval === "") {
        setErrorMsg(password, "* Password Can't be blank!");
        passwordErr = false;
    } else if (passwordval.length < 8) {
        setErrorMsg(password, "* Password must be greater than 8 digits");
        passwordErr = false;
    }
    else {
        setSuccessMsg(password);
    }

    //validate Confirm password
    if (confirmval === "") {
        setErrorMsg(confirm_pass, "*Confirm Password Can't be blank!");
        confirmErr = false;
    }
    else if (confirmval != passwordval) {
        setErrorMsg(confirm_pass, "* Password Does not matched");
        confirmErr = false;
    }
    else {
        setSuccessMsg(confirm_pass);
    }

    //validate Address
    if (addressval === "") {
        setErrorMsg(address, "*Please Enter Your Address!");
        addressErr = false;
    }
    else {
        setSuccessMsg(address);
    }

    //validate Gender
    if (genderval === "") {
        //alert("Please Select Gender");
        //This below line is use to change the innerhtml of the small tag under the radio buttons
        document.getElementById("genderErr").innerHTML = "* Please select Gender!";
        //thie following is use to set the error class of radio buttons
        var elem = document.getElementById("genderclass");
        elem.classList.add("error");
        genderErr = false;
    }
    else {
        document.getElementById("genderErr").innerHTML = "";
        var a = document.getElementById("genderclass");
        a.classList.remove("error");
        a.classList.add("success");
        genderErr = true;
    }

    //validate Course
    if (courseval === "" || courseval == 0) {
        setErrorMsg(course, "* You must have to Select one Course!");
        courseErr = false;
    }
    else {
        setSuccessMsg(course);
    }

    //successMsg(nameval);
    if ((nameErr && emailErr && phoneErr && courseErr && passwordErr && confirmErr && addressErr && genderErr) == false) {
        return false;
    } else {
        //swal("Good job!" + nameval , " All form is Correct ", "success");
        return true;
    }
};

//Name Validation for character and whitespaces
const isName = (nameval) => {
    var namepattern = /^[a-zA-Z ]{2,30}$/;
    if (!namepattern.test(nameval)) return false;
    return true;
}

//Email validate function
const isEmail = (emailval) => {
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


//validate phone number
const isPhone = (phoneval) => {
    var phonePattern = /^[0-9]{11}$/;
    var onlyNumbers = /^[0-9]+$/;
    if (!phonePattern.test(phoneval)) return false;
    else if (!onlyNumbers.test(phoneval)) return false;
    return true;
}

//set error message function 
function setErrorMsg(input, errormsgs) {
    //take the div (form-control) that show error
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    formControl.className = "form-control error ";
    small.innerHTML = errormsgs;
}

//set Success Message
function setSuccessMsg(input) {
    const formControl = input.parentElement;
    formControl.className = "form-control success";
}
