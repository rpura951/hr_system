
$('#logout').on('click', function(event) {
    event.preventDefault();
    sessionStorage.clear();
    window.location.replace('http://localhost/hr_system/login.html');
});
