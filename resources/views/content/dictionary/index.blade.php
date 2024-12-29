@extends('layouts.commonLayout')

@section('styles')
    <style>
        /* Styling for Search Bar */
        #searchBar {
            width: 100%; 
            padding: 10px 0; 
            border: none;
            border-bottom: 1px solid gray;
            outline: none;
            font-size: 16px; 
            background-color: transparent; 
            border-radius: 0;
        }

        #searchBar:focus {
            border-bottom: 2px solid #2D3A4D; 
        }

        /* Remove any focus, hover, or input effects */
        #searchBar:focus, #searchBar:hover, #searchBar:active {
            background-color: transparent; 
            box-shadow: none; 
        }

        /
        #searchBar::placeholder {
            color: #aaa; 
            opacity: 1;
        }
        /* Custom Card Styling */
        .card {
            border: none; /* Remove all borders */
            border-radius: 0; /* Remove card border radius */
            box-shadow: none; /* Remove card shadow */
        }

        .card-body {
            padding: 20px;
            border-bottom: 1px solid gray; /* Bottom border for both ja and vie */
        }

        .card-title {
            margin-bottom: 10px;
        }

        .card-text {
            padding-top: 10px;
        }
        .word-ja{
            color: #ED1F26;
        }


        /* Custom Styling for Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .pagination .page-item {
            margin: 0 5px;
        }

        .pagination .page-link {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 16px;
            color: #000000; /* Change the default pagination number color */
        }

        /* Active Page Styling */
        .pagination .page-item.active .page-link {
            background-color: #2D3A4D; /* Active page background */
            color: white; /* Active page text color */
            border-color: #2D3A4D;
        }

        /* Disabled Page Styling */
        .pagination .page-item.disabled .page-link {
            color: #ccc;
        }

        /* Hover effect for pagination links */
        .pagination .page-link:hover {
            background-color:#2D3A4D; /* Hover background */
            color: white;
            border-color:#2D3A4D; /* Hover border */
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4">
        <h2>Từ điển</h2>
        
        <!-- Single Search Bar -->
        <div class="row mb-4">
            <div class="col-md-12">
                <input type="text" class="form-control" id="searchBar" placeholder="Search by Japanese, Vietnamese, or Furigana">
            </div>
        </div>

        <!-- Từ điển -->
        <div class="row">
            @foreach ($words as $word)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- Check if there is furigana -->
                            <h5 class="card-title">
                                @if ($word->furigana)
                                    <span class="word-ja">{{ $word->ja }}</span><small class="text-muted">({{ $word->furigana }})</small>
                                @else
                                    <span class="word-ja">{{ $word->ja }}</span>
                                @endif
                            </h5>
                            <p class="card-text">{{ $word->vie }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item {{ $words->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $words->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <!-- Page Number Links -->
                    @foreach ($words->getUrlRange(1, $words->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $words->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    <!-- Next Page Link -->
                    <li class="page-item {{ $words->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $words->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection

