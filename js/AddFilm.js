
let poster =false;
$('input[name="poster"]').change(function (r) {
    poster = r.target.files[0];

});
$('.btn-block').click(function (e) {
    e.preventDefault();
    $('.msg').text('');
    $('.msg_year').text('');
    $('.msg_age').text('');
    $('.msg_data_of_end').text('');
    $('.msg_name').text('');
    $('*.alert-danger').addClass('alert-none');
    $('*.alert-success').addClass('alert-none');
    $(`input`).removeClass('error');
    $(`textarea`).removeClass('error');
    let name = $('input[id="name"]').val();
    let year = $('input[id="year"]').val();
    let duration = $('input[id="duration"]').val();
    let age = $('input[id="age"]').val();
    let date_of_start = $('input[id="date_of_start"]').val();
    let date_of_end = $('input[id="date_of_end"]').val();
    let genre =$('input[id="genre"]').val();
    let description =$('textarea[id="description"]').val();

    let formData = new FormData();
    formData.append('name', name);
    formData.append('year', year);
    formData.append('duration', duration);
    formData.append('age', age);
    formData.append('date_of_start', date_of_start);
    formData.append('date_of_end', date_of_end);
    formData.append('description', description);
    formData.append('poster', poster);
    formData.append('genre', genre);

    $.ajax({
        url:'../Add/addfilm.php',
        type:'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success(data) {
            if (data.status) {
                console.log(data);
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
                        $('*.msg_year').text(data.message);
                        break;
                    case 3:
                        $('*.msg_age').text(data.message);
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

/*Вывод в input файла*/

function getFileNameWithExt(event) {

    if (!event || !event.target || !event.target.files || event.target.files.length === 0) {
        return;
    }

    const name = event.target.files[0].name;
    const lastDot = name.lastIndexOf('.');

    const fileName = name.substring(0, lastDot);
    const ext = name.substring(lastDot + 1);

    $('*#fileNameExt').text(`${fileName}.${ext}`);
}