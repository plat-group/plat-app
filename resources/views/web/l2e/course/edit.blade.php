@extends('web.layout')
@section('title_page') Plats L2E - Edit course @stop
@section('content')
<div class="row">
    <div class="col-12">
        <x-alert/>
    </div>
    <x-form::open action="{{ route(STORE_COURSE_ROUTE) }}" files="true" id="create-l2e" class="form-default create_l2e has_validate">
    <div class="col-12 col-md-10 mx-md-auto inner-box bg-mauve-400 rounded-3 p-4 mb-4">
        <x-form::group label="Title of course">
            <x-form::input name="name" class="rounded-3 bg-white text-black required"
                           placeholder="Input learning course title" :value="$course->name"/>
        </x-form::group>
        <x-form::group label="Course description">
            <x-form::textarea name="description" :value="$course->description"
                              placeholder="Input learning course description" rows="7"
                              class="rounded-3 bg-white text-black required"/>
        </x-form::group>

        <x-forms.input type="hidden" name="id" value="{{ $course->id }}"/>

        <div class="d-grid gap-2 col-3 mx-auto">
            <button class="btn btn-success" type="submit">Update course</button>
        </div>
    </div>
    </x-form::open>
</div>
<div class="row">
    <div class="col-12 col-md-10 mx-md-auto">
        <a href="#" title="" class="btn btn-warning mb-3">
            + Add new lesson for course
        </a>

        @for ($i = 1; $i < 5; $i++)
        <div class="card text-white bg-mauve-400 mb-3">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">
                            Lesson {{ $i }}
                        </h5>
                        <p class="card-text">
                            Learner can get basic knowleage about NEAR and can create simple smart contract
                        </p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="https://via.placeholder.com/360x205" class="img-fluid w-100 rounded-end" alt="...">
                </div>

            </div>
        </div>
        @endfor
    </div>
</div>



@stop
@push('js')
    <script src="{{ mix('static/js/web/pages/l2e.js') }}" type="text/javascript"></script>
@endpush
