document.addEventListener("DOMContentLoaded", function() {
    const table = document.getElementById("MembersTable");
    const regionButtons = document.querySelectorAll('.region-btn');
    const searchInput = document.getElementById('searchInput');
    let currentRegion = 'all';

    searchInput.addEventListener('input', function() {
        filterTable();
    });

    regionButtons.forEach(button => {
        button.addEventListener('click', function() {
            regionButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            currentRegion = this.getAttribute('data-region');
            filterTable();
        });
    });

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const rowRegion = row.getAttribute('data-region');
            const rowText = row.textContent.toLowerCase();
            const matchesSearch = searchTerm === '' || rowText.includes(searchTerm);
            const matchesRegion = currentRegion === 'all' || rowRegion === currentRegion;

            row.style.display = matchesSearch && matchesRegion ? '' : 'none';
        });
    }

    table.querySelectorAll("th").forEach((header, index) => {
        header.addEventListener("click", function() {
            sortTable(index);
        });
    });

    function sortTable(columnIndex) {
        let rows = Array.from(table.querySelectorAll('tbody tr'));
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
            let cellA = rowA.cells[columnIndex].textContent.toLowerCase();
            let cellB = rowB.cells[columnIndex].textContent.toLowerCase();

            if (isAscending) {
                return cellA.localeCompare(cellB);
            } else {
                return cellB.localeCompare(cellA);
            }
        });

        const tbody = table.querySelector('tbody');
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }

        rows.forEach(row => tbody.appendChild(row));
    }

    function confirmDelete() {
        return confirm("Are you sure you want to delete this member?");
    }
    
    function editMember(id_number) {
        window.location.href = `edit_member.php?id=${id_number}`;
    }
});