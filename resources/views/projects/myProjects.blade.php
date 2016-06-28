@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<h1>My Projects Page</h1>
	</div>

	<p><a href="">Old Postings</a></p>

	@if(!empty($projects))
		<div class="list-group">
			@foreach($projects as $project)
				<a href="{{ route('viewProject', ['project' => $project->id]) }}" class="list-group-item">{{ $project->name }}</a>
			@endforeach
		</div>
		{{ $projects->links() }}
	@endif

</div>
@endsection

