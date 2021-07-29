import React, { useState, useEffect } from "react";
import { Col, Row, Container, Button, Modal, Jumbotron } from "react-bootstrap";
import $, { data } from "jquery";
import Axios from "axios";
import qs from 'qs';
window.$ = $;

const REGAX_SDT = /^[0-9]{10}$/;
const REGAX_CMND = /^([0-9]{9})$/;

const Account = (props) => {
  const { histories } = props;

  const [id, setID] = useState("");
  const [name, setName] = useState("");
  const [phone, setPhone] = useState("");
  const [address, setAddress] = useState("");
  const [cmnd, setCmnd] = useState("");
  const [email, setEmail] = useState("");
  const [modalState, setModalState] = useState(false);
  // const [getTT, setGetTT] = useState("");

  const [user, getUser] = useState(JSON.parse(localStorage.getItem("user")));

  // Get model edit user info
  const handleEdit = (cus_code, ten, sdt, dc, cm, mail) => {
    modalState === true ? setModalState(false) : setModalState(true);
    setName(ten);
    setPhone(sdt);
    setAddress(dc);
    setCmnd(cm);
    setEmail(mail);
    setID(cus_code);
  }


  const handleError = () => {
    let flag = true;
    if (name.length === 0) {
      $("#error_name").show();
      $("#error_name").text("Tên không được để trống!!!");
      flag = false
    } else {
      $("#error_name").hide();
    }

    if (phone.length === 0 || !REGAX_SDT.test(phone)) {
      $("#error_sdt").show();
      $("#error_sdt").text("Số điện thoại không được để trống hoặc không đúng định dạng!!!");
      flag = false
    } else {
      $("#error_sdt").hide();
    }
    if (address.length === 0) {
      $("#error_dc").show();
      $("#error_dc").text("Địa chỉ không được để trống!!!");
      flag = false
    } else {
      $("#error_dc").hide();
    }
    if (cmnd.length === 0 || !REGAX_CMND.test(cmnd)) {
      $("#error_cmnd").show();
      $("#error_cmnd").text("CMND không được để trống hoặc không đúng định dạng!!!");
      flag = false
    } else {
      $("#error_cmnd").hide();
    }

    return flag;
  };

  // Cap nhat thong tin ca nhan
  const handleSubmit = () => {
    const data = {
      id,
      name,
      phone,
      address,
      cmnd,

    }
    if (handleError()) {
      const url = "/hotel/backend/updateAcount.php";
      Axios.post(url, qs.stringify(data), {
        headers: {
          "content-type": "application/x-www-form-urlencoded"
        }
      }).then(res => {
        console.log(res.data);
        localStorage.setItem('user', JSON.stringify(res.data.user[0]));
        alert("Bạn đã cập nhật thành công");
        setModalState(false);
        // user
        // user(JSON.parse(localStorage.getItem("user"));
        getUser(JSON.parse(localStorage.getItem("user")));

      })
        .catch(err => console.log(err));
    }

  }

  // Fomat ngày hiển thị lên trong xác nhận đơn đặt phòng
  const handleShowDate = (item) => {
    const data = item.split('-');
    return `${data[2]}-${data[1]}-${data[0]}`
  }

  // const handleSendUser = () => {
  //   var frm = new FormData();
  //   var userId = user.cus_code;
  //   frm.append("userId", JSON.stringify(userId));
  //   var url = "/hotel/backend/lichSuDatPhong.php";
  //   Axios.post(url, frm).then(res => {
  //     if (res.data.success === 1) {
  //       setHistory(res.data.historys);
  //     }
  //   }).catch(err => alert(err));
  // }
  // useEffect(() => {
  //   handleSendUser()
  // }, [])
  // useEffect(() => {
  //   if (history.length > 0 ) {
  //     props.setHistories(history);
  //   }
  // }, [history])

  return (
    <div style={{ height: "auto", minHeight: "350px" }}>
      <Container>
        {histories.length > 0 ?
          (
            <Row style={{ marginTop: "30px" }}>
              <Col md={5}>
                <Jumbotron>
                  <h5 style={{ textAlign: "center" }}>THÔNG TIN CÁ NHÂN</h5>
                  <p style={{ fontSize: "13pt" }}>
                    <label>Họ tên: {user?.name}</label>
                  </p>
                  <p style={{ fontSize: "13pt" }}>
                    <label>Số điện thoại: {user?.phone}</label>
                  </p>
                  <p style={{ fontSize: "13pt" }}>
                    <label>Địa chỉ: {user?.address}</label>
                  </p>
                  <p style={{ fontSize: "13pt" }}>
                    <label>CMND: {user?.cmnd}</label>
                  </p>
                  <p style={{ fontSize: "13pt" }}>
                    <label>Email: {user?.email}</label>
                  </p>
                  <p style={{ textAlign: "center" }}>
                    {
                      user && (
                        <Button variant="primary" onClick={() =>
                          handleEdit(
                            user.cus_code,
                            user.name,
                            user.phone,
                            user.address,
                            user.cmnd,
                            user.email
                          )
                        }>Cập nhật</Button>
                      )
                    }
                  </p>
                </Jumbotron>
              </Col>
              <Col md={7}>
                <h5 style={{ textAlign: "center" }}>LỊCH SỬ ĐẶT PHÒNG</h5>
                <table
                  border="1px soild #bd9d1b"
                  width="100%"
                >
                  <thead>
                    <tr style={{ textAlign: "center", fontSize: "13pt" }}>
                      <th>Loại phòng</th>
                      <th>Thời gian</th>
                      <th>Số lượng</th>
                      <th>Tổng tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    {histories && histories.map((item, index) => (
                      <tr key={index} style={{ textAlign: "center" }}>
                        <td style={{ fontSize: "13pt" }}>{item.name}</td>
                        <td style={{ fontSize: "13pt" }}>
                          <label>Ngày nhận: </label> {handleShowDate(item.check_in)}<br></br>
                          <label>Ngày trả: </label> {handleShowDate(item.check_out)}
                        </td>
                        <td>{item.number_room}</td>
                        <td>{item.total}</td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </Col>
            </Row>) : 
            (
              <Row style={{ marginTop: "30px" }}>
              <Col md={5}>
                <Jumbotron>
                  <h5 style={{ textAlign: "center" }}>THÔNG TIN CÁ NHÂN</h5>
                  <p style={{ fontSize: "13pt" }}>
                    <label>Họ tên: {user?.name}</label>
                  </p>
                  <p style={{ fontSize: "13pt" }}>
                    <label>Số điện thoại: {user?.phone}</label>
                  </p>
                  <p style={{ fontSize: "13pt" }}>
                    <label>Địa chỉ: {user?.address}</label>
                  </p>
                  <p style={{ fontSize: "13pt" }}>
                    <label>CMND: {user?.cmnd}</label>
                  </p>
                  <p style={{ fontSize: "13pt" }}>
                    <label>Email: {user?.email}</label>
                  </p>
                  <p style={{ textAlign: "center" }}>
                    {
                      user && (
                        <Button variant="primary" onClick={() =>
                          handleEdit(
                            user.cus_code,
                            user.name,
                            user.phone,
                            user.address,
                            user.cmnd,
                            user.email
                          )
                        }>Cập nhật</Button>
                      )
                    }
                  </p>
                </Jumbotron>
              </Col>
              </Row>
            )}
        <Row>
          <Col md={6}>
            <Modal show={modalState} onHide={() => handleEdit()}>
              <Modal.Header closeButton>
                <Modal.Title>Cập nhật thông tin cá nhân</Modal.Title>
              </Modal.Header>
              <Modal.Body>
                <Container>
                  <Row>
                    <Col md={6}>
                      <label>Họ tên: </label>
                      <input
                        name="name"
                        type="text"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                        required
                      />
                      <p id="error_name" />
                    </Col>
                    <Col md={6}>
                      <label>SĐT : </label>
                      <input
                        name="phone"
                        type="text"
                        value={phone}
                        onChange={(e) => setPhone(e.target.value)}
                        required
                      />
                      <p id="error_sdt" />
                    </Col>
                  </Row>
                  <Row>
                    <Col md={6}>
                      <label>Email: </label>
                      <input
                        name="email"
                        type="text"
                        value={email}
                        disabled
                      />

                    </Col>
                    <Col md={6}>
                      <label>CMND: </label>
                      <input
                        name="cmnd"
                        type="text"
                        value={cmnd}
                        onChange={(e) => setCmnd(e.target.value)}
                        required
                      />
                      <p id="error_cmnd" />
                    </Col>
                  </Row>
                  <Row>
                    <Col md={12}>
                      <label>Địa chỉ: </label>
                      <input
                        name="address"
                        type="text"
                        value={address}
                        onChange={(e) => setAddress(e.target.value)}
                        required
                        style={{ width: "100%" }}

                      />
                      <p id="error_dc" />
                    </Col>
                  </Row>
                </Container>
              </Modal.Body>
              <Modal.Footer>
                <Button variant="success" onClick={() => { handleSubmit() }}>
                  Cập nhật {""}
                </Button>
                <Button variant="secondary" onClick={() => handleEdit()}>
                  Close{""}
                </Button>
              </Modal.Footer>
            </Modal>
          </Col>
        </Row>
      </Container>
    </div >
  )
}

export default Account;