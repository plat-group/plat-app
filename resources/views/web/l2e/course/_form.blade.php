<x-form::open action="{{ route(STORE_COURSE_ROUTE) }}" files="true" id="create-l2e" class="form-default create_l2e has_validate">
    <x-forms.input type="hidden" name="id" value="{{ old('id', 0) }}"/>
    <x-form::group label="Title of course">
        <x-form::input name="name" class="rounded-3 bg-white text-black required"
                       placeholder="Input learning course title" :value="old('name')"/>
    </x-form::group>
    <x-form::group label="Course description">
        <x-form::textarea name="description" :value="old('description')"
                          placeholder="Input learning course description" rows="7"
                          class="rounded-3 bg-white text-black required"/>
    </x-form::group>
    <div class="box-upload upload-file rounded-3">
        <label for="thumbnail" class="form-label align-self-center cursor-pointer">
            Thumbnail
        </label>
        <input class="form-control" type="file" name="thumbnail" id="thumbnail">
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-3">
            <a href="{{ route(MY_COURSE_ROUTE) }}" class="btn btn-outline-info w-100">
                Back to my courses
            </a>
        </div>
        <div class="col-md-3">
            <button class="btn btn-success w-100" type="submit">
                {{ old('id') ? 'Update course' : 'Save' }}
            </button>
        </div>
    </div>
</x-form::open>
