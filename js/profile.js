function editProfile() {
    
    $('#name').prop('disabled', false);
    $('#phoneNumber').prop('disabled', false);
    $('#gender').prop('disabled', false);
    $('#dob').prop('disabled', false);
    $('#address').prop('disabled', false);

    
    $('.btn-primary').hide();
    $('.btn-success').show();
}

function saveProfile() {
    
    $('#email').prop('disabled', true);

    
    var formData = $('#profileForm').serialize();

    $.ajax({
        type: 'POST',
        url: 'php/edit_profile.php', 
        data: formData,
        success: function(response) {
            
            alert('Profile saved successfully!');
            
           
            $('#name').prop('disabled', true);
            $('#phoneNumber').prop('disabled', true);
            $('#gender').prop('disabled', true);
            $('#dob').prop('disabled', true);
            $('#address').prop('disabled', true);

            $('.btn-primary').show();
            $('.btn-success').hide();
        },
        error: function(error) {
            
            alert('Error saving profile: ' + error.responseText);
        }
    });
}

function load() {
    $.ajax({
        type: "GET",
        data:{user:localStorage.getItem('login')},
        url: "php/profile.php",
        success: function (response) {
            displayProfile(JSON.parse(response));
        },
        error: function (error) {
            console.error(error);
        }
    });

   
    function displayProfile(profileData) {
        document.getElementById("name").value = profileData.name;
        document.getElementById("email").value = profileData.email;
        document.getElementById("phoneNumber").value = profileData.phoneNumber;
        document.getElementById("gender").value = profileData.gender;
        document.getElementById("dob").value = profileData.dob;
        document.getElementById("address").value = profileData.address;
        document.getElementById('id').value = localStorage.getItem('login');
    }
};

