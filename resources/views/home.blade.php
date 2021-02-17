@extends('layouts.app')

@section('content')
<div class="content">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}            
        </div>
    @endif

    <div>
        @foreach ($categories as $item)                                      
            <button onclick="window.location.href='./trick/{{ $item->name}}'">{{ $item->name}}</button>
        @endforeach                
    </div>
</div>
@section('userinfotrick')    
@endsection
@endsection