@extends('layouts.app')

@section('content')

<div class="container flex justify-content-center">
	<div class="col-6">
		<label>Mail</label>
		<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Email">
		<label>Password</label>
		<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Password">
		<a href="#" class="btn btn-green mt-5">Log in</a>
	</div>
</div>

@endsection(content)