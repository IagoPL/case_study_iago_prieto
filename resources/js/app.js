document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('proceduresTable');
    const rows = table.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function(e) {
        const term = e.target.value.toLowerCase();
        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            const rowData = row.textContent.toLowerCase();
            row.style.display = rowData.indexOf(term) > -1 ? '' : 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    alert('JavaScript está funcionando correctamente');
});