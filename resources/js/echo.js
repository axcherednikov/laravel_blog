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

Echo
    .private('admin-report')
    .listen('.post.updated', (e) => {
        console.log(e);
        popupS.alert({
            title: 'Измененная статья' + e.title,
            content: e.message,
        })
    });
