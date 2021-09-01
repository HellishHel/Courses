config.postBtn && config.postBtn.addEventListener('click', async function(event) {
    event.preventDefault();

    const type = config.postBtn.getAttribute('data-type');
    const id = config.postBtn.getAttribute('data-id');

    const data = {
        id: type === 'update' ? id : null,
        methodName: config.methodName,
        additionMethods: config.additionMethods,
        errorMessage: config.deleteErrorMessage
    };

    // Добавляем все данные с инпутов в объект data
    config.inputs.forEach(function(inputCtrl) {
        data[inputCtrl.getAttribute('name')] = inputCtrl.value;
    });

    for (let field in config.additionFuelds) {
        data[field] = config.additionFuelds[field];
    }

    const path = type === 'insert' ? config.apiPostFile : config.apiUpdateFile;

    const response = await fetch(path, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    });

    let result = await response.text();

    if (result === 'Ok') {
        config.searchDataPromise = dataPromise = renderTable();
    } else {
        console.error('Error. Something went wrong! Result => ' + result);
    }

    showHideAddForm(false, changeFormStatus('Добавить', 'insert'));
});
