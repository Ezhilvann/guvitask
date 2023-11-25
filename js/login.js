function submitForm() {
    var form = document.getElementById('loginForm');
    var formData = new FormData(form);

    fetch('php/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        try{
        statusVar = JSON.parse(data);
        if (statusVar.status === "Login successful!") {
            localStorage.setItem('login',statusVar.id);
            window.location.href = 'profile.html';
        } else {
           
            alert("Invalid email or password!");
        }
    }catch(e){
        alert("Invalid email or password!");
    }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
