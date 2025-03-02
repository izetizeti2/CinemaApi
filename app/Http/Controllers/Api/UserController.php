<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Merr të gjithë përdoruesit (Vetëm për adminët).
     */
    public function getUsers()
    {
        // Merr të gjithë përdoruesit
        $users = User::all();
    
        return response()->json($users);
    }

    /**
     * Merr një përdorues sipas ID-së.
     */
    public function getUserById($id)
    {
        // Gjej përdoruesin me ID
        $user = User::findOrFail($id);
        
        return response()->json($user);
    }

    /**
     * Fshin një përdorues.
     */
    public function deleteUser($id)
    {
        // Gjej përdoruesin me ID
        $user = User::findOrFail($id);

        // Fshi përdoruesin
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    /**
     * Përditëson një përdorues ekzistues.
     */
    public function updateUser(Request $request, $id)
    {
        // Gjej përdoruesin me ID
        $user = User::findOrFail($id);

        // Validimi i të dhënave
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string|in:admin,user',  // Mund të ndryshosh rolet sipas nevojës
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Përditëso përdoruesin
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return response()->json($user);
    }
}
