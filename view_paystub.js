
(() => {
    let fname = sessionStorage.getItem('fname');
    $('#page-header').html('Hello, ' + fname);

    await $.post('view_paystub.php', {
        username: sessionStorage.getItem('username'),
    }, function(result) {
        console.log(result); 
        if(!result.success) {
            alert(result.error);
            return;
        }

        let payStart = result.data.payPeriodStart;
        let payEnd = result.data.payPeriodEnd;
        let totalPay = result.data.pay;
        let message = "Your pay between " + payStart + " and " + payEnd + " is $" + totalPay;
        $('#total_pay').html(message);
        
    });
}) ()

