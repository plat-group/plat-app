<div class="box-order-game mt-5">
    <div class="inner-box bg-mauve-400 rounded-3 px-4 pt-3 pb-5">
        <div>Release to Client</div>
        <x-alert/>
        <x-form::open action="{{ route(STORE_TEMPLATE_GAME_ROUTE) }}" files="true" id="sdsadsd" class="create_new_game has_validate">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="box-upload upload-file rounded-3">
                    <label for="fileGame" class="form-label align-self-center h4 cursor-pointer">
                        {{ trans('web.upload_game_file') }}
                    </label>
                    <input class="form-control" type="file" name="game_file" id="fileGame">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="box-upload upload-file rounded-3">
                    <label for="fileResource" class="form-label align-self-center h4 cursor-pointer">
                        {{ trans('web.upload_resource_file') }}
                    </label>
                    <input class="form-control" type="file" name="resource_file" id="fileResource">
                </div>
            </div>
        </div>
        <div class="row mt-3 mt-md-5">
            <div class="col-md-3 mx-auto d-grid">
                <button type="submit" class="btn btn-red-pink btn-lg">
                    {{ trans('web.btn_create_game') }}
                </button>
            </div>
        </div>
        </x-form::open>
    </div>
</div>
