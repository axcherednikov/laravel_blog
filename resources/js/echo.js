Echo.channel('hello').listen('SomethingHappens', (e) => {
    alert(e.whatHappens);
});

