$(document).ready(function () {
    $('#data-table').DataTable( {
        language: {
            url: 'lib/datatables/dataTables.russian.json'
        }
    } );
});



function addFavouriteFilm(id){
    let status='add';
    let myname= document.getElementById('myname').innerHTML;

    $.ajax({
        url:'../Add/Film.php',
        type:'POST',
        dataType:'json',
        data:{
            idd: id,
            status:status,
        },
        success(data) {
            if(data.status) {
                let i =0;
                document.getElementById('favoritebaton').innerHTML = '';
                console.log(data);
                data.mas.forEach(function (mas) {


                    document.getElementById('favoritebaton').innerHTML =`
                                            <button onclick="addFavouriteFilm(${id})" class="btn favouriteIcon">
                                                Добавить в любимые<i class="bi bi-heart-fill align-middle"></i></button>
                                        
`;

                    if(mas.name==myname && mas.IDFilm==id){
                        i++;

                    }

                })
                if(i==1){
                    document.getElementById('favoritebaton').innerHTML =` 
                                            <button onclick="removeFavouriteFilm(${id})" class="btn favouriteIconTrue">
                                                Удалить из любимых <i class="bi bi-heart-fill align-middle"></i></button>
                                        `;
                }else{                document.getElementById('favoritebaton').innerHTML =`
                                            <button onclick="addFavouriteFilm(${id})" class="btn favouriteIcon">
                                                Добавить в любимые<i class="bi bi-heart-fill align-middle"></i></button>
                                        
`;}
            }
        }
    });
}



function removeFavouriteFilm(id){
    let status='delete';
    let myname= document.getElementById('myname').innerHTML;

    $.ajax({
        url:'../Add/Film.php',
        type:'POST',
        dataType:'json',
        data:{
            idd: id,
            status:status,
        },
        success(data) {
            if(data.status) {
                let i =0;
                document.getElementById('favoritebaton').innerHTML = '';
                console.log(data);
                data.mas.forEach(function (mas) {


                    document.getElementById('favoritebaton').innerHTML =`
                                            <button onclick="addFavouriteFilm(${id})" class="btn favouriteIcon">
                                                Добавить в любимые<i class="bi bi-heart-fill align-middle"></i></button>
                                        
`;

                    if(mas.name==myname && mas.IDFilm==id){
                        i++;

                    }

                })
                if(i==1){
                    document.getElementById('favoritebaton').innerHTML =` 
                                            <button onclick="removeFavouriteFilm(${id})" class="btn favouriteIconTrue">
                                                Удалить из любимых <i class="bi bi-heart-fill align-middle"></i></button>
                                        `;
                }else{                document.getElementById('favoritebaton').innerHTML =`
                                            <button onclick="addFavouriteFilm(${id})" class="btn favouriteIcon">
                                                Добавить в любимые<i class="bi bi-heart-fill align-middle"></i></button>
                                        
`;}
            }
        }
    });
}
