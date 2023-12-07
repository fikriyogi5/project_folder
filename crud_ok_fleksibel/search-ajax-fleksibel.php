<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial Page</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <header>
        <h1>Tutorial Page</h1>
    </header>

    <main>
        <!-- Tutorial content goes here -->
        <section id="tutorialContent">
            <h2>Welcome to the Tutorial</h2>
            <p>This is the introductory section of the tutorial.</p>
        </section>

        <!-- Search form -->
        <section id="searchSection">
            <h2>Search</h2>
            <form id="searchForm">
                <label for="searchName">Name:</label>
                <input type="text" id="searchName" name="searchName">

                <label for="searchCategory">Category:</label>
                <input type="text" id="searchCategory" name="searchCategory">

                <label for="searchType">Type:</label>
                <input type="text" id="searchType" name="searchType">

                <label for="searchDate">Date:</label>
                <input type="text" id="searchDate" name="searchDate">

                <button type="submit">Search</button>
            </form>
        </section>

        <!-- Search results section -->
        <section id="searchResultsSection">
            <h2>Search Results</h2>
            <div id="searchResults">
                <!-- Search results will be dynamically loaded here -->
            </div>
        </section>

        <!-- Comments section -->
        <section id="commentsSection">
            <h2>Comments</h2>
            <div id="commentsList">
                <!-- Comments will be dynamically loaded here -->
            </div>

            <!-- Add a form to submit comments -->
            <form id="commentForm">
                <label for="comment">Add your comment:</label>
                <textarea id="comment" name="comment" required></textarea>
                <button type="submit">Submit Comment</button>
            </form>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            

            // Function to display search results
            function displaySearchResults(results) {
                var searchResults = $('#searchResults');
                searchResults.empty();

                // Display search results dynamically
                results.forEach(function(result) {
                    searchResults.append('<div>' + result.nama + ' - ' + result.nik + ' - ' + result.status + ' - ' + result.tanggal_lahir + '</div>');
                });
            }


            // Submit search form with AJAX
            $('#searchForm').submit(function(event) {
                event.preventDefault();

                // Get search criteria from the form
                var searchName = $('#searchName').val();
                var searchCategory = $('#searchCategory').val();
                var searchType = $('#searchType').val();
                var searchDate = $('#searchDate').val();

                // Send AJAX request to fetch search results
                $.ajax({
                    type: 'POST',
                    url: 'search-ajax-fleksibel-server.php', // Replace with your PHP script handling the search
                    data: {
                        name: searchName,
                        category: searchCategory,
                        type: searchType,
                        date: searchDate
                    },
                    success: function(response) {
                        // Parse the JSON response
                        var results = JSON.parse(response);

                        // Display search results
                        displaySearchResults(results);
                    },
                    error: function() {
                        alert('Error fetching search results');
                    }
                });
            });
        });

    </script>
</body>
</html>
