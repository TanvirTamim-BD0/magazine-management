@extends('layouts.admin')
@section('content')

<style>
        .stats-card {
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }
        .stats-icon {
            font-size: 2rem;
            padding: 15px;

            color: white;
            display: inline-block;
        }
        .icon-orange { background-color: #ffa500; }
        .icon-blue { background-color: #007bff; }
        .icon-green { background-color: #008f65; }
        .icon-pink { background-color: #e83e8c; }
</style>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card text-center stats-card p-3">
                    <div class="stats-icon icon-orange">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <h4 class="mt-3">00</h4>
                    <p class="text-muted">Test</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center stats-card p-3">
                    <div class="stats-icon icon-blue">
                        <i class="fa fa-th-list"></i>
                    </div>
                    <h4 class="mt-3">{{$categoryCount}}</h4>
                    <p class="text-muted">Category</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center stats-card p-3">
                    <div class="stats-icon icon-green">
                        <i class="fa fa-stethoscope"></i>
                    </div>
                    <h4 class="mt-3">00</h4>
                    <p class="text-muted">Test</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center stats-card p-3">
                    <div class="stats-icon icon-pink">
                        <i class="fa fa-microchip"></i>
                    </div>
                    <h4 class="mt-3">00</h4>
                    <p class="text-muted">Test</p>
                </div>
            </div>
        </div>
    </div><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection