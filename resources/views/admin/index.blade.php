@extends('home')
@section('content')

<div class="admin_container">
     @include("admin.layouts.sidebar")
     <div class="admin_content">
          @yield("admin")
     </div>
</div>
@yield("javascript")
@stop