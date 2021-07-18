import React, { useEffect, useState } from "react";
import Carousel from 'react-bootstrap/Carousel'
import Axios from "axios";

const Slider = (props) => {
  const [listSlides, setListSlides] = useState([]);
  
  // Lấy danh sách hình ảnh được trả về từ api
  const getListImages = () => {
    Axios.get("/hotel/backend/getSlider.php")
      .then(({ data }) => {
        if (data.success === 1) {
          setListSlides(data.slides);
        }
      })
      .catch((error) => {
        console.log(error);
      });
  }

  // Giống component did mount
  useEffect(() => {
    getListImages();
  }, []);

  return (
    <Carousel width="100%">
      {listSlides.map((item, index) => (
         <Carousel.Item  key={index}>
           <img src={"images/" + item.image} alt="First slide" width="100%" height="450px"/>
         </Carousel.Item>
      ))}
    </Carousel>
  );
}

export default Slider;