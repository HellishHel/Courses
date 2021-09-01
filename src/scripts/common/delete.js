const deleteRow = function(event) {
    let rowId = event.target.getAttribute('data-id') || event.target.parentNode.getAttribute('data-id');

    const data = {
        id: rowId,
        methodName: config.methodName,
        additionMethods: config.additionMethods,
        errorMessage: config.deleteErrorMessage
    };

    if (confirm('Вы уверены, что хотете удалить выбранную запись?')) {
        (async function() {
            let response = await fetch(config.apiDeleteFile, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(data)
            });

            let result = await response.text();

            if (result === 'Ok') {
                config.searchDataPromise = dataPromise = renderTable();
            } else if (result === 'Error') {
                console.error('Error. Something went wrong!');
                console.log(result);
            } else {
                alert(result);
            }
        })();
    }
};

config.onDelete = deleteRow;
