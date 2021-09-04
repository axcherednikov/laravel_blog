window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
window.popupS = require('popups');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

const APP_KEY = process.env.MIX_PUSHER_APP_KEY;
const APP_CLUSTER = process.env.MIX_PUSHER_APP_CLUSTER;

const pusher = new Pusher(APP_KEY, {
    cluster: APP_CLUSTER,
    enabledTransports: ['ws'],
    wsHost: window.location.hostname,
    wsPort: 6009,
    forceTLS: false,
    authEndpoint: '/broadcasting/auth',
});

window.Echo = new Echo({
    broadcaster: 'pusher',
    client: pusher
});
