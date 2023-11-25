function registerUser() {
    
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var phoneNumber = document.getElementById("phoneNumber").value;
    var gender = document.getElementById("gender").value;
    var dob = document.getElementById("dob").value;
    var address = document.getElementById("floatingTextarea2").value;
    var password = document.getElementById("password").value;

   
    var userData = {
        name: name,
        email: email,
        phoneNumber: phoneNumber,
        gender: gender,
        dob: dob,
        address: address,
        password: password
    };
  alert("Register Successfully!");
    
    $.ajax({
        type: "POST",
        url: "php/register.php",
        data: userData,
        success: function(response) {
            console.log(response);
        },
        error: function(error) {
            console.error(error);
        }
    });
}


