<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = config('job_categories');
        $statuses   = config('statuses');
        return view('user.create')->with([
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get('action') === 'back') {
            return redirect()->route('user.index');
        } else {
            $rules = [
                'name'       => ['required'],
                'wage' => ['required','integer'],
                'status'     => ['required'],
            ];
            $this->validate($request, $rules);
            $user = new User;
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->job_category = $request->job_category;
            $user->wage   = $request->wage;
            $user->status       = $request->status;
            $user->save();
            session()->flash('success', 'ユーザー追加が完了しました');
            return redirect()->route('user.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $categories = config('job_categories');
        $statuses   = config('statuses');
        return view('user.edit')->with([
            'user' => $user,
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->action === 'back') {
            return redirect()->route('user.index');
        } else {
            $user = User::find($id);
            $user->name        = $request->name;
            $user->email       = $request->email;
            $user->job_category  = $request->job_category;
            $user->wage  = $request->wage;
            $user->status      = $request->status;
            $user->save();
            session()->flash('success', '編集が完了しました');
            return redirect()->route('user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->is_workable = 5;   // 退職済みに変更
        $user->save();
        $user->delete();
        session()->flash('alert', 'ユーザーを削除しました');
        return redirect()->route('user.index');
    }
}
