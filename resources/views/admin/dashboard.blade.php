@extends('admin.master')
@section('content')
    @if (Session::has('alert.message'))
        <div class="alert alert-success alert-dismissible fade show">
            <button class="close" data-dismiss="alert">&times;</button>
            <strong>{{ Session::get('alert.message') }}</strong>
        </div>
    @endif

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ config('cms.store_name') }}管理後台</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <button type="button" class="btn btn-primary mb-2" id="cardToggle">展開/收合區塊</button>

        @include('admin.card.option')

        @include('admin.card.type')

        @include('admin.card.payment')

        @include('admin.card.discount')

        @include('admin.card.item')

        @include('admin.card.order')

    </section>
@endsection
