<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\MinistryTypes;
use App\Models\ChurchPositions;
use App\Models\MinistryPosition;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $members = Member::latest()->get()->map(function ($member) {
            $ministries = array();
            $ministry_positions = DB::table('member_position_ministry')->where('member_id', $member->id)->get();
            foreach ($ministry_positions as $min_pos) {
                $min_pos_object = (object) [];
                $min_pos_object->ministry = MinistryTypes::where('id', $min_pos->ministry_id)->first();
                $min_pos_object->position = ChurchPositions::where('id', $min_pos->position_id)->first();
                array_push($ministries, $min_pos_object);
            }
            $member->ministries = $ministries;
            return $member;
        });
        $ministries = MinistryTypes::all();
        $positions = ChurchPositions::all();
        return view('members.index', compact('members', 'ministries', 'positions'))
            ->with('i');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ministries = MinistryTypes::all();
        $positions = ChurchPositions::all();
        return view('members.create', compact('ministries', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->ministry);
        $request->validate([
            'full_name' => 'required',
        ]);

        $input_url = null;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $profileImage = date('YmdHis') . "." . $photo->getClientOriginalExtension();
            $photo->move(public_path('upload/user'), $profileImage);
            $input_url = 'upload/user/' . $profileImage;
        }


        $member = Member::create([
            'full_name' => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'place_of_residence' => $request->place_of_residence,
            'job' => $request->job,
            'contact1' => $request->contact1,
            'contact2' => $request->contact2,
            'spouse_name' => $request->spouse_name,
            'spouse_contact' => $request->spouse_contact,
            'fathers_name' => $request->fathers_name,
            'Fathers_contact' => $request->fathers_contact,
            'mothers_name' => $request->mothers_name,
            'mothers_contact' => $request->mothers_contact,
            'photo' => $input_url,
        ]);

        if ($member) {
            for ($i = 0; $i < count($request->ministry); $i++) {
                MinistryPosition::create([
                    'member_id' => $member->id,
                    'ministry_id' => $request->ministry[$i],
                    'position_id' => $request->position[$i]
                ]);
            }
        }

        return redirect()->route('member.index')
            ->with(['success' => 'member created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        $ministries = array();
            $ministry_positions = DB::table('member_position_ministry')->where('member_id', $member->id)->get();
            foreach ($ministry_positions as $min_pos) {
                $min_pos_object = (object) [];
                $min_pos_object->ministry = MinistryTypes::where('id', $min_pos->ministry_id)->first();
                $min_pos_object->position = ChurchPositions::where('id', $min_pos->position_id)->first();
                array_push($ministries, $min_pos_object);
            }
            $member->ministries = $ministries;
        return view('members.show', compact('member'));
    }

    public function filter_ministry()
    {
        // dd(request()->all());
        $ministry_members = DB::table('member_position_ministry')->where('ministry_id', request()->ministryId)->get();
        $members = array();
        foreach ($ministry_members as $min_member) {
            $member = Member::where('id', $min_member->member_id)->first();
            $ministries = array();
            $ministry_positions = DB::table('member_position_ministry')->where('member_id', $member->id)->get();
            foreach ($ministry_positions as $min_pos) {
                $min_pos_object = (object) [];
                $min_pos_object->ministry = MinistryTypes::where('id', $min_pos->ministry_id)->first();
                $min_pos_object->position = ChurchPositions::where('id', $min_pos->position_id)->first();
                array_push($ministries, $min_pos_object);
            }
            $member->ministries = $ministries;
            array_push($members, $member);
        }
        $ministries = MinistryTypes::all();
        $positions = ChurchPositions::all();
        return view('members.index', compact('members', 'ministries', 'positions'))
            ->with('i');
    }

    public function filter_position()
    {
        // dd(request()->all());
        $position_members = DB::table('member_position_ministry')->where('position_id', request()->positionId)->get();
        $members = array();
        foreach ($position_members as $pos_member) {
            $member = Member::where('id', $pos_member->member_id)->first();
            $ministries = array();
            $ministry_positions = DB::table('member_position_ministry')->where('member_id', $member->id)->get();
            foreach ($ministry_positions as $min_pos) {
                $min_pos_object = (object) [];
                $min_pos_object->ministry = MinistryTypes::where('id', $min_pos->ministry_id)->first();
                $min_pos_object->position = ChurchPositions::where('id', $min_pos->position_id)->first();
                array_push($ministries, $min_pos_object);
            }
            $member->ministries = $ministries;
            array_push($members, $member);
        }
        $ministries = MinistryTypes::all();
        $positions = ChurchPositions::all();
        return view('members.index', compact('members', 'ministries', 'positions'))
            ->with('i');
    }


    public function print(Request $request){

        $members = json_decode($request->members);
    
        return view('members.print', compact('members'))->with('i');
    
    
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        $min_pos = [];
        $ministry_position = MinistryPosition::where('member_id', $id)->get();
        foreach ($ministry_position as $data) {
            $response = (object) [
                'ministry' => MinistryTypes::where('id', $data->ministry_id)->first(['id', 'ministry']),
                'position' => ChurchPositions::where('id', $data->position_id)->first(['id', 'position'])
            ];
            $min_pos[] = $response;
        }
        $member->ministries = $min_pos;
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        request()->validate([
            'full_name' => 'required'
        ]);

        $member = Member::find($id);

        $input_url = $member->photo != null ? $member->photo : null;

        if (request()->has('photo')) {
            $photo = request()->file('photo');
            $profileImage = date('YmdHis') . "." . $photo->getmemberOriginalExtension();
            $photo->move(public_path('upload/user'), $profileImage);
            $input_url = 'upload/user/' . $profileImage;
        }

        $member->update([
            'full_name' => request()->full_name,
            'date_of_birth' => request()->date_of_birth,
            'place_of_residence' => request()->place_of_residence,
            'job' => request()->job,
            'contact1' => request()->contact1,
            'contact2' => request()->contact2,
            'spouse_name' => request()->spouse_name,
            'spouse_contact' => request()->spouse_contact,
            'fathers_name' => request()->fathers_name,
            'Fathers_contact' => request()->Fathers_contact,
            'mothers_name' => request()->mothers_name,
            'mothers_contact' => request()->mothers_contact,
            'photo' => $input_url,
        ]);

        if (count(request()->ministry) > 0) {
            $ministries = MinistryPosition::where('member_id', $id)->get();
            foreach ($ministries as $ministry) {
                MinistryPosition::find($ministry->id)->delete();
            }
            for ($i = 0; $i < count(request()->ministry); $i++) {
                MinistryPosition::create([
                    'member_id' => $member->id,
                    'ministry_id' => request()->ministry[$i],
                    'position_id' => request()->position[$i]
                ]);
            }
        }

        return redirect()->route('member.index')
            ->with(['success' => 'member Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect()->route('member.index')
            ->with(['success' => 'member deleted successfully.']);

    }
}