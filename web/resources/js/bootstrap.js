import Cookies from "js-cookie";
window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios.interceptors.request.use(config => {
    const xsrfToken = Cookies.get("XSRF-TOKEN");
    config.headers["X-XSRF-TOKEN"] = xsrfToken;
    return config;
});

window.axios.interceptors.response.use(
    response => response,
    error => error.response || error
);
