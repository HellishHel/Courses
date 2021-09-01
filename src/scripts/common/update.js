const updateRow = function(event) {
    let rowId = event.target.getAttribute('data-id') || event.target.parentNode.getAttribute('data-id');

    showHideAddForm(true, function() {
        dataPromise.then(function(data) {
            data.forEach(function(row) {
                if (+row['id'] === +rowId) {
                    document.querySelectorAll('[data-input="inputCtrl"]').forEach(function(inputCtrl) {
                        let name = inputCtrl.getAttribute('name');

                        if (name && row[name]) {
                            document.querySelector('[name="' + name + '"]').value = row[name];
                        }
                    });
                }
            });

            changeFormStatus('Редактировать', 'update');
            config.postBtn.setAttribute('data-id', rowId) // formPosition.js
        });
    });
};

config.onUpdate = updateRow;
