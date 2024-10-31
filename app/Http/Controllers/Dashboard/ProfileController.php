<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompleteProfileRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function settings()
    {
        return view('dashboard.Profile.settings');
    }

    public function update(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ],[
            'old_password.required' => 'كلمة المرور القديمة مطلوبة',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن لا تقل عن 8 أحرف',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
        ]);

        $user = auth()->user();

        if (!\Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'كلمة المرور القديمة غير صحيحة'])->withInput();
        }

        $user->update([
            'password' => $request->password,
        ]);

        $this->MakeActivity('قام بتغيير كلمة المرور' , $request);

        return redirect()->route('dashboard.home')->with('success', 'تم تحديث كلمة المرور بنجاح');
    }


    public function complete(CompleteProfileRequest $request)
    {
        auth()->user()->update($request->only('department_id' , 'program_id'));

        $this->MakeActivity('قام بإكمال الملف الشخصي' , $request);

        return redirect()->route('dashboard.home')->with('success','تمت إكمال البيانات بنجاح');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function activities()
    {
        $activities = auth()->user()->activities()->paginate(10);

        return view('dashboard.activities' , compact('activities'));
    }

    public function usersActivities(Request $request)
    {
        $this->middleware('admin');

        $query = UserActivity::query();

        if($request->has('user_id') && $request->user_id != null)
        {
            $query->where('user_id' , $request->user_id);
        }

        if($request->filled('from_date') && $request->filled('to_date'))
        {
            $query->whereBetween('created_at' , [$request->from_date , $request->to_date]);
        }

        $activities = $query->paginate(10);


        $users = User::all();

        return view('dashboard.users-activities' , compact('activities' , 'users'));
    }
}
