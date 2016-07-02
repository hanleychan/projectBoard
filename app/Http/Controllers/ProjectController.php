<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Message;

class ProjectController extends Controller
{
	/**
	 * Create a ProjectController instance
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except' => [
			'browse',
			'viewProject',
			'replyPost',
			'index',
		]]);
	}

	/**
	 * Redirect user to the correct page based on whether they are logged in
	 */
	public function index()
	{
		// Redirect to browse projects page if not logged in
		return redirect('/browse');	
	}

	/**
	 * Load my project postings view
	 */
	public function myProjects(Request $request)
	{
		// Get all open projects
		$projects = $request->user()->projects()->where('open', true)->orderBy('id', 'desc')->paginate(20);

		return view('projects.myProjects', compact('projects'));
	}

	/**
	 * Load browse project postings view
	 */
	public function browse()
	{
		$projects = \DB::table('projects')->where('open', true)->orderBy('id', 'desc')->paginate(20);
		return view('projects.browse', compact('projects'));
	}

	/**
	 * Load create new project posting view
	 */
	public function newProject(Request $request)
	{
		return view('projects.createEditProject');
	}

	/**
	 * Process creating a new project posting
	 */
	public function processNewProject(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:50',
			'email' => 'required|max:255|email',
			'description' => 'required',
		]);

		$request->user()->projects()->create(array('name'=>$request->name, 'description' => $request->description, 'open' => true, 'email' => $request->email));
		return redirect('/myProjects');
	}

	/**
	 * Load view a specific project view
	 */
	public function viewProject(Request $request, Project $project)
	{
		$project = $project->load('user');	
		return view('projects.viewProject', compact('project'));
	}

	/**
	 * Load edit post view
	 */
	public function editPost(Request $request, Project $project) {
		$this->authorize('editPost', $project);

		$editPost = true;
		return view('projects.createEditProject', compact('project', 'editPost'));
	}

	/**
	 * Process editing a project posting
	 */
	public function processEditProject(Request $request, Project $project)
	{
		$this->authorize('editPost', $project);

		$this->validate($request, [
			'name' => 'required|max:50',
			'email' => 'required|max:255|email',
			'description' => 'required',
		]);

		$project->name = $request->name;
		$project->description = $request->description;
		$project->email = $request->email;
		$project->save();

		return redirect()->route('viewProject', ['project' => $project->id]);
	}

	public function replyPost(Project $project)
	{
		$this->authorize('replyPost', $project);

		return $project;
	}

	/**
	 * Process deleting a project posting
	 */
	public function processDeletePost(Request $request, Project $project)
	{
		$this->authorize('deletePost', $project);

		$project->delete();

		if ($project->open) {
			return redirect()->route('myProjects');
		} else {
			return redirect()->route('archivedProjects');
		}
	}

	/**
	 * Process closing a project posting
	 */
	public function processClosePost(Request $request, Project $project)
	{
		$this->authorize('editPost', $project);

		$project->open = false;
		$project->save();

		return redirect()->route('myProjects');
	}

	/**
	 * Load archived project postings view
	 */
	public function archivedProjects(Request $request)
	{
		$archivedProjects = true;
		$projects = $request->user()->projects()->where('open', false)->orderBy('id', 'desc')->paginate(20);

		return view('projects.myProjects', compact('projects', 'archivedProjects'));
	}

	/**
	 * Load repost project view
	 */
	public function repostProject(Request $request, Project $project) 
	{
		$this->authorize('repostPost', $project);

		return view('projects.createEditProject', compact('project'));
	}
}
