@extends('admin.layouts.app')

@section('content')
    @include('admin.packs._form', ['pack' => $pack])
@endsection
