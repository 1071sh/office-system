@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">プロジェクト一覧
                    @can('system-only')
                    <a class="btn btn-success" href="{{ route('project.create') }}" role="button">案件登録</a>
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
                                    <th scope="col" class="text-nowrap">案件名</th>
                                    <th scope="col" class="text-nowrap">業界</th>
                                    <th scope="col" class="text-nowrap">開始日</th>
                                    <th scope="col" class="text-nowrap">終了日</th>
                                    {{-- <th scope="col" class="text-nowrap">予算</th> --}}
                                    <th scope="col" class="text-nowrap">メンバー</th>
                                    @can('system-only')
                                    <th scope="col" class="text-nowrap">&nbsp;</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                <tr>
                                    <td class="text-nowrap">{{ $project->id }}</td>
                                    <td class="text-nowrap">{{ $project->name }}</td>
                                    <td class="text-nowrap">{{ $project->industry }}</td>
                                    <td class="text-nowrap">{{ $project->start_date }}</td>
                                    <td class="text-nowrap">{{ $project->end_date }}</td>
                                    {{-- <td class="text-nowrap">{{ $project->billing }}万</td> --}}
                                    <td class="text-nowrap">
                                        @forelse ($project->users as $user)
                                        {{ $user->name }}
                                        @empty
                                        <p>-</p>
                                        @endforelse
                                    </td>
                                    @can('system-only')
                                    <td class="text-nowrap"><a class="btn btn-outline-primary" href="{{ route('project.edit', $project->id) }}">詳細</a></td>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                            {{ $projects->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection