if (!table) {
    const table = document.getElementById('mainTable');
}

table.addEventListener('afterRender', function (event) {
    const rows = table.querySelectorAll('tbody tr');

    for (let i = 0; i < rows.length; i++) {
        const link = rows[i].querySelectorAll('td')[1];

        if (link) {
            const linkText = link.textContent;
            link.innerHTML = '<a href="' + linkText + '" target="_blank">' + linkText + '</a>';
        }
    }
});
