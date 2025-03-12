window.filterTable = function() {
    // Get the input value (search query)
    var filter = document.getElementById("searchInput").value.toLowerCase();
    var table = document.getElementById("adminTable");
    var rows = table.getElementsByTagName("tr");  // Get all rows in the table

    // Log the search query for debugging
    console.log("Search query: ", filter);

    // Loop through each row (starting from index 1 to skip the header row)
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");  // Get all cells in the row
        var usernameCell = cells[0];  // The first cell contains the username

        // If the username cell exists, perform the filter check
        if (usernameCell) {
            var usernameText = usernameCell.textContent || usernameCell.innerText;

            // If the username doesn't match the filter, hide the row; otherwise, show it
            if (usernameText.toLowerCase().indexOf(filter) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
};
