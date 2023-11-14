@extends('layouts.app')

@section('content')


<!-- Brand Area Start-->
@include('components.slider')
<!-- Brand Area End -->

<!-- Brand Area Start-->
@include('components.brands')
<!-- Brand Area End -->


<!-- About Area Start-->
@include('components.about')
<!-- About Area End -->

<!-- Service Area -->
@include('components.services')
<!-- Service Area End -->

<!-- About Area Start-->
@include('components.bussines')
<!-- About Area End -->


<!-- Product Area -->
@include('components.products')
<!-- Product Area End -->

<!-- Gallery Area -->

<!-- Gallery Area End -->

<!-- Trainers Area -->

<!-- Trainers Area End -->

<!-- News Area -->
@include('components.news')
<!-- News Area End -->


@endsection
