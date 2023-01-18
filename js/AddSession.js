$('.btn-block').click(function (e) {
    e.preventDefault();
    $('.msg').text('');
    $('.msg_year').text('');
    $('.msg_time').text('');
    $('.msg_age').text('');
    $('.msg_date').text('');
    $('.msg_name').text('');
    $('*.msg-success').addClass('alert-none');
    $('*.msg').addClass('alert-none');
    $(`input`).removeClass('error');
    let date = $('input[id="date"]').val();
    let hole = document.getElementById("hole").value
    let film = document.getElementById("film").value
    let time = $('input[id="time"]').val();

console.log(time);



    $.ajax({
        url:'../Add/AddSession.php',
        type:'POST',
        dataType: 'json',

        data: {
            date: date,
            hole:hole,
            film:film,
            time:time,
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
                            $(`input[id="${field}"]`).addClass('error');
                            $(`textarea[id="${field}"]`).addClass('error');

                        })
                        $('*.msg').removeClass('alert-none');
                        $('*.msg').text(data.message);
                        break;
                    case 2:
                        $('*.msg_time').text(data.message);
                        break;
                    case 3:
                        $('*.msg_date').text(data.message);
                        break;
                    case 4:
                        $('*.msg_data_of_end').text(data.message);
                        break;
                    case 5:
                        $('*.msg_name').text(data.message);
                        break;

                }
            }
        }
    });
});

document.getElementById('date').valueAsDate = new Date();
$(function () {
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10)
        month = '0' + month.toString();
    if (day < 10)
        day = '0' + day.toString();

    var maxMonth = dtToday.getMonth() + 1;
    var maxYear = year;
    if(maxMonth == 12){
        maxMonth = 1;
        maxYear = year+1;
    }
    else {
        maxMonth = maxMonth+1;
    }
    if (maxMonth < 10)
        maxMonth = '0' + maxMonth.toString();

    var minDate = year + '-' + month + '-' + day;
    var maxDate = maxYear + '-' + maxMonth + '-' + day;
    $('#date').attr('min', minDate);
    $('#date').attr('max', maxDate);
});
