<div class="card text-white bg-primary-2 mb-3">
    <div class="row g-0">
        <div class="col-md-8 p-4">
            <div class="row h-100">
                <div class="col-12 lesson-content">
                    <h5 class="fw-bold">
                        {{ $lesson->name }}
                    </h5>
                    <div class="lesson-desc">
                        {{ $lesson->description }}
                    </div>
                </div>
                <div class="col-12 lesson-actions mt-auto">
                    <a href="{{ route(DETAIL_LESSON_ROUTE, $lesson->id) }}" class="btn btn-primary" title="{{ $lesson->name }}">
                        Learn to earn
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <img src="{{ $lesson->thumb_url }}" class="img-fluid w-100 rounded-end" alt="{{ $lesson->name }}">
        </div>
    </div>
</div>
