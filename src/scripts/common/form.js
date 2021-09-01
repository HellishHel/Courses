const showHideAddForm = function(isShow, callback) {
    if (config.addBtn) {
        config.addBtn.style.display = isShow === true ? 'none' : 'block';
    }
    if (config.addForm) {
        config.addForm.style.display = isShow === true ? 'block' : 'none';
    }

    if (typeof callback === 'function') {
        callback();
    }
};

const changeFormStatus = function(caption, type) {
    if (config.postBtn) {
        config.postBtn.innerHTML = caption;
        config.postBtn.setAttribute('data-type', type);
    }

    // if (type === 'insert') {
    //     config.inputs.forEach(function (ctrl) {
    //         ctrl.value = '';
    //     })
    // }
};

config.addBtn && config.addBtn.addEventListener('click', function(event) {
    event.preventDefault();
    showHideAddForm(true);
});

config.cancelBtn && config.cancelBtn.addEventListener('click', function(event) {
    event.preventDefault();

    showHideAddForm(false, changeFormStatus.bind(this, 'Добавить', 'insert'));

    document.querySelectorAll('input, select').forEach(function(node) {
        node.value = '';
    });
});

showHideAddForm(false, changeFormStatus.bind(null, 'Добавить', 'insert'));
