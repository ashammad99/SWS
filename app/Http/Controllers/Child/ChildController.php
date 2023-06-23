<?php

namespace App\Http\Controllers\Child;

use App\Http\Controllers\Controller;
use App\Models\BankInfo;
use App\Models\Beneficiary;
use App\Models\Guardian;
use App\Models\Orphan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $beneficiaries     = Beneficiary::with('Guardian')->where('sr_id', '=', Auth::user()->sr_id)->get();
        //$Child = Orphan::with('Guardian')->find(2816);
//        dd($orphans);
        return view('Child.table-data');
    }

    public function create()
    {

        $scales = self::getEnumValues('child_identification', 'Scale_Of_poverty');

        $categories = self::getEnumValues('child_identification', 'category');

        $governates = DB::table('governorates')->get();

        $areas = DB::table('areas')->get();

        $relationsAr = self::getEnumValues('guardians','rel_to_ar');
        $relationsEN = self::getEnumValues('guardians','rel_to_en');

        $mother_martial_status = self::getEnumValues('child_identification','mother_martial_status');
        $guardian_martial_status = self::getEnumValues('guardians','guardian_martial_status');
        $works = self::getEnumValues('guardians','work');
        $edu_levels = self::getEnumValues('guardians','edu_level');
        $monthly_salary = self::getEnumValues('guardians','monthly_salary');
        $child_edu_level = self::getEnumValues('childs_edu_status','edu_level');

        $jobs_members = self::getEnumValues('childs_economic_status','jobs_members');
        $periodic_sponsorships = self::getEnumValues('childs_economic_status','periodic_sponsorships');
        $irregular_aids = self::getEnumValues('childs_economic_status','irregular_aids');
        $resident_statuses = self::getEnumValues('childs_resident_status','resident_status');
        $resident_types = self::getEnumValues('childs_resident_status','resident_type');
        $resident_descriptions = self::getEnumValues('childs_resident_status','resident_description');

        return view('Child.form-wizards',
            compact('scales',
                'categories','governates','areas','relationsAr','relationsEN',
                'mother_martial_status','guardian_martial_status','works',
                'edu_levels','monthly_salary','child_edu_level','jobs_members'
            ,'periodic_sponsorships','irregular_aids','resident_statuses','resident_types','resident_descriptions'
            )
        );
    }

    public function store(Request  $request)
    {
        dd($request->all());
        $data = $request->validate([
            'NO_ORPHAN_CODE' => ['required','integer'],
            'childGovNum' => ['required','integer','digits:9'],
            'Orphan_Name_En' => ['required','string'],
            'Orphan_Name_Ar'=> ['required','string'],
            'ORPHAN_DOB' => ['required','date'],
            'Category' =>['required','exists:beneficiaries,Category'],
            'CAT' =>['required','exists:beneficiaries,CAT'],
            'Scale_Of_poverty' => ['required','exists:beneficiaries,Scale_Of_poverty'],
            'Father_Name_EN' => ['required','string'],
            'Father_Name_AR'=> ['required','string'],
            'Father_ID' => ['required','integer','digits:9'],
            'father_death_date' => ['nullable','date'],
            'NO_SPONSORED' => ['required','integer'],
            //Address Information validation Rules
            'Address' => ['required','string'],
            'governate' =>['required','exists:governorates,gov_id'],
            'camp' =>['required','exists:camps,camp_id'],
            'MAIL_CODE' => ['int','nullable'],
            //Banking Information Validation Rules
            'AREA_CODE' => ['int','nullable'],
            'ACCOUNT_NO_BOP' => ['required','int'],
            'Branch_No' => ['required','int'],
            'IBAN' =>['string','max:34'],
            //Guardian Information Validation Rules
            'Guardian_En' => ['required','string'],
            'Guardian_Ar' => ['required','string'],
            'relation_en' => ['required','exists:guardian,REL_TO_CHILD_EN'],
            'relation_ar' => ['required','exists:guardian,REL_TO_CHILD_AR'],
            'GuardianPhoneNum' => ['required','between: 8,10'],
            'GuardianPhoneNum2' => ['required','between: 8,10'],
            'GuardianTelephoneNum' => ['nullable','integer','digits:9'],
        ]);
        $beneficiary = new Beneficiary();
        $beneficiary->NO_ORPHAN_CODE = $data['NO_ORPHAN_CODE'];
        $beneficiary->is_vip = $data['is_vip'];
        $beneficiary->Category = $data['Category'];
        $beneficiary->Orphan_Name_En = $data['Orphan_Name_En'];
        $beneficiary->Orphanc_Name_Ar = $data['Orphanc_Name_Ar'];
        $beneficiary->Gender = $data['Gender'];
        $beneficiary->ORPHAN_DOB = $data['ORPHAN_DOB'];
        $beneficiary->Guardian_id = $data['Guardian_id'];
        $beneficiary->childGovNum = $data['childGovNum'];
        $beneficiary->father_death_date = $data['father_death_date'];
        $beneficiary->gov_id = $data['gov_id'];
        $beneficiary->camp_id = $data['camp_id'];
        $beneficiary->sr_id = Auth::user()->sr_id;
        $beneficiary->Disability = $data['Disability'];
        $beneficiary->Disability_type = $data['Disability_type'];
        $beneficiary->MAIL_CODE = $data['MAIL_CODE'];
        $beneficiary->AREA_CODE = $data['AREA_CODE'];
        $beneficiary->address = $data['address'];
        $beneficiary->Father_ID = $data['Father_ID'];
        $beneficiary->Father_Name_EN = $data['Father_Name_EN'];
        $beneficiary->Father_Name_AR = $data['Father_Name_AR'];
        $beneficiary->Scale_Of_poverty = $data['Scale_Of_poverty'];
        $beneficiary->CAT = $data['CAT'];
        $beneficiary->NO_SPONSORED = $data['NO_SPONSORED'];
        $beneficiary->save();


        $guardian_id = $data['Guardian_id'];

        if (Guardian::where('id', $guardian_id)->exists()) {
            // Guardian with this id already exists, do not store the new Guardian
        } else {
            // Create a new Guardian and store it in the database
            $guardian = new Guardian();
            $guardian->id = $data['Guardian_id'];
            $guardian->Guardian_En = $data['Guardian_En'];
            $guardian->Guardian_Ar = $data['Guardian_Ar'];
            $guardian->REL_TO_CHILD_EN = $data['REL_TO_CHILD_EN'];
            $guardian->REL_TO_CHILD_AR = $data['REL_TO_CHILD_AR'];
            $guardian->GuardianPhoneNum = $data['GuardianPhoneNum'];
            $guardian->GuardianPhoneNum2 = $data['GuardianPhoneNum2'];
            $guardian->GuardianTelephoneNum = $data['GuardianTelephoneNum'];
            $guardian->save();
        }


        if (BankInfo::where('guardian_id', $guardian_id)->exists()) {
            // BankInfo of beneficiary with this guardian_id already exists, do not store the new banking info
        } else {
            $bank_info = new BankInfo();
            $bank_info->guardian_id = $data['Guardian_id'];
            $bank_info->ACCOUNT_NO_BOP = $data['ACCOUNT_NO_BOP'];
            $bank_info->Branch_No = $data['Branch_No'];
            $bank_info->IBAN = $data['IBAN'];
            $bank_info->save();
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $beneficary = Beneficiary::with('Governate','Guardian')->find($id);
        //dd($beneficary->Guardian->BankInfo);

//        $bank_info = $beneficary->Guardian()->with('BankInfo')->get();
//dd($bank_info);
        $scales = self::getEnumValues('beneficiaries', 'Scale_Of_poverty');
        $categories = self::getEnumValues('beneficiaries', 'Category');
        $governates = DB::table('governorates')->get();
        $camps = DB::table('camps')->get();
        $relationsAr = self::getEnumValues('Guardian','REL_TO_CHILD_AR');
        $relationsEN = self::getEnumValues('Guardian','REL_TO_CHILD_EN');
        $CATs = self::getEnumValues('beneficiaries','CAT');
        return view('Child.edit', compact('beneficary','scales', 'categories','governates','camps','relationsAr','relationsEN','CATs'));
    }

    public function update(Request $request, $id) {
//        dd($request->all());
        $request->validate([
            'NO_ORPHAN_CODE' => ['required','integer'],
            'childGovNum' => ['required','integer','digits:9'],
            'Orphan_Name_En' => ['required','string'],
            'Orphan_Name_Ar'=> ['required','string'],
            'ORPHAN_DOB' => ['required','date'],
            'Category' =>['required','exists:beneficiaries,Category'],
            'Scale_Of_poverty' => ['required','exists:beneficiaries,Scale_Of_poverty'],
            'Father_Name_EN' => ['required','string'],
            'Father_Name_AR'=> ['required','string'],
            'Father_ID' => ['required','integer','digits:9'],
            'father_death_date' => ['nullable','date'],
            'NO_SPONSORED' => ['required','integer'],
            'CAT' =>['required','exists:beneficiaries,CAT'],
            //Address Information alidation Rules
            'Address' => ['required','string'],
            'governate' =>['required','exists:governorates,gov_id'],
            'camp' =>['required','exists:camps,camp_id'],
            'MAIL_CODE' => ['int','nullable'],
            //Banking Information Validation Rules
            'AREA_CODE' => ['int','nullable'],
            'ACCOUNT_NO_BOP' => ['required','int'],
            'Branch_No' => ['required','int'],
            'IBAN' =>['string','max:34','required'],
            //Guardian Information Validation Rules
            'Guardian_En' => ['required','string'],
            'Guardian_Ar' => ['required','string'],
            'relation_en' => ['required','exists:guardian,REL_TO_CHILD_EN'],
            'relation_ar' => ['required','exists:guardian,REL_TO_CHILD_AR'],
            'GuardianPhoneNum' => ['required','between: 8,10'],
            'GuardianPhoneNum2' => ['required','between: 8,10'],
            'GuardianTelephoneNum' => ['nullable','integer','digits:9'],
        ]);
//        dd('success');
        return redirect()->back();
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
