@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">メンバー情報</div>
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
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">名前
                                <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="job_category" class="col-md-4 col-form-label text-md-right">職種</label>
                            <div class="col-md-6">
                                <select name="job_category" id="job_category" class="form-control">
                                    <option value="">選択してください</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category }}" @if(old('category')==$category)selected @endif>{{$category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wage" class="col-md-4 col-form-label text-md-right">単価 <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="wage" type="number" class="form-control" name="wage" value="{{ old('wage') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">雇用形態 <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <select name="status" id="status" class="form-control">
                                    <option value="">選択してください</option>
                                    @foreach($statuses as $status)
                                    <option value="{{ $status }}" @if(old('status')==$status)selected @endif>{{$status}}</option>
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
                                    追加
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