@extends('layouts.app')

@section('headScripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea', height: "400" });</script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
            @if(isset($editPost))
            <h1>Edit Post</h1>
            @else
			<h1>Post New Project</h1>
            @endif
		</div>
	</div>

	@if(isset($editPost))
	<form action="{{ route('processEditProject', ['project' => $project->id]) }}" method="post">
	@else
	<form action="{{ route('processPostProject') }}" method="post">
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
				<label for="email">Contact Email:</label>
				@if ($errors->has('email'))
				    <span class="help-block">
				        <strong>{{ $errors->first('email') }}</strong>
				    </span>
				@endif
				<input type="text" id="email" name="email" class="form-control" maxlength="255" value="{{ (isset($project) && !old('email')) ? $project->email : (!old('email') ? Auth::user()->email : old('email')) }}">
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
