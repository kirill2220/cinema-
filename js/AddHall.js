
$('.btn-block').click(function (e) {
    e.preventDefault();
    $('.msg').text('');
    $('.msg_seats').text('');
    $('.msg_coastnorm').text('');
    $('.msg_coastvip').text('');
    $('.msg_name').text('');
    $('*.msg-success').addClass('alert-none');
    $('*.msg').addClass('alert-none');
    let coastvip = $('input[id="coastvip"]').val();
    let coastnorm = $('input[id="coastnorm"]').val();
    let seats = $('input[id="seats"]').val();
    let rows = $('input[id="rows"]').val();
    let name = $('input[id="name"]').val();


    $.ajax({
        url:'../Add/AddHall.php',
        type:'POST',
        dataType: 'json',

        data:{
            coastvip: coastvip,
            coastnorm: coastnorm,
            seats: seats,
            rows: rows,
            name: name,
        },
        success(data) {
            if (data.status) {
                //document.location.href = 'Register.php';
                $('*.msg-success').removeClass('alert-none');
                $('*.msg-success').text(data.message);
            } else {
                console.log(data);
                switch (data.type){
                    case 1:
                        data.fields.forEach(function (field){
                            $(`input[id*="${field}"]`).addClass('error');
                            $(`textarea[id*="${field}"]`).addClass('error');

                        })
                        $('*.msg').removeClass('alert-none');
                        $('*.msg').text(data.message);
                        break;
                    case 2:
                        $('*.msg_seats').text(data.message);
                        break;
                    case 3:
                        $('*.msg_coastnorm').text(data.message);
                        break;
                    case 4:
                        $('*.msg_coastvip').text(data.message);
                        break;
                    case 5:
                        $('*.msg_name').text(data.message);
                        break;
                    case 6:
                        $('*.msg_row').text(data.message);
                        break;

                }
            }
        }
    });
});
function Bak(){
    $.ajax({
        url:'../Add/AddHall.php',
        type:'POST',
        dataType:'json',
        data:{
            flag: 1,
        },
        success(data) {
            console.log(data);
            $('*.msg-successs').removeClass('alert-none');
            $('*.msg-successs').text(data.message);
        }

    });

}

function ImportXML(){
    $.ajax({
        url:'../Add/AddHall.php',
        type:'POST',
        dataType:'json',
        data:{
            flag1: 1,
        },
        success(data) {
            console.log(data);
            $('*.msg-successs').removeClass('alert-none');
            $('*.msg-successs').text(data.message);
        }

    });

}

function ExportXML(){
    $.ajax({
        url:'../Add/AddHall.php',
        type:'POST',
        dataType:'json',
        data:{
            flag2: 1,
        },
        success(data) {
            console.log(data);
            $('*.msg-successs').removeClass('alert-none');
            $('*.msg-successs').text(data.message);
        }

    });

}