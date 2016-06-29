@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		@if (isset($archivedProjects) && $archivedProjects === true)
			<h1>Archived Posts</h1>
		@else
			<h1>My Posts</h1>
		@endif
	</div>

	@if (isset($archivedProjects) && $archivedProjects === true)
	<p><a href="{{ route('myProjects') }}">My Posts</a></p>
	@else
	<p><a href="{{ route('archivedProjects') }}">Archived Postings</a></p>
	@endif


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

