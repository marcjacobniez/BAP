document.addEventListener("DOMContentLoaded", function() {
    const table = document.getElementById("MembersTable");
    table.querySelectorAll("th").forEach((header, index) => {
        header.addEventListener("click", function() {
            sortTable(index);
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
        rows.forEach(row => table.appendChild(row));
    }
});
