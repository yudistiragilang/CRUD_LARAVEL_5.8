@extends('layouts.global')

@section('title')
	Show Category
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="card">
				<div class="card-body">
					<label><b>Category Name</b></label>
					<br>
					{{$category->name}}
					<br>
					<br>

					<label><b>Category Slug</b></label>
					<br>
					{{$category->slug}}
					<br>
					<br>

					<label><b>Category Image</b></label>
					<br>
					@if($category->image)
						<img src="{{asset('public/storage/'.$category->image)}}" width="120px">
					@endif
				</div>
			</div>
		</div>
	</div>

@endsection