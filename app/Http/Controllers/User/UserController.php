<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\backend\Master\Bagian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        $bagians          = Bagian::all();

        return view('backend.user.index', ['users' => $users, 'bagians' => $bagians ]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), User::rules());

        if($validator->fails())
        {
            return redirect()->route('user.index')->withErrors($validator)->withInput();
        }

        $user = new User();

        $user->name      = $request->name;

        $user->username      = $request->username;

        $user->email      = $request->email;

        $user->password = \Hash::make($request->password);

        $user->bagian_id      = $request->bagian_id;

        $user->save();

        \Session::flash('success', trans('backend/user.store.messages.success'));

        return redirect()->route('user.index')->withInput();
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), User::rules());

        if($validator->fails())
        {
            return redirect()->route('bagian.index')->withErrors($validator)->withInput();
        }

        $user = User::find($id);

        $user->name      = $request->name;

        $user->username      = $request->username;

        $user->email      = $request->email;

        $user->bagian_id      = $request->bagian_id;

        $user->save();

        \Session::flash('success', trans('backend/user.update.messages.success'));

        return redirect()->route('user.index')->withInput();
    }

    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/user.destroy.messages.info'));

            return redirect()->route('user.index');
        }

        User::destroy($id);
        \Session::flash('success', trans('backend/user.destroy.messages.success'));

        return redirect()->route('user.index');
    }

    public function search(Request $request)
    {
        $users = User::orderBy('users.created_at', 'desc')
            ->join('bagian', 'bagian.id', '=', 'users.bagian_id')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);

        $bagians          = Bagian::all();

        return view('backend.user.index', ['users' => $users, 'bagians' => $bagians ]);
    }

}