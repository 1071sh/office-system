@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">案件情報(編集中)
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal1">
                        案件削除
                    </button>
                    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="label1">案件削除</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    本当にこの案件を削除しますか。
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                    <form style="display:inline" action="{{ route('project.destroy', $project->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('削除') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="/project/{{ $project->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">顧客名 </label>
                            <div class="col-md-6">
                                <select type="text" class="form-control" name="client">
                                    @foreach($clients as $client)
                                    <option value="{{ $client['id'] }}" @if($project->client_id ==$client['id']) selected @endif>{{ $client['name'] }}</option>
                        @endforeach
                        </select>
                </div>
            </div> --}}
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">案件名 <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$project->name) }}" placeholder="案件名を入力してください">
                </div>
            </div>
            <div class="form-group row">
                <label for="industry" class="col-md-4 col-form-label text-md-right">業界 <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <select name="industry" id="industry" class="form-control">
                        <option value="">選択してください</option>
                        @foreach($industries as $industry)
                        <option value="{{ $industry }}" @if($project->industry==$industry)selected @endif>{{$industry}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="start_date" class="col-md-4 col-form-label text-md-right">開始日 </label>
                <div class="col-md-6">
                    <input name="start_date" class="form-control" type="date" id="start_date" value="{{ $project->start_date }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="end_date" class="col-md-4 col-form-label text-md-right">終了日 </label>
                <div class="col-md-6">
                    <input name="end_date" class="form-control" type="date" id="end_date" value="{{ $project->end_date }}">
                </div>
            </div>
            {{-- <div class="form-group row">
                <label for="billing" class="col-md-4 col-form-label text-md-right">予算 <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <calc-component :value="{{ $project->billing }}"></calc-component>
        </div>
    </div> --}}
    <div class=" form-group row">
        <label class="col-md-4 col-form-label text-md-right">メンバー <span class="text-danger">*</span></label>
        <div class="col-md-6">
            {{-- @foreach($users as $user)
                                <input id="user{{$user['id']}}" type="checkbox" name="checkbox[]" value="{{$user['id']}}" {{ $user['id'] == old('checkbox') ? "checked" : '' }}>
            <label class="form-check-label" for="user{{$user['id']}}">{{$user['name']}}</label>
            @endforeach --}}
            <member-component users="{{ $users }}"></member-component>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-secondary" name='action' value='back'>
                戻る
            </button>
            <button type="submit" class="btn btn-primary" name='action' value='add'>
                編集終了
            </button>
        </div>
    </div>
    </form>
</div>
</div>
</div>
<div class="col-md-6">
    <div class="card">
        <div class="card-header">参加メンバー</div>
        <div class="card-body">
            <div class="form-group">
                <result-component></result-component>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection