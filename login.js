
(() => {
    let username = sessionStorage.getItem('username');
    let isAdmin = sessionStorage.getItem('isAdmin');
    if(username !== null) {
        let relocation = (isAdmin === '0') ? 'main_page.php' : 'admin.php';
        window.location.replace(relocation);
    }
}) ()

$('#verify').on('click', async function(event) {
    event.preventDefault();
    let username = $('#emp_id').val();
    let password = $('#pwd').val(); 
    console.log(username, password);

    await $.post('login.php', {
        emp_id: username,
        pwd: password
    }, function(result) {
        if(!result.success) {
            $('#emp_id').val('');
            $('#pwd').val('');
            alert(result.error);
            return;
        }
        event.preventDefault();
        sessionStorage.setItem('username', username);
        sessionStorage.setItem('fname', result.fname);
        sessionStorage.setItem('isAdmin', result.isAdmin);

        let relocation = (result.isAdmin === '0') ? 'main_page.php' : 'admin.php';
        window.location.replace(relocation);
    });
});


