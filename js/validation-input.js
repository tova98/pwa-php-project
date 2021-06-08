document.getElementById("submit").onclick = function(event) {
    var submitForm = true;

    var title = document.getElementById("title");
    var about = document.getElementById("about");
    var content = document.getElementById("content");
    var picture = document.getElementById("picture");
    var category = document.getElementById("category");

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

    if(picture.value.length == 0) {
        submitForm = false;
        picture.style.border = "2px inset red";
        document.getElementById("pictureMessage").innerHTML = "Picture can't be empty!";
    }
    else {
        picture.style.border = "2px inset green";
        document.getElementById("pictureMessage").innerHTML = "";
    }
    
    if(category.selectedIndex == 0) {
        submitForm = false;
        category.style.border = "2px inset red";
        document.getElementById("categoryMessage").innerHTML = "Must choose a category!";
    }
    else {
        category.style.border = "2px inset green";
        document.getElementById("categoryMessage").innerHTML = "";
    }

    if(!submitForm) {
        event.preventDefault();
    }
};