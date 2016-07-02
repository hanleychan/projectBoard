@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<h1>Browse</h1>
	</div>

	<div class="row">
	<form action="{{ route('browse') }}" method="get" id="filterResultsForm" class="form-horizontal">
		<label for="search" class="col-sm-1 control-label">Search:</label>

		<div class="col-sm-4">
			<div class="input-group">
				<input type="text" id="search" name="search" class="form-control" value="{{ $search }}">
				<span class="input-group-btn">
				<button type="submit" class="btn btn-primary">Go</button>
				</span>
			</div>
		</div>
	</form>
	</div>

	<div class="row">
	@if(count($projects))
		<div class="list-group" id="resultsList">
			@foreach($projects as $project)
				<a href="{{ route('viewProject', ['project' => $project->id]) }}" class="list-group-item">{{ $project->name }}</a>
			@endforeach
		</div>
		{{ $projects->links() }}
	@else
		<p>No Results Found</p>
	@endif
	</div>
</div>
@endsection