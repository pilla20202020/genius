@extends('layouts.admin.admin')

@section('title', 'Create a Package')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('package.store')}}" method="POST" enctype="multipart/form-data">
            @include('package.form',['header' => 'Create a Package'])
            </form>
        </div>
    </section>
@endsection

