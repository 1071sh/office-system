@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">メンバー情報
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal1">
                        ユーザー削除
                    </button>
                    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="label1">ユーザー削除</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    本当にこのユーザーを削除しますか。
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                    <form style="display:inline" action="{{ route('user.destroy', $user->id) }}" method="post">
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
                    <form action="/user/{{ $user->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$user->name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email',$user->email) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="job_category" class="col-md-4 col-form-label text-md-right">職種</label>
                            <div class="col-md-6">
                                <select name="job_category" id="job_category" class="form-control">
                                    <option value="">選択してください</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category }}" @if($user->job_category == $category)selected @endif>
                                        {{$category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wage" class="col-md-4 col-form-label text-md-right">単価</label>
                            <div class="col-md-6">
                                <input id="wage" type="number" class="form-control" name="wage" value="{{ old('wage',$user->wage) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">雇用形態</label>
                            <div class="col-md-6">
                                <select name="status" id="status" class="form-control">
                                    <option value="">選択してください</option>
                                    @foreach($statuses as $status)
                                    <option value="{{ $status }}" @if($user->status==$status)selected @endif>{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-secondary" name='action' value='back'>
                                    戻る
                                </button>
                                <button type="submit" class="btn btn-primary" name='action' value='add'>
                                    変更する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection