document.getElementById("update").onclick = function(event) {
    var submitForm = true;

    var title = document.getElementById("title");
    var about = document.getElementById("about");
    var content = document.getElementById("content");

    if(title.value.length < 5 || title.value.length > 150) {
        submitForm = false;
        title.style.border = "2px inset red";
        document.getElementById("titleMessage").innerHTML = "Title must be between 5 and 150 characters!";
    }
    else {
        title.style.border = "2px inset green";
        document.getElementById("titleMessage").innerHTML = "";
    }

    if(about.value.length == 0) {
        submitForm = false;
        about.style.border = "2px inset red";
        document.getElementById("aboutMessage").innerHTML = "About field can't be empty!";
    }
    else {
        about.style.border = "2px inset green";
        document.getElementById("aboutMessage").innerHTML = "";
    }

    if(content.value.length == 0) {
        submitForm = false;
        content.style.border = "2px inset red";
        document.getElementById("contentMessage").innerHTML = "Content field can't be empty!";
    }
    else {
        content.style.border = "2px inset green";
        document.getElementById("contentMessage").innerHTML = "";
    }

    if(!submitForm) {
        event.preventDefault();
    }
};