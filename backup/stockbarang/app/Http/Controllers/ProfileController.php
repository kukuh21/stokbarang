<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use JsValidator;

class ProfileController extends Controller
{
    public function index()
    {
        $userid = auth()->user()->user_id;
        $user = \App\User::findOrFail($userid);
        return view('userupdate.user_index',[
            'user' => $user,
            'JsValidator' => JsValidator::make($this->rulesCreate())
        ]);
    }

    public function rulesCreate()
    {
      return [
          'nama' => 'required',
          'username' => 'required',
          'nohp' => 'required',
          'alamat' => 'required'
      ];
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, $this->rulesCreate());

        $user = \App\User::findOrFail($id);
        $user->nama = $request->get('nama');
        $user->username = $request->get('username');
        $user->alamat = $request->get('alamat');
        $user->nohp = $request->get('nohp');

        if($request->password) {
            $user->password = \Hash::make($request->get('password'));
        }

        if ($request->hasFile('avatar')) {
            if($user->avatar != null) {
                File::delete('images/avatar/'.$user->avatar);
            }

            $file = $request->username . '-' . 'avatar.' . $request->avatar->getClientOriginalExtension();
            $filename = $request->file('avatar');
            $filename->move('images/avatar', $file);

            $user->avatar = $file;
        }


        $user->save();
        return redirect()->route('profile.index')->with('status', 'User Berhasil Diupdate');
    }
}
