@extends('layouts.app')
@section('content')
<div class="container">
	<h1>{{ $project->name }}</h1>
	<ul id="postDetailsList">
		<li><span class="postDetailsHeading">Posted By:</span>{{ $project->user->name }}</li>
		<li><span class="postDetailsHeading">Posting Date:</span>{{ date('F d, Y', strtotime($project->created_at)) }}</li>
		<li><span class="postDetailsHeading">Last Updated:</span>{{ date('F d, Y', strtotime($project->updated_at)) }}</li>
	</ul>

	<div class="panel panel-default">
		<div class="panel-heading">Description:</div>
		<div class="panel-body">
			{!! $project->description !!}

		</div>
	</div>

	@if ($project->user->id === Auth::id())
		<p>
			<a href="{{ route('editPost', ['project' => $project->id]) }}">
				<button type="button" class="btn btn-primary">Edit Post</button>
			</a>
				<button type="button" class="btn btn-primary">Delete Post</button>
				<button type="button" class="btn btn-primary">Archive Post</button>
		</p>
	@else
		<p><a href="{{ route('replyPost', ['project' => $project->id]) }}">Reply to Post</a></p>
	@endif


</div>
@endsection

@section('scripts')
<script>
</script>
@endsection