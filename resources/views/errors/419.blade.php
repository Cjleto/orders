@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))
@section('link')
<div class="ml-4 text-lg tracking-wider text-gray-500 uppercase border-l border-gray-400" style="padding-right: 1.5rem;">
      <a class="ml-4" href="/">Go Home</a>
</div>
<style>
    a.ml-4 {
        color: rebeccapurple;
    }
    a.ml-4:hover {
        color: darkorange;
    }
</style>
@endsection
