import React from 'react';
import { Col, Row, Container } from 'react-bootstrap'


function About(props) {
    const dd = {
        marginTop: '50px',
        borderRadius: '50px'
    }
    return (
        <div>
            <h1 style={{ textAlign: "center",
                    marginTop: '50px',
                    fontFamily: 'Playfair Display',
                    fontStyle: 'italic' }}>Giới thiệu của khách sạn</h1>
            <Container>
                <Row>
                    <Col md={6}>
                        <img src="images/about.jpg" alt="" width="400px" height="80%" style={dd} />
                    </Col>
                    <Col md={6}>
                        <h5 style={{ textAlign: "center", marginTop: '50px', color: '#bd9d1b' }}>
                            Chào mừng bạn đến với khách sạn Roxandrea</h5>
                        <h2 style={{ textAlign: "center", marginTop: '10px' }}>Chào mừng bạn đã đến với khách sạn của chúng tôi</h2>
                        <p>
                            Khách sạn chúng tôi phục đầy đủ các loại phòng thương gia, đầy đủ các loại phòng có view đẹp. Ngoài các loại phòng thương gia,
                            thì cũng có các phòng đôi, phòng đơn với đầy đủ tiện nghi sẵn sàng phục vụ quý khách. Là một khách sạn gần biển,
                            quý khách sẽ tiện ra biển và đảo trên Vĩnh Hy.
                        </p>
                        <p>
                            Ngoài ra khách sạn gần với các nhà hàng hải sản lớn, phục vụ hải sản tươi sống thơm ngon. Gần cạnh những spa, khu vụ
                            làm đẹp và chăm sóc da. Đi chơi nhưng chúng ta không quên vấn đề làm đẹp.
                            Với đầy đủ tiện nghi và tiện ích khách sạn Roxandrea rất hân hạnh được phục vụ quý khách.
                        </p>
                    </Col>
                </Row>
            </Container>
        </div>
    )
}

export default About;