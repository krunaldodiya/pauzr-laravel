<?php

namespace App\Http\Controllers;

use App\Http\Resources\MeResource;
use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(Request $request)
    {
        $data = User::create($request->all());

        return $data->wasRecentlyCreated ? User::find($data->id) : $data;
    }

    public function me(Request $request)
    {
        $user = $this->userRepository->getUserById(auth()->user()->id);

        return new MeResource($user);
    }
}
