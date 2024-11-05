namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan Anda memiliki view login
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        if (Auth::attempt($request->only('email', 'password'))) {
            // Jika login berhasil, arahkan ke dashboard
            return redirect()->intended('/dashboard');
        }

        // Jika gagal login, kembali dengan error
        return redirect()->back()->withErrors([
            'email' => 'Kredensial yang Anda masukkan salah.',
        ]);
    }
}
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Di LoginController
public function logout(Request $request)
{
    Auth::logout();
    return redirect('/login');
}

