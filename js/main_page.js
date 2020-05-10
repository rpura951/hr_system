(() => {
    let username = sessionStorage.getItem('username');
    if(username === null)
        window.location.replace('http://localhost/hr_system/login.html');

    let isAdmin = sessionStorage.getItem('isAdmin');
    if(isAdmin === '1')
        window.location.replace('http://localhost/hr_syste/html/admin.html');

    let fname = sessionStorage.getItem('fname');
    $('#fname').html(fname);
}) ()