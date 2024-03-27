<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Http\Controllers\JWT\Token;
use App\Http\Requests\AddUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $access_token;
    public function __construct()
    {
        $this->access_token = new Token();
    }
    public function index()
    {

        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUserRequest $request)
    {
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $token = $this->access_token->token($users->name, $users->id, $users->email);
        return response()->json(['message' => 'created successful'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}