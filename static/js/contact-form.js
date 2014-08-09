var form = document.querySelector("#main-content form");

form.onsubmit = function validateForm() {
    var valid = true;

    // Obtain the data inputted by the user
    var name = form['name'].value;
    var emailAddress = form['email'].value;
    var message = form['message'].value;

    // The name must have at least 2 characters
    if (name.length < 2) {
        valid = false;
    }

    // The email must be valid
    var emailPattern = /^\w+@[\w_\-]+?(\.[a-zA-Z]{2,})+$/;
    if (!emailPattern.test(emailAddress)) {
        valid = false;
    }

    // The message must have a minimum content
    if (message.length < 5) {
        valid = false;
    }

    if (!valid) {
        alert('Please fill all fields, thank you');
    }

    return valid;
};
