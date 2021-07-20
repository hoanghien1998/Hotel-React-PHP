import React, { useEffect, useState } from "react";
import { Col, Row, Container, Button } from "react-bootstrap";
import Axios from 'axios';
import NumberFormat from "react-number-format";
function Detail_Book(props) {
    const { rooms, token } = props;
    console.log("rooms", rooms);
    const [total, setTotal] = useState(0);

    // Tính số ngày thông qua ngày nhận và ngày trả phòng
    const handleTinhNgay = (datenhan, datetra) => {
        const d1 = new Date(datenhan).getTime();
        const d2 = new Date(datetra).getTime();
        var daysTill30June2035 = Math.floor((d2 - d1) / (1000 * 60 * 60 * 24));
        // console.log("daysTill30June2035", daysTill30June2035 + 1);
        return daysTill30June2035 + 1;
    };

    // Tính số ngày được giảm thông qua ngày bắt đầu giảm giá và ngày kết thúc
    const handleTinhNgayGiamGia = (datenhan, datetra, dateStart, dateEnd) => {
        const ngayNhan = datenhan.split('-');
        const ngayTra = datetra.split('-');
        const ngayBT = dateStart.split('-');
        const ngayKT = dateEnd.split('-');
        // TH 1: Ngay nhan va ngay tra nam trong khoang uu dai
        var daysTill30June2035 = 0;
        if ((parseInt(ngayNhan[0], 10) === parseInt(ngayBT[0], 10)) 
              && ((parseInt(ngayNhan[1], 10) === parseInt(ngayBT[1], 10))) 
              && ((parseInt(ngayNhan[2], 10) >= parseInt(ngayBT[2], 10)))
              && (parseInt(ngayKT[0], 10) === parseInt(ngayTra[0], 10)) 
              && (parseInt(ngayKT[1], 10) === parseInt(ngayTra[1],10)) 
              && (parseInt(ngayKT[2],10) >= parseInt(ngayTra[2],10))) {
          const d1 = new Date(datenhan).getTime();
          const d2 = new Date(datetra).getTime();
          daysTill30June2035 = Math.floor((d2 - d1) / (1000 * 60 * 60 * 24));
          console.log("daysTill30June2035", daysTill30June2035);
        }
        // TH2: ngày đặt < ngày bắt đầu ưu đãi && ngày trả > ngày bắt đầu ưu đãi và ngày trả < ngày kết ưu đãi
        else if ((parseInt(ngayNhan[0], 10) === parseInt(ngayBT[0], 10))
                  && (parseInt(ngayNhan[1], 10) === parseInt(ngayBT[1], 10))
                  && (parseInt(ngayNhan[2], 10) <= parseInt(ngayBT[2], 10))
                  && (parseInt(ngayTra[0], 10) === parseInt(ngayBT[0], 10))
                  && (parseInt(ngayTra[1], 10) === parseInt(ngayBT[1], 10))
                  && (parseInt(ngayTra[2], 10) >= parseInt(ngayBT[2], 10))
                  && (parseInt(ngayTra[0], 10) === parseInt(ngayKT[0], 10))
                  && (parseInt(ngayTra[1], 10) === parseInt(ngayKT[1], 10))
                  && (parseInt(ngayTra[2], 10) <= parseInt(ngayKT[2], 10))
                ) {
          const d1 = new Date(dateStart).getTime();
          const d2 = new Date(datetra).getTime();
          daysTill30June2035 = Math.floor((d2 - d1) / (1000 * 60 * 60 * 24));
        }
        //TH3: ngày đặt > ngày bắt đầu ưu đãi && ngày đặt < ngày kết thúc ưu đãi và ngày trả >=ngày kết thúc ưu đãi 
        else if ((parseInt(ngayNhan[0], 10) === parseInt(ngayBT[0], 10))
                  && (parseInt(ngayNhan[1], 10) === parseInt(ngayBT[1], 10))
                  && (parseInt(ngayNhan[2], 10) >= parseInt(ngayBT[2], 10))
                  && (parseInt(ngayNhan[0], 10) === parseInt(ngayKT[0], 10))
                  && (parseInt(ngayNhan[1], 10) === parseInt(ngayKT[1], 10))
                  && (parseInt(ngayNhan[2], 10) <= parseInt(ngayKT[2], 10))
                  && (parseInt(ngayTra[0], 10) === parseInt(ngayKT[0], 10))
                  && (parseInt(ngayTra[1], 10) === parseInt(ngayKT[1], 10))
                  && (parseInt(ngayTra[2], 10) >= parseInt(ngayKT[2], 10))
                ) {
          const d1 = new Date(datenhan).getTime();
          const d2 = new Date(dateEnd).getTime();
          daysTill30June2035 = Math.floor((d2 - d1) / (1000 * 60 * 60 * 24));
        }
        //TH4:  ngày đặt phòng<ngày bắt đầu ưu đãi và ngày trả phòng > ngày kết thúc ưu đãi
        else if ((parseInt(ngayNhan[0], 10) === parseInt(ngayBT[0], 10))
                  && (parseInt(ngayNhan[1], 10) === parseInt(ngayBT[1], 10))
                  && (parseInt(ngayNhan[2], 10) <= parseInt(ngayBT[2], 10))
                  && (parseInt(ngayTra[0], 10) === parseInt(ngayKT[0], 10))
                  && (parseInt(ngayTra[1], 10) === parseInt(ngayKT[1], 10))
                  && (parseInt(ngayTra[2], 10) >= parseInt(ngayKT[2], 10))
                ) {
          const d1 = new Date(dateStart).getTime();
          const d2 = new Date(dateEnd).getTime();
          daysTill30June2035 = Math.floor((d2 - d1) / (1000 * 60 * 60 * 24));
        }
        else {
          daysTill30June2035 = -1;
        }
        return daysTill30June2035 + 1;
    };

    // Fomat ngày hiển thị lên trong xác nhận đơn đặt phòng
    const handleShowDate = (item) => {
        const data = item.split('-');
        return `${data[2]}-${data[1]}-${data[0]}`
    }

    // Sau khi hoàn tất đặt hàng
    const Hoantatdatphong = (tb) => {
        alert(tb);
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
        frm.append("total", total);
        var url = "/hotel/backend/Room/DatPhong.php";
        Axios.post(url, frm).then(res => {
            // console.log(res);
            Hoantatdatphong(res.data)
        }).catch(err => alert(err));
    }
    useEffect(() => {
        handleTong(rooms);
    }, [rooms])
    const handleTong = (rooms) => {
      const totalMoney = rooms.reduce(
            (a, c) =>
                a +
                ((handleTinhNgay(c.datenhan, c.datetra) *
                c.slphong *
                c.item_price) - (handleTinhNgayGiamGia(c.datenhan, c.datetra, c.dateStart, c.dateEnd)*
                c.slphong * c.item_price * (c.giaGiam /100))),
            0
        )
        setTotal(totalMoney);
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
              >

              </div>
              <table
                border="1px soild #bd9d1b"
                style={{ margin: "20px auto" }}
                width="100%"
              >
                <thead>
                  <tr style={{ textAlign: "center", fontSize: "13pt" }}>
                    <th style={{width:"150px"}}>Loại phòng</th>
                    <th>Hình ảnh</th>
                    <th style={{width:"230px"}}>Thời gian</th>
                    <th>Số người</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Số tiền giảm</th>
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
                          <NumberFormat 
                            value={handleTinhNgayGiamGia(item.datenhan, item.datetra, item.dateStart, item.dateEnd) *
                              (parseInt(item.giaGiam, 10) /100) * item.slphong * parseInt(item.item_price, 10)
                            }
                            decimalScale={0}
                            displayType={'text'} 
                            thousandSeparator={true}
                          />
                        </td>
                        <td>
                            <NumberFormat value={(handleTinhNgay(item.datenhan, item.datetra) *
                                parseInt(item.item_price, 10) *
                                item.slphong) - (handleTinhNgayGiamGia(item.datenhan, item.datetra, item.dateStart, item.dateEnd) *
                                (parseInt(item.giaGiam, 10) /100) * item.slphong * parseInt(item.item_price, 10))} displayType={'text'} thousandSeparator={true} />

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
              <h5>Tổng: </h5>
            </Col>
            <Col md={10} >
              <h5>
                <NumberFormat value={total} displayType={'text'} thousandSeparator={true} /> VND
              </h5>
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
