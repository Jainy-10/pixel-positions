<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(Request $request)
    {
        return view('users.edit', [
            'user' => $request->user()
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => ['string', 'min:3'],
            'last_name' => ['string', 'min:3']
        ]);

        $request->user()->update($validatedData);

        return redirect('/')->with('success', 'Profile Updated Successfully');
    }
}
