const { default: Echo } = require('laravel-echo');

require('./bootstrap');

// (e) => is callback contain information that been sent from UserSessionChanged class  ($type , $message)

//   here commen error dont use  Echo.channel('notifications')   => Echo is not function error
//  Instead Echo.channel try window.Echo.channel
window.Echo.channel('notifications')
    .listen('UserSessionChanged', (e) => {
        const notificationElement = document.getElementById('notification');
        notificationElement.innerText = e.message; // add message from callback
        notificationElement.classList.remove('invisible'); //remove the invisibility
        notificationElement.classList.remove('alert-success');
        notificationElement.classList.remove('alert-danger');

        notificationElement.classList.add('alert-' + e.type); // add type from callback



    })
