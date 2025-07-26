<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoryResource;
use App\Http\Services\GameService;
use App\Http\Services\HistoryService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(private readonly GameService $gameService)
    {
    }

    public function index()
    {
        return view('pages.dashboard.index');
    }

    public function play(Request $request)
    {
        $userHistoryService = new HistoryService(token: $request->query('token'));

        $result = $this->gameService->play();
        $gameResult = $userHistoryService->createHistoryRecord($result);

        return view('pages.dashboard.index', compact('gameResult'));
    }

    public function history(Request $request)
    {
        $userHistoryService = new HistoryService(token: $request->query('token'));

        $history = $userHistoryService->getLastestHistoryRecords();

        return view('pages.dashboard.index', compact('history'));

    }

}
