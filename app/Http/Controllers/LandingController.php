<?php

namespace App\Http\Controllers;

use App\Http\Requests\KtaRequest;
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
