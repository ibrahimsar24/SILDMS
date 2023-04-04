<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
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
     * Show the roles page
     *
     */
    public function index()
    {
        try{
            return view('admin.attendance');
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Show the role list with associate permissions.
     * Server side list view using yajra datatables
     */

    public function getAttendanceList(Request $request)
    {

        $data  = Attendance::get();

        return Datatables::of($data)
            ->addColumn('action', function($data){
                if (Auth::user()->can('manage_attendance')){
                    return '<div class="table-actions">
                                    <a href="'.url('attendance/delete/'.$data->id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </div>';
                }else{
                    return '';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store new roles with assigned permission
     * Associate permissions will be stored in table
     */

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'lecture_id' => 'required',
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try{
            $lecture_id = Attendance::create(['Lecture Id' => $request->lecture_id]);
            $user_id = Attendance::create(['User Id' => $request->user_id]);

            if($lecture_id){
                return redirect('attendance')->with('success', 'Created succesfully!');
            }else{
                return redirect('attendance')->with('error', 'Failed! Try again.');
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    public function update(Request $request)
    {

        // update permission table
        $lectureid = Attendance::find($request->id);
        $lectureid->lecture_id = $request->lecture_id;
        $lectureid->save();

        return $lectureid;
    }


    public function delete($id)
    {
        $lectureid   = Attendance::find($id);
        if($lectureid){
            $lectureid->delete();
            return redirect('attendance')->with('success', 'Attendance deleted!');
        }else{
            return redirect('404');
        }
    }
}
