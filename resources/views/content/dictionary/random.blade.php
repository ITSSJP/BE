@section('content')
    <div class="daily-words-container">
        <!-- Header with "Daily Words" and Refresh Icon Button -->
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Từ vựng mỗi ngày</h2>
            <button id="refresh-button" class="btn btn-link p-0" title="Refresh">
                <i class="bi bi-arrow-repeat" style="font-size: 1.5rem;"></i>
            </button>
        </div>

        <!-- Table-like structure for the words -->
        <div class="container">
            <div class="table">
                <div class="row word-row" id="word1">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 word-ja"></div>
                            <div class="col-6 word-vie"></div>
                        </div>
                    </div>
                </div>
                <div class="row word-row" id="word2">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 word-ja"></div>
                            <div class="col-6 word-vie"></div>
                        </div>
                    </div>
                </div>
                <div class="row word-row" id="word3">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 word-ja"></div>
                            <div class="col-6 word-vie"></div>
                        </div>
                    </div>
                </div>
                <div class="row word-row" id="word4">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 word-ja"></div>
                            <div class="col-6 word-vie"></div>
                        </div>
                    </div>
                </div>
                <div class="row word-row" id="word5">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 word-ja"></div>
                            <div class="col-6 word-vie"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to load random words
        function loadRandomWords() {
            $.ajax({
                url: "{{ route('dictionary.random') }}",  // Correct route helper syntax
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    // Iterate through the 5 words and insert into the rows
                    response.forEach(function (word, index) {
                        let row = $(`#word${index + 1}`);
                        row.find('.word-ja').html(
                            `${word.ja} ${word.furigana ? `<small class="text-muted">(${word.furigana})</small>` : ''}`
                        );
                        row.find('.word-vie').text(word.vie);
                    });
                },
                error: function (xhr) {
                    alert('Failed to fetch daily words.');
                }
            });
        }

        // Initially load words on page load
        loadRandomWords();

        // Refresh button click event
        $('#refresh-button').on('click', function() {
            loadRandomWords();  // Refresh words when the button is clicked
        });
    </script>

    <style>
        /* Table-like look with bottom borders */
        .table {
            border-bottom: 1px solid #ddd;
        }

        .word-row {
            padding: 10px 0;
            border-bottom: 1px solid #ddd; /* Border only on the bottom */
        }

        .word-ja {
            font-weight: bold;
            font-size: 1.2rem;
            color: #ED1F26;
        }

        .word-vie {
            font-size: 1rem;
            color: #666;
        }

        /* Styling for the refresh button and header */
        .header {
            margin-bottom: 20px;
        }

        .header h2 {
            margin-bottom: 0;
        }

        .header button {
            margin-left: 10px;
        }

        .bi-arrow-repeat {
            cursor: pointer;
        }
    </style>
@endsection
