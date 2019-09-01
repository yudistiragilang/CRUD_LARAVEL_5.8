@extends('layouts.global')

@section('title')
	Category list
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-6">
			<form action="{{route('categories.index')}}">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Filter by category name" name="name">
					<div class="input-group-append">
						<input type="submit" name="submit" value="Filter" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-6">
			<ul class="nav nav-pills card-header-pills">
				<li class="nav-item">
					<a class="nav-link active" href="{{route('categories.index')}}">Published</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('categories.trash')}}">Trash</a>
				</li>
			</ul>
		</div>
	</div>
	<br>
	<hr class="my-3">

	<div class="row">
		<div class="col-md-12 text-right">
			<a href="{{route('categories.create')}}" class="btn btn-primary">Create category</a>
		</div>
	</div>
	<br>

	<div class="row">
		<div class="col-md-12">

			@if(session('status'))

				<div class="alert alert-success">
					{{session('status')}}
				</div>

			@endif

			<table class="table table-bordered table-stripped">
				<thead>
					<tr>
						<th><b>No</b></th>
						<th><b>Name</b></th>
						<th><b>Slug</b></th>
						<th><b>Image</b></th>
						<th><b>Actions</b></th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 0;?>
					@foreach ($categories as $category)
					<?php $no++ ;?>
					<tr>
						<td>{{$no}}</td>
						<td>{{$category->name}}</td>
						<td>{{$category->slug}}</td>
						<td>
							@if($category->image)
								<img src="{{asset('public/storage/'.$category->image)}}" width="48px">
							@else
								No Image
							@endif
						</td>
						<td>
							<a href="{{route('categories.edit', ['id' => $category->id])}}" class="btn btn-info btn-sm"> Edit </a>

							<a href="{{route('categories.show', ['id' => $category->id])}}" class="btn btn-primary btn-sm"> Show </a>

							<form class="d-inline" action="{{route('categories.destroy', ['id' => $category->id])}}" method="POST" onsubmit="return confirm('Move category to trash?')">

								@csrf
								<input type="hidden" value="DELETE" name="_method">
								<input type="submit" name="submit" value="Trash" class="btn btn-danger btn-sm">
								
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="10">
							{{$categories->appends(Request::all())->links()}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

@endsection