$(document).ready(function () {
    $('#data-table').DataTable( {
        language: {
            url: '../lib/datatables/dataTables.russian.json'
        }
    } );
});
function showMessage() {

        $('#data-table').DataTable( {
            language: {
                url: '../lib/datatables/dataTables.russian.json'
            }
        } );
}
function DelUSer(id){
    $.ajax({
        url:'../Add/AllUser.php',
        type:'POST',
        dataType:'json',
        data:{
            id: id,
        },
        success(data) {
            if(data.status) {
                document.getElementById('midf').innerHTML = ' <div class="mb-0">\n' +

                    '                                                <table id="data-table" class="table table-striped" style="width:100%">\n' +
                    '                                                    <thead>\n' +
                    '                                                    <tr>\n' +
                    '                                                        <th>Логин</th>\n' +
                    '                                                        <th>Имя</th>\n' +
                    '                                                        <th>Email</th>\n' +
                    '                                                        <th>Удалить</th>\n' +
                    '                                                    </tr>\n' +
                    '                                                    </thead>\n' +
                    '                                                    <tbody id="bodyuser">';


                data.info.forEach(function (info) {
                    let id = info.id;
                  


                    document.getElementById('bodyuser').innerHTML += ` <tr>
                                                        <td>${info.login}</td>
                                                        <td>${info.name}</td>
                                                        <td>${info.email}</td>
                                                        <td>
                                                            <button class="btn btn-outline-primary" onclick=DelUSer(${id})>Удалить</button>
                                                        </td>
                                                    </tr>`;

                })
            }
        }

    });
    document.getElementById('midf').innerHTML += `         </tbody>
        <tfoot>
        <tr>
        <th>Логин</th>
    <th>Имя</th>
    <th>Email</th>
    <th>Удалить</th>
</tr>
</tfoot>
</table>

    <!-- AllUsers DataTable end -->
</div>`;
    showMessage()
}