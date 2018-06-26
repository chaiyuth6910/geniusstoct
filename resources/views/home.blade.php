@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    You are logged in!

                    <?php
                        if(auth()->user()->isAdmin==1){
                    ?>
                        <div class="panel-body">
                            You are <a href="{{url('admin/routes')}}">Admin</a>
                        </div>
                    <?php
                        }else{
                    ?>
                        <div class="panel-body">
                                You are Normal User
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
