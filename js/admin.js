(() => {
    let username = sessionStorage.getItem('username');
    if(username === null)
        window.location.replace('http://localhost/hr_system/login.html');

    let isAdmin = sessionStorage.getItem('isAdmin');
    if(isAdmin === '0')
        window.location.replace('html/main_page.html');

    let fname = sessionStorage.getItem('fname');
    $('#fname').html(fname);
}) ()