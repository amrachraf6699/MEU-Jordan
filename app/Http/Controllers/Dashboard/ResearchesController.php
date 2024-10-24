<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ResearchesExport;
use App\Exports\ResearchExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateResearchRequest;
use App\Models\AcademicYear;
use App\Models\Department;
use App\Models\DocumentaionPeriod;
use App\Models\Indexing;
use App\Models\Language;
use App\Models\Research;
use App\Models\Status;
use App\Models\Type;
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

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('my_researches')) {
            $query->where('user_id', auth()->id());
        }


        $researches = $query->paginate(10);

        $departments = Department::all();

        $statuses = Status::all();

        return view('dashboard.researches.index', compact('researches', 'departments' , 'statuses'));
    }


    public function create()
{
    $types = Type::all();
    $statuses = Status::all();
    $languages = Language::all();
    $indexings = Indexing::all();
    $documentaion_periods = DocumentaionPeriod::all();
    $academic_years = AcademicYear::all();

    return view('dashboard.researches.create', compact('types', 'statuses', 'languages', 'indexings', 'documentaion_periods', 'academic_years'));
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
                'indexing' => $request->indexing,
                'sources' => $request->sources,
                'documentaion_period' => $request->documentaion_period,
                'academic_year' => $request->academic_year,
            ]
        );

        return redirect()->route('dashboard.home')->with('success', 'تمت الإضافة بنجاح');
    }

    public function show(Research $research)
    {
        $this->authorize('view', $research);

        $research->load('user');

        return view('dashboard.researches.show', compact('research'));
    }

    public function edit(Research $research)
    {
        $this->authorize('update', $research);

        $research->date_of_publication = Carbon::parse($research->date_of_publication)->format('Y-m-d');
        $research->documentaion_period_start = Carbon::parse($research->documentaion_period_start)->format('Y-m-d');
        $research->documentaion_period_end = Carbon::parse($research->documentaion_period_end)->format('Y-m-d');

        return view('dashboard.researches.edit', compact('research'));
    }

    public function update(CreateResearchRequest $request, Research $research)
    {
        $this->authorize('update', $research);

        $research->update(
            [
                'title' => $request->title,
                'type' => $request->type,
                'language' => $request->language,
                'date_of_publication' => $request->date_of_publication,
                'sort' => $request->sort,
                'evidences' => $request->hasFile('evidences') ? $this->uploadFile($request->file('evidences')) : $research->evidences,
                'indexing' => $request->indexing,
                'sources' => $request->sources,
                'documentaion_period_start' => $request->documentaion_period_start,
                'documentaion_period_end' => $request->documentaion_period_end,
                'academic_year' => $request->academic_year,
            ]
        );

        return redirect()->route('dashboard.home')->with('success', 'تم التعديل بنجاح');
    }

    public function approve(Research $research)
    {
        $this->authorize('approve', $research);

        $research->update(['status' => 'approved']);

        return back()->with('success', 'تم الإعتماد بنجاح');
    }

    public function destroy(Research $research)
    {
        $this->authorize('delete', $research);

        $research->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }

    public function export(Research $research, Request $request)
    {
        $research->load('user');

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

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('my_researches')) {
            $query->where('user_id', auth()->id());
        }

        $researches = $query->get();

        if($request->format == 'pdf')
        {
            return $this->exportAllExcel($researches);
        }elseif($request->format == 'excel')
        {
            return $this->exportAllPDF($researches);
        }

    }



    public function revoke(Research $research)
    {
        $this->authorize('revoke', $research);

        $research->update(['status' => 'pending']);

        return back()->with('success', 'تم فك الإعتماد بنجاح');
    }


    protected function exportAllPDF($researches)
    {
        return Excel::download(new ResearchesExport($researches), 'تصدير النتاجات البحثية.xlsx');
    }

    protected function exportAllExcel($researches)
    {
        $researches->load('user');

        $pdf = PDF::loadView('dashboard.researches.pdfs',compact('researches'));

        return $pdf->download('تصدير النتاجات البحثية.pdf');
    }
}
