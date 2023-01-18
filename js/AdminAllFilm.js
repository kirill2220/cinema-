$(document).ready(function () {
    $('#data-table').DataTable( {
        language: {
            url: '../lib/datatables/dataTables.russian.json'
        }
    } );
});

function DelFilm(id){
    $.ajax({
        url:'../Add/AdminAllFilm.php',
        type:'POST',
        dataType:'json',
        data:{
            id: id,
        },
        success(data) {
            if(data.status) {
                document.getElementById('midf').innerHTML = `    <table id="data-table" class="table table-striped" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Название</th>
                                                        <th>год</th>
                                                        <th>Удалить</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="bodyFilm">
        </tbody>
                                                    <tfoot>
                                                    <tr>
                                                     <th>Название</th>
                                                        <th>год</th>
                                                        <th>Удалить</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>

                                                <!-- AllUsers DataTable end -->
                                            </div>`;


                data.info.forEach(function (info) {
                    let id = info.id;



                    document.getElementById('bodyFilm').innerHTML += ` <tr>
                                                        <td>${info.name}</td>
                                                        <td>${info.year}</td>
                                                        <td>
                                                            <button class="btn btn-outline-primary" onclick=DelFilm(${id})>Удалить</button>
                                                        </td>
                                                    </tr>`;

                })
            }
        }

    });

}