document.addEventListener("DOMContentLoaded", function() {
    const table = document.getElementById("MembersTable");
    const regionButtons = document.querySelectorAll('.region-btn');

    table.querySelectorAll("th").forEach((header, index) => {
        header.addEventListener("click", function() {
            sortTable(index);
        });
    });

    regionButtons.forEach(button => {
        button.addEventListener('click', function() {
            regionButtons.forEach(btn => btn.classList.remove('active'));
            
            this.classList.add('active');
            
            const selectedRegion = this.getAttribute('data-region');
            console.log(`Selected Region: ${selectedRegion}`);
            
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                if (selectedRegion === 'all') {
                    row.style.display = '';
                } else {
                    const rowRegion = row.getAttribute('data-region');
                    row.style.display = rowRegion === selectedRegion ? '' : 'none';
                }
            });
        });
    });

    function sortTable(columnIndex) {
        let rows = Array.from(table.rows).slice(1);
        let isAscending = true;
        let header = table.rows[0].cells[columnIndex];

        if (header.classList.contains("asc")) {
            isAscending = false;
            header.classList.remove("asc");
            header.classList.add("desc");
        } else {
            header.classList.remove("desc");
            header.classList.add("asc");
        }

        rows.sort((rowA, rowB) => {
            let cellA = rowA.cells[columnIndex].innerText.toLowerCase();
            let cellB = rowB.cells[columnIndex].innerText.toLowerCase();

            if (isAscending) {
                return cellA.localeCompare(cellB);
            } else {
                return cellB.localeCompare(cellA);
            }
        });
        rows.forEach(row => table.querySelector('tbody').appendChild(row));
    }
});