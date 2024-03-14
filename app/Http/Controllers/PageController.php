<?php

namespace App\Http\Controllers;

use App\Services\PageService;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(
        protected PageService $pageService,
    ) {}
    /**
     * Show specified view.
     *
     */
    public function dashboard(): View
    {
        $data = $this->pageService->getData();
        return view('pages.dashboard.index', $data);
    }
}
