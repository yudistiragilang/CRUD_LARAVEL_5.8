@extends('layouts.global')

@section('title')
	Trashed Categories
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-6">
			<form action="{{route('categories.index')}}">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Filter by category name" value="{{Request::get('name')}}" name="name">

					<div class="input-group-append">
						<input type="submit" value="Filter" class="btn btn-primary" name="submit">
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-6">
			<ul class="nav nav-pills card-header-pills">
				<li class="nav-item">
					<a class="nav-link" href="{{route('categories.index')}}">Published</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="{{route('categories.trash')}}">Trash</a>
				</li>
			</ul>
		</div>
	</div>
	<br>
	<hr class="my-3">

	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
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
					<?php $no=0; ?>
					@foreach($categories as $category)
					<?php $no++; ?>
						<tr>
							<td>{{$no}}</td>
							<td>{{$category->name}}</td>
							<td>{{$category->slug}}</td>
							<td>
								@if($category->image)
									<img src="{{asset('public/storage/'.$category->image)}}" width="48px">
								@endif
							</td>
							<td>
								<a class="btn btn-success" href="{{route('categories.restore', ['id' => $category->id])}}">Restore</a>

								<form class="d-inline" action="{{route('categories.delete-permanent', ['id' => $category->id])}}" method="POST" onsubmit="return confirm('Delete this category permanently?')">

									@csrf
									<input type="hidden" name="_method" value="DELETE">

									<input type="submit" class="btn btn-danger" name="submit" value="Delete">
									
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