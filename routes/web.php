<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChecklistItemController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectFileController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use Carbon\Carbon;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::controller(MailController::class)->prefix('mail')->name('mail.')->group(function () {
        Route::get('/', 'index')->name('inbox');
    });
    Route::resource('projects', ProjectController::class);
    Route::post('project/team', [ProjectController::class, 'addMember'])->name('projects.addMember');
    Route::get('projects/{project}/tasks', [TaskController::class, 'index'])->name('projects.tasks.index');
    Route::post('projects/{project}/tasks', [TaskController::class, 'store'])->name('projects.tasks.store');

    /*Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::post('tasks/{task}/update-status', [TaskController::class, 'updateStatus']);*/
    
    
    Route::get('dashboard', function () {
        $user = Auth::user();
        $tasksCount = $user->tasks()->count();
        		
		// Project status counts
		$pendingProjectsCount = Project::where('user_id', $user->id)
			->where(function($query) {
				$today = Carbon::now();
				$query->whereNotNull('start_date')
					->where('start_date', '>', $today);
			})->count();

		$overduetaskCount = Project::where('user_id', $user->id)
			->where(function($query) {
				$query->where('status', 'pending') // Ensure task status is 'pending'
					  ->where('end_date', '<', Carbon::now());
			})->count();
	
			//dd($overduetaskCount);
	
	
			
		$completeTaskCount = Project::where('user_id', $user->id)
			->where('status', '=', 'complete') // Ensure project status is 'complete'
			->count();
			
		$pendingtasksCount = Project::where('user_id', $user->id)
			->where('status', '!=', 'complete') // Ensure project status is 'complete'
			->count();
			
		$onGoingProjectsCount = Project::where('user_id', $user->id)
			->where(function($query) {
				$today = Carbon::now();
				$query->whereNull('end_date')
					->orWhere('end_date', '>=', $today);
			})->count();

        return view('dashboard', compact(
            'tasksCount', 
 			'overduetaskCount',
			'pendingtasksCount',
			'completeTaskCount'
        ));
    })->name('dashboard');
});
