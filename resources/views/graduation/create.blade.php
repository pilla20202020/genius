@extends('layouts.admin.admin')

@section('title', 'Create a Graduation')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('graduation.store')}}" method="POST" enctype="multipart/form-data">
            @include('graduation.form',['header' => 'Create a Graduation'])
            </form>
        </div>
    </section>
@endsection

