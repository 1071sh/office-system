<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\User;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->paginate(10);
        return view('project.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::select('id', 'name', 'wage')->get();
        $clients = Client::select('id', 'name')->get();
        $industries = config('industries');
        return view('project.create')->with([
            'users' => $users,
            'clients' => $clients,
            'industries' => $industries
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
            return redirect()->route('project.index');
        } else {
            $rules = [
                'name'       => ['required'],
                'billing'    => ['required','numeric'],
            ];
            $this->validate($request, $rules);
            $project = new Project;
            $project->name        = $request->name;
            $project->industry    = $request->industry;
            $project->client_id   = $request->client;
            $project->start_date  = $request->start_date;
            $project->end_date    = $request->end_date ;
            $project->billing     = $request->billing;
            $project->notes       = $request->notes;
            $project->save();
            session()->flash('success', '案件追加が完了しました');
            return redirect()->route('project.index');
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
        $users = User::select('id', 'name', 'wage')->get();
        $project = Project::find($id);
        $clients = Client::all();
        $industries = config('industries');
        return view('project.edit')->with([
            'project' => $project,
            'users' => $users,
            'clients' => $clients,
            'industries' => $industries
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
            return redirect()->route('project.index');
        } else {
            $rules = [
                'checkbox'    => ['required'],
            ];
            $this->validate($request, $rules);
            $project = Project::find($id);
            $project->name        = $request->name;
            $project->client_id   = $request->client;
            $project->billing     = $request->billing;
            $project->save();


            // 中間テーブルに保存
            $exists = DB::table('project_user')->where('project_id', '=', $project->id)->exists();
            foreach ($request->checkbox as $value) {
                if ($exists) {
                    if ($value) {
                        $project->users()->detach();
                        $project->users()->sync(
                            ['user_id' => $value],
                            ['project_id' => $project->id],
                        );
                    } else {
                        $project->users()->detach();
                    }
                } else {
                    //DBにない場合は追加
                    $project->users()->attach(
                        ['user_id' => $value],
                        ['project_id' => $project->id],
                    );
                }
            }

            // 更新する
            session()->flash('success', '編集が完了しました');
            return redirect()->route('project.index');
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
        $project = Project::find($id);
        $project->is_deleted = true;   // 削除済みに変更
        $project->save();
        $project->delete();
        DB::table('project_user')->where('project_id', '=', $project->id)->delete(); // 中間テーブル削除
        session()->flash('alert', '案件を削除しました');
        return redirect()->route('project.index');
    }
}
