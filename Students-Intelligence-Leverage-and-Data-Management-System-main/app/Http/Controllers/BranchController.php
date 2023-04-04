<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
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
            $streams = Stream::pluck('name','id');
            return view('admin.branch', compact('streams'));
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Show the role list with associate permissions.
     * Server side list view using yajra datatables
     */

    public function getBranchList(Request $request)
    {

        $data  = Branch::get();

        return Datatables::of($data)
            ->addColumn('code', function($data){
                return $data->code;
            })
            ->addColumn('duration', function($data){
                return $data->duration;
            })
            ->addColumn('streams', function($data){
                return $data->stream->name;
            })
            ->addColumn('action', function($data){
                if (Auth::user()->can('manage_branch')){
                    return '<div class="table-actions">
                                    <a href="'.url('branch/delete/'.$data->id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </div>';
                }else{
                    return '';
                }
            })
            ->rawColumns(['code','duration','streams','action'])
            ->make(true);
    }

    /**
     * Store new roles with assigned permission
     * Associate permissions will be stored in table
     */

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'branch' => 'required',
            'duration' => 'required',
            'stream' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try{
            $branch = Branch::create([
                'name' => $request->branch,
                'code' => $request->code,
                'duration' => $request->duration,
                'stream_id' => $request->stream,
            ]);

            if($branch){
                return redirect('branch')->with('success', 'Branch created succesfully!');
            }else{
                return redirect('branch')->with('error', 'Failed to create branch! Try again.');
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    public function update(Request $request)
    {
        $branch = Branch::find($request->id);
        if ($request->name) {
            $branch->name = $request->name;
        }
        if ($request->code) {
            $branch->code = $request->code;
        }
        $branch->save();
        return $branch;
    }


    public function delete($id)
    {
        $branch = Branch::find($id);
        if($branch){
            $branch->delete();
            return redirect('branch')->with('success', 'Branch deleted!');
        }else{
            return redirect('404');
        }
    }
}
