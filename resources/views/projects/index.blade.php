@extends('layouts.app')
@section('title')
    Tasks 
@endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center bg-white mb-4 shadow-sm p-3 rounded">
            <h2>Tasks</h2>
            <a href="{{ route('projects.create') }}" class="btn btn-primary">Add Task</a>
        </div>
		
		<div class="d-flex justify-content-between align-items-center bg-white mb-4 shadow-sm p-3 rounded">
			<form method="GET" action="{{ route('projects.index') }}" class="mb-4">
				<div class="row">
					<!-- Priority Field -->
					@csrf
					<div class="col-md-4 mb-3">
						<label for="priority" class="form-label">Priority:</label>
						<select name="status" id="status" class="form-select">
                            <option value="">Select Priority</option>
							<option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
					</div>

					<!-- Due Date Field -->
					<div class="col-md-4 mb-3">
						<label for="due_date" class="form-label">Due Date:</label>
						<input type="date" name="due_date" id="due_date" class="form-control" value="{{ request('due_date') }}">
					</div>

					<!-- Submit Button -->
					<div class="col-md-4 d-flex align-items-end mb-3">
						<button type="submit" class="btn btn-primary" style="float: right;">Task Filtering</button>

					</div>
				</div>
			</form>
			
			<form method="GET" action="{{ route('projects.index') }}" class="mb-4">
				<div class="row">
					<!-- Search Field -->
					<div class="col-md-6 mb-3">
						<label for="search" class="form-label">Search Tasks:</label>
						<input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Search by title or description">
					</div>

					<!-- Submit Button -->
					<div class="col-md-6 d-flex align-items-end mb-3">
						<button type="submit" class="btn btn-primary" style="float: right;">Search</button>
					</div>
				</div>
			</form>
			
		</div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @foreach($projects as $project)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->name }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <p class="card-text">
                                <!-- <strong>Status:</strong> {{ $project->status == 'pending' ? 'Pending' : ($project->status == 'on_going' ? 'In Progress' : 'Completed') }} -->
								<strong>Priority:</strong> {{ $project->priority }}<br>
								<strong>Status:</strong> {{ $project->status }}<br>
                                <strong>Deadline:</strong> {{ $project->end_date }}
                               
                            </p>
                            <!-- <a href="{{ route('projects.tasks.index', $project->id) }}" class="btn btn-primary"> <i class="bi bi-list"></i> </a>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary"> <i class="bi bi-eye"></i> </a> -->
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning"> <i class="bi bi-pencil-square"></i> </a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')"> <i class="bi bi-trash"></i> </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
