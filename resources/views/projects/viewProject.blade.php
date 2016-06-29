@extends('layouts.app')
@section('content')
<div class="container">
	<h1>{{ $project->name }}</h1>
	<ul id="postDetailsList">
		<li><span class="postDetailsHeading">Posted By:</span>{{ $project->user->name }}</li>
		<li><span class="postDetailsHeading">Posting Date:</span>{{ date('F d, Y', strtotime($project->created_at)) }}</li>
		<li><span class="postDetailsHeading">Last Updated:</span>{{ date('F d, Y', strtotime($project->updated_at)) }}</li>
		<li><span class="postDetailsHeading">Open:</span>{{ ($project->open) ? 'Yes' : 'No' }}</li>
	</ul>

	<div class="panel panel-default">
		<div class="panel-heading">Description:</div>
		<div class="panel-body">
			{!! $project->description !!}

		</div>
	</div>

	@if ($project->user->id === Auth::id())
		<div>
			@if ($project->open)
			<a href="{{ route('editPost', ['project' => $project->id]) }}">
				<button type="button" class="btn btn-primary">Edit Posting</button>
			</a>

			<form id="closePostForm" action="{{ route('closePost', ['project' => $project->id]) }}" method="post">
				{{ csrf_field() }}
				<button type="button" id="closePost" class="btn btn-primary">Close Posting</button>
			</form>
			@else
				<button type="button" class="btn btn-primary">Repost</button>
			@endif

			<form id="deletePostForm" action="{{ route('deletePost', ['project' => $project->id]) }}" method="post">
				{{ csrf_field() }}
				{{ method_field('delete') }}	
				<button type="button" id="deletePost" class="btn btn-primary">Delete Posting</button>
			</form>
		</div>
	@else
		<p><a href="{{ route('replyPost', ['project' => $project->id]) }}">Reply to Post</a></p>
	@endif


</div>
@endsection

@section('scripts')
<script>
	$("button#deletePost").on("click", function() {
		var confirmDelete = confirm("Are you sure you want to delete this posting?");
		if (confirmDelete) {
			$(this).parent().submit();
		}
	});

	$("button#closePost").on("click", function() {
		var confirmArchive = confirm("Are you sure you want to close this posting?");
		if (confirmArchive) {
			$(this).parent().submit();
		}
	});
</script>
@endsection