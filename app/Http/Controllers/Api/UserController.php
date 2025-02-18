<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    // Merr të gjithë përdoruesit
    public function index()
    {
        // Këtu mund të përdorësh një kontrolle të rolit për të siguruar që vetëm admin mund të merr të gjithë përdoruesit
        

        $users = User::all(); // Merr të gjithë përdoruesit
        return Response::json($users);
    }

    // Merr një përdorues sipas ID-së
    public function show($id)
    {
        $user = User::find($id);

        

        return Response::json($user);
    }

    // Përditëso një përdorues
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        

        // Validimi i të dhënave
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|string|in:user,admin', // Mund të përshtatet me rolet që ke
        ]);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 400);
        }

        // Përditëso përdoruesin
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('role')) {
            $user->role = $request->role;
        }

        $user->save();

        return Response::json($user);
    }
}
