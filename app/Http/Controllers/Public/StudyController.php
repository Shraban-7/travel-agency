<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudyController extends Controller
{
    public function index(Request $request): View
    {
        $query = University::query()
            ->where('is_active', true)
            ->with(['country'])
            ->withCount(['studyPrograms as programs_count' => function ($q) {
                $q->where('is_active', true);
            }])
            ->with(['studyPrograms' => function ($q) use ($request) {
                $q->where('is_active', true);
                if ($request->filled('level')) {
                    $q->where('level', $request->string('level')->toString());
                }
                if ($request->filled('field')) {
                    $q->where('field', 'like', '%'.$request->string('field')->toString().'%');
                }
                $q->with(['intakes' => function ($iq) {
                    $iq->whereDate('application_deadline', '>=', now()->toDateString())
                        ->orderBy('application_deadline');
                }]);
            }]);

        if ($request->filled('country')) {
            $query->where('country_id', $request->integer('country'));
        }

        $universities = $query->orderBy('ranking')->paginate(9)->withQueryString();
        $countries = Country::where('is_active', true)->orderBy('sort_order')->get();

        return view('public.study.index', compact('universities', 'countries'));
    }

    public function show(University $university): View
    {
        abort_unless($university->is_active, 404);

        $university->load([
            'country',
            'studyPrograms' => function ($q) {
                $q->where('is_active', true)->orderBy('tuition_fee');
            },
            'studyPrograms.intakes' => function ($q) {
                $q->orderBy('application_deadline');
            },
        ]);

        return view('public.study.show', compact('university'));
    }
}
