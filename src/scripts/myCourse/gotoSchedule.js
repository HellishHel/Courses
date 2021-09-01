const table = document.getElementById('mainTable');

table.addEventListener('afterRender', function (event) {
    const rows = table.querySelectorAll('tbody tr');

    for (let i = 0; i < rows.length; i++) {
        const td = document.createElement('td');
        td.setAttribute('data-id', event.data[i].id);
        td.style.cursor = 'pointer';

        td.innerHTML = 'Расписание';
        td.addEventListener('click', function () {
            location.replace(`./schedule?courseId=${event.data[i].id}`);
        });

        rows[i].appendChild(td);
    }
});

