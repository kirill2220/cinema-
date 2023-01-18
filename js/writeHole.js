let expensive_seats = [];
let added_seat = [];

let occupied_seats_global = [];
let fullPrice = 0;
let countTicket = 0;

let IdSession = 0;
let IdHall =0;

function writeHole(row, count_seats, occupied_seats,minn,maxx,idsession,idhall) {

    IdSession=idsession;
    IdHall=idhall;
    occupied_seats_global = occupied_seats;
    expensive_seats.length= 0;
    /*console.log(occupied_seats)*/
    let seat = 1;
    let expensive_row_start = Math.round(row * 0.20);
    let expensive_row_end = row - expensive_row_start;
    let expensive_seats_in_row_start = Math.round(count_seats * 0.20);
    let expensive_seats_in_row_end = count_seats - expensive_seats_in_row_start;

    let occupied_seats_class = '';
    let seat_type = 'Standart';
    /*console.log(`expensive_row_start: ${expensive_row_start}`)
    console.log(`expensive_row_end: ${expensive_row_end}`)
    console.log(`expensive_seats_in_row_start: ${expensive_seats_in_row_start}`)
    console.log(`expensive_seats_in_row_end: ${expensive_seats_in_row_end}`)*/

    $('.hole-title').text('Зал');
    $('*.hole-block').html('');
    $(`.selected-seats`).html('');
    $(`.total-seats`).html('');
    fullPrice = 0;
    countTicket = 0;
    for (let i = 1; i <= row; i++) {
        $('.hole-block').append(`<div value="${row}" class="row row-of-seats row-of-seats-${i}">`);
        for (let n = 1; n <= count_seats; n++) {
            if (i > expensive_row_start && i <= expensive_row_end && n > expensive_seats_in_row_start && n <= expensive_seats_in_row_end) {
                expensive_seats.push(seat)
            }
            for (let k = 0; k < occupied_seats.length; k++) {
                let x = Number(occupied_seats[k]);
                /*console.log(`${typeof(x)} --- ${typeof(seat)}`);
                console.log(`${(x)} --- ${(seat)}`);*/
                if (seat === x) {
                    occupied_seats_class = 'occupied_seats';
                }
            }
            /*console.log(`occupied_seats_class ${seat}: ${occupied_seats_class}`);*/
            $(`.row-of-seats-${i}`).append(`<div onclick='selectSeat(${seat}, ${i}, ${minn}, ${maxx})' class="col seat ${occupied_seats_class} seat_${seat}">${seat}</div>`);
            seat++;
            occupied_seats_class = '';
        }
    }
    console.log(`expensive_seats: ${expensive_seats}`);


    /*Вывод пользователей*/


    document.getElementById('bodyusers').innerHTML = ``;
    console.log(idsession);
    $.ajax({
        url:'../Add/AddTicket.php',
        type:'POST',
        dataType:'json',
        data:{
            IdSession2: idsession,
        },
        success(data) {
            console.log(data);
            data.mas.forEach(function (mas) {

                document.getElementById('bodyusers').innerHTML +=`   <tr>
            <td>${mas.login}</td>
            <td>  ${mas.name}</td>
            <td>  ${mas.place}</td>
          <td>
                                                    <button class="  btn btn-danger text-center"><i
                                                                class="bi bi-x-square" onclick=dellorder(${mas.id},${mas.sessionid})></i>
                                                    </button>
                                                </td>
        </tr>`;


            })}
    });
}



/*Select Session*/
$(".session-data").click(function () {
    $(".session-selected").removeClass("session-selected");
    $(this).addClass("session-selected");
    $(`.selected-seats`).html('');
    added_seat.length = 0;
});

function selectSeat(seat, row, priceMin, priceMax) {
    let testSeat = false;
    let price = 0;
    for(let i = 0; i < added_seat.length;i++){
        if(added_seat[i] == seat){
            testSeat = true;
        }
    }
    /*Проверка занятых мест*/
    let occupiedSeatTrue = false;
    for (let k = 0; k < occupied_seats_global.length; k++) {
        let x = Number(occupied_seats_global[k]);
        if (seat === x) {
            occupiedSeatTrue = true;
        }
    }
    /*Проверка дешевых/дорогих мест*/
    let highCost = false;
    for (let k = 0; k < expensive_seats.length; k++) {
        let x = Number(expensive_seats[k]);
        if (seat === x) {
            highCost = true;
        }
    }
    if(highCost){
        price = priceMax;
    }else{
        price = priceMin;
    }
    console.log(`highCost ${highCost}`)


    if(occupiedSeatTrue){}
    else if(testSeat == true){
        const index = added_seat.indexOf(seat);
        if (index > -1) {
            added_seat.splice(index, 1);
            $(`.seat_${seat}`).removeClass("sel-sead-item");
            $(`.seat-${seat}`).remove();


            fullPrice-=price;
            countTicket-=1;


            $(`.total-seats`).html(`<p>Итого: ${countTicket} Билетов на сумму ${fullPrice} р.</p><button class="btn btn-primary col-sm-3" onclick="AddOrders(added_seat)">Оформить заказ</button>`);

        }
    }else{
        added_seat.push(seat);
        $(`.seat_${seat}`).addClass("sel-sead-item");
        $(`.selected-seats`).append(`
        <div class="selected-seat col-sm-2 seat-${seat}">
        <p>Ряд: ${row}, Место: ${seat}</p>
        <p>Тип места: Стандарт</p>
        <p>Стоимость: ${price} р.</p>
        </div>`);

        fullPrice+=price;
        countTicket+=1;

        $(`.total-seats`).html(`<p>Итого: ${countTicket} Билетов на сумму ${fullPrice} р.</p><button class="btn btn-primary col-sm-3" onclick="AddOrders(added_seat)">Оформить заказ</button>`);
    }
    //console.log(added_seat);
}

function favourite(val) {
    if(val){
        $('*#favouriteIcon').addClass('activeFavourite');
        $('*#favouriteIcon').removeClass('disableFavourite');
    }
    else{

    }

}
function AddOrders(mas) {
    console.log(IdSession);
    console.log(IdHall);
    console.log(mas);
    $.ajax({
        url:'../Add/AddTicket.php',
        type:'POST',
        dataType:'json',
        data:{
            IdSession: IdSession,
            IdHall:IdHall,
            mas:mas,
        },

    });
    window.location.reload();
}

function dellorder(id,sessionid){
    $.ajax({
        url:'../Add/AddTicket.php',
        type:'POST',
        dataType:'json',
        data:{
            id: id,
            sessionid:sessionid
        },
        success(data) {
            console.log(data)
            if(data.status) {
                window.location.reload();/*
                document.getElementById('data-table ').innerHTML = `
                    <thead>
                                        <tr>
                                            <th>Логин</th>
                                            <th>Имя</th>
                                            <th>Email</th>
                                            <th>Удалить</th>
                                        </tr>
                                        </thead>
                                        <tbody id="bodyusers">


                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Логин</th>
                                            <th>Имя</th>
                                            <th>Email</th>
                                            <th>Удалить</th>
                                        </tr>
                                        </tfoot>`;


                data.mas.forEach(function (mas) {

                    document.getElementById('bodyusers').innerHTML += `   <tr>
            <td>${mas.login}</td>
            <td>  ${mas.name}</td>
            <td>  ${mas.place}</td>
          <td>
                                                    <button class="  btn btn-danger text-center"><i
                                                                class="bi bi-x-square" onclick=dellorder(${mas.id},${mas.sessionid})></i>
                                                    </button>
                                                </td>
        </tr>`;
                })*/
            }
        }

    });

}

