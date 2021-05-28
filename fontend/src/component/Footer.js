import React, { Component } from 'react'
import {Col,Row} from 'react-bootstrap'
import 'font-awesome/css/font-awesome.min.css';

export default class Footer extends Component {
    render() {
        
        return (
            <div>
                
                    <Row style={{backgroundColor:'black', color:'white', marginTop:'50px'}}>
                        <Col md={6}>
                            <div style={{marginLeft:'50px'}}>
                                <h2>Roxandrea</h2>
                                <p>Đứng trên đèo cao quan sát, vịnh Vĩnh Hy được ôm ấp trong lòng núi bình lặng. Suối Lồ Ồ chảy từ trên núi xuống như một dải lụa trắng mềm mại, thoắt ẩn, thoắt hiện, vắt qua núi, đổ xuống vịnh. Một ngư dân ở đây kể cho chúng tôi nghe về một truyền thuyết của Vĩnh Hy. Ngày xưa, vịnh này gọi là Vũng Găng. </p>
                            </div>
                            
                        </Col>
                       
                        <Col md={6}>
                            <div style={{marginLeft:'50px'}}>
                                <h2>Thông tin liên hệ</h2>
                                <p><i className="fas fa-map-marker-alt"></i> 32 Quang Trung, Vĩnh Hy, Ninh Hải, Ninh Thuận</p>
                                <p><i className="fas fa-phone-square-alt"></i> +2 392 3929 210</p>
                                <p><i className="far fa-envelope-open"></i> info@yourdomain.com</p>
                            </div>
                            
                        </Col>
                        
                    </Row>
                
            </div>
        )
    }
}
