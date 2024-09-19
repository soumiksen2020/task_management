@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="container">
        <h2>Welcome to your Dashboard</h2>
        <p>This is your dashboard where you can manage your tasks, routines, notes, and files.</p>
        
        <div class="row mb-4">
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Tasks</h5>
                        <p class="card-text flex-grow-1">You have </p>
						<p class="card-text flex-grow-1"><strong>{{ $completeTaskCount }}</strong> tasks completed.</p>
						<p class="card-text flex-grow-1"><strong>{{ $pendingtasksCount }}</strong> tasks pending.</p>
						<p class="card-text flex-grow-1"><strong>{{ $overduetaskCount }}</strong> overduetask pending.</p>
                        <a href="{{ route('projects.index') }}" class="btn btn-primary mt-auto">View Tasks</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
