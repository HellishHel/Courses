class CustomEvent extends Event {
    constructor(eventName, data = []) {
        super(eventName);
        this.data = data;
    }
}

const renderTable = async function(data, search) {
    let result;
    let tr;

    const table = document.getElementById('mainTable');
    const tableHead = table.querySelector('tr');
    const loader = document.getElementById('loader');
    const tbody = document.createElement('tbody');

    loader.style.display = 'block';

    table.innerHTML = null;
    table.appendChild(tableHead);

    if (!data) {
        const getData = {
            methodName: config.methodName
        };

        for (let field in config.additionFuelds) {
            getData[field] = config.additionFuelds[field];
        }

        let response = await fetch(config.apiGetFile, {
            method: 'POST',
                headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(getData)
        });
        result = await response.json();
    } else {
        result = data;
    }

    if (search) {
        let searchData = [];

        result.forEach(function(row) {
            let searchArray = [];

            for (let key in row) {
                if (row.hasOwnProperty(key)) {
                    searchArray.push(row[key]);
                }
            }

            for (let i = 0; i < searchArray.length; i++) {
                if ((searchArray[i] + '').toLowerCase().includes((search + '').toLowerCase())) {
                    searchData.push(row);
                    break;
                }
            }
        });

        result = searchData;
    }

    const createIcon = function(rowId, iconClasses, handleFunction) {
        // Создание иконки Update
        let td = document.createElement('td');
        let icon = document.createElement('i');

        if (typeof iconClasses === 'string') {
            iconClasses.split(' ').forEach(function (currentClass) {
                icon.classList.add(currentClass);
            });
        } else {
            throw 'Переменная iconClasses должна быть типа string';
        }

        td.style.textAlign = 'center';
        td.style.cursor = 'pointer';
        td.setAttribute('data-id', rowId);

        td.addEventListener('click', handleFunction);

        td.appendChild(icon);

        return td;
    };

    // Sort data by captions
    const thNodes = document.querySelectorAll('[data-value]');

    result.forEach(function(row) {
        let fields = [];

        if (thNodes) {
            thNodes.forEach(function(th) {
                const thValue = th.getAttribute('data-value');

                if (row.hasOwnProperty(thValue)) {
                    fields.push(thValue);
                }
            });
        } else {
            for (let key in row) {
                if (row.hasOwnProperty(key)) {
                    if (Array.isArray(config.exceptFields) && config.exceptFields.includes(key)) {
                        continue;
                    }

                    fields.push(key);
                }
            }
        }

        tr = document.createElement('tr');

        for (let i = 0; i < fields.length; i++) {
            let td = document.createElement('td');
            let text = document.createTextNode(row[fields[i]]);

            td.appendChild(text);
            tr.appendChild(td);
        }

        // Создание иконки Update
        config.letUpdate && tr.appendChild(createIcon(row['id'], config.iconUpdateClasses, config.onUpdate));
        // Создание иконки Delete
        config.letDelete && tr.appendChild(createIcon(row['id'], config.iconDeleteClasses, config.onDelete));

        tbody.appendChild(tr);
    });
    
    table.appendChild(tbody);

    loader.style.display = 'none';

    table.dispatchEvent(new CustomEvent('afterRender', result));

    return result;
};

config.renderHandler = renderTable;

var dataPromise = renderTable();
