<?php

namespace App\Http\Controllers;

use App\Http\helpers\Formula;
use App\Models\Subcriteria;
use App\Models\SubcriteriaComparison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcriteriaComparisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($criteria_id)
    {
        $subcriterias      = Subcriteria::where('criteria_id', $criteria_id)->with('comparisons')->get();
        $count_subcriteria = $subcriterias->count();
        $is_valid          = Subcriteria::isCRValid($criteria_id);
        $IR                = Formula::$nilai_index_random[$count_subcriteria];
        $CI                = Subcriteria::getCI($criteria_id);
        $max_lamda         = Subcriteria::getMaxLamda($criteria_id);
        $CR                = Subcriteria::getCR($criteria_id);
        $matrix_valid      = Subcriteria::isMatrixValid($criteria_id);

        return view('pages.subcriteria.matrix', compact(
            'criteria_id',
            'subcriterias',
            'is_valid',
            'IR',
            'CI',
            'CR',
            'max_lamda',
            'count_subcriteria',
            'matrix_valid'
        ));
    }

    public function store(Request $request, $criteria_id)
    {
        // dd($request);
        DB::transaction(function () use ($request, $criteria_id) {
            // Simpan subcriteria comparison
            $subcriteriaComparisons = SubcriteriaComparison::whereHas('subcriteria', function ($query) use ($criteria_id) {
                $query->where('criteria_id', $criteria_id);
            })->get();

            foreach ($subcriteriaComparisons as $criteriaComparison) {
                $criteriaComparison->value = $request->post(strval($criteriaComparison->id));
                $criteriaComparison->save();
            }

            SubcriteriaComparison::calculateMatrix($criteria_id);
        });

        $redirect = route('subcriteria.matrix', ['criteriaId' => $criteria_id]);
        return response()->json(['redirect' => $redirect]);
    }

    // public function alternatif()
    // {
    //     $kriterias = Criteria::get();
    //     $alternatifs = Employee::get();
    //     $nilai_prioritas_subkriterias = SubcriteriaPriority::get();
    //     $perhitungans_all = Calculation::get();
    //     $is_valid = ValidCriteria::first();
    //     $is_subkriteria_valid = ValidSubcriteria::where('is_valid', false)->first();
    //     $error_alternatif = false;
    //     $error_sub = false;
    //     $sub_valid = ValidSubcriteria::get();
    //     if (count($sub_valid) != count($kriterias)) {
    //         $error_sub = true;
    //     }

    //     foreach ($alternatifs as $alt) {
    //         $count_alt_det = EmployeeDetail::where('employee_id', $alt->id)->get();
    //         if (count($count_alt_det) != count($kriterias)) {
    //             $error_alternatif = true;
    //             break;
    //         }
    //     }

    //     return view('pages.perhitungan_subkriteria.alternatif', [
    //         'subcriterias' => $kriterias,
    //         'alternatifs' => $alternatifs,
    //         'nilai_prioritas_subkriterias' => $nilai_prioritas_subkriterias,
    //         'perhitungans_all' => $perhitungans_all,
    //         'is_valid' => $is_valid,
    //         'is_subkriteria_valid' => $is_subkriteria_valid ? false : true,
    //         'error_sub' => $error_sub,
    //         'error_alternatif' => $error_alternatif,
    //     ]);
    // }
}
