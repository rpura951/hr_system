//Retrieve Data from 
var RetrieveData = function() {
    $.get('test/test.php', {
        'username': sessionStorage.getItem('username')
    }, function(result) {
        console.log(result);
        if(!result.success) {
            if(result.error){
                alert(result.message);
            } else {
                alert('No Data Entry for current day');
            }
            return;
        }
        if(result.data) {
            $('#clockin').html(result.data.start);
            $('#lunchin').html(result.data.lunch_in);
            $('#lunchout').html(result.data.lunch_out);
            $('#clockout').html(result.data.end);

            let empty = '00:00:00';

            if(result.data.start === empty) {
                buttonToggle('start');
            } else if (result.data.lunch_in === empty) {
                buttonToggle('lunchin');
            } else if (result.data.lunch_out === empty) {
                buttonToggle('lunchout');
            } else if (result.data.end === empty) {
                buttonToggle('end');
            } else {
                buttonToggle('over');
            }
        } else {
            alert('fresh');
        }

        
    });
}

$(document).ready(function() {
    let fname = sessionStorage.getItem('fname');
    $('#page-header').html('Hello, ' + fname);

    RetrieveData();
});

$('.timesheet').on('click', function(event) {
    event.preventDefault();
    let option = $(this).attr('name');
    console.log(option);
    console.log(sessionStorage.getItem('username'));

    $.post('test/test.php', {
        'option': option,
        'username': sessionStorage.getItem('username')
    }, function(result) {
        console.log(result);
        if(!result.success) {   
            alert(result.error);
        } else {
            $('#'+ option).html(result.time);
            buttonToggle(option);
        }
    });
    // let date = new Date();
    // $('#'+ option).html(date);
    // buttonToggle(option);
});


var buttonToggle = function(option) {
    let options = ['#clockinButton', '#lunchinButton', '#lunchoutButton', '#clockoutButton'];
    
    // Enables all Buttons
    $('.timesheet').removeAttr('disabled');

    console.log(option);
    switch(option) {
        case 'start':
            options.splice(1, 3);
            break;
        case 'lunchin':
            options = [ options[0], options[2] ];
            break;
        case 'lunchout':
            options = [ options[2] ];
            break;
        case 'end':
            options.splice(3, 1);
            break;
        case 'over':
            break;
    }

    // Disable buttons
    for (const opt of options) {
        $(opt).attr('disabled', true);
    }
}



