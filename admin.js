$(document).on('ready', function()
{
    $.get('main_page.php', function(data)
        {
            var admin = sessionStorage.getItem('isAdmin');

            console.log(admin);

            if(!admin)
            {
                $('.adminMenu').hide();
            }
        }
    )

    
});