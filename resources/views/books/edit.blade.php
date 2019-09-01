@extends('layouts.global')

@section('title')
	Book Edit
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">

			@if(session('status'))
			<div class="alert alert-success">
				{{session('status')}}
			</div>
			@endif

			<form action="{{route('books.update', ['id' => $book->id])}}" method="POST" enctype="multipart/form-data" class="shadow-sm p-3 bg-white">

				@csrf
				<input type="hidden" name="_method" value="PUT">

				<label>Title</label>
				<br>
				<input type="text" class="form-control" name="title" value="{{$book->title}}" placeholder="Book title">
				<br>

				<label>Cover</label>
				<small class="text-muted">Current cover</small>
				<br>
				@if($book->cover)
				<img src="{{asset('public/storage/'.$book->cover)}}" width="96px">
				@endif
				<br>
				<br>
				<input type="file" name="cover" class="form-control">
				<small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
				<br>
				<br>

				<label>Slug</label>
				<br>
				<input type="text" name="slug" class="form-control" value="{{$book->slug}}" placeholder="Enter a slug">
				<br>

				<label>Description</label>
				<br>
				<textarea name="description" class="form-control" placeholder="Give a description about this book">{{$book->description}}</textarea>
				<br>

				<label>Categories</label>
				<br>
				<select name="categories[]" multiple class="form-control" id="categories">
					
				</select>
				<br>
				<br>

				<label>Stock</label>
				<br>
				<input type="number" class="form-control" name="stock" min="0" value="{{$book->stock}}">
				<br>

				<label>Author</label>
				<br>
				<input type="text" class="form-control" name="author" placeholder="Book author" value="{{$book->author}}">
				<br>

				<label>Publisher</label>
				<br>
				<input type="text" class="form-control" name="publisher" placeholder="Book publisher" value="{{$book->publisher}}">
				<br>

				<label>Price</label>
				<br>
				<input type="number" class="form-control" name="price" placeholder="Book price" value="{{$book->price}}">
				<br>

				<label for="">Status</label>
				<select name="status" id="status" class="form-control">
					<option {{$book->status == 'PUBLISH' ? 'selected' : ''}} value="PUBLISH">PUBLISH</option>
					<option {{$book->status == 'DRAFT' ? 'selected' : ''}} value="DRAFT">DRAFT</option>
				</select>
				<br>

				<button class="btn btn-primary" value="PUBLISH">Update</button>

			</form>

		</div>
	</div>
@endsection

@section('footer-scripts')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

	<script>
		$('#categories').select2({
			ajax: {
				url: 'http://localhost/aquascape/ajax/categories/search',
				processResults: function(data){
					return {
						results: data.map(function(item){return {id: item.id, text: item.name} })
					}
				}
			}
		});

		var categories = {!! $book->categories !!}

		categories.forEach(function(category){
			var option = new Option(category.name, category.id, true, true);
			$('#categories').append(option).trigger('change');
		});
	</script>

@endsection