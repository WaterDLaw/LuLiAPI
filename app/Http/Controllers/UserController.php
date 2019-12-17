<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
use Log;

class UserController extends Controller{

    public function __construct()
    {
        // Adds the JWT Auth Middleware to patients
        $this->middleware('jwt.auth')->except(['login', 'register']);
    }

    // Function zum anmelden des Benutzers
    public function register(Request $request){

        // Der Validator überprüft ob die Daten des request alle in Ordnung und vorhanden sind
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'vorname' => 'required',
            'name' => 'required',
            'password'=> 'required',
            'ort' => 'required',
            'userType' => 'required'
        ]);

        // Falls die Daten nicht ok sind so sende die Errors zurück
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        info("CREATTTTTTEEEEEEEEEEE");
        // Kreier den User und speichere in
        User::create([
            'name' => $request->get('name'),
            'vorname' => $request->get('vorname'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'userType' => $request->get('userType'),
            'ort' => $request->get('ort')
        ]);
        // Nehme den neusten User (first) der gerade kreiert wurde und erstelle ein JWT-Token
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        
        return Response::json(compact('token'));
    }

    // Function welche sich um das Login der Benutzer kümmert
    public function login(Request $request){

        
        // Der Validator überprüft ob die Daten des request alle in Ordnung und vorhanden sind
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);

        // Falls die Daten nicht vorhanden oder falsch formatiert sind returne die Errors
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        // Erstelle die Credentials mit den eingegeben Daten
        $credentials = $request->only('email', 'password');

        /**
         * Schritte um das Login korrekt zu überprüfen
         * 
         * try: Versuche den User einzuloggen und erstelle Token
         *      Falls dies nicht möglich ist waren es falsche credentials
         * 
         * catch: Fange alle Fehler ab welche mit der JWT Auth passieren könnten
         * 
         * Falls alles geklappt hat return JWT Token
         */
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        
        return response()->json(compact('token'));
    }

    // Function welche den User mit der entsprechenden Email returned
    public function getUserByEmail($email){
        $user = User::where('email', '=', $email)->get();
        return $user;
    }

    // Function welche den User updated
    public function getAllUsers(){
        $users = User::all();
        return $users;
    }

    // Function to update a User
    public function update(Request $request){
        Log::debug("HIER ALL REQUEST");
        Log::debug($request);
        Log::debug($request->get('password'));

        $user = User::findOrFail($request->id);
        $user->name = $request->get('name');
        $user->vorname = $request->get('vorname');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->userType = $request->get('userType');
        $user->ort = $request->get('ort');
        $user->save();
        return $user;
    }

    public function getSingleUser(Request $request){
        $user = User::findOrFail($request->id);
        return $user;
    }
}