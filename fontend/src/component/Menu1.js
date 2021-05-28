import React from "react";
import {Navbar, Nav, Button} from "react-bootstrap";
import {useHistory} from "react-router-dom";

function Menu1(props) {
    const history = useHistory();
    return (
        <Navbar bg="light" expand="lg" className="sticky-top">
            <Navbar.Brand href="/" style={{
                marginLeft: "30px",
                fontFamily: "Poppins",
                fontWeight: "bold",
            }}>
                ROXANDREA
            </Navbar.Brand>
            <Navbar.Toggle aria-controls="basic-navbar-nav"/>
            <Navbar.Collapse id="basic-navbar-nav">
                <Nav className="mr-auto" style={{marginLeft: "60px"}}>
                    <Nav.Link href="/" style={{
                        marginTop: "8px",
                        fontFamily: "Bookman",
                        fontWeight: "bold",
                    }}>
                        TRANG CHỦ
                    </Nav.Link>
                    {/* <Nav.Link href="bookroom" style={dd}>BookRoom</Nav.Link> */}
                    <Nav.Link href="rooms" style={{
                        marginLeft: "10px",
                        marginTop: "8px",
                        fontFamily: "'Times New Roman', Times, serif",
                        fontWeight: "bold",
                    }}>
                        PHÒNG
                    </Nav.Link>
                    {/* <Nav.Link href="restaurant" style={dd}>Restaurant</Nav.Link> */}
                    <Nav.Link href="about" style={{
                        marginLeft: "15px",
                        marginTop: "8px",
                        fontFamily: "'Times New Roman', Times, serif",
                        fontWeight: "bold",
                    }}>
                        GIỚI THIỆU
                    </Nav.Link>
                    <Nav.Link href="contact" style={{
                        marginLeft: "15px",
                        marginTop: "8px",
                        fontFamily: "'Times New Roman', Times, serif",
                        fontWeight: "bold",
                    }}>
                        LIÊN HỆ
                    </Nav.Link>
                    <Nav.Link href="detail_book" style={{
                        marginLeft: "15px",
                        marginTop: "8px",
                        fontFamily: "'Times New Roman', Times, serif",
                        fontWeight: "bold",
                    }}>
                        XÁC NHẬN ĐẶT PHÒNG
                    </Nav.Link>
                   
                    {props.token.length > 0 ? (
                        <>
                        <Nav.Link href="acount" style={{
                            marginLeft: "80px",
                            marginTop: "8px",
                            fontFamily: "'Times New Roman', Times, serif",
                            fontWeight: "bold",
                        }}>
                            TÀI KHOẢN
                        </Nav.Link>
                        <Button onClick={() => {
                            localStorage.clear();
                            history.push("/");
                            window.location.reload();
                        }} variant="outline-info" style={{
                            marginLeft: "30px",
                            fontFamily: "'Times New Roman', Times, serif",
                        }}>Đăng xuất</Button>
                        </>
                    ) : (
                        <>
                            <Nav.Link href="login" style={{
                                marginLeft: "80px",
                                fontFamily: "'Times New Roman', Times, serif",
                                fontWeight: "bold",
                            }}>
                                {" "}
                                <Button variant="outline-info">Đăng nhập</Button>{" "}
                            </Nav.Link>
                            <Nav.Link href="register" style={{
                                marginLeft: "10px",
                                fontFamily: "'Times New Roman', Times, serif",
                                fontWeight: "bold",
                            }}>
                                {" "}
                                <Button variant="outline-info">Đăng ký</Button>{" "}
                            </Nav.Link>
                        </>
                    )}
                </Nav>
            </Navbar.Collapse>
        </Navbar>
    );
}

export default Menu1;