<?php

namespace App\Http\Controllers;

use App\Http\Requests\KtaRequest;
use App\Http\Resources\KtaCollection;
use App\Services\KtaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\View\View;

class KtaController extends Controller
{
    public function __construct(
        protected KtaService $ktaService,
    ) {}

    public function tabulator(Request $request): KtaCollection | AnonymousResourceCollection
    {
        $result = $this->ktaService->fetchTabulator($request);

        return KtaCollection::collection($result->data)
                ->additional([
                    'last_page' => $result->data->lastPage(),
                    'last_row'  => $result->data->total(),
                ]);
    }

    public function list(): View
    {
        return view('pages.kta.index');
    }

    public function detail($id): JsonResource
    {
        $result = $this->ktaService->findKta(id: $id);

        return (new KtaCollection($result->data));
    }

    public function front($id): View
    {
        $result = $this->ktaService->findKta(id: $id);

        return view('pages.kta.modals._front', [
            'data' => $result->data
        ]);
    }

    public function back($id): View
    {
        $result = $this->ktaService->findKta(id: $id);

        return view('pages.kta.modals._back', [
            'data' => $result->data
        ]);
    }

    public function store(KtaRequest $request): RedirectResponse
    {
        $result = $this->ktaService->saveKta(request: $request);

        if ($result->code == Response::HTTP_OK) {
            return redirect()->route('kta.list')->with('success-message', $result->message);
        }

        return redirect()->route('kta.list')->with('error-message', $result->message);
    }

    public function update(KtaRequest $request, $id): RedirectResponse
    {
        $result = $this->ktaService->updateKta(request: $request, id: $id);

        if ($result->code == Response::HTTP_OK) {
            return redirect()->route('kta.list')->with('success-message', $result->message);
        }

        return redirect()->route('kta.list')->with('error-message', $result->message);
    }

    public function delete($id): RedirectResponse
    {
        $result = $this->ktaService->deleteKta(id: $id);

        if ($result->code == Response::HTTP_OK) {
            return redirect()->route('kta.list')->with('success-message', $result->message);
        }

        return redirect()->route('kta.list')->with('error-message', $result->message);
    }
}
