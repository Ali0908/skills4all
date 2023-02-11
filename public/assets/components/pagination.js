    $(document).ready(function() {
        // Initialize variables
        var currentPage = 1;
        var itemsPerPage = 15;
        var totalPages;
    
        // Function to load data
        function loadData() {
        $.ajax({
            url: "http://localhost:8000/list",
            dataType: "json",
            success: function(data) {
            // Calculate total pages
            totalPages = Math.ceil(data.length / itemsPerPage);
    
            // Render data
            var startIndex = (currentPage - 1) * itemsPerPage;
            var endIndex = startIndex + itemsPerPage;
            var rows = "";
            for (var i = startIndex; i < endIndex; i++) {
                if (data[i]) {
                rows += "<tr><td>" + data[i].name + "</td><td>" + data[i].nbreSeats + "</td><td>" + data[i].nbreDoors + "</td><td>" + data[i].cost + "</td><td>" + data[i].category.name;
                }
            }
            $("#cars-table").html(rows);
    
            // Render pagination
            var pagination = "";
            for (var i = 1; i <= totalPages; i++) {
                var active = i == currentPage ? "active" : "";
                pagination += "<li class='page-item " + active + "'><a class='page-link' href='#' data-page='" + i + "'>" + i + "</a></li>";
            }
            $("#paginationContainer").html(pagination);
            }
        });
        }
    
        // Load data for the first time
        loadData();
    
        // Handle pagination click
        $("#paginationContainer").on("click", "a", function(e) {
        e.preventDefault();
        currentPage = $(this).data("page");
        loadData();
        });
    });
    