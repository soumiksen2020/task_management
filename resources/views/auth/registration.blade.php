<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Task Manager</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-circle.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }


        .card-header {
            background-color: #495057;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 1.25rem;
            font-weight: 500;
        }
        .card-header img{
            filter: invert(100%) brightness(200%);
        }

        .btn-primary {
            background-color: #495057;
            border-color: #495057;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #343a40;
            border-color: #343a40;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .form-check-label {
            font-weight: 500;
        }

        .text-danger {
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header text-center p-4 fs-1">
                    <img src="{{ asset('assets/img/logo-horizontal.png') }}" class="img-fluid" alt="task manager">
					Registration
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
						<div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="name" name="name" id="name" class="form-control" placeholder="user mame" required autofocus>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="admin@example.com" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
						<div class="mb-3">
							<form method="POST" action="{{ route('register') }}" id="logout-form">
								<label for="Signup" class="form-check-label">Already have an account?</label> 
								<a href="/login" style="color: #495057; font-weight: bold; text-decoration: none;">Login now</a>
								<!-- <button type="submit" class="dropdown-item">Signup now</button> -->
							</form>
						</div>
                    </form>
                </div>

                <div class="card-footer text-center">
                   <p>Developed by: Soumik Sen</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
