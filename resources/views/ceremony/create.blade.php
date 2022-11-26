@extends('layouts.admin.admin')

@section('title', 'Create a ceremony')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('ceremony.store')}}" method="POST" enctype="multipart/form-data">
            @include('ceremony.form',['header' => 'Create a ceremony'])
            </form>
        </div>
    </section>
@endsection

