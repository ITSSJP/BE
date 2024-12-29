<div class="col-md-6 mb-4">
    <div class="card">
        <div class="card-body">
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
