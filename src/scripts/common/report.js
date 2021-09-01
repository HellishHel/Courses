config.reportBtn && config.reportBtn.addEventListener('click', function() {
    config.searchDataPromise.then(async function(reportData) {
        let data = {};

        data.reportData = [];

        for (let i = 0; i < reportData.length; i++) {
            let obj = {};

            for (let key in reportData[i]) {
                if (reportData[i].hasOwnProperty(key)) {
                    if (Array.isArray(config.exceptFields) && config.exceptFields.includes(key)) {
                        continue;
                    }

                    obj[key] = reportData[i][key];
                }
            }

            data.reportData.push(obj);
        }

        data.methodName = config.methodName;
        data.fields = [];

        for (let i = 0; i < config.captions.length; i++) {
            data.fields.push({
                caption: config.captions[i].getAttribute('data-caption')
            });
        }

        let response = await fetch(config.apiReportFile, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(data)
        });
        
        let result = await response.json();

        if (+result.status === 1) {
            let win = window.open(result.path, '_blank');
            win.focus();
        } else {
            console.error('Something went wrong!');
        }
    });
});