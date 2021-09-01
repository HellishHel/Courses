const table = document.getElementById('mainTable');

function makeClaim(data) {
    if (confirm(`Вы уверены, что хотите записаться на курс "${data.name}", автор курса ${data.author}?`)) {
        const requestData = {
            methodName: 'claim',
            user_id: config.userId,
            author_id: data.author_id,
            course_id: data.id
        };

        fetch(config.apiPostFile, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(requestData)
        })
            .then(response => response.text())
            .then(response => {
                if (response === 'Ok') {
                    if (typeof config.renderHandler === 'function') {
                        config.renderHandler();
                    }

                    alert(`Вы успешно записаны на курс "${data.name}"`);
                }
            })
            .catch(console.error)
    }
}

function deleteClaim(data) {
    if (confirm(`Вы уверены, что хотите отменить запись на курс "${data.name}", автор курса ${data.author}?`)) {
        const requestData = {
            methodName: 'claim',
            user_id: config.userId,
            author_id: data.author_id,
            course_id: data.id
        };

        fetch(config.apiDeleteFile, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(requestData)
        })
            .then(response => response.text())
            .then(response => {
                if (response === 'Ok') {
                    if (typeof config.renderHandler === 'function') {
                        config.renderHandler();
                    }

                    alert(`Вы успешно отменили запись на курс "${data.name}"`);
                }
            })
            .catch(console.error);
    }
}

table.addEventListener('afterRender', function (event) {
    const rows = table.querySelectorAll('tbody tr');

    for (let i = 0; i < rows.length; i++) {
        const td = document.createElement('td');
        td.setAttribute('data-id', event.data[i].id);
        td.style.cursor = 'pointer';

        if (event.data[i].is_claim == 0) {
            td.innerHTML = 'Записаться';
            td.addEventListener('click', makeClaim.bind(this, event.data[i]));
        } else {
            td.style.backgroundColor = '#94F945';
            td.innerHTML = 'Уже записаны';
            td.addEventListener('click', deleteClaim.bind(this, event.data[i]));
        }

        rows[i].appendChild(td);
    }
});

