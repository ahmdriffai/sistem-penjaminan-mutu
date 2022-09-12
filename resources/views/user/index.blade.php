@extends('layouts.template')


@section('content')

    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">
        <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah User
    </a>
    <div class="card py-2 px-2">
        <div class="row">
            <div class="col-md-6">
                <h5 class="card-header">Daftar User</h5>
            </div>
        </div>
        <div class="text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Hak Akses</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($data as $key => $user)
                    <tr>
                        <td>#</td>
                        <td><i class="fa-lg text-danger"></i><strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <span class="badge bg-label-primary me-1">{{ $v }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            
                            <div>
                                <!-- {!! Form::open(['route' => ['user.destroy', $user->id], 'method' => 'DELETE']) !!} -->
                                <!-- <button type="submit" class="btn btn-sm btn-info delete-confirm">
                                    <i class="bx bx-user me-1"></i> Lupa password
                                </button> -->
                                <!-- {!! Form::close() !!} -->
                                <a href="#" class="btn btn-sm btn-info delete-confirm">
                                    <i class="bx bx-user me-1"></i> Lupa password
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $data->links() !!}
        </div>
    </div>
@endsection
