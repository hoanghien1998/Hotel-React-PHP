import React, {useState} from 'react'
import "../common/login.css";
import {Link, useHistory} from "react-router-dom";
import {Button} from "react-bootstrap";
import $ from "jquery";
import Axios from "axios";

const REGEX_PASS = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
function Register(props) {
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const history = useHistory();

    const handleError = () => {
        let flag = true;
        if (name.length === 0) {
            $("#error_name").show();
            $("#error_name").text("Tên không được để trống!!!");
            flag = false
        } else {
            $("#error_name").hide();
        }

        if (email.length === 0 || !email) {
            $("#error_email").show();
            $("#error_email").text("Email không được để trống hoặc không chính xác!!!");
            flag = false;
        } else {
            $("#error_email").hide();
        }

        if (password.length === 0 || !REGEX_PASS.test(password)) {
            $("#error_password").show();
            $("#error_password").text("Mật khẩu tối thiểu 8 ký tự và có ký tự đặc biệt hoặc hoa thường!!!");
            flag = false;
        } else {
            $("#error_password").hide();
        }
        return flag;
    };

    const handleRegister = (e) =>{
// lấy data từ request để đưa xuống backend
        const data = {
            name,
            email,
            password
        }
        if (handleError()) {
            const url = "/hotel/backend/register.php";
            Axios.post(url, data).then(res => {
                if (res.data.status === 422) {
                    alert(res.data.message);
                } if (res.data.status !== 422) {
                    alert(res.data.message);
                    // localStorage.setItem('token', res.data.token)
                    // props.handleGetToken(res.data.token);
                    history.push('/login');
                    setName("");
                    setEmail("");
                    setPassword("");

                }
            })
                .catch(err => console.log(err));
        }
    }
    return (
        <div className="_loginRegister">
            <h1>Đăng ký</h1>

            <div className="form-control">
                <label>Họ tên</label>
                <input name="name" value={name}
                       onChange={(e) => setName(e.target.value)}
                       required type="text" placeholder="Enter your name"/>
                <p id="error_name" />
            </div>
            <div className="form-control">
                <label>Email</label>
                <input name="email"
                       value={email}
                       onChange={(e) => setEmail(e.target.value)}
                       required type="email" placeholder="Enter your email"/>
                <p id="error_email" />
            </div>
            <div className="form-control">
                <label>Password</label>
                <input name="password" value={password}
                       onChange={(e) => setPassword(e.target.value)}
                       required type="password" placeholder="Enter your password"/>
                <p id="error_password" />
            </div>

            <div className="form-control">
                <button type="submit" onClick={() => handleRegister()}>Đăng ký</button>
            </div>

            <div className="_navBtn">
                <Button><Link to="/login" style={{color: 'white', hover: '#008B8B'}}>Đăng nhập</Link></Button>
            </div>
        </div>
    );
}

export default Register