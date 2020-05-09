$(document).ready(function() {
    let username = sessionStorage.getItem('username');
    if(username === null)
        window.location.replace('login.html');

    let isAdmin = sessionStorage.getItem('isAdmin');
    if(isAdmin === '1')
        window.location.replace('admin.php');

    let fname = sessionStorage.getItem('fname');
    $('#fname').html(fname);
});