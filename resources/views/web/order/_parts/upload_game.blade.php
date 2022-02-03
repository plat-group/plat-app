@if($order->status != FINISH_ORDER_STATUS)
    <div>Release to Client</div>
    <div class="box-order-game mt-5">
        <div class="inner-box bg-mauve-400 rounded-3 px-4 pt-3 pb-5">
            <x-form::open action="{{ route(ORDER_STORE_GAME_ROUTE, $order->id) }}" enctype="multipart/form-data" files="true" id="sdsadsd" class="create_new_game has_validate">
            <input type="hidden" name="order_id" value="{{$order->id}}">
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
                        <input class="form-control" type="file" name="resource_file" id="fileResource" accept="image/*,.zip">
                    </div>
                </div>
            </div>
            <div class="row mt-3 mt-md-5">
                <div class="col-md-3 mx-auto d-grid">
                    <button type="submit" class="btn btn-red-pink btn-lg">
                        {{ trans('web.btn_upload_game') }}
                    </button>
                </div>
            </div>
            </x-form::open>
        </div>
    </div>
@endif
