@extends('layouts.admin.admin')

@section('title', 'Create a Institution')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('institution.store')}}" method="POST" enctype="multipart/form-data">
            @include('institution.form',['header' => 'Create a Institution'])
            </form>
        </div>
    </section>
@endsection

