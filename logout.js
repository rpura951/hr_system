
$('#logout').on('click', function(event) {
    event.preventDefault();
    sessionStorage.clear();
    window.location.replace('login.html');
});
