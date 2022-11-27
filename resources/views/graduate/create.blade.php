@extends('layouts.admin.admin')

@section('title', 'Create a Graduates')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('graduate.store')}}" method="POST" enctype="multipart/form-data">
            @include('graduate.form',['header' => 'Create a Graduates'])
            </form>
        </div>
    </section>
@endsection

