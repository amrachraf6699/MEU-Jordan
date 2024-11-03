<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\DocumentaionPeriod;
use App\Models\Hint;
use App\Models\Indexing;
use App\Models\Language;
use App\Models\Priority;
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
        'Priority' => 'priorities',
    ];

    public function index()
    {
        $types = Type::all();
        $statuses = Status::all();
        $languages = Language::all();
        $indexings = Indexing::all();
        $documentaion_periods = DocumentaionPeriod::all();
        $academic_years = AcademicYear::all();
        $hints = Hint::first();
        $priorities = Priority::all();

        return view('dashboard.adopt-research.index', compact('types', 'statuses', 'languages', 'indexings', 'documentaion_periods', 'academic_years', 'hints', 'priorities'));
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

    public function saveHints(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'date_of_publication' => 'nullable|string|max:255',
            'sort' => 'nullable|string|max:255',
            'sources' => 'nullable|string|max:255',
            'indexing' => 'nullable|string|max:255',
            'evidences' => 'nullable|string|max:255',
            'documentaion_period' => 'nullable|string|max:255',
            'academic_year' => 'nullable|string|max:255',
            'priority' => 'nullable|string|max:255',
            'publication_link' => 'nullable|string|max:255',
        ], [
            'title.max' => 'الحد الأقصى لعنوان النتاج البحثي هو 255 حرف.',
            'type.max' => 'الحد الأقصى لنوع النتاج البحثي هو 255 حرف.',
            'status.max' => 'الحد الأقصى لحالة النشر هو 255 حرف.',
            'language.max' => 'الحد الأقصى للغة النشر هو 255 حرف.',
            'date_of_publication.max' => 'الحد الأقصى لتاريخ النشر هو 255 حرف.',
            'sort.max' => 'الحد الأقصى لترتيب المباحث هو 255 حرف.',
            'sources.max' => 'الحد الأقصى لمصدر النتاج البحثي هو 255 حرف.',
            'indexing.max' => 'الحد الأقصى للفهرسة هو 255 حرف.',
            'evidences.max' => 'الحد الأقصى لتحميل الشواهد هو 255 حرف.',
            'documentaion_period.max' => 'الحد الأقصى لفترة التوثيق هو 255 حرف.',
            'academic_year.max' => 'الحد الأقصى للعام الأكاديمي هو 255 حرف.',
            'priority.max' => 'الحد الأقصى لأولوية النشر هو 255 حرف.',
            'publication_link.max' => 'الحد الأقصى لرابط النشر هو 255 حرف.',
        ]);

        $hints = Hint::first();

        if ($hints) {
            $hints->update($validatedData);
        } else {
            Hint::create($validatedData);
        }

        return redirect()->back()->with('success', 'تم حفظ الحقول بنجاح!');
    }



}
