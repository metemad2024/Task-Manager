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
        <link href="{{ url('/css/styles.css'); }}" rel="stylesheet" />
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
                    <a data-code="dashboard-box" id="show-dashboard"  class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Dashboard</a>
                    <a data-code="add-task-box" id="show-add-task" class="menu-link-item list-group-item list-group-item-action list-group-item-light p-3" href="#!">New Task</a>
                    <a data-code="task-list-box" id="show-task-list" class="menu-link-item list-group-item list-group-item-action list-group-item-light p-3" href="#!">Task List</a>
                    <a data-code="add-user-box" id="show-add-user" class="menu-link-item admin-menu list-group-item list-group-item-action list-group-item-light p-3" href="#!">New User</a>
                    <a data-code="user-list-box" id="show-user-list" class="menu-link-item admin-menu list-group-item list-group-item-action list-group-item-light p-3" href="#!">User List</a>
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
                                
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!">Profile</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid content-box" id="dashboard-box">
                    <p>Welcome to simple task manager panel.</p>
                </div>
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
                            <label for="task-date" class="form-label">Dead date</label>
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

                <div class="container-fluid content-box" id="add-user-box">
                    <h1 class="mt-4">Add new user</h1>
                    <p id="new-user-msg"></p>
                    <div>
                        <div class="mb-3">
                            <label for="user-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="user-name">
                            <div id="user-name-info" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="user-email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="user-email">
                            <div id="user-email-info" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="user-password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="user-password">
                            <div id="user-password-info" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="user-password-rep" class="form-label">Password (Repeat)</label>
                            <input type="text" class="form-control" id="user-password-rep">
                            <div id="user-password-rep-info" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="user-isAdmin" class="form-label">Is admin</label>
                            <select class="form-control" id="user-isAdmin">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                                
                            </select>
                            <div id="user-isAdmin-info" class="form-text"></div>
                        </div>
                        
                        <button class="btn btn-primary" id="submit-new-user">Submit</button>
                    </div>
                </div>

                <div class="container-fluid content-box" id="user-list-box">
                    <h1 class="mt-4">User list</h1>
                    <p></p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Is Admin</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="user-table-body">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="{{ url('/js/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ url('/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core theme JS-->
        <script src="{{ url('/js/scripts.js') }}"></script>
    </body>
</html>
