@extends('layouts.template')


@section('content')
    <a href="{{ route('home') }}" class="btn btn-primary mb-3">
        <span class="tf-icons bx bx-arrow-back"></span>&nbsp; Kembali
    </a>
    <!-- Basic Layout -->
    {!! Form::open(array('route' => 'users.change-password-post','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xl-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Password Lama <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                {!! Form::password('old_password', array('placeholder' => 'Password Lama','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Password Baru <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                {!! Form::password('new_password', array('placeholder' => 'Password Lama','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Konfirmasi Password <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                {!! Form::password('confirm_password', array('placeholder' => 'Konfirmasi Password','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Ganti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {!! Form::close() !!}


@endsection
