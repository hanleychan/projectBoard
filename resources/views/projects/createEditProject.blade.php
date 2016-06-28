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

	@if(isset($project))
	<form action="{{ url('processEditProject', ['project' => $project->id]) }}" method="post">
	@else
	<form action="{{ url('processPostProject') }}" method="post">
	@endif
		{{ csrf_field() }}
		<div class="row">
			<div class="form-group col-md-12">
				<label for="name">Name:</label>
				@if ($errors->has('name'))
				    <span class="help-block">
				        <strong>{{ $errors->first('name') }}</strong>
				    </span>
				@endif
				<input type="text" id="name" name="name" class="form-control" maxlength="50" value="{{ (isset($project) && !old('name')) ? $project->name : old('name') }}">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-12">
				<label for="description">Description:</label>
				@if ($errors->has('description'))
				    <span class="help-block">
				        <strong>{{ $errors->first('description') }}</strong>
				    </span>
				@endif
				<textarea id="description" name="description">{{ (isset($project) && !old('description')) ? $project->description : old('description') }}</textarea>
			</div>
		</div>

		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
@endsection