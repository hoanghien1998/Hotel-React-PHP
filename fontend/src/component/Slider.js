// import React, { Component } from 'react'
// import Carousel from 'react-bootstrap/Carousel'

// export default class Slider extends Component {
//     render() {
//         return (
            
//             <Carousel width="100%">
//                 <Carousel.Item>
//                     <img src="/images/bg_1.jpg" alt="First slide" width="100%" height="450px"/>
//                     <Carousel.Caption>
//                     <h3 style={{color:'white'}}>Roxandrea </h3>
//                     <p style={{color:'white', fontSize:'18pt'}}>Du thuyền trên vịnh Vĩnh Hy, ngắm san hô và tắm biển Bà Điên </p>
//                     </Carousel.Caption>
//                 </Carousel.Item>

//                 <Carousel.Item>
//                     <img src="/images/bg_2.jpg" alt="First slide" width="100%" height="450px"/>
//                     <Carousel.Caption>
//                     <h3 style={{color:'white'}}>Khách sạn Roxandrea</h3>
//                     <p style={{color:'white'}}>Khách sạn Roxandrea &amp; Resort </p>
//                     </Carousel.Caption>
//                 </Carousel.Item>

//                 <Carousel.Item>
//                     <img src="/images/bg_3.jpg" alt="First slide" width="100%" height="450px"/>
//                     <Carousel.Caption>
//                     <h3 style={{color:'#FFCC00'}}>Amenities</h3>
//                     <p style={{color:'#FFCC00'}}>Even the all-powerful Pointing </p>
//                     </Carousel.Caption>
//                 </Carousel.Item>

//             </Carousel>
            
//         )
//     }
// }
import React, { useEffect, useState } from "react";
// import "./index.css";

const LISTIMAGES = [
  { id: 0, img: "https://www.w3schools.com/howto/img_avatar.png" },
  { id: 1, img: "https://www.w3schools.com/howto/img_avatar2.png" },
  { id: 2, img: "https://www.w3schools.com/w3images/avatar6.png" },
  { id: 3, img: "https://www.w3schools.com/w3images/avatar2.png" },
  {
    id: 4,
    img:
      "https://cdn4.iconfinder.com/data/icons/avatars-xmas-giveaway/128/girl_avatar_child_kid-512.png",
  },
  {
    id: 5,
    img:
      "https://png.pngtree.com/element_our/20190530/ourlarge/pngtree-520-couple-avatar-boy-avatar-little-dinosaur-cartoon-cute-image_1263411.jpg",
  },
];

const SlideImage = (props) => {
  const [count, setCount] = useState(0);
  useEffect(() => {
    let x = count;
    const id = setInterval(() => {
      if (count < LISTIMAGES.length) {
        x = x + 1;
      }
      if (count === LISTIMAGES.length - 1) {
        x = 0;
      }
      setCount(x);
    }, 3000);

    return () => {
      clearInterval(id);
    };
  }, [count]);

  return (
    <div className="slide-image">
      <ul>
        {LISTIMAGES &&
          LISTIMAGES.map((item, index) => (
            <li key={index} className={count === index ? "active" : null}>
              <img src={item.img} alt={item.id} />
            </li>
          ))}
      </ul>
      <div className="show-image">
        <img src={LISTIMAGES[count].img} alt="1" />
      </div>
      {/* show-image */}
    </div>
    // slide-image
  );
};

export default SlideImage;