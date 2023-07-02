<?php

namespace App\Http\Controllers\Child;

use App\Http\Controllers\Controller;
use App\Models\BankInfo;
use App\Models\Beneficiary;
use App\Models\ChildEducationStatus;
use App\Models\ChildHealthSituation;
use App\Models\ChildIdentification;
use App\Models\ChildsAttachment;
use App\Models\ChildsEconomicStatus;
use App\Models\ChildsResidentStatus;
use App\Models\FamiliesConfiguration;
use App\Models\Guardian;
use App\Models\Orphan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ChildController extends Controller
{
    protected $rules = [
        //Child Identification Rules
        'child_code' => 'required|numeric|unique:child_identification',
        'child_fullName_en' => 'required|string',
        'child_fullName_ar' => 'required|string',
        'child_id_no' => 'required|integer|digits:9',
        'gender' => 'required|in:Male,Female',
        'category' => 'required|in:Orphan,Needy,Special Needs',
        'birth_date' => 'required|date',
        'mother_fullName_en' => 'required|string',
        'mother_fullName_ar' => 'required|string',
        'mother_id_no' => 'required|integer|digits:9',
        'mother_martial_status' => 'required|in:Divorced,Married,Widow,Abandon',
        'father_fullName_en' => 'required|string',
        'father_fullName_ar' => 'required|string',
        'father_id_no' => 'required|integer|digits:9',
        'death_date' => 'nullable|date',
        'disability_type' => 'nullable|string',
        'sponsorship_category' => 'required|string',
        'scale_of_poverty' => 'required|in:VERY POOR,SEVERE,POOR',

        /*
        //Start Guardian rules
        'guardian_fullName_en' => 'required|string',
        'guardian_fullName_ar' => 'required|string',
        'rel_to_en' => 'required|in:FATHER,MOTHER,GRANDFATHER,GRANDMOTHER,BROTHER,SISTER,UNCLE,ANT,FATHER IN LAW,MOTHER IN LAW,SETP-FATHER,STEP-MOTHER,SON,HIM/HERSELF,HER/HIMSELF,AUNT,COUSIN,WIFE',
        'rel_to_ar' => 'required|in:ام,اب,الجد/ة,عم/ة,نفسه/ا,زوج الام,اخ/اخت,الزوج/ة,زوجة الاب,ابن/ابنة عم/خال,ابن/ة,العم/الخال,خالة,نفسه',
        'guardian_id_no' => 'required|integer',
        'guardian_martial_status' => 'required|in:Divorced,Married,Widow',
        'work' => 'required|in:Employee,Jobless,Irregular work',
        'edu_level' => 'required|in:Primary,Preparator,Secondary,Diploma,University,Higher Degree,Vocational,illiterate',
        'monthly_salary' => 'required|in:000-200 GBP,200-500 GBP,More than 500 BGP',
        'address_details' => 'required|string',
        'governorate_id' => 'required',
        'area_id' => 'required',
        'email' => 'required|email',
        'phone_no' => 'nullable|string',
        'mobile_1' => 'required|string',
        'mobile_2' => 'required|string',
        //start of family configuration rules
        'members_count' => 'required|integer',
        'members_university' => 'required|integer',
        'members_school' => 'required|integer',
        'members_worker' => 'required|integer',
        'relatives' => 'nullable',
        //Start of Educational Status
        'child_edu_level' => 'required|in:Under School Age,Kindergarten,Primary School',
        'school_name' => 'nullable|string|max:255',
        'need_lessons' => 'nullable|boolean',
        'intensive_lessons' => 'array|required_if:need_lessons,1|nullable',
        'cost_lesson' => 'required_if:need_lessons,1|numeric|nullable',
        'hobbies' => 'nullable',

        //start of Health Status
        'good_health' => 'boolean',
        'has_disease' => 'boolean',
        'patients' => 'nullable',
        'medications' => 'nullable|string',

        //start of Economic status
        'jobs_members' => ['required', 'in:No,From GBP 0 - GBP 200,From GBP 200 - GBP 500,More than GBP 500'],
        'periodic_sponsorships' => ['required', 'in:No,From GBP 0 - GBP 60,From GBP 60 - GBP 150,More than GBP 150'],
        'irregular_aids' => ['required', 'in:No,From GBP 0 - GBP 100,From GBP 100 - GBP 250,More than GBP 250'],
        'house_fees' => 'required|integer',
        'edu_fees' => 'required|integer',
        'rents' => 'required|integer',
        'medical_fees' => 'required|integer',
        'family_needs' => 'required|array',
        'project_type' => 'required|string',
        'project_cost' => 'required|integer',
        'notes' => 'nullable|string',
        //start of Resident Status
        'resident_status' => 'required|in:Ownership,Shared,Rent',
        'resident_type' => 'required|in:Concrete,Asbestos,Zinc plate',
        'resident_description' => 'required|in:Good,Moderate,Bad',
        'resident_needs' => 'required|array',
        'rent_cost' => 'nullable|integer',
        'no_rooms' => 'required|integer',
        'house_area' => 'required|integer',
*/
        //start of Attachments rules
        'birth_certificate' => 'image|mimes:jpg,png,jpeg,gif,svg',
        'child_personal_photo' => 'image|mimes:jpg,png,jpeg,gif,svg',
        'education_certificate' => 'image|mimes:jpg,png,jpeg,gif,svg',
        'father_id_card' => 'image|mimes:jpg,png,jpeg,gif,svg',
        'guardian_id_card' => 'image|mimes:jpg,png,jpeg,gif,svg',
        'medical_report' => 'image|mimes:jpg,png,jpeg,gif,svg',
        'mother_id_card' => 'image|mimes:jpg,png,jpeg,gif,svg',
        'various_photos.*' => 'image|mimes:jpg,png,jpeg,gif,svg',
    ];

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

        $relationsAr = self::getEnumValues('guardians', 'rel_to_ar');
        $relationsEN = self::getEnumValues('guardians', 'rel_to_en');

        $mother_martial_status = self::getEnumValues('child_identification', 'mother_martial_status');
        $guardian_martial_status = self::getEnumValues('guardians', 'guardian_martial_status');
        $works = self::getEnumValues('guardians', 'work');
        $edu_levels = self::getEnumValues('guardians', 'edu_level');
        $monthly_salary = self::getEnumValues('guardians', 'monthly_salary');
        $child_edu_level = self::getEnumValues('childs_edu_status', 'child_edu_level');

        $jobs_members = self::getEnumValues('childs_economic_status', 'jobs_members');
        $periodic_sponsorships = self::getEnumValues('childs_economic_status', 'periodic_sponsorships');
        $irregular_aids = self::getEnumValues('childs_economic_status', 'irregular_aids');
        $resident_statuses = self::getEnumValues('childs_resident_status', 'resident_status');
        $resident_types = self::getEnumValues('childs_resident_status', 'resident_type');
        $resident_descriptions = self::getEnumValues('childs_resident_status', 'resident_description');

        return view('Child.form-wizards',
            compact('scales',
                'categories', 'governates', 'areas', 'relationsAr', 'relationsEN',
                'mother_martial_status', 'guardian_martial_status', 'works',
                'edu_levels', 'monthly_salary', 'child_edu_level', 'jobs_members'
                , 'periodic_sponsorships', 'irregular_aids', 'resident_statuses', 'resident_types', 'resident_descriptions'
            )
        );
    }

    public function store(Request $request)
    {
        $string_lessons = null;
        $string_hobbies = null;
        $string_needs = null;
        $string_resident_needs = null;
//        dd($request->all());
        if ($request->has('intensive_lessons')) {
            $count_lessons = count($request->intensive_lessons);
            $a = array();
            for ($i = 0; $i < $count_lessons; $i++) {
                array_push($a, $request->intensive_lessons[$i]);
            }
            array_push($a, $request->input('custom_lesson'));
            $string_lessons = implode(',', $a);
        }

        if ($request->has('hobbies')) {
            $count_hobbies = count($request->hobbies);
            $a = array();
            for ($i = 0; $i < $count_hobbies; $i++) {
                array_push($a, $request->hobbies[$i]);
            }
            array_push($a, $request->input('custom_hobbie'));
            $string_hobbies = implode(',', $a);
        }

        if ($request->has('family_needs')) {
            $count_needs = count($request->family_needs);
            $a = array();
            for ($i = 0; $i < $count_needs; $i++) {
                array_push($a, $request->family_needs[$i]);
            }
            array_push($a, $request->input('custom_need'));
            $string_needs = implode(',', $a);
        }
        if ($request->has('resident_needs')) {
            $count_resident_needs = count($request->resident_needs);
            $a = array();
            for ($i = 0; $i < $count_resident_needs; $i++) {
                array_push($a, $request->resident_needs[$i]);
            }
            $string_resident_needs = implode(',', $a);
        }

//        dd($string_lessons);

//        dd(print_r(json_encode($request['relatives'])));
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            dd($validator->errors());
        }

        $validatedData = $request->validate($this->rules);
        DB::beginTransaction();
        try {
            $child = ChildIdentification::create($validatedData);

            /*
            $guardian = new Guardian();
            $guardian->child_id = $child->id;
            $guardian->fill($validatedData);
            $guardian->save();

            $familiesConfiguration = new FamiliesConfiguration();
            $familiesConfiguration->child_id = $child->id;
//            $familiesConfiguration->relatives = json_encode($request->relatives);
            $familiesConfiguration->fill($validatedData);
            $familiesConfiguration->save();


            $childEducationStatus = new ChildEducationStatus();
            $childEducationStatus->child_id = $child->id;
            $childEducationStatus->intensive_lessons = $string_lessons;
            $childEducationStatus->hobbies = $string_hobbies;
            unset($validatedData['intensive_lessons'], $validatedData['hobbies']);
            $childEducationStatus->fill($validatedData);
            $childEducationStatus->save();

            $childHealthSituation = new ChildHealthSituation();
            $childHealthSituation->child_id = $child->id;
            $childHealthSituation->fill($validatedData);
            $childHealthSituation->save();

            $childsEconomicStatus = new ChildsEconomicStatus();
            $childsEconomicStatus->child_id = $child->id;
            $childsEconomicStatus->family_needs = $string_needs;

            unset($validatedData['family_needs']);

            $childsEconomicStatus->fill($validatedData);
//            dd($validatedData,$request->all());
            $childsEconomicStatus->save();

            $childsResidentStatus = new ChildsResidentStatus();
            $childsResidentStatus->child_id = $child->id;
            $childsResidentStatus->resident_needs = $string_resident_needs;
            unset($validatedData['resident_needs']);
//            $childsResidentStatus->fill($validatedData);

            $childsResidentStatus->fill($validatedData);
            $childsResidentStatus->save();
*/



            if($request->has('birth_certificate')) {
                $imagefile = $request->file('birth_certificate');
                $image_name1 = $child->id . '_birth_certificate'  . '.' . $imagefile->getClientOriginalExtension();
                Storage::disk('uploads')->putFileAs('/children/birth_certificates/', $imagefile, $image_name1);
                ChildsAttachment::create([
                    'child_id' => $child->id,
                    'file_name' => 'birth_certificate',
                    'path' => $image_name1
                ]);
            }

            if($request->has('child_personal_photo')) {
                $imagefile = $request->file('child_personal_photo');
                $image_name1 = $child->id . '_child_personal_photo'  . '.' . $imagefile->getClientOriginalExtension();
                Storage::disk('uploads')->putFileAs('/children/child_personal_photos/', $imagefile, $image_name1);
                ChildsAttachment::create([
                    'child_id' => $child->id,
                    'file_name' => 'child_personal_photo',
                    'path' => $image_name1
                ]);
            }

            if($request->has('education_certificate')) {
                $imagefile = $request->file('education_certificate');
                $image_name1 = $child->id . '_education_certificate'  . '.' . $imagefile->getClientOriginalExtension();
                Storage::disk('uploads')->putFileAs('/children/education_certificates/', $imagefile, $image_name1);
                ChildsAttachment::create([
                    'child_id' => $child->id,
                    'file_name' => 'education_certificate',
                    'path' => $image_name1
                ]);
            }
            if($request->has('father_id_card')) {
                $imagefile = $request->file('father_id_card');
                $image_name1 = $child->id . '_father_id_card'  . '.' . $imagefile->getClientOriginalExtension();
                Storage::disk('uploads')->putFileAs('/children/father_id_cards/', $imagefile, $image_name1);
                ChildsAttachment::create([
                    'child_id' => $child->id,
                    'file_name' => 'father_id_card',
                    'path' => $image_name1
                ]);
            }

            if($request->has('guardian_id_card')) {
                $imagefile = $request->file('guardian_id_card');
                $image_name1 = $child->id . '_guardian_id_card'  . '.' . $imagefile->getClientOriginalExtension();
                Storage::disk('uploads')->putFileAs('/children/guardian_id_cards/', $imagefile, $image_name1);
                ChildsAttachment::create([
                    'child_id' => $child->id,
                    'file_name' => 'guardian_id_card',
                    'path' => $image_name1
                ]);
            }

            if($request->has('medical_report')) {
                $imagefile = $request->file('medical_report');
                $image_name1 = $child->id . '_medical_report'  . '.' . $imagefile->getClientOriginalExtension();
                Storage::disk('uploads')->putFileAs('/children/medical_reports/', $imagefile, $image_name1);
                ChildsAttachment::create([
                    'child_id' => $child->id,
                    'file_name' => 'medical_report',
                    'path' => $image_name1
                ]);
            }

            if($request->has('mother_id_card')) {
                $imagefile = $request->file('mother_id_card');
                $image_name1 = $child->id . '_mother_id_card'  . '.' . $imagefile->getClientOriginalExtension();
                Storage::disk('uploads')->putFileAs('/children/mother_id_cards/', $imagefile, $image_name1);
                ChildsAttachment::create([
                    'child_id' => $child->id,
                    'file_name' => 'mother_id_card',
                    'path' => $image_name1
                ]);
            }

//            dd($request->file('various_photos'));
            if($request->has('various_photos')) {
                $i = 1;
                $x = $request->file('various_photos');
                foreach ($x as $imagefile) {
                    $image_name1 = $child->id . '_various_photo'. $i  . '.' . $imagefile->getClientOriginalExtension();
                    Storage::disk('uploads')->putFileAs('/children/various_photos/', $imagefile, $image_name1);
                    ChildsAttachment::create([
                        'child_id' => $child->id,
                        'file_name' => 'various_photo'.$i,
                        'path' => $image_name1
                    ]);
                    $i++;
                }
            }



            DB::commit();
            dd("success");

        } catch (Exception $e) {
            DB::rollBack();
        }
        /*
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        */
        return redirect()->back();
    }

    public function edit($id)
    {
        $beneficary = Beneficiary::with('Governate', 'Guardian')->find($id);
        //dd($beneficary->Guardian->BankInfo);

//        $bank_info = $beneficary->Guardian()->with('BankInfo')->get();
//dd($bank_info);
        $scales = self::getEnumValues('beneficiaries', 'Scale_Of_poverty');
        $categories = self::getEnumValues('beneficiaries', 'Category');
        $governates = DB::table('governorates')->get();
        $camps = DB::table('camps')->get();
        $relationsAr = self::getEnumValues('Guardian', 'REL_TO_CHILD_AR');
        $relationsEN = self::getEnumValues('Guardian', 'REL_TO_CHILD_EN');
        $CATs = self::getEnumValues('beneficiaries', 'CAT');
        return view('Child.edit', compact('beneficary', 'scales', 'categories', 'governates', 'camps', 'relationsAr', 'relationsEN', 'CATs'));
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        $request->validate([
            'NO_ORPHAN_CODE' => ['required', 'integer'],
            'childGovNum' => ['required', 'integer', 'digits:9'],
            'Orphan_Name_En' => ['required', 'string'],
            'Orphan_Name_Ar' => ['required', 'string'],
            'ORPHAN_DOB' => ['required', 'date'],
            'Category' => ['required', 'exists:beneficiaries,Category'],
            'Scale_Of_poverty' => ['required', 'exists:beneficiaries,Scale_Of_poverty'],
            'Father_Name_EN' => ['required', 'string'],
            'Father_Name_AR' => ['required', 'string'],
            'Father_ID' => ['required', 'integer', 'digits:9'],
            'father_death_date' => ['nullable', 'date'],
            'NO_SPONSORED' => ['required', 'integer'],
            'CAT' => ['required', 'exists:beneficiaries,CAT'],
            //Address Information alidation Rules
            'Address' => ['required', 'string'],
            'governate' => ['required', 'exists:governorates,gov_id'],
            'camp' => ['required', 'exists:camps,camp_id'],
            'MAIL_CODE' => ['int', 'nullable'],
            //Banking Information Validation Rules
            'AREA_CODE' => ['int', 'nullable'],
            'ACCOUNT_NO_BOP' => ['required', 'int'],
            'Branch_No' => ['required', 'int'],
            'IBAN' => ['string', 'max:34', 'required'],
            //Guardian Information Validation Rules
            'Guardian_En' => ['required', 'string'],
            'Guardian_Ar' => ['required', 'string'],
            'relation_en' => ['required', 'exists:guardian,REL_TO_CHILD_EN'],
            'relation_ar' => ['required', 'exists:guardian,REL_TO_CHILD_AR'],
            'GuardianPhoneNum' => ['required', 'between: 8,10'],
            'GuardianPhoneNum2' => ['required', 'between: 8,10'],
            'GuardianTelephoneNum' => ['nullable', 'integer', 'digits:9'],
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
            $enum = \array_add($enum, $v, $v);
        }
        return $enum;
    }
}
