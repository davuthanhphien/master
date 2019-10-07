@extends('admin.dashboard')
@section('content')
    <div id="app">
        <upload-component></upload-component>
    </div>
@endsection
@push('scripts')
    <script src="/js/app.js"></script>
@endpush
