import React, { useEffect, useState } from "react";
import { Col, Row, Container, Button } from "react-bootstrap";
import Axios from 'axios';
import NumberFormat from "react-number-format";
function Detail_Book(props) {
    // Define state in function
    const [IDRoom, setIDRoom] = useState("");
    const [DateNhan, setDateNhan] = useState(null);
    const [DateTra, setDateTra] = useState(null);
    const [price, setPrice] = useState("");
    const [NameRoomType, setNameRoomType] = useState("");
    const [RoomNumber, setRoomNumber] = useState(1);
    const [AdultNumber, setAdultNumber] = useState(1);
    const [ChildNumber, setChildNumber] = useState(0);
    const [Total, setTotal] = useState(0);

    const { rooms, token } = props;
    console.log("rooms", rooms);

    // Tính số ngày thông qua ngày nhận và ngày trả phòng
    const handleTinhNgay = (datenhan, datetra) => {
        const d1 = new Date(datenhan).getTime();
        const d2 = new Date(datetra).getTime();
        var daysTill30June2035 = Math.floor((d2 - d1) / (1000 * 60 * 60 * 24));
        // console.log("daysTill30June2035", daysTill30June2035 + 1);
        return daysTill30June2035 + 1;
    };

    // Fomat ngày hiển thị lên trong xác nhận đơn đặt phòng
    const handleShowDate = (item) => {
        const data = item.split('-');
        return `${data[2]}-${data[1]}-${data[0]}`
    }

    // Sau khi hoàn tất đặt hàng
    const Hoantatdatphong = (tb) => {
        // alert(tb);
        localStorage.removeItem("room");
        window.location.reload();
    }

    // Hủy đơn hàng
    const handleClear = () => {
        localStorage.removeItem("room");
        window.location.reload();
    }
    // Xử lý gửi cái giỏ xuống backend
    const handleSendCart = () => {
        var frm = new FormData();
        frm.append("rooms", JSON.stringify(rooms));
        frm.append("token", token);
        var url = "/hotel/backend/Room/DatPhong.php";
        Axios.post(url, frm).then(res => {
            // console.log(res);
            Hoantatdatphong(res.data)
        }).catch(err => alert(err));
    }

    return (
        <div>
            <Container style={{ height: "auto", minHeight: "350px" }}>
                <Row>
                    <Col md={12}>
                        <div
                            style={{
                                textAlign: "center",
                                fontSize: "14pt",
                                fontFamily: "Poppins",
                                marginTop: "20px",
                            }}
                        ></div>
                        <table
                            border="1px soild #bd9d1b"
                            style={{ margin: "20px auto" }}
                            width="100%"
                        >
                            <thead>
                                <tr style={{ textAlign: "center", fontSize: "16pt" }}>
                                    <th style={{width:"150px"}}>Loại phòng</th>
                                    <th>Hình ảnh</th>
                                    {/* <th>Ngày nhận</th>
                                    <th>Ngày Trả</th> */}
                                    <th style={{width:"230px"}}>Thời gian</th>
                                    <th>Số người</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                {rooms &&
                                    rooms.map((item, index) => (
                                        <tr key={index} style={{ textAlign: "center" }}>
                                            <td style={{ fontSize: "13pt" }}>{item.nametype}</td>
                                            <td><img src={"images/" + item.image} height="150px" width="150px" alt="" /></td>
                                            {/* <td style={{ fontSize: "16pt" }}>
                                                {handleShowDate(item.datenhan)}
                                            </td>
                                            <td style={{ fontSize: "16pt" }}>
                                                {handleShowDate(item.datetra)}
                                            </td> */}
                                            <td style={{ fontSize: "13pt"}}>
                                                <label>Ngày nhận: </label> {handleShowDate(item.datenhan)}<br></br>
                                                <label>Ngày trả: </label> {handleShowDate(item.datetra)} 
                                            </td>
                                            <td style={{ fontSize: "13pt" }}>
                                                <label>Số người lớn:</label> {item.songuoilon}<br></br>
                                                <label>Số trẻ em:</label> {item.sotre}
                                            </td>
                                            <td>
                                                {/* handleMinustQtyRoom */}
                                                <button
                                                    onClick={() => props.handleMinustQtyRoom(item)}
                                                    style={{ marginRight: "10px" }}
                                                >
                                                    <i className="fas fa-minus"></i>
                                                </button>
                                                {item.slphong}
                                                <button
                                                    onClick={() => props.handlePlustQtyRoom(item)}
                                                    style={{ marginLeft: "10px" }}
                                                >
                                                    <i className="fas fa-plus"></i>
                                                </button>
                                            </td>
                                            {/* <td>{handleTinhNgay(item.datenhan, item.datetra)}</td> */}
                                            <td>
                                                <NumberFormat value={item.item_price} displayType={'text'} thousandSeparator={true} />

                                            </td>
                                            <td>
                                                <NumberFormat value={handleTinhNgay(item.datenhan, item.datetra) *
                                                    parseInt(item.item_price, 10) *
                                                    item.slphong} displayType={'text'} thousandSeparator={true} />

                                            </td>
                                            {/* handleDeleteRoom */}

                                            <td>
                                                <button
                                                    onClick={() => props.handleDeleteRoom(item.choseID)}
                                                >
                                                    X
                        </button>
                                            </td>
                                        </tr>
                                    ))}
                            </tbody>
                        </table>
                    </Col>
                </Row>
                <Row>
                    <Col md={2}>
                        <h4>Tổng: </h4>
                    </Col>
                    <Col md={10} >
                        <h4>
                            <NumberFormat value={rooms &&
                                rooms.reduce(
                                    (a, c) =>
                                        a +
                                        handleTinhNgay(c.datenhan, c.datetra) *
                                        c.slphong *
                                        c.item_price,
                                    0
                                )} displayType={'text'} thousandSeparator={true} /> VND
                        </h4>
                    </Col>
                </Row>
                <Row>
                    <Col>
                        {rooms.length !== 0 ?
                            <Col>
                                <Button
                                    variant="primary"
                                    style={{ marginLeft: "300px", marginTop: "50px" }}
                                    onClick={() => handleSendCart()}
                                >
                                    Xác nhận đơn đặt phòng
                                </Button>
                                <Button
                                    variant="primary"
                                    style={{ marginLeft: "300px", marginTop: "50px" }}
                                    onClick={() => handleClear()}
                                >
                                    Hủy đơn
                                </Button>
                            </Col>

                            : null}

                    </Col>
                </Row>
            </Container>
        </div>
    );
}

export default Detail_Book;
