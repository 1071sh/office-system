@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">案件情報</div>
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
                    <form action="{{ route('project.store') }}" method="POST">
                        @csrf
                        {{-- <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">顧客名 </label>
                            <div class="col-md-6">
                                <select type="text" class="form-control" name="client">
                                    @foreach($clients as $client)
                                    <option value="{{ $client['id'] }}">{{ $client['name'] }}</option>
                        @endforeach
                        </select>
                </div>
            </div> --}}
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">案件名 <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="案件名を入力してください">
                </div>
            </div>
            <div class="form-group row">
                <label for="industry" class="col-md-4 col-form-label text-md-right">業界 </label>
                <div class="col-md-6">
                    <select name="industry" id="industry" class="form-control">
                        <option value="">選択してください</option>
                        @foreach($industries as $industry)
                        <option value="{{ $industry }}" @if(old('industry')==$industry)selected @endif>{{$industry}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="start_date" class="col-md-4 col-form-label text-md-right">開始日 </label>
                <div class="col-md-6">
                    <input name="start_date" class="form-control" type="date" id="start_date" value="{{ old('start_date') }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="end_date" class="col-md-4 col-form-label text-md-right">終了日 </label>
                <div class="col-md-6">
                    <input name="end_date" class="form-control" type="date" id="end_date" value="{{ old('end_date') }}">
                </div>
            </div>
            {{-- <div class="form-group row">
                <label for="billing" class="col-md-4 col-form-label text-md-right">予算 <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input id="billing" type="number" class="form-control" name="billing" value="{{ old('billing') }}">
        </div>
    </div> --}}
    <div class="form-group row">
        <label for="notes" class="col-md-4 col-form-label text-md-right">メモ </label>
        <div class="col-md-6">
            <textarea id="notes" class="form-control" name="notes">{{ old('notes') }}</textarea>
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