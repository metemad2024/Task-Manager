<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class ApiController extends Controller
{
    public function addUser(Request $request){
        $user = Auth::user();
        if($user->isAdmin){
            $messages = [
                'required' => 'The :attribute field is required',
                'string'    => 'The :attribute must be a string',
                'email'    => 'The :attribute must be a valid email',
                'unique'    => 'The :attribute already exists. Try another :attribute',                
              ];
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required|email|unique:users",
                "password" => "required|confirmed"
            ], $messages);
            if($validator->fails()){ 
                return response()->json([
                    "status" => false,
                    "message" => $validator->errors()->all()
                ]);
            } else{ 
                User::create([
                    "name" => htmlspecialchars($request->name),
                    "email" => htmlspecialchars($request->email),
                    "password" => Hash::make(htmlspecialchars($request->password)),
                    "isAdmin" => htmlspecialchars($request->isAdmin)
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "User created."
                ]);
            }            
        } else {
            return response()->json([
                "status" => false,
                "message" => "You are not allowed to call this API."
            ]);
        }
        
    }

    public function editUser(Request $request){
        $user = Auth::user();
        if($user->isAdmin){
            $request->validate([
                "id" => "required",
                "name" => "required",
                "password" => "required|confirmed",
                "isAdmin" => "required"
            ]);

            $affected = User::find($request->id)->update([
                "name" => htmlspecialchars($request->name),
                "password" => Hash::make(htmlspecialchars($request->password)),
                "isAdmin" => htmlspecialchars($request->isAdmin)
            ]);
            if($affected){
                return response()->json([
                    "status" => true,
                    "message" => "User updated."
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Error!"
                ]);
            }
            
        } else {
            return response()->json([
                "status" => false,
                "message" => "You are not allowed to call this API."
            ]);
        }
        
    }

    public function registeradmin(Request $request){
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "isAdmin" => true
        ]);
        return response()->json([
            "status" => true,
            "message" => "Admin user created."
        ]);
    }

    public function login(Request $request){
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token = $user->createToken("myToken")->accessToken;
            return response()->json([
                "status" => true,
                "message" => "Login seccess.",
                "token" => $token,
                "isAdmin" => $user->isAdmin
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "email or password is wrong!"
            ]);
        }
    }

    public function profile(){
        $user = Auth::user();
        return response()->json([
            "status" => true,
            "message" => "User profile!",
            "data" => $user
        ]);
    }

    public function logout(){
        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message" => "User logged out!"
        ]);
    }

    public function deleteUser(Request $request){
        $user = Auth::user();
        if($user->isAdmin){
            $request->validate([
                "id" => "required"
            ]);
            if($user->id == $request->id){
                return response()->json([
                    "status" => false,
                    "message" => "You are not allowed to delete this user!"
                ]);
            } else {
                $affected = User::find($request->id)->delete();
                if($affected){
                    return response()->json([
                        "status" => true,
                        "message" => "User deleted."
                    ]);
                } else {
                    return response()->json([
                        "status" => false,
                        "message" => "Error!"
                    ]);
                }
            }
        } else {
            return response()->json([
                "status" => false,
                "message" => "You are not allowed to call this API."
            ]);
        }
    }

    public function userList(Request $request){
        $user = Auth::user();
        
        if($user->isAdmin){
            
            $data = User::orderBy('id')->paginate(10);
            return response()->json([
                "status" => true,
                "message" => "User list.",
                "data" => $data
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "You are not allowed to call this API."
            ]);
        }
        
    }

    //============= Tasks APIs =================

    public function addTaskForOthers(Request $request){
        $user = Auth::user();
        if($user->isAdmin){
            $request->validate([
                "title" => "required",
                "dead_date" => "required",
                "priority" => "required",
                "userId" => "required"
            ]);
            Task::create([
                "title" => htmlspecialchars($request->title),
                "dead_date" => htmlspecialchars($request->dead_date),
                "priority" => htmlspecialchars($request->priority),
                "userId" => htmlspecialchars($request->userId)
            ]);
            return response()->json([
                "status" => true,
                "message" => "Task created."
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "You are not allowed to call this API."
            ]);
        }
    }

    public function addTask(Request $request){
        $user = Auth::user();
        
        $messages = [
            'required' => 'The :attribute field is required',
            'string'    => 'The :attribute must be a string',
            'email'    => 'The :attribute must be a valid email',
            'unique'    => 'The :attribute already exists. Try another :attribute',                
          ];
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "dead_date" => "required",
            "priority" => "required",
        ], $messages);
        if($validator->fails()){ 
            return response()->json([
                "status" => false,
                "message" => $validator->errors()->all()
            ]);
        } else { 
            Task::create([
                "title" => htmlspecialchars($request->title),
                "dead_date" => htmlspecialchars($request->dead_date),
                "description" => htmlspecialchars($request->description),
                "priority" => htmlspecialchars($request->priority),
                "userId" => $user->id
            ]);
            return response()->json([
                "status" => true,
                "message" => "Task created."
            ]);
        }
    }

    public function editTask(Request $request){
        $user = Auth::user();
        $task = Task::find($request->id);
        if($user->isAdmin){
            $request->validate([
                "title" => "required",
                "dead_date" => "required",
                "priority" => "required",
                "description" => "required",
                "id" => "required"
            ]);
            $task->update([
                "title" => htmlspecialchars($request->title),
                "dead_date" => htmlspecialchars($request->dead_date),
                "priority" => htmlspecialchars($request->priority),
                "description" => htmlspecialchars($request->description)
            ]);
            return response()->json([
                "status" => true,
                "message" => "Task updated."
            ]);
        } else {
            if($user->id == $task->userId){
                $request->validate([
                    "title" => "required",
                    "dead_date" => "required",
                    "priority" => "required",
                    "description" => "required",
                    "id" => "required"
                ]);
                $task->update([
                    "title" => $request->title,
                    "dead_date" => $request->dead_date,
                    "priority" => $request->priority,
                    "description" => $request->description
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "Task updated."
                ]);
            } else {
                 return response()->json([
                    "status" => false,
                    "message" => "You are not allowed to call this API."
                ]);
            }
           
        }
        
    }

    public function deleteTask(Request $request){
        $user = Auth::user();
        $task = Task::find($request->id);
        if($user->isAdmin){
            $request->validate([
                "id" => "required"
            ]);
            $task->delete();
            return response()->json([
                "status" => true,
                "message" => "Task deleted."
            ]);
        } else {
            if($user->id == $task->userId){
                $request->validate([
                    "id" => "required"
                ]);
                $task->delete();
                return response()->json([
                    "status" => true,
                    "message" => "Task deleted."
                ]);
            } else {
                 return response()->json([
                    "status" => false,
                    "message" => "You are not allowed to call this API."
                ]);
            }
           
        }
        
    }

    public function taskList(Request $request){
        $user = Auth::user();
        
        if($user->isAdmin){
            
            $data = Task::orderBy('priority')->paginate(10);
            return response()->json([
                "status" => true,
                "message" => "Task list.",
                "data" => $data
            ]);
        } else {
            $data = Task::where('userId', $user->id)->orderBy('priority')->paginate(10);
            return response()->json([
                "status" => true,
                "message" => "Task list.",
                "data" => $data
            ]);
        }
        
    }
}
