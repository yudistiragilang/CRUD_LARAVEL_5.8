@extends('layouts.global')

@section('title')
	Create Book
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-8 offset-md-2">

			@if(session('status'))
			<div class="alert alert-success">
				{{session('status')}}
			</div>
			@endif

			<form action="{{route('books.store')}}" method="POST" enctype="multipart/form-data" class="shadow-sm p-3 bg-white">

				@csrf
				<label>Title</label>
				<br>
				<input value="{{old('title')}}" type="text" class="form-control {{$errors->first('title') ? "is-invalid" : ""}}" name="title" placeholder="Book title">
				<div class="invalid-feedback">
					{{$errors->first('title')}}
				</div>
				<br>

				<label>Cover</label>
				<br>
				<input type="file" class="form-control {{$errors->first('cover') ? "is-invalid" : ""}}" name="cover" placeholder="Book cover">
				<div class="invalid-feedback">
					{{$errors->first('cover')}}
				</div>
				<br>

				<label>Category</label>
				<br>
				<select name="categories[]" multiple class="form-control" id="categories">
					
				</select>
				<br>
				<br>

				<label>Description</label>
				<br>
				<textarea name="description" class="form-control {{$errors->first('description') ? "is-invalid" : ""}}" placeholder="Give a description about this book">{{old('description')}}</textarea>
				<div class="invalid-feedback">
					{{$errors->first('description')}}
				</div>
				<br>

				<label>Stock</label>
				<br>
				<input type="number" class="form-control {{$errors->first('stock') ? "is-invalid" : ""}}" name="stock" min="0" value="{{old('stock')}}">
				<div class="invalid-feedback">
					{{$errors->first('stock')}}
				</div>
				<br>

				<label>Author</label>
				<br>
				<input value="{{old('author')}}" type="text" class="form-control {{$errors->first('author') ? "is-invalid" : ""}}" name="author" placeholder="Book author">
				<div class="invalid-feedback">
					{{$errors->first('author')}}
				</div>
				<br>

				<label>Publisher</label>
				<br>
				<input value="{{old('publisher')}}" type="text" class="form-control {{$errors->first('publisher') ? "is-invalid" : ""}}" name="publisher" placeholder="Book publisher">
				<div class="invalid-feedback">
					{{$errors->first('publisher')}}
				</div>
				<br>

				<label>Price</label>
				<br>
				<input value="{{old('price')}}" type="number" class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" name="price" placeholder="Book price">
				<div class="invalid-feedback">
					{{$errors->first('price')}}
				</div>
				<br>

				<button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
				<button class="btn btn-secondary" name="save_action" value="DRAFT">Save as draft</button>
			</form>
		</div>
	</div>
@endsection

@section('footer-scripts')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

	<script type="text/javascript">
		$('#categories').select2({
			ajax: {
				url: 'http://localhost/aquascape/ajax/categories/search',
				processResults: function (data) {
					return {
						results: data.map(function(item) {
							return {
								id: item.id, text: item.name
							}
						})
					}
				}
			}
		});
	</script>
	
@endsection