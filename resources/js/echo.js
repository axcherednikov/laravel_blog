Echo
    .channel('lara_hello')
    .listen('SomethingHappens', (e) => {
        alert(e.whatHappens);
    });

Echo
    .private('App.Models.User.' + userId)
    .notification((notification) => {
        alert(notification.type + ': ' + notification.subject);
    });
