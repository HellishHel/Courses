config.searchDataPromise = dataPromise;

config.searchInput.addEventListener('keyup', function(event) {
    event.preventDefault();

    dataPromise.then(function(data) {
        config.searchDataPromise = renderTable(data, event.target.value);
    });
});
