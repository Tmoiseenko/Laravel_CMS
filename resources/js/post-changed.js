Echo
    .channel('post-changed')
    .listen('PostChanged', (e) => {
        alert(e.what);
    });
