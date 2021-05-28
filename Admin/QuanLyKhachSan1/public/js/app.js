// Phòng
//ajax update room
$(document).ready(function () {
    $("button[name='roomUpdate']").click(function () {
        var id = $(this).attr('room-id');
        var data = {id: id};
        var roomType;
        var roomState;
        //console.log(id);
        $.ajax({
            url: '?mod=room&controller=room&action=update_room', //Trang xử lý, mặc định trang hiện tại xử lý ngầm lên server
            method: 'POST', //POST OR GET, mặc định GET
            data: data, //Dữ liệu truyền lên server, biến được khai báo bên trên
//            dataType: 'text', //html,text, script
            dataType: 'json', //dataType kiểu json
            success: function (data) {
                //Xử lý dữ liệu trả về
                $("input[name='roomId']").val(data.id);
                $("input[name='roomNumber']").val(data.roomNuber);
//                CKEDITOR.instances['roomDescription'].setData(data.description);
                roomType = data.typeCode;
                $("#roomType>option[value='" + roomType + "']").attr('selected', 'selected');
                $("#roomType>option[value!='" + roomType + "']").removeAttr('selected');
                roomState = data.state;
                $("#roomState>option[value='" + roomState + "']").attr('selected', 'selected');
                $("#roomState>option[value!='" + roomState + "']").removeAttr('selected');
                console.log(roomState);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });


});
//===============================================================================
//ajax delete room
$(document).ready(function () {

    $("button[name='roomDelete']").click(function () {
        var id = $(this).attr('del-room-id');
        var data = {id: id};
        console.log(id);
        $.ajax({
            url: '?mod=room&controller=room&action=update_room', //Trang xử lý, mặc định trang hiện tại xử lý ngầm lên server
            method: 'POST', //POST OR GET, mặc định GET
            data: data, //Dữ liệu truyền lên server, biến được khai báo bên trên
//            dataType: 'text', //html,text, script
            dataType: 'json', //dataType kiểu json
            success: function (data) {
                //Xử lý dữ liệu trả về
                $("input[name='roomId']").val(data.id);
                $("#roomNumber_del").html("<strong>" + data.roomNuber + "</strong>");
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

});
//===============================================================================

//Loại Phòng
//ajax update_loạiphong
$(document).ready(function () {
    $("button[name='roomtypeUpdate']").click(function () {
        var id = $(this).attr('update-room-type-id');
        var data = {id: id};
        console.log(id);
        $.ajax({
            url: '?mod=room&controller=roomtype&action=update_room_type', //Trang xử lý, mặc định trang hiện tại xử lý ngầm lên server
            method: 'POST', //POST OR GET, mặc định GET
            data: data, //Dữ liệu truyền lên server, biến được khai báo bên trên
//            dataType: 'text', //html,text, script
            dataType: 'json', //dataType kiểu json
            success: function (data) {
                //Xử lý dữ liệu trả về
                $("input[name='roomtypeId']").val(data.id);
                $("input[name='roomtypeName']").val(data.name);
                $("input[name='roomtypePrice']").val(data.price);
//                //CKEDITOR.instances['room_type_Description'].setData(data.description);
                console.log(data.price);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
});
//===============================================================================

//ajax delete_Loại Phòng
$(document).ready(function () {

    $("button[name='roomtypeDelete']").click(function () {
        var id = $(this).attr('del-room-type-id');
        var data = {id: id};
        console.log(id);
        $.ajax({
            url: '?mod=room&controller=roomtype&action=update_room_type', //Trang xử lý, mặc định trang hiện tại xử lý ngầm lên server
            method: 'POST', //POST OR GET, mặc định GET
            data: data, //Dữ liệu truyền lên server, biến được khai báo bên trên
//            dataType: 'text', //html,text, script
            dataType: 'json', //dataType kiểu json
            success: function (data) {
                //Xử lý dữ liệu trả về
                $("input[name='roomtypeId']").val(data.id);
                $("#roomtypeName_del").html("<strong>" + data.name + "</strong>");
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

});
//===============================================================================

//Customer
//ajax update_customer
$(document).ready(function () {
    $("button[name='customerUpdate']").click(function () {
        var id = $(this).attr('update-customer-id');
        var data = {id: id};
        var customerState;
        console.log(id);
        $.ajax({
            url: '?mod=customer&controller=customer&action=update_customer', //Trang xử lý, mặc định trang hiện tại xử lý ngầm lên server
            method: 'POST', //POST OR GET, mặc định GET
            data: data, //Dữ liệu truyền lên server, biến được khai báo bên trên
            //dataType: 'text', //html,text, script
            dataType: 'json', //dataType kiểu json
            success: function (data) {
                //Xử lý dữ liệu trả về
                $("input[name='customerId']").val(data.cus_code);
                $("input[name='customerName']").val(data.name);
                $("input[name='customerCMND']").val(data.cmnd);
                $("input[name='customerPhone']").val(data.phone);
                $("input[name='customerAddress']").val(data.address);
                $("input[name='customerEmail']").val(data.email);
                customerState = data.state;
                $("#customerState>option[value='" + customerState + "']").attr('selected', 'selected');
                $("#customerState>option[value!='" + customerState + "']").removeAttr('selected');
//                //CKEDITOR.instances['room_type_Description'].setData(data.description);
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
});
//===============================================================================

//ajax delete_Loại Phòng_Cart
$(document).ready(function () {

    $("button[name='cart_roomtypeDelete']").click(function () {
        var id = $(this).attr('del-cart-room-type-id');
        var data = {id: id};
        console.log(id);
        $.ajax({
            url: '?mod=book_room&action=cart', //Trang xử lý, mặc định trang hiện tại xử lý ngầm lên server
            method: 'POST', //POST OR GET, mặc định GET
            data: data, //Dữ liệu truyền lên server, biến được khai báo bên trên
            dataType: 'text', //html,text, script
            //dataType: 'json', //dataType kiểu json
            success: function (data) {
                //Xử lý dữ liệu trả về

                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

});
//===============================================================================
//ajax Cart
$(document).ready(function () {
    $("button[name='cartUpdate']").click(function () {
        var id = $(this).attr('update-cart-id');
        var data = {id: id};
        console.log(id);
        $.ajax({
            url: '?mod=book_room&action=update_cart', //Trang xử lý, mặc định trang hiện tại xử lý ngầm lên server
            method: 'POST', //POST OR GET, mặc định GET
            data: data, //Dữ liệu truyền lên server, biến được khai báo bên trên
            //dataType: 'text', //html,text, script
            dataType: 'json', //dataType kiểu json
            success: function (data) {
                //Xử lý dữ liệu trả về
                $("input[name='cartId']").val(data.id_roomtype);
                $("input[name='cartNumber']").val(data.number_room);
                $("input[name='receiveddate_BookRoom']").val(data.check_in);
                $("input[name='paydate_BookRoom']").val(data.check_out);
                $("input[name='adults_BookRoom']").val(data.number_adults);
                $("input[name='childrens_BookRoom']").val(data.number_childrens);
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
});

//================================================================================
//ajax Bill
$(document).ready(function () {
    $("button[name='billUpdate']").click(function () {
        var id = $(this).attr('update-bill-id');
        var data = {id: id};
        var billState;
        console.log(id);
        $.ajax({
            url: '?mod=bill&action=update', //Trang xử lý, mặc định trang hiện tại xử lý ngầm lên server
            method: 'POST', //POST OR GET, mặc định GET
            data: data, //Dữ liệu truyền lên server, biến được khai báo bên trên
            //dataType: 'text', //html,text, script
            dataType: 'json', //dataType kiểu json
            success: function (data) {
                //Xử lý dữ liệu trả về
                $("input[name='billId']").val(data.id);
                $("p[name='billName']").text(data.name);
                $("p[name='billTotal']").text(data.total);
                billState = data.state;
                $("#billState>option[value='" + billState + "']").attr('selected', 'selected');
                $("#billState>option[value!='" + billState + "']").removeAttr('selected');
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
//            error: function (data) {
//                console.log("AJAX ERROR:", data);
//            }
        });
    });
});
//==============================================================================
//ajax Detail_Bill
$(document).ready(function () {
    $("button[name='detailbillUpdate']").click(function () {
        var id = $(this).attr('update-detailbill-id');
        var data = {id: id};
        console.log(id);
        $.ajax({
            url: '?mod=bill&controller=detail_bookroom&action=update_detailbill', //Trang xử lý, mặc định trang hiện tại xử lý ngầm lên server
            method: 'POST', //POST OR GET, mặc định GET
            data: data, //Dữ liệu truyền lên server, biến được khai báo bên trên
            //dataType: 'text', //html,text, script
            dataType: 'json', //dataType kiểu json
            success: function (data) {
                //Xử lý dữ liệu trả về
                $("input[name='detailbillId']").val(data.id);
                $("input[name='detailbillNumberRoom']").val(data.number_room);
                $("input[name='detailbillCheckIn']").val(data.check_in);
                $("input[name='detailbillCheckOut']").val(data.check_out);
                $("input[name='detailbill_Adults']").val(data.number_adults);
                $("input[name='detailbill_Childrens']").val(data.number_childrens);
                $("input[name='detailbillNumberRoom']").attr('max', data.number_room_empty);
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
//            error: function (data) {
//                console.log("AJAX ERROR:", data);
//            }
        });
    });
});
//======================================================================================
// Sản phẩm
//ajax update room
$(document).ready(function () {
    $("button[name='productUpdate']").click(function () {
        var id = $(this).attr('product-id');
        var data = {id: id};
        //console.log(id);
        $.ajax({
            url: '?mod=product&action=update_product', //Trang xử lý, mặc định trang hiện tại xử lý ngầm lên server
            method: 'POST', //POST OR GET, mặc định GET
            data: data, //Dữ liệu truyền lên server, biến được khai báo bên trên
//            dataType: 'text', //html,text, script
            dataType: 'json', //dataType kiểu json
            success: function (data) {
                //Xử lý dữ liệu trả về
                $("input[name='productId']").val(data.id);
                $("input[name='productName']").val(data.name_product);
                $("input[name='productPrice']").val(data.price);
                $("input[name='productNumber']").val(data.number);
//                console.log(roomState);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });


});
//===============================================================================
// Số phòng trống theo ngày tìm kiếm trong đặt phòng
//ajax tìm kiếm phòng trống
//$(document).ready(function () {
//    $("input[name='checkout_BookRoom']").change(function () {
//        var check_in = $('#received-date').val();
//        var check_out = $('#pay-date').val();
//        console.log(check_in, '=======', check_out);
//        var data = {check_in: check_in, check_out:check_out};
////        console.log(data);
//        $.ajax({
//            url: '?mod=book_room&action=check_date', //Trang xử lý, mặc định trang hiện tại xử lý ngầm lên server
//            method: 'POST', //POST OR GET, mặc định GET
//            data: data, //Dữ liệu truyền lên server, biến được khai báo bên trên
////            dataType: 'text', //html,text, script
//            dataType: 'json', //dataType kiểu json
//            success: function (data) {
//                //Xử lý dữ liệu trả về
////                $("input[name='productId']").val(data.id);
////                $("input[name='productName']").val(data.name_product);
////                $("input[name='productPrice']").val(data.price);
////                $("input[name='productNumber']").val(data.number);
////                console.log(roomState);
//                  console.log(data);
//            },
////            error: function (xhr, ajaxOptions, thrownError) {
////                alert(xhr.status);
////                alert(thrownError);
////            }
//            error: function (data) {
//                console.log("AJAX ERROR:", data);
//            }
//        });
//    });
//
//
//});