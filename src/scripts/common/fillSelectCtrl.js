config.selects.forEach(function (select) {
    const data = {
        methodName: select.getAttribute('data-select'),
        functionName: select.getAttribute('data-function')
    };

    fetch(config.apiGetFile, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(function(data) {
            data.forEach(function (item) {
                const textNode = document.createTextNode(item['name']);
                const optionNode = document.createElement('option');
                optionNode.value = item['id'];

                optionNode.appendChild(textNode);
                select.appendChild(optionNode);
            });

            return data;
        })
        .catch(error => console.error(error));
});