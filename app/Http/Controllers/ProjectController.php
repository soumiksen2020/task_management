<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index(Request $request)
	{
		 // Extract filters from the request
		$priority = $request->input('status'); // Adjust to match your form field names
		$dueDate = $request->input('due_date');
		$search = $request->input('search');

		// Build the base query
		$sql = "SELECT * 
				FROM projects 
				WHERE user_id = ?"; // Assuming tasks.user_id is the foreign key for the authenticated user

		$bindings = [Auth::id()]; // Authenticated user's ID

		// Apply filters dynamically
		if (!empty($priority)) {
			$sql .= " AND priority = ?";
			$bindings[] = $priority;
		}

		if (!empty($dueDate)) {
			$sql .= " AND DATE(end_date) = ?";
			$bindings[] = $dueDate;
		}
		
		if (!empty($search)) {
			$sql .= " AND (name LIKE ? OR description LIKE ?)";
			$bindings[] = '%' . $search . '%';
			$bindings[] = '%' . $search . '%';
		}
		
		// Retrieve the results
		$projects = DB::select($sql, $bindings);
		
		

		// Optionally: Convert stdClass objects to Eloquent models if needed
		// $projects = Project::hydrate($projects);

		// Return the view with the filtered or all projects
		return view('projects.index', ['projects' => $projects]);
	}

	

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
			
            'budget' => 'nullable|numeric',
        ]);
		//dd($request->all());
		Auth::user()->projects()->create($request->all());

        return redirect()->route('projects.index')->with('success', 'Task created successfully.');
    }

    public function show(Project $project)
    {
        $teamMembers = $project->users()->get();
        $users = User::all();
        return view('projects.show', compact('project', 'teamMembers', 'users'));
    }
    public function edit(Project $project)
    {
        //dd($project);
		return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
       
		$request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
			'status' => 'required|in:pending,complete',
            'budget' => 'nullable|numeric',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Task deleted successfully.');
    }

    public function addMember(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
        ]);
       
        $project = Project::find($request->project_id);
        $project->teamProjects()->attach($request->user_id);
        return redirect()->back()->with('success', 'User added successfully.');
    }
}
