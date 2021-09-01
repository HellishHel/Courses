const table = document.getElementById('mainTable');

table.addEventListener('afterRender', function (event) {
    const rows = table.querySelectorAll('tbody tr');

    for (let i = 0; i < rows.length; i++) {
        if (event.data[i].is_lost == 0) {
           rows[i].querySelectorAll('td').forEach(function(td) {
               td.style.backgroundColor = '#ccc';
               td.style.textDecoration = 'line-through';
           });
        }
    }
});