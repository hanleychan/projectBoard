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
			'messages',
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
		return view('projects.myProjects');
	}

	public function browse()
	{
		return view('projects.browse');
	}

	public function newProject()
	{
		return view('projects.newProject');
	}

	public function processNewProject(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:50',
			'description' => 'required',
		]);

		$request->user()->projects()->create(array('name'=>$request->name, 'description' => $request->description, 'open' => true));
	}

	public function messages()
	{
		return view('projects.messages');
	}
}
