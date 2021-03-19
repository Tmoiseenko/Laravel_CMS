Echo
    .private('admin-notify')
    .listen('.App\\Events\\AdminNotifyUpdatePost', (e) => {
        alert('Приватный канал успешно работает');
    });
