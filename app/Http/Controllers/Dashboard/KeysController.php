<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RecoveryKey;
use Illuminate\Http\Request;

class KeysController extends Controller
{
    public function index()
    {
        $key = auth()->user()->key;
        return view('dashboard.keys.index', compact('key'));
    }

    public function generate(Request $request)
    {
        $key = RecoveryKey::where('user_id', auth()->id())->first();

        if($key)
        {
            $key->update([
                'key' => bin2hex(random_bytes(6))
            ]);
        } else {
            RecoveryKey::create([
                'user_id' => auth()->id(),
                'key' => bin2hex(random_bytes(6))
            ]);
        }

        $this->MakeActivity('قام بإنشاء رمز إسترداد', $request);
        
        return back()->with('success', 'تم إنشاء مفتاح الإسترداد بنجاح');
    }
}
