import React, { useState } from "react";
import { Link, useHistory } from "react-router-dom"
import { Button } from "react-bootstrap";
import "../common/login.css";
import Axios from 'axios';
import { GoogleLogin } from 'react-google-login';
import FacebookLogin from 'react-facebook-login';
import $ from 'jquery';
window.$ = $;
var qs = require('qs');


const REGEX_PASS = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

function Login(props) {
    const [email, setEmail] = useState("hoanghien@gmail.com");
    const [password, setPassword] = useState("Hien123@");
    const history = useHistory();

    const handleError = () => {
        let flag = true;
        if (email.length === 0 || !email) {
            $("#error_email").show();
            $("#error_email").text("Email không được để trống hoặc không chính xác!!!");
            flag = false;
        } else {
            $("#error_email").hide();
        }

        if (password.length === 0 || !REGEX_PASS.test(password)) {
            $("#error_password").show();
            $("#error_password").text("Mật khẩu tối thiểu 8 ký tự và có ký tự đặt biệt hoặc hoa thường!!!");
            flag = false;
        } else {
            $("#error_password").hide();
        }
        return flag;
    };

    // Xu ly khi nhan nut login.
    const handleLogin = (e) => {
        // lấy data từ request để đưa xuống backend
        const data = {
            email,
            password
        }
        if (handleError()) {
            console.log("Login")
            const url = "/hotel/backend/Login.php";
            Axios.post(url, data).then(res => {
                if (res.data.status === 422) {
                    alert(res.data.message);
                } if (res.data.status !== 422) {
                    console.log(res)
                    localStorage.setItem('token', res.data.token)
                    localStorage.setItem('user', JSON.stringify(res.data.user))
                    props.handleGetToken(res.data.token);
                    props.handleGetUser(res.data.user);
                    history.push('/');
                    setEmail("");
                    setPassword("");
                    alert("DAng nhap thanh cong");
                }
            })
                .catch(err => console.log(err));
        }
    };

    // Hanle login google
    const responseGoogle = (res) => {
        // console.log(res.profileObj)
        var email = res.profileObj.email;
        var user = res.profileObj.name;
        var logingg = 1;
        const data = {
            email,
            user,
            logingg

        }
        const url = "/hotel/backend/Login.php";
        Axios.post(url, data, {
            headers: {
                "content-type": "application/x-www-form-urlencoded"
            }
        }).then(response => {
            localStorage.setItem('token', response.data.token)
            localStorage.setItem('user', JSON.stringify(response.data.user))
            props.handleGetToken(response.data.token);
            props.handleGetUser(response.data.user);
            history.push('/acount');
        })
            .catch((error) => {
                console.log(error);
            });

    }

    // handle login facebook
    const responseFacebook = (res) => {
        // console.log(res);
        var email = res.email;
        var user = res.name;
        var loginface = 1;
        const data = {
            email,
            user,
            loginface

        }
        const url = "/hotel/backend/Login.php";
        Axios.post(url, data, {
            headers: {
                "content-type": "application/x-www-form-urlencoded"
            }
        }).then(response => {
            // console.log(response.data.message)
            localStorage.setItem('token', response.data.token)
            localStorage.setItem('user', JSON.stringify(response.data.user))
            props.handleGetToken(response.data.token);
            props.handleGetUser(response.data.user);
            history.push('/acount');
        })
            .catch((error) => {
                console.log(error);
            });
    }
    return (
        <div className="_loginRegister">
            <h1>Đăng nhập</h1>
            <div className="form-control">
                <label>Email</label>
                <input
                    name="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    type="email"
                    required
                    placeholder="Enter your email"
                />
                <p id="error_email" />
            </div>
            <div className="form-control">
                <label>PassWord</label>
                <input
                    name="password"
                    type="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                    placeholder="Enter your password"
                />
                <p id="error_password" />
            </div>

            <div className="form-control">
                <button onClick={() => handleLogin()} type="submit">Đăng nhập</button>
            </div>
            <div className="_navBtn">
                <Button><Link to="/register" style={{ color: 'white', hover: '#008B8B' }} >Đăng ký</Link></Button>
            </div>
            <div className="_navBtn" style={{ marginTop: '5px' }}>
                <GoogleLogin
                    clientId="1046614447632-i3hsc5liq1scjj818s6kfdj74hihu4oj.apps.googleusercontent.com"
                    render={renderProps => (
                        <button onClick={renderProps.onClick} style={{ backgroundColor: "#d73d32" }}>Đăng nhập google</button>
                    )}
                    buttonText="Login"
                    onSuccess={responseGoogle}
                    cookiePolicy={'single_host_origin'}

                />
            </div>
            <div className="_navBtn" style={{ marginTop: '5px' }}>
                <FacebookLogin
                    appId="140235647703492"
                    icon="fa-facebook"
                    fields="name,email,picture"
                    callback={responseFacebook}
                    cssClass="css_facebook" />
            </div>
        </div>

    );
}

export default Login;
