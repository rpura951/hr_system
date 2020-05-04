$(document).on('ready', function()
{
    $.get('main_page.php', {'f_name': fname, 'isAdmin': admin}, function(data)
        {
            var admin = sessionStorage.getItem('isAdmin');
            alert("I'm here at least");
            console.log(admin);

            if(!admin)
            {
                $('.adminMenu').hide();
            }
        }
    )
});