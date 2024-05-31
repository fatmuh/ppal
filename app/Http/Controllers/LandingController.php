<?php

namespace App\Http\Controllers;

use App\Http\Requests\KtaRequest;
use App\Http\Requests\SearchRequest;
use App\Services\KtaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function __construct(
        protected KtaService $ktaService,
    ) {}
    
    public function index(): View
    {
        return view('landing.index');
    }
    
    public function search(): View
    {
        return view('landing.search');
    }

    public function detail(SearchRequest $request): View
    {
        $search = $request->query('search');
        $result = $this->ktaService->getDataKta($search);

        return view('landing.detail', $result);
    }  

    public function update(KtaRequest $request, $id)
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $result = $this->ktaService->updateKtaLanding(request: $request, id: $id);

        if ($result->code == Response::HTTP_OK) {
            return redirect()->back()->with('success-message', $result->message);
        }

        return redirect()->back()->with('error-message', $result->message);
    }

    public function store(KtaRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $result = $this->ktaService->saveKta(request: $request);

        if ($result->code == Response::HTTP_OK) {
            return redirect()->route('landing.index')->with('success-message', $result->message);
        }

        return redirect()->route('landing.index')->with('error-message', $result->message);
    }
}
