@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		@if (isset($archivedProjects) && $archivedProjects === true)
			<h1>My Archived Posts</h1>
		@else
			<h1>My Open Posts</h1>
		@endif
	</div>

	@if (isset($archivedProjects) && $archivedProjects === true)
	<p><a href="{{ route('myProjects') }}">View Open Postings</a></p>
	@else
	<p><a href="{{ route('archivedProjects') }}">View Archived Postings</a></p>
	@endif

	@if(count($projects))
		<div class="list-group">
			@foreach($projects as $project)
				<a href="{{ route('viewProject', ['project' => $project->id]) }}" class="list-group-item">{{ $project->name }}</a>
			@endforeach
		</div>
		{{ $projects->links() }}
	@else
		<p>No Results Found</p>
	@endif

</div>
@endsection

