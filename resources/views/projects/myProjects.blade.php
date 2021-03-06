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
	<p><a href="{{ route('myProjects') }}" id="openPostingsLink">View Open Postings</a></p>
	@else
	<p><a href="{{ route('archivedProjects') }}" id="archivedPostingsLink">View Archived Postings</a></p>
	@endif

	<p id="postingsNote">Note: Postings older than 60 days will be automatically archived</p>

	@if(count($projects))
		<div class="list-group">
			@foreach($projects as $project)
				<a href="{{ route('viewProject', ['project' => $project->id]) }}" class="list-group-item">{{ $project->name }}</a>
			@endforeach
		</div>
		{{ $projects->links() }}
	@else
		@if (isset($archivedProjects) && $archivedProjects === true)
		<p>No Archived Results Found</p>
		@else
		<p>No Open Results Found</p>
		@endif
	@endif

</div>
@endsection

