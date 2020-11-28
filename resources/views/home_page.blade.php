@extends('home')

@section('main_area')
<style>
.video-fluid {
  width: 100%;
  height: auto;
}
</style>
<div class="container">
    <video class="video-fluid z-depth-1" autoplay loop controls muted>
        <source src="https://mdbootstrap.com/img/video/Sail-Away.mp4" type="video/mp4" />
    </video>
</div>
@endsection
