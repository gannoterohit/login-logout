<?php
   namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\hash;
use App\Models\User;



class AuthController extends Controller
{
    
    
    public function index()
    {
        return view('home');
    }
    public function desbord()
    {
        return view('desbord');
    }

        public function showLoginForm()
        {
            return view('login');
        }


        public function login(Request $request)
{
   
    $credentials = $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $user = User::where('email', $credentials['email'])->first();

    if ($user) {
        session::put('loginID', $user->email);

        return redirect('desbord');
    } else {
        return redirect('login');
    }
}

    
      
    
        public function showRegistrationForm()
        {
            return view('registration');
        }
    
        public function register(Request $request)
        {
            $this ->validate($request,[
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|min:8|confirmed',
            ]);
            $validatedData=$request->all();
            // Create a new user
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();
    
            return redirect('desbord')->with('success', 'Registration successful! Please log in.');
            
        }
    
    
        public function logout  (Request $request)
        {
            // dd('hello');
            // Log the user out
            Auth::logout();
    
            // Clear the session data
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            // Redirect the user to the desired location after logout
            return redirect('showLoginForm');
        }
    }