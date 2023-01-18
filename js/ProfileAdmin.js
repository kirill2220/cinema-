

$('.changpassword').click(function (e) {
    e.preventDefault();
    $('*.msg').text('');
    $('.msg_password').text('');
    $('.msg_newpassword').text('');
    $('.msg_renewpassword').text('');
    $('*.msg-success').addClass('alert-none');
    $('*.msg-success').text('');
    $('*.msg').addClass('alert-none');
    $(`input`).removeClass('error-field');
    let newpassword = $('input[id="newpassword"]').val();
    let renewpassword = $('input[id="renewpassword"]').val();
    let password = $('input[id="password"]').val();
console.log(newpassword);

    $.ajax({
        url:'../Add/ProfileAdminPassword.php',
        type:'POST',
        dataType:'json',
        data:{
            renewpassword:renewpassword,
            password:password,
            newpassword:newpassword,

        },
        success(data) {
            console.log(data);
            if (data.status) {
                //document.location.href = 'Reg.php';
                $('*.msg-success').removeClass('alert-none');
                $('*.msg-success').text(data.message);

            } else {
                switch (data.type){
                    case 1:
                        data.fields.forEach(function (field){
                            $(`input[id*="${field}"]`).addClass('error-field');
                        })
                        $('*.msg').removeClass('alert-none');
                        $('*.msg').text(data.message);
                        break;
                    case 2:
                        $('*.msg_password').text(data.message);
                        break;
                    case 3:
                        $('*.msg_newpassword').text(data.message);
                        break;
                    case 4:
                        $('*.msg_renewpassword').text(data.message);
                        break;

                }

            }
        }
    });
});


$('.changdata').click(function (e) {
    e.preventDefault();
    $('*.msg').text('');
    $('.msg_login').text('');
    $('.msg_email').text('');
    $('.msg_name').text('');
    $('*.msg-success').addClass('alert-none');
    $('*.msg-success').text('');
    $('*.msg').addClass('alert-none');

    $(`input`).removeClass('error-field');
    let email = $('input[id="email"]').val();
    let name = $('input[id="name"]').val();
    let login = $('input[id="login"]').val();


    $.ajax({
        url:'../Add/ProfileAdmin.php',
        type:'POST',
        dataType:'json',
        data:{
            email:email,
            name:name,
            login:login,

        },
        success(data) {
            console.log(data);
            if (data.status) {

                //document.location.href = 'Reg.php';
                $('*.msg-success').removeClass('alert-none');
                $('*.msg-success').text(data.message);
                console.log(data.message);


            } else {
                switch (data.type){
                    case 1:
                        data.fields.forEach(function (field){
                            $(`input[name*="${field}"]`).addClass('error-field');
                        })
                        $('*.msg').removeClass('alert-none');
                        $('*.msg').text(data.message);
                        break;
                    case 2:
                        $('*.msg_login').text(data.message);
                        break;
                    case 3:
                        $('*.msg_email').text(data.message);
                        break;
                    case 4:
                        $('*.msg_name').text(data.message);
                        break;

                }

            }
        }
    });
});

function dellorder(id){
    $.ajax({
        url:'../Add/ProfileAdmin.php',
        type:'POST',
        dataType:'json',
        data:{
            id: id,
        },
        success(data) {
            console.log(data)
            if(data.status) {
                document.getElementById('tableorder').innerHTML = `     <thead>
                                        <tr>
                                            <td>Название</td>
                                            <td>Дата</td>
                                            <td>Время</td>
                                            <td>Зал</td>
                                            <td>Номер места</td>
                                            <td>Удалить</td>
                                        </tr>
                                        </thead>
                                        <tbody id="orderbody">
         </tbody>`;


                data.mas.forEach(function (mas) {
                    let id = mas.id;

                    let date = new Date(mas.dateSession.date);
                    let time = new Date(mas.timeSession.date);
                    let da=date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();
                    let ti=time.getHours()+':'+time.getMinutes();

                    document.getElementById('orderbody').innerHTML += ` <tr>
                                            <td>${mas.name}</td>
                                            <td>${da}</td>
                                            <td>${ti}</td>
                                            <td>${mas.hallname}</td>
                                            <td>${mas.place}</td>
                                            <td>
                                                <button class="  btn btn-danger text-center"><i
                                                            class="bi bi-x-square" onclick="dellorder(${id})"></i>
                                                </button>
                                            </td>
                                        </tr>`;

                })
            }
        }

    });

}
