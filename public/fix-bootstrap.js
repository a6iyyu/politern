// Simple bootstrap.js for build testing
import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Echo is optional, we can comment it out for now
// window.Echo = new Echo({...});
