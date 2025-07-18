<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Homework List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mx-auto">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Student Homework Submit List</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mt-5">
                        <div class="card-header">
                            <h5 class="card-title">Add Info</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store') }}" method="POST">
                                @csrf
                                <label for="">Student Name</label>
                                <input type="text" name="name" id=""
                                    class="form-control mb-3 @error('name') is-invalid @enderror"
                                    placeholder="Student Name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <label for="">Choose a Department:</label>
                                <select name="option" id=""
                                    class="form-control @error('option') is-invalid @enderror"
                                    value="{{ old('option') }}">
                                    <option value="CSE">CSE</option>
                                    <option value="BBA">BBA</option>
                                    <option value="English">English</option>
                                    <option value="Economics">Economics</option>
                                    <option value="Law">Law</option>
                                    <option value="Pharmacy">Pharmacy</option>
                                    <option value="Agriculture">Agriculture</option>
                                    @error('option')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </select>
                                <label for="">HomeWork Topic</label>
                                <input type="text" name="topic" id=""
                                    class="form-control mb-3 @error('topic') is-invalid @enderror"
                                    placeholder="Homework Topic" value="{{ old('topic') }}">
                                @error('topic')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <button class="btn btn-primary w-100">Add</button>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="card mt-5">
                        <div class="card-header m-auto mb-2 mb-lg-0 w-100">
                            <h5 class="card-title">Details</h5>
                        </div>
                        @foreach ($infos as $key => $info)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Student List</h5>
                                            </div>

                                            <div class="card-body">{{ ++$key }}. {{ $info->name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Department</h5>
                                            </div>
                                            <div class="card-body">{{ $info->option }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">HW Topic</h5>
                                            </div>
                                            <div class="card-body">{{ $info->topic }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 my-auto">
                                        <button class="btn btn-primary"><a href="{{ route('edit', $info->id) }}"
                                                class="text-white text-decoration-none">Edit</a></button>
                                        <button class="btn btn-danger"
                                            onclick="
             Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this student?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/delete/{{ $info->id }}';
                }
            });
            return false;
        "><a
                                                href="{{ route('delete', $info->id) }}"
                                                class="text-white text-decoration-none">Delete</a></button>
                                        <span
                                            class="btn
                                                btn-sm mt-3
                                                btn-{{ $info->status == 0 ? 'danger' : 'success' }}">{{ $info->status == 0 ? 'Incomplete' : 'Complete' }}</span>
                                        @if ($info->status == 0)
                                            <a href="{{ route('status', $info->id) }}"
                                                class="btn btn-sm btn-warning mt-2">Mark as Complete</a>
                                        @endif
                                    </div>


                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="div">
                        {{ $infos->links() }}
                    </div>
                </div>
            </div>


        </div>



    </main>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>
    @if (session()->has('msg'))
        <script>
            Toast.fire({
                icon: `{{ session('msg')['type'] ?? 'success' }}`,
                title: `{{ session('msg')['res'] ?? 'Success' }}`
            });
        </script>
    @endif







</body>

</html>
