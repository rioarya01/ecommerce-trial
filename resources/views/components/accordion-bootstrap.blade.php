<div class="accordion" id="{{ $id }}">
    @foreach($items as $index => $item)
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="true" aria-controls="collapse{{ $index }}">
                    {{ $item['title'] }}
                </button>
            </h2>
            <div id="collapse{{ $index }}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="{{ $id }}">
                <div class="accordion-body">
                    {{ $item['body'] }}
                </div>
            </div>
        </div>
    @endforeach
</div>