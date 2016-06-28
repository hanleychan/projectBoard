@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<h1>Browse Page</h1>
	</div>

	@if(!empty($projects))
		<div class="list-group">
			@foreach($projects as $project)
				<a href="/project/{{ $project->id }}" class="list-group-item">{{ $project->name }}</a>
			@endforeach
		</div>
		{{ $projects->links() }}
	@endif
</div>
@endsection