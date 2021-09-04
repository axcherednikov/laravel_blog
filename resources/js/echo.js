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
    .private('update.post.report')
    .listen('.post.updated', (e) => {
        popupS.alert({
            title: 'Измененная статья' + e.title,
            content: e.message,
        })
    });

Echo
    .private('total.admin.report')
    .listen('.create.admin.report', (e) => {
        popupS.alert({
            title: 'Отчёт',
            content: e.report
        })
    });
