<?php

namespace App\Http\Controllers\Child;

use App\Http\Controllers\Controller;
use App\Models\ChildEducationStatus;
use App\Models\ChildHealthSituation;
use App\Models\ChildIdentification;
use App\Models\ChildsAttachment;
use App\Models\ChildsEconomicStatus;
use App\Models\ChildsResidentStatus;
use App\Models\ChildSummaryReport;
use App\Models\FamiliesConfiguration;
use App\Models\Guardian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ChildController extends Controller
{
    protected $rules = [
        //Child Identification Rules
        'child_code' => 'required|numeric|unique:child_identification,child_code',
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
        'has_disability' => 'sometimes|boolean',
        'disability_type' => 'nullable|string',
        'sponsorship_category' => 'required|string',
        'scale_of_poverty' => 'required|in:VERY POOR,SEVERE,POOR',
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
        $children = ChildIdentification::withoutTrashed('guardian')->get();
        return view('Child.table-data', compact('children'));
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
                'mother_martial_status', 'guardian_martial_status', 'works', 'edu_levels', 'monthly_salary', 'child_edu_level', 'jobs_members'
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

        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
//            dd($validator->errors());
        }

        $validatedData = $request->validate($this->rules);
        DB::beginTransaction();
        try {
            $child = ChildIdentification::create($validatedData);
            $child->sr_id = Auth::user()->id;
            $guardian = new Guardian();
            $guardian->child_id = $child->id;
            $guardian->fill($validatedData);
            $guardian->save();

            $familiesConfiguration = new FamiliesConfiguration();
            $familiesConfiguration->child_id = $child->id;
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
            $childsEconomicStatus->save();

            $childsResidentStatus = new ChildsResidentStatus();
            $childsResidentStatus->child_id = $child->id;
            $childsResidentStatus->resident_needs = $string_resident_needs;
            unset($validatedData['resident_needs']);
            $childsResidentStatus->fill($validatedData);
            $childsResidentStatus->save();

            if ($request->has('birth_certificate')) {
                $this->save_image($request, 'birth_certificate', $child->id, 'birth_certificates');
            }
            if ($request->has('child_personal_photo')) {
                $this->save_image($request, 'child_personal_photo', $child->id, 'child_personal_photos');
            }

            if ($request->has('education_certificate')) {
                $this->save_image($request, 'education_certificate', $child->id, 'education_certificates');
            }
            if ($request->has('father_id_card')) {
                $this->save_image($request, 'father_id_card', $child->id, 'father_id_cards');
            }
            if ($request->has('guardian_id_card')) {
                $this->save_image($request, 'guardian_id_card', $child->id, 'guardian_id_cards');
            }
            if ($request->has('medical_report')) {
                $this->save_image($request, 'medical_report', $child->id, 'medical_reports');
            }
            if ($request->has('mother_id_card')) {
                $this->save_image($request, 'mother_id_card', $child->id, 'mother_id_cards');
            }
            if ($request->has('various_photos')) {
                $i = 1;
                $x = $request->file('various_photos');
                foreach ($x as $imagefile) {
                    $image_name1 = $child->id . '_various_photo' . $i . '.' . $imagefile->getClientOriginalExtension();
                    Storage::disk('local')->putFileAs('/public/uploads/children/various_photos/', $imagefile, $image_name1);
                    ChildsAttachment::create([
                        'child_id' => $child->id,
                        'file_name' => 'various_photos',
                        'path' => $image_name1
                    ]);
                    $i++;
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'New Child Created Successfully.');
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function edit($id)
    {
        $child = ChildIdentification::find($id);
        $json_data = $child->family->relatives;
        $lessons = $child->education->intensive_lessons;
        $lessonsArray = explode(',', $lessons);

        $hobbies = $child->education->hobbies;
        $hobbiesArray = explode(',', $hobbies);

        $json_patients = $child->health->patients;

        $familyNeeds = $child->economic->family_needs;
        $familyNeedsArray = explode(',', $familyNeeds);

        $residentNeeds = $child->resident->resident_needs;
        $residentNeedsArray = explode(',', $residentNeeds);

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
        return view('Child.edit', compact('child', 'scales',
            'categories', 'governates', 'areas', 'relationsAr', 'relationsEN',
            'mother_martial_status', 'guardian_martial_status', 'works',
            'edu_levels', 'monthly_salary', 'child_edu_level', 'jobs_members'
            , 'periodic_sponsorships', 'irregular_aids', 'resident_statuses', 'resident_types', 'resident_descriptions',
            'json_data', 'lessonsArray', 'hobbiesArray', 'json_patients', 'familyNeedsArray', 'residentNeedsArray'
        ));
    }

    public function update(Request $request, $id)
    {
        $this->rules['child_code'] = Rule::unique('child_identification')->ignore($id, 'id');
        $string_lessons = null;
        $string_hobbies = null;
        $string_needs = null;
        $string_resident_needs = null;

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

        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            dd($validator->errors());
        }
        $validatedData = $request->validate($this->rules);
        DB::beginTransaction();
        try {
            $child = ChildIdentification::findOrFail($id);
            $child->has_disability = $request->has('has_disability') ? 1 : 0;
            $child->fill($validatedData);
            $child->save();

            $guardian = Guardian::where('child_id', $id)->firstOrFail();
            $guardian->fill($validatedData);
            $guardian->save();

            $familiesConfiguration = FamiliesConfiguration::where('child_id', $id)->firstOrFail();
            $familiesConfiguration->fill($validatedData);
            $familiesConfiguration->save();

            $childEducationStatus = ChildEducationStatus::where('child_id', $id)->firstOrFail();
            $childEducationStatus->intensive_lessons = $string_lessons;
            $childEducationStatus->hobbies = $string_hobbies;
            unset($validatedData['intensive_lessons'], $validatedData['hobbies']);
            $childEducationStatus->fill($validatedData);
            $childEducationStatus->save();

            $childHealthSituation = ChildHealthSituation::where('child_id', $id)->firstOrFail();
            $childHealthSituation->fill($validatedData);
            $childHealthSituation->save();

            $childsEconomicStatus = ChildsEconomicStatus::where('child_id', $id)->firstOrFail();
            $childsEconomicStatus->family_needs = $string_needs;
            unset($validatedData['family_needs']);
            $childsEconomicStatus->fill($validatedData);
            $childsEconomicStatus->save();

            $childsResidentStatus = ChildsResidentStatus::where('child_id', $id)->firstOrFail();
            $childsResidentStatus->child_id = $child->id;
            $childsResidentStatus->resident_needs = $string_resident_needs;
            unset($validatedData['resident_needs']);
            $childsResidentStatus->fill($validatedData);
            $childsResidentStatus->save();

            if ($request->has('birth_certificate')) {
                $this->update_image($request, 'birth_certificate', $child->id, 'birth_certificates');
            }
            if ($request->has('child_personal_photo')) {
                $this->update_image($request, 'child_personal_photo', $child->id, 'child_personal_photos');
            }
            if ($request->has('education_certificate')) {
                $this->update_image($request, 'education_certificate', $child->id, 'education_certificates');
            }
            if ($request->has('father_id_card')) {
                $this->update_image($request, 'father_id_card', $child->id, 'father_id_cards');
            }
            if ($request->has('guardian_id_card')) {
                $this->update_image($request, 'guardian_id_card', $child->id, 'guardian_id_cards');
            }
            if ($request->has('medical_report')) {
                $this->update_image($request, 'medical_report', $child->id, 'medical_reports');
            }
            if ($request->has('mother_id_card')) {
                $this->update_image($request, 'mother_id_card', $child->id, 'mother_id_cards');
            }
            if ($request->has('various_photos')) {
                $i = 1;
                $x = $request->file('various_photos');
                foreach ($x as $imagefile) {
                    $image_name1 = $child->id . '_various_photo' . $i . '.' . $imagefile->getClientOriginalExtension();
                    Storage::disk('local')->putFileAs('/public/uploads/children/various_photos/', $imagefile, $image_name1);
                    ChildsAttachment::create([
                        'child_id' => $child->id,
                        'file_name' => 'various_photos' . $i,
                        'path' => $image_name1
                    ]);
                    $i++;
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'The Child Updated Successfully.');
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function show($id)
    {
        $child = ChildIdentification::with([
            'guardian.governorate',
            'guardian.area',
            'education',
            'health',
            'economic',
            'resident',
            'family'
        ])->findOrFail($id);
//        dd($child);
        $attachs = ChildsAttachment::where('child_id', '=', $id)->get()->toArray();
        $photo = ChildsAttachment::where('child_id', '=', $id)->where('file_name', '=', 'child_personal_photos')->first();
//        $guardin = Guardian::findOrFail($id);
        return view('Child.child-profile', compact('child', 'attachs', 'photo'));
    }

    public function destroy($id)
    {
        $child = ChildIdentification::find($id);
        $del = $child->delete();
        if ($del) {
            return redirect()->back()->with('success', 'The Child Delete Successfully.');
        } else {
            return redirect()->back()->with('failed', 'The Child Delete failed.');
        }
    }

    public function download($filename, $path)
    {
        $file = 'uploads/children/' . $filename . '/' . $path;
        if (Storage::disk('public')->exists($file)) {
            return Storage::disk('public')->download($file);
        } else {
            abort(404);
        }
    }

    public function update_image(Request $request, $request_file, $child_id, $parent_folder)
    {
        $imagefile = $request->file($request_file);
        $image_name1 = $child_id . '_' . $request_file . '.' . $imagefile->getClientOriginalExtension();
        $attachment = ChildsAttachment::where('child_id', $child_id)->where('file_name', $parent_folder)->firstOrFail();
        $file = 'uploads/children/' . $attachment->file_name . '/' . $attachment->path;
        if (!$attachment) {
            Storage::disk('local')->putFileAs('/public/uploads/children/' . $parent_folder . '/', $imagefile, $image_name1);
            ChildsAttachment::create([
                'child_id' => $child_id,
                'file_name' => $parent_folder,
                'path' => $image_name1
            ]);
        } else {
            if (Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
            Storage::disk('local')->putFileAs('/public/uploads/children/' . $parent_folder . '/', $imagefile, $image_name1);
            $attachment->file_name = $parent_folder;
            $attachment->path = $image_name1;
            $attachment->save();
        }
    }

    public function save_image(Request $request, $request_file, $child_id, $parent_folder)
    {
        $imagefile = $request->file($request_file);
        $image_name1 = $child_id . '_' . $request_file . '.' . $imagefile->getClientOriginalExtension();
        Storage::disk('local')->putFileAs('/public/uploads/children/' . $parent_folder . '/', $imagefile, $image_name1);
        ChildsAttachment::create([
            'child_id' => $child_id,
            'file_name' => $parent_folder,
            'path' => $image_name1
        ]);
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
