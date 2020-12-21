@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">メンバー一覧
                    @can('system-only')
                    <a class="btn btn-primary" href="{{ route('user.create') }}" role="button">ユーザー追加</a>
                    @endcan
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif
                    @if (session('alert'))
                    <div class="alert alert-danger" role="alert">{{ session('alert') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-nowrap">ID</th>
                                    <th scope="col" class="text-nowrap">名前</th>
                                    <th scope="col" class="text-nowrap">メールアドレス</th>
                                    <th scope="col" class="text-nowrap">職種</th>
                                    <th scope="col" class="text-nowrap">単価</th>
                                    <th scope="col" class="text-nowrap">雇用形態</th>
                                    @can('system-only')
                                    <th scope="col" class="text-nowrap">&nbsp;</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="text-nowrap">{{ $user->id }}</td>
                                    <td class="text-nowrap">{{ $user->name }}</td>
                                    <td class="text-nowrap">{{ $user->email }}</td>
                                    <td class="text-nowrap">{{ $user->job_category }}</td>
                                    <td class="text-nowrap">
                                        @isset ($user->wage)
                                        {{$user->wage}}万円
                                        @endisset
                                    </td>
                                    <td class="text-nowrap">{{ $user->status }}</td>
                                    @can('system-only')
                                    <td class="text-nowrap"><a class="btn btn-outline-primary" href="{{ route('user.edit', $user->id) }}">編集</a></td>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection