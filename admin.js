(() => {
    let username = sessionStorage.getItem('username');
    if(username === null)
        window.location.replace('login.html');

    let isAdmin = sessionStorage.getItem('isAdmin');
    if(isAdmin === '0')
        window.location.replace('main_page.php');

    let fname = sessionStorage.getItem('fname');
    $('#fname').html(fname);
}) ()