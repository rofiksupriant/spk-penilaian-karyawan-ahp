<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Criteria;
use App\Models\Employee;
use App\Models\Subcriteria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $employees = $user->role == User::ADMIN
            ? Employee::paginate(10)
            : Employee::where('assessor_id', $user->id)->paginate(10);

        return view('pages.assessment.index', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($employeeId)
    {
        $employee         = Employee::findOrFail($employeeId);
        $criterias        = Criteria::all();

        $assessments = [];
        foreach ($criterias as $criteria) {
            $assessmentModels = Assessment::with('subcriteria')
                ->where('employee_id', $employeeId)
                ->where('criteria_id', $criteria->id)
                ->orderBy('subcriteria_id', 'asc')
                ->get();

            $assessmentResponse = [];
            foreach ($assessmentModels as $assessment) {
                $assessmentResponse[] = (object)[
                    'id'    => $assessment->id,
                    'name'  => $assessment->subcriteria['name'],
                    'value' => $assessment->value,
                ];
            }
            $assessments[] = (object) ['criteria' => $criteria->name, 'values' => $assessmentResponse];
        }

        $grade_dropdown = Assessment::gradeDropdown();
        return view('pages.assessment.edit', compact('employee', 'assessments', 'grade_dropdown'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        foreach ($request->all() as $key => $value) {
            Assessment::where('id', intval($key))->update(['value' => $value]);
        }

        toast('Nilai berhasil disimpan', 'success');
        return redirect()->back();
    }


    public function matrix()
    {
        $employees       = Employee::all();
        $subcriteriaList = Subcriteria::all();
        $assessments     = Assessment::with('subcriteria', 'employee')->get();

        return view('pages.assessment.result', compact('employees', 'subcriteriaList', 'assessments'));
    }

    public function calculate()
    {
        if (!Criteria::isCRValid() || !Criteria::isMatrixValid()) {
            toast('Nilai CR kriteria tidak valid', 'error');
            return redirect()->back();
        }

        $criterias = Criteria::all();
        foreach ($criterias as $criteria) {
            if (!Subcriteria::isCRValid($criteria->id) || !Subcriteria::isMatrixValid($criteria->id)) {
                toast('Nilai CR subkriteria (' . $criteria->name . ') tidak valid', 'error');
                return redirect()->back();
            }
        }

        Assessment::calculate();

        toast('Berhasil hitung nilai', "success");
        return redirect()->back();
    }
}
