@extends('layouts.app')

@section('headScripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea', height: "400" });</script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Post Project</h1>
		</div>
	</div>
	<form action="/processPostProject" method="post">
		{{ csrf_field() }}
		<div class="row">
			<div class="form-group col-md-6">
				<label for="name">Name:</label>
				@if ($errors->has('name'))
				    <span class="help-block">
				        <strong>{{ $errors->first('name') }}</strong>
				    </span>
				@endif
				<input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-6">
				<label for="description">Description:</label>
				@if ($errors->has('description'))
				    <span class="help-block">
				        <strong>{{ $errors->first('description') }}</strong>
				    </span>
				@endif
				<textarea id="description" name="description">{{ old('description') }}</textarea>
			</div>
		</div>

		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
@endsection