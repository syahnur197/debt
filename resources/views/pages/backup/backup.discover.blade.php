@extends('layouts.app')

@section('content')
  <Discover></Discover>
@endsection

@section('script')
  <script id="dsq-count-scr" src="//bruneidebtrepo.disqus.com/count.js" async></script>
@endsection

@section('style')
<style>
  .image { 
    position:relative; 
    overflow:hidden;
    padding-bottom:100%; 
  } 
  .image img { 
    position:absolute; 
  }
</style>
@endsection