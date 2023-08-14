<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\ChildIdentification;
use App\Models\Governorate;
use App\Models\Guardian;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $count_users = User::count();
        $count_children = ChildIdentification::count();
        $governorates_count = Governorate::count();
        $areas_count = Area::count();

        $orphan_count = ChildIdentification::where('category', 'Orphan')->get()->count();
        $needy_count = ChildIdentification::where('category', 'Needy')->get()->count();
        $special_needs_count = ChildIdentification::where('category', 'Special Needs')->get()->count();

        $male_count = ChildIdentification::where('gender', 'Male')->get()->count();
        $female_count = ChildIdentification::where('gender', 'Female')->get()->count();

        $Social_Researcher_count = User::role('Social Researcher')->get()->count();
        $Supervisor_count = User::role('Supervisor')->get()->count();
        $Admin_count = User::role('Admin')->get()->count();

        $NORTH_count = Guardian::where('governorate_id', '18')->get()->count();
        $GAZA_count = Guardian::where('governorate_id', '19')->get()->count();
        $MIDDLE_count = Guardian::where('governorate_id', '20')->get()->count();
        $KHANYOUNES_count = Guardian::where('governorate_id', '21')->get()->count();
        $RAFAH_count = Guardian::where('governorate_id', '22')->get()->count();

        $count_cared_children = ChildIdentification::where('sr_id', Auth::id())->get()->count();
        $category_data = [
            ['label' => 'Orphan', 'value' => $orphan_count],
            ['label' => 'Needy', 'value' => $needy_count],
            ['label' => 'Special Needs', 'value' => $special_needs_count],
        ];
        $gender_data = [
            ['label' => 'Male', 'value' => $male_count],
            ['label' => 'Female', 'value' => $female_count]
        ];
        $role_data = [
            ['label' => 'Admin', 'value' => $Admin_count],
            ['label' => 'Supervisor', 'value' => $Supervisor_count],
            ['label' => 'Social Researcher', 'value' => $Social_Researcher_count]
        ];

        $Governorate_data = [
            ['label' => 'NORTH', 'value' => $NORTH_count],
            ['label' => 'GAZA', 'value' => $GAZA_count],
            ['label' => 'MIDDLE', 'value' => $MIDDLE_count],
            ['label' => 'KHANYOUNES', 'value' => $KHANYOUNES_count],
            ['label' => 'RAFAH', 'value' => $RAFAH_count],
        ];

        return view('home',
            compact('count_users',
                'count_children',
                'governorates_count',
                'areas_count',
                'category_data',
                'gender_data',
                'role_data',
                'Governorate_data',
                'count_cared_children'
            ));
    }
}
