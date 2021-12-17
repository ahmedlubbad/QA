require('./bootstrap');

// import Alpine from 'alpinejs';
//
// window.Alpine = Alpine;
//
// Alpine.start();

window.Echo.private('App.Models.User.' + userId)
    .notification(function (data) {
        var toast = new bootstrap.Toast(document.getElementById('notificationToast'))
        document.getElementById('notification-title').innerHTML = data.title
        document.getElementById('notification-body').innerHTML = data.body
        document.getElementById('notification-time').innerHTML = new Date()
        toast.show()

        let count = Number(document.getElementById('nm-count').innerText)
        document.getElementById('nm-count').innerHTML = count + 1

        const listElm = document.getElementById('nm-list');
        listElm.innerHTML = ` <li><a class="dropdown-item"
                   href="${data.url}?notify_id=${data.id}">
                    <h6>${data.title}</h6>
                    <p>${data.body}</p>
                    <p class="text-muted">${(new Date).toLocaleTimeString()}</p>
                </a></li>` + listElm.innerText

    })
;
