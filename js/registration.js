document.getElementById("register").onclick = function(event) {
    var submitRegister = true;

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    var reppassword = document.getElementById("reppassword");

    if(fname.value.length == 0) {
        submitRegister = false;
        fname.style.border = "2px inset red";
        document.getElementById("fnMessage").innerHTML = "First name can't be empty!";
    }
    else {
        fname.style.border = "2px inset green";
        document.getElementById("fnMessage").innerHTML = "";
    }

    if(lname.value.length == 0) {
        submitRegister = false;
        lname.style.border = "2px inset red";
        document.getElementById("lnMessage").innerHTML = "Last name can't be empty!";
    }
    else {
        lname.style.border = "2px inset green";
        document.getElementById("lnMessage").innerHTML = "";
    }

    if(username.value.length == 0) {
        submitRegister = false;
        username.style.border = "2px inset red";
        document.getElementById("usernameMessage").innerHTML = "Username can't be empty!";
    }
    else {
        username.style.border = "2px inset green";
        document.getElementById("usernameMessage").innerHTML = "";
    }

    if(password.value.length < 4) {
        submitRegister = false;
        password.style.border = "2px inset red";
        document.getElementById("pwMessage").innerHTML = "Password must be at least 4 characters long!";
    }
    else {
        password.style.border = "2px inset green";
        document.getElementById("pwMessage").innerHTML = "";
    }

    if(reppassword.value == "" || (password.value != reppassword.value)) {
        submitRegister = false;
        reppassword.style.border = "2px inset red";
        document.getElementById("rpwMessage").innerHTML = "Passwords must match!";
    }
    else {
        reppassword.style.border = "2px inset green";
        document.getElementById("rpwMessage").innerHTML = "";
    }

    if(!submitRegister) {
        event.preventDefault();
    }
}
