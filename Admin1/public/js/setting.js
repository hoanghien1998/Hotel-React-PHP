$(document).ready(function () {
    $("button[name='roomtype_update_price_all']").click(function () {
        $("#roomtype_price[disabled='']").removeAttr("disabled");
        //$("#roomtype_price").attr("enable","");
    });
});

// xử lý js roomtype_detail
$(document).ready(function () {
    $('#add_file_img').click(function () {
        $('#tamthoi').before($('<li/>', {
            id: 'filedli',
            class: 'col-md-4'
        }).fadeIn('slow').append($("<input/>", {
            name: 'roomtypedetail_img[]',
            type: 'file'
        }), $("<br/><br/>")));
    });
});

// lấy id của hình ảnh muốn xóa đưa vô value của roomtypedetail_img_Id trong #custome2
$(document).ready(function () {
    $("button[name='roomtypedetail_img_Delete']").click(function () {
        var id = $(this).attr('del-room-type-detail-img-id');
        $("input[name='roomtypedetail_img_Id']").val(id);

    });
});

// lấy count_room của select dc chọn 
$(document).ready(function () {
    $("#roomType_select").change(function () {
        var id = $("#roomType_select option:selected").attr('value');
        var count_room = $("#roomType_select option:selected").attr('count_room');
        //console.log(id);
        $("input[name='count_room']").attr('max', count_room);
    });
});


//Chọn ngày tháng năm
$('#received-date').datepicker({
    uiLibrary: 'bootstrap4',
    dateFormat: "yy-mm-dd"
});

$('#pay-date').datepicker({
    uiLibrary: 'bootstrap4',
    dateFormat: "yy-mm-dd"
});

//Chọn ngày tháng năm1
$('#received-date1').datepicker({
    uiLibrary: 'bootstrap4',
    dateFormat: "yy-mm-dd"
});

$('#pay-date1').datepicker({
    uiLibrary: 'bootstrap4',
    dateFormat: "yy-mm-dd"
});

// Lấy id của product để xóa
$(document).ready(function () {
    $("button[name='productDelete']").click(function (){
        var id = $(this).attr('del-product-id');
        //console.log(id);
        $("input[name='productId']").val(id);
    });
});

// Lấy id của bill để thêm vào phụ thu
$(document).ready(function () {
    $("button[name='surchargeAdd']").click(function (){
        var id = $(this).attr('add-surcharge_bill-id');
        //console.log(id);
        $("input[name='surcharge_Booking_code']").val(id);
    });
});

//Message-submit
$(document).ready(function(){
    $("#message-submit").animate({left: '10px'},2500);
    $("#message-submit").animate({left: '0px'});
    $("#message-submit" ).fadeOut();
});