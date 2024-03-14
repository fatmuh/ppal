<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
    ) {}

    public function tabulator(Request $request): UserCollection | AnonymousResourceCollection
    {
        $result = $this->userService->fetchTabulator($request);

        return UserCollection::collection($result->data)
                ->additional([
                    'last_page' => $result->data->lastPage(),
                    'last_row'  => $result->data->total(),
                ]);
    }

    public function list(): View
    {
        return view('pages.users.index');
    }

    public function detail($id): JsonResource
    {
        $result = $this->userService->findUser(id: $id);

        return (new UserCollection($result->data));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $result = $this->userService->saveUser(request: $request);

        if ($result->code == Response::HTTP_OK) {
            return redirect()->route('user.list')->with('success-message', $result->message);
        }

        return redirect()->route('user.list')->with('error-message', $result->message);
    }

    public function update(UserRequest $request, $id): RedirectResponse
    {
        $result = $this->userService->updateUser(request: $request, id: $id);

        if ($result->code == Response::HTTP_OK) {
            return redirect()->route('user.list')->with('success-message', $result->message);
        }

        return redirect()->route('user.list')->with('error-message', $result->message);
    }

    public function delete($id): RedirectResponse
    {
        $result = $this->userService->deleteUser(id: $id);

        if ($result->code == Response::HTTP_OK) {
            return redirect()->route('user.list')->with('success-message', $result->message);
        }

        return redirect()->route('user.list')->with('error-message', $result->message);
    }
}
