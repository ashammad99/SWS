<?php

namespace App\Http\Controllers\Orphan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use mysql_xdevapi\Collection;

class OrphanController extends Controller
{
    //
    public function index()
    {
        $orphans     = Orphan::with('Guardian')->where('sr_id', '=', Auth::user()->sr_id)->get();
        //$Child = Orphan::with('Guardian')->find(2816);
//        dd($orphans);
        return view('Child.table-data', ['orphans' => $orphans]);
    }

    public function create()
    {
        $scales = self::getEnumValues('children', 'Scale_Of_poverty');
        $categories = self::getEnumValues('children', 'Category');
        $governates = DB::table('governorates')->get();
        $camps = DB::table('camps')->get();
        $relationsAr = self::getEnumValues('Guardian','REL_TO_CHILD_AR');
        $relationsEN = self::getEnumValues('Guardian','REL_TO_CHILD_EN');
//        dd($governates);
//        dd($scales);
        return view('Child.form-wizards',
            compact('scales', 'categories','governates','camps','relationsAr','relationsEN'));
    }

    public function store(Request  $request)
    {

        $request->validate([
            'NO_ORPHAN_CODE' => ['required','integer'],
            'childGovNum' => ['required','integer','digits:9'],
            'Orphan_Name_En' => ['required','string'],
            'Orphan_Name_Ar'=> ['required','string'],
            'ORPHAN_DOB' => ['required','date'],
            'Category' =>['required','exists:children,Category'],
            'Scale_Of_poverty' => ['required','exists:children,Scale_Of_poverty'],
            'Father_Name_EN' => ['required','string'],
            'Father_Name_AR'=> ['required','string'],
            'Father_ID' => ['required','integer','digits:9'],
            'father_death_date' => ['nullable','date'],
            'Address' => ['nullable','string'],
            'MAIL_CODE' => ['int','nullable'],
            'AREA_CODE' => ['int','nullable'],
            'ACCOUNT_NO_BOP' => ['']

        ]);

        dd($request->all());

    }

    public function edit()
    {

    }

    public static function getEnumValues($table, $column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum = \array_add($enum,$v,$v);
        }
        return $enum;
    }
}
