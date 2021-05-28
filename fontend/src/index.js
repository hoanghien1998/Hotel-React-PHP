import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import Trangchu from './Trangchu';
import * as serviceWorker from './serviceWorker';
import './bootstrap.min.css';

import 'primereact/resources/themes/nova-light/theme.css';
import 'primereact/resources/primereact.min.css';
import 'primeicons/primeicons.css';
import './primereact.css';

// const axios = require('axios');
// axios.defaults.baseURL = 'http://localhost:8081';

ReactDOM.render(<Trangchu />,document.getElementById("root"));

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
