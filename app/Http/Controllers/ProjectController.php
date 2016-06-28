<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Message;

class ProjectController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth', ['only' => [
			'newProject',
			'myProjects',
			'processNewProject',
			'editPost',
		]]);
	}

	public function index()
	{
		// Redirect to browse projects page if not logged in
		if (!\Auth::user()) {
			return redirect('/browse');	
		} else {
			return redirect('/myProjects');
		}

	}

	public function myProjects(Request $request)
	{
		// Get all open projects
		$projects = $request->user()->projects()->where('open', true)->orderBy('id', 'desc')->paginate(20);

		return view('projects.myProjects', compact('projects'));
	}

	public function browse()
	{
		$projects = \DB::table('projects')->paginate(20);
		return view('projects.browse', compact('projects'));
	}

	public function newProject()
	{
		return view('projects.createEditProject');
	}

	public function processNewProject(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:50',
			'description' => 'required',
		]);

		$request->user()->projects()->create(array('name'=>$request->name, 'description' => $request->description, 'open' => true));
		return redirect('/myProjects');
	}

	public function viewProject(Request $request, Project $project)
	{
		$project = $project->load('user');	
		return view('projects.viewProject', compact('project'));
	}

	public function editPost(Request $request, Project $project) {
		$this->authorize('editPost', $project);

		return view('projects.createEditProject', compact('project'));
	}

	public function processEditProject(Request $request, Project $project)
	{
		$this->authorize('editPost', $project);

		$this->validate($request, [
			'name' => 'required|max:50',
			'description' => 'required',
		]);

		$project->name = $request->name;
		$project->description = $request->description;
		$project->save();

		return redirect()->route('viewProject', ['project' => $project->id]);
	}

	public function replyPost(Project $project)
	{
		return $project;
	}
}
