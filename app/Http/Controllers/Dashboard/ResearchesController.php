<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ResearchesExport;
use App\Exports\ResearchExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateResearchRequest;
use App\Models\AcademicYear;
use App\Models\Department;
use App\Models\DocumentaionPeriod;
use App\Models\Hint;
use App\Models\Indexing;
use App\Models\Language;
use App\Models\Priority;
use App\Models\Program;
use App\Models\Research;
use App\Models\Status;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use ArPHP\I18N\Arabic;
use PDF;

class ResearchesController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $role = $user->role;

        $query = Research::query();

        if ($role == 'user') {
            $query->where('user_id', $user->id);
        }
        elseif ($role == 'committee_member') {
            $query->whereHas('user', function ($q) use ($user) {
                $q->where('department_id', $user->department_id);
            });
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        if ($request->filled('department_id')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('department_id', $request->department_id);
            });
        }

        if($request->filled('program_id')){
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('program_id', $request->program_id);
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('my_researches')) {
            $query->where('user_id', auth()->id());
        }

        if($request->filled('accreditation_status')){
            $query->where('accreditation_status', $request->accreditation_status);
        }


        $researches = $query->paginate(10);

        $departments = Department::all();
        $programs = Program::all();

        $statuses = Status::all();

        return view('dashboard.researches.index', compact('researches', 'departments' , 'statuses', 'programs'));
    }


    public function create()
    {
        $types = Type::all();
        $statuses = Status::all();
        $languages = Language::all();
        $indexings = Indexing::all();
        $documentaion_periods = DocumentaionPeriod::all();
        $academic_years = AcademicYear::all();
        $priorities = Priority::all();
        $hints = Hint::first();
        return view('dashboard.researches.create', compact('types', 'statuses', 'languages', 'indexings', 'documentaion_periods', 'academic_years', 'hints', 'priorities'));
    }


    public function store(CreateResearchRequest $request)
    {

        auth()->user()->researches()->create(
            [
                'title' => $request->title,
                'type' => $request->type,
                'language' => $request->language,
                'date_of_publication' => $request->date_of_publication,
                'sort' => $request->sort,
                'evidences' => $this->uploadFile($request->file('evidences')),
                'indexing' => implode(',', $request->indexing),
                'sources' => $request->sources,
                'documentaion_period' => $request->documentaion_period,
                'academic_year' => $request->academic_year,
                'status' => $request->status,
                'priority' => $request->priority,
                'publication_link' => $request->publication_link,
            ]
        );

        $this->MakeActivity('قام بإضافتة نتاج بحثي جديد', $request);

        return redirect()->route('dashboard.home')->with('success', 'تمت الإضافة بنجاح');
    }

    public function show(Research $research)
    {
        $this->authorize('view', $research);

        $research->load('user', 'revokedBy');

        return view('dashboard.researches.show', compact('research'));
    }

    public function edit(Research $research)
    {
        $this->authorize('update', $research);


        $types = Type::all();
        $statuses = Status::all();
        $languages = Language::all();
        $indexings = Indexing::all();
        $documentaion_periods = DocumentaionPeriod::all();
        $academic_years = AcademicYear::all();
        $priorities = Priority::all();
        $hints = Hint::first();

        return view('dashboard.researches.edit', compact('research', 'types', 'statuses', 'languages', 'indexings', 'documentaion_periods', 'academic_years', 'hints', 'priorities'));
    }

    public function update(CreateResearchRequest $request, Research $research)
    {
        $this->authorize('update', $research);

        $research->update(
            [
                'title' => $request->title,
                'type' => $request->type,
                'status' => $request->status,
                'language' => $request->language,
                'date_of_publication' => $request->date_of_publication,
                'sort' => $request->sort,
                'evidences' => $request->hasFile('evidences') ? $this->uploadFile($request->file('evidences')) : $research->evidences,
                'indexing' => implode(',', $request->indexing),
                'sources' => $request->sources,
                'documentaion_period' => $request->documentaion_period,
                'academic_year' => $request->academic_year,
                'priority' => $request->priority,
                'publication_link' => $request->publication_link,
            ]
        );

        $this->MakeActivity("قام بتعديل نتاج بحثي بعنوان {$research->title}", $request);

        return redirect()->route('dashboard.home')->with('success', 'تم التعديل بنجاح');
    }

    public function approve(Research $research)
    {
        $this->authorize('approve', $research);

        $research->update(['accreditation_status' => 'معتمد']);


        $this->MakeActivity("قام بإعتماد نتاج بحثي بعنوان {$research->title}", request());

        return back()->with('success', 'تم الإعتماد بنجاح');
    }

    public function destroy(Research $research)
    {
        $this->authorize('delete', $research);

        $this->MakeActivity("قام بحذف نتاج بحثي بعنوان {$research->title}", request());

        $research->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }

    public function export(Research $research, Request $request)
    {
        $research->load('user');

        $this->authorize('view', $research);


        $this->MakeActivity("قام بتصدير نتاج بحثي بعنوان {$research->title}", request());

        if($request->type == 'excel')
        {
            return Excel::download(new ResearchExport($research), 'النتاج البحثي-' . $research->title . '.xlsx');
        }elseif($request->type == 'pdf')
        {
            $research->load('user');

            $pdf = PDF::loadView('dashboard.researches.pdf',compact('research'));

            return $pdf->download('النتاج البحثي-' . $research->title . '.pdf');

        }
        abort(403, "Something Went Wrong");
    }

    public function exportall(Request $request)
    {
        $user = auth()->user();
        $role = $user->role;

        $this->MakeActivity('قام بتصدير جميع النتاجات البحثية', $request);

        $query = Research::query();

        if ($role == 'user') {
            $query->where('user_id', $user->id);
        }
        elseif ($role == 'committee_member') {
            $query->whereHas('user', function ($q) use ($user) {
                $q->where('department_id', $user->department_id);
            });
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        if ($request->filled('department_id')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('department_id', $request->department_id);
            });
        }

        if($request->filled('program_id')){
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('program_id', $request->program_id);
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('my_researches')) {
            $query->where('user_id', auth()->id());
        }

        if($request->filled('accreditation_status')){
            $query->where('accreditation_status', $request->accreditation_status);
        }

        $researches = $query->get();

        if($request->format == 'pdf')
        {
            return $this->exportAllPDF($researches);
        }elseif($request->format == 'excel')
        {
            return $this->exportAllExcel($researches);
        }

    }



    public function revoke(Research $research)
    {
        $this->authorize('revoke', $research);

        $research->update([
            'accreditation_status' => 'معلق',
            'revoked_by' => auth()->id()
        ]);

        $this->MakeActivity("قام بفك الإعتماد عن نتاج بحثي بعنوان {$research->title}", request());

        return back()->with('success', 'تم فك الإعتماد بنجاح');
    }

    public function assign(Research $research)
    {
        $this->authorize('assign', $research);

        $users = User::where('id', '!=', auth()->id())->get();

        return view('dashboard.researches.assign', compact('research', 'users'));
    }

    public function assignStore(Request $request, Research $research)
    {
        $this->authorize('assign', $research);

        $request->validate((['user_id' => 'required|exists:users,id']));

        $research->update(['user_id' => $request->user_id]);

        $user = User::find($request->user_id);

        $this->MakeActivity("قام بإسناد نتاج بحثي بعنوان {$research->title} للمستخدم {$user->full_name}", request());

        return redirect()->route('dashboard.home')->with('success', 'تم الإسناد بنجاح');
    }


    protected function exportAllExcel($researches)
    {
        return Excel::download(new ResearchesExport($researches), 'تصدير النتاجات البحثية.xlsx');
    }

    protected function exportAllPDF($researches)
    {
        $researches->load('user');

        $pdf = PDF::loadView('dashboard.researches.pdfs',compact('researches'));

        return $pdf->download('تصدير النتاجات البحثية.pdf');
    }
}
