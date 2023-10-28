/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';

window.axios = axios;

window.axios.defaults.baseURL = 'http://127.0.0.1:8000';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;
window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('guestUserToken')}`;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

window.Pusher = Pusher
Pusher.logToConsole = true;

console.log(localStorage.getItem('guestUserToken'))

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: 'aef230f05c11d67dce6f',
  cluster: 'ap2',
  forceTLS: true,
  encrypted: true,
  authEndpoint: 'http://127.0.0.1:8000/broadcasting/auth',
  auth: {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('guestUserToken')}`, // Add the authentication token to the headers
    },
  },
});
