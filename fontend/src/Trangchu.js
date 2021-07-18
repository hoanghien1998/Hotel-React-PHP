/* eslint-disable react/jsx-pascal-case */
import React, { useState } from "react";
import { Container } from "react-bootstrap";
import { BrowserRouter } from "react-router-dom";
import Menu1 from "./component/Menu1";
import Footer from "./component/Footer";
import { Route, Switch } from "react-router-dom";
import Home from "./component/Home";
import Room from "./component/Room";
import About from "./component/About";
import Contact from "./component/Contact";
import Login from "./component/Login";
import Register from "./component/Register";
import Detail_Book from "./component/Detail_book";
import Account from './component/Account';

function Trangchu(props) {
    const [token, setToken] = useState(
        localStorage.getItem("token") ? localStorage.getItem("token") : ""
    );
    const [user, setUser] = useState(
        localStorage.getItem("user") ? JSON.parse(localStorage.getItem("user")) : []
    );

    const [rooms, setRooms] = useState(
        localStorage.getItem("room") ? JSON.parse(localStorage.getItem("room")) : []
    );

    // Xử lý lấy cái token
    const handleGetToken = (e) => {
        setToken(e);
    };

    // Xu ly lay user
    const handleGetUser = (e) => {
        setUser(e);
    };

    // Lưu cái thông tin khi đặt phòng xuống localStorage.
    // Neu tim thay x ID = data.choseID thi cu push x vao listRoom
    const handleAddToCart = (data) => {
        console.log("", data);
        // console.log(rooms)
        const listRoom = rooms.slice();
        listRoom.find(
            (x) => x.choseID.toString() === data.choseID.toString()
        );
        listRoom.push(data);
        localStorage.setItem("room", JSON.stringify(listRoom));
        setRooms(listRoom);
    };

    // Xử lý nút xóa trong giỏ đặt phòng.
    const handleDeleteRoom = (id) => {
        // console.log("item", item);
        const listRoom = rooms.slice();
        const data = listRoom.filter((x) => x.choseID.toString() !== id.toString());
        localStorage.setItem("room", JSON.stringify(data));
        setRooms(data);
    };

    // Xử lý nút cộng trong giỏ đặt phòng.
    const handlePlustQtyRoom = (item) => {
        // console.log("item", item);
        let listRoom = rooms.slice();
        const data = listRoom.findIndex((x) => x.choseID.toString() === item.choseID.toString());
        if (data !== -1) {
            if (item.slphong < item.slPhongCon) {
                listRoom[data].slphong = listRoom[data].slphong + 1;
            }
        }

        localStorage.setItem("room", JSON.stringify(listRoom));
        setRooms(listRoom);
    };

    // Xử lý nút trừ trong giỏ đặt phòng.
    const handleMinustQtyRoom = (item) => {
        // console.log("item", item);
        let listRoom = rooms.slice();
        const index = listRoom.findIndex((x) => x.choseID.toString() === item.choseID.toString());

        if (index !== -1 && listRoom[index].slphong > 1) {
            listRoom[index].slphong = listRoom[index].slphong - 1;
        }
        // if (index !== -1 && listRoom[index].slphong === 0) {
        //     listRoom = listRoom.filter((x) => x.choseID.toString() !== item.choseID.toString());
        // }
        localStorage.setItem("room", JSON.stringify(listRoom));
        setRooms(listRoom);
    };

    return (

        <BrowserRouter>
            <Container fluid style={{ margin: "0", padding: "0" }}>
                <Menu1 token={token} />
                <Switch>
                    {/* <Route exact path="/" component={Home} /> */}
                    <Route exact path="/">
                        <Home token={token} handleAddToCart={(e) => handleAddToCart(e)} rooms={rooms} />
                    </Route>
                    <Route exact path="/rooms" component={Room} />
                    {/* <Route exact path="/rooms">
                        <Room  />
                    </Route> */}
                    <Route exact path="/about" component={About} />
                    <Route exact path="/contact" component={Contact} />
                    <Route exact path="/login">
                        <Login handleGetToken={(e) => handleGetToken(e)}
                            handleGetUser={(e) => handleGetUser(e)} />
                    </Route>
                    <Route exact path="/register" component={Register} />
                    <Route exact path="/detail_book">
                        <Detail_Book
                            rooms={rooms}
                            handleDeleteRoom={(e) => handleDeleteRoom(e)}
                            handlePlustQtyRoom={(e) => handlePlustQtyRoom(e)}
                            handleMinustQtyRoom={(e) => handleMinustQtyRoom(e)}
                            token={token}
                        />
                    </Route>
                    <Route exact path="/acount">
                        <Account token={token}
                            user={user} />

                    </Route>
                </Switch>
                <Footer />
            </Container>
        </BrowserRouter>
    );
}

export default Trangchu;
