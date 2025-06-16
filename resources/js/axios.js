import axios from 'axios';

let baseURL = '';
if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
  baseURL = 'http://127.0.0.1:8001'; // Pas aan indien je backend op een andere poort draait
}

const instance = axios.create({
  baseURL,
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'Accept': 'application/json',
  },
});

export default instance; 