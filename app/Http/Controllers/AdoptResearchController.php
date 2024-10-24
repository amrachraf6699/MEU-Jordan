<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\DocumentaionPeriod;
use App\Models\Indexing;
use App\Models\Language;
use App\Models\Status;
use App\Models\Type;
use Illuminate\Http\Request;

class AdoptResearchController extends Controller
{
    protected $modelTableMap = [
        'status' => 'statuses',
        'type' => 'types',
        'language' => 'languages',
        'indexing' => 'indexings',
        'DocumentaionPeriod' => 'documentaion_periods',
        'AcademicYear' => 'academic_years',
    ];

    public function index()
    {
        $types = Type::all();
        $statuses = Status::all();
        $languages = Language::all();
        $indexings = Indexing::all();
        $documentaion_periods = DocumentaionPeriod::all();
        $academic_years = AcademicYear::all();
        return view('dashboard.adopt-research.index', compact('types', 'statuses', 'languages', 'indexings', 'documentaion_periods', 'academic_years'));
    }

    public function store(Request $request, $model)
    {
        if (!array_key_exists($model, $this->modelTableMap)) {
            return redirect()->back()->with('error', 'النموذج غير موجود.')->withInput();
        }

        $tableName = $this->modelTableMap[$model];

        $rules = [
            'value' => 'required|unique:' . $tableName . '|string|max:255'
        ];

        $messages = [
            'value.required' => 'يرجى ملء هذا الحقل.',
            'value.string' => 'يجب أن يكون الاسم نصًا.',
            'value.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا.',
            'value.unique' => 'هذا الاسم مستخدم بالفعل.',
        ];

        $request->validate($rules, $messages);

        $modelClass = 'App\Models\\' . ucfirst($model);
        if (!class_exists($modelClass)) {
            return redirect()->back()->with('error', 'النموذج غير موجود.')->withInput();
        }

        $modelClass::create([
            'value' => $request->value
        ]);

        return redirect()->back()->with('success', 'تمت الإضافة بنجاح');
    }


    public function delete(Request $request, $id, $model)
    {

        if (!array_key_exists($model, $this->modelTableMap)) {
            return redirect()->back()->with('error', 'النموذج غير موجود.')->withInput();
        }

        $modelClass = 'App\Models\\' . ucfirst($model);
        if (!class_exists($modelClass)) {
            return redirect()->back()->with('error', 'النموذج غير موجود.')->withInput();
        }

        $record = $modelClass::find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'السجل غير موجود.')->withInput();
        }

        $record->delete();

        return redirect()->back()->with('success', 'تم حذف السجل بنجاح.');
    }






}
