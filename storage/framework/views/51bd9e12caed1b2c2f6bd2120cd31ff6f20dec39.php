<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Simple Task Manager</title>
        <!-- Favicon-->
        <!-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> -->
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?php echo e(url('/css/styles.css')); ?>" rel="stylesheet" />
        <style>
            .content-box{display: none;}
            #wrapper{display: none;}
        </style>
    </head>
    <body>
        <div id="login">
            <h3 class="text-center text-white pt-5">Login form</h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <div id="login-form">
                                <h3 class="text-center text-info">Login</h3>
                                <div class="form-group">
                                    <label for="username" class="text-info">Username:</label><br>
                                    <input type="text" name="email" id="login-email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="text" name="password" id="login-password" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <span id="login-btn" name="submit" class="btn btn-info btn-md">Login</span>
                                    <a href="#" class="text-info float-left">Register here</a>
                                    <span id="login-error"></span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <div id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">Task Manager</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Dashboard</a>
                    <a data-code="add-task-box" id="show-add-task" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">New Task</a>
                    <a data-code="task-list-box" id="show-task-list" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Task List</a>
                    <a data-code="logout" id="logout-menu" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Logout</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle"><></button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item active"><a class="nav-link" href="#!">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#!">Link</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!">Action</a>
                                        <a class="dropdown-item" href="#!">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Something else here</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid content-box" id="add-task-box">
                    <h1 class="mt-4">Add new task</h1>
                    <p id="new-task-msg"></p>
                    <div>
                        <div class="mb-3">
                            <label for="task-title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="task-title">
                            <div id="task-title-info" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="task-description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="task-description">
                            <div id="task-description-info" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="task-priority" class="form-label">Priority</label>
                            <select class="form-control" id="task-priority">
                                <option value="1">High</option>
                                <option value="2">Middle</option>
                                <option value="3">Low</option>
                            </select>
                            <div id="task-priority-info" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="task-date" class="form-label">Dead date(YYYY-MM-DD)</label>
                            <input type="date" class="form-control" id="task-date" pattern="\d{4}-\d{2}-\d{2}" placeholder="YYYY-MM-DD">
                            <div id="task-date-info" class="form-text"></div>
                        </div>
                        <button class="btn btn-primary" id="submit-new-task">Submit</button>
                    </div>
                </div>

                <div class="container-fluid content-box" id="task-list-box">
                    <h1 class="mt-4">Task list</h1>
                    <p></p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Dead Date</th>
                            <th scope="col">Description</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="task-table-body">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="<?php echo e(url('/js/jquery-3.7.1.min.js')); ?>"></script>
        <script src="<?php echo e(url('/js/bootstrap.bundle.min.js')); ?>"></script>
        <!-- Core theme JS-->
        <script src="<?php echo e(url('/js/scripts.js')); ?>"></script>
    </body>
</html>
<?php /**PATH D:\Projects\Novin52\novin52\task-mngr\resources\views/front/dashboard.blade.php ENDPATH**/ ?>