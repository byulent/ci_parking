function new_car() {
    return '<div class="card mb-3">'+'\n'+
        '<div class="form-group card-body">'+'\n'+
        '<input type="text" class="form-control mb-3" name="new_car[label]" placeholder="Марка">' +'\n'+
        '<input type="text" class="form-control mb-3" name="new_car[model]" placeholder="Модель">' +'\n'+
        '<input type="text" class="form-control mb-3" name="new_car[reg_plate]" placeholder="Гос. номер">'+'\n'+
        '<label>Цвет</label>'+'\n'+
        '<input type="color" class="form-control" name="new_car[color]" placeholder="Цвет">'+'\n'+
        '</div>'+'\n'+
        '</div>';
}

$(document).ready(function () {
    //var cars = $('.card').length;

    $('#save-cars').click(function (e) {
        e.preventDefault();
        var data = {};
        var arr = $('#cars').serializeArray();
        for (var i in arr){
            if (arr.hasOwnProperty(i)) {
                    var name = arr[i].name;
                    if (name.search(/car\[(\d+)]\[(\w+)]/g) !== -1) {
                        var substr = name.match(/(car)\[(\d+)]\[(\w+)]/);
                        if (data[substr[1]] === undefined) data[substr[1]] = {};
                        if (data[substr[1]][substr[2]] === undefined) data[substr[1]][substr[2]] = {};
                        data[substr[1]][substr[2]][substr[3]] = arr[i].value;
                        //console.log(data[i].name);
                    }
                    if (name.search(/new_car\[(\w+)]/g) !== -1) {
                        substr = name.match(/(new_car)\[(\w+)]/);
                        if (data[substr[1]] === undefined) data[substr[1]] = {};
                        data[substr[1]][substr[2]] = arr[i].value;
                    }
            }
        }
        //console.log(data);
        //$(this).before(car(cars+1));
        $.ajax({
            type: "POST",
            url: base_url+'clients/save_cars/'+client_id,
            dataType: 'json',
            data: data,
            success: function (data) {
                if (data.hasOwnProperty('errors')){
                    $('#client-form-wrapper').prepend(data.errors);
                }
                if (data.hasOwnProperty('success')){
                    $('#client-form-wrapper').prepend(data.success);
                    $('[name *= new_car]').each(function () {
                        var name = $(this).attr('name');
                        $(this).attr('name', name.replace(/new_car\[(\w+)]/,'car['+data.car_id+'][$1]'));
                    });
                    $('form#cars .col-6').append(new_car());
                }
            },
            error: function( data, status, error ) {
                console.log(data);
                console.log(status);
                console.log(error);
            }
        });
    })
});