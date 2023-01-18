//Авторизация
$('.login-but').click(function (e) {
e.preventDefault();
    $('*.msg').text('');
    $(`input`).removeClass('error');
    $('*.alert-danger').addClass('alert-none');
let login = $('input[name="login"]').val();
let password = $('input[name="password"]').val();
$.ajax({
    url:'../RegAuth/auth.php',
    type:'POST',
    dataType:'json',
    data:{
        login:login,
        password:password
    },
success(data) {

    if (data.status) {
        if(data.path=='User'){
            document.location.href = '../UserHome.php';

        }else{
            document.location.href = '../AdminHome.php';
        }

    } else {

        switch (data.type) {
            case 1:
                console.log(data.message);
                $('*.msg').text(data.message);
                $('*.alert-danger').removeClass('alert-none');
                break;
            case 2:
                    data.fields.forEach(function (field) {
                        $(`input[name*="${field}"]`).addClass('error');
                        $('*.alert-danger').removeClass('alert-none');
                    })
                    $('*.msg').text(data.message);


        }
        }

}
});
});
//Регистрация
$('.register-but').click(function (e) {
    e.preventDefault();
    $('*.msg').text('');
    $('.msg_login').text('');
    $('.msg_name').text('');
    $('.msg_email').text('');
    $('.msg_data_of_end').text('');
    $('.msg_confirm').text('');
    $('*.msg_password').text('');
    $('*.alert-danger').addClass('alert-none');
    $('*.alert-success').addClass('alert-none');
    $(`input`).removeClass('error');
    let login = $('input[name="login"]').val();
    let password = $('input[name="password"]').val();
    let Confirm_password = $('input[name="Confirm_password"]').val();
    let name = $('input[name="name"]').val();
    let email = $('input[name="email"]').val();
    $.ajax({
        url:'../RegAuth/function.php',
        type:'POST',
        dataType:'json',
        data:{
            login:login,
            password:password,
            Confirm_password:Confirm_password,
            email:email,
            name:name
        },
        success(data) {
            console.log(data);
            if (data.status) {
                //document.location.href = 'Register.php';
                $('.msg-success').text(data.message);
                $('*.alert-success').removeClass('alert-none');
            } else {
                switch (data.type){
                    case 1:
                        data.fields.forEach(function (field){
                            $(`input[name="${field}"]`).addClass('error');
                        })
                        $('.msg').text(data.message);
                        $('*.alert-danger').removeClass('alert-none');
                        break;
                    case 2:
                        $('*.msg_login').text(data.message);
                        break;
                    case 3:
                        $('*.msg_email').text(data.message);
                    break;
                    case 4:
                        $('*.msg_password').text(data.message);
                        break;
                    case 5:
                        $('*.msg_confirm').text(data.message);
                        break;
                    case 6:
                        $('*.msg_name').text(data.message);
                        break;
                }
            }
        }
    });
});