<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class Transaction extends Controller
{
    /**
     * @var \App\Services\TransactionService
     */
    protected $transactionService;

    /**
     * @param \App\Services\TransactionService $transactionService
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Show list transaction
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $transactions = $this->transactionService->getTransactions($request->user()->id)->loadMissing('campaign.game');
        $totalEarned = $transactions->sum('amount');

        return view('web.income.history', compact('totalEarned', 'transactions'));
    }

}
