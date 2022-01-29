<?php

namespace App\Services;

use App\Events\OrderConfirmedEvent;
use App\Events\OrderCreatedEvent;
use App\Repositories\GameTemplateRepository;
use App\Repositories\OrderRepository;
use App\Services\Concerns\BaseService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class OrderService extends BaseService
{

    /**
     * @var \App\Repositories\GameTemplateRepository
     */
    protected $gameTemplateRepo;

    /**
     * @param \App\Repositories\OrderRepository $repository
     * @param \App\Repositories\GameTemplateRepository $gameTemplateRepo
     */
    public function __construct(OrderRepository $repository, GameTemplateRepository $gameTemplateRepo)
    {
        $this->repository = $repository;
        $this->gameTemplateRepo = $gameTemplateRepo;
    }

    /**
     * Get all orders of client
     *
     * @param string $userId User Id
     *
     * @return mixed
     */
    public function clientOrders($userId)
    {
        return $this->repository->clientOrders($userId)->loadMissing('gameTemplate.creator');
    }

    /**
     * Get all orders of Creator
     *
     * @param string $userId User Id
     *
     * @return mixed
     */
    public function creatorOrders($userId)
    {
        return $this->repository->creatorOrders($userId)->loadMissing(['gameTemplate', 'client']);
    }

    /**
     * Create an order
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create(Request $request)
    {
        // Find game template
        $gameTemplate = $this->gameTemplateRepo->find($request->input('game_template_id'));

        //authorization user can create order
        $request->user()->can('order', $gameTemplate);

        // Create order from request
        $order = $this->repository->create(['client_id' => $request->user()->id] + $request->toArray());

        // Send alert
        $this->withSuccess(trans('message.created_order_game_template'));

        // Fire event
        OrderCreatedEvent::dispatch($order);

        return $order;
    }

    /**
     * Creator confirm request order game of client
     *
     * @return bool
     */
    public function confirm($creator, $orderId, $accepted = null)
    {
        $order = $this->repository->ofCreator($creator->id, $orderId);
        if (is_null($order) || $order->isFinished()) {
            abort(404);
        }

        // Update status of order
        $order->status = ($accepted) ? ACCEPTED_ORDER_STATUS : DENIED_ORDER_STATUS;
        $order->save();

        // Fire event
        OrderConfirmedEvent::dispatch($order, $accepted);

        return $this->withSuccess(trans('message.order_status_changed'));
    }

    /**
     * Creator confirm request order game of client
     *
     * @return bool
     */
    public function storeGame($orderId, Request $request)
    {
        $order = $this->repository->find($orderId);
        if (is_null($order) || $order->waitingConfirm()) {
            abort(404);
        }

        if ($request->hasFile('game_file')) {
            $order->game_file = $this->uploadGame($request->file('game_file'), $orderId);
        }

        if ($request->hasFile('resource_file')) {
            $order->resource_file = $this->uploadGame($request->file('resource_file'), $orderId);
        }
        $order->save();

        return $this->withSuccess(trans('message.creator_upload_game_success'));
    }

    /**
     * Upload game template
     *
     * @param \Illuminate\Http\UploadedFile $file
     */
    protected function uploadGame($file, $createId = null)
    {
        return Storage::putFile('game/' . $createId, $file);
    }

    /**
     * Upload game template
     *
     * @param \Illuminate\Http\UploadedFile $file
     */
    protected function uploadResource($file, $createId = null)
    {
        return Storage::putFile('game/' . $createId, $file);
    }
}
