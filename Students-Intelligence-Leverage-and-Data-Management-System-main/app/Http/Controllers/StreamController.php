<?php

namespace App\Http\Controllers;

use App\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class StreamController extends Controller
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
            return view('admin.stream');
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Show the role list with associate permissions.
     * Server side list view using yajra datatables
     */

    public function getStreamList(Request $request)
    {

        $data  = Stream::get();

        return Datatables::of($data)
            ->addColumn('action', function($data){
                if (Auth::user()->can('manage_stream')){
                    return '<div class="table-actions">
                                    <a href="'.url('stream/delete/'.$data->id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
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
            'stream' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try{
            $stream = Stream::create(['name' => $request->stream]);

            if($stream){
                return redirect('stream')->with('success', 'Stream created succesfully!');
            }else{
                return redirect('stream')->with('error', 'Failed to create stream! Try again.');
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    public function update(Request $request)
    {

        // update permission table
        $stream = Stream::find($request->id);
        $stream->name = $request->name;
        $stream->save();

        return $stream;
    }


    public function delete($id)
    {
        $stream   = Stream::find($id);
        if($stream){
            $stream->delete();
            return redirect('stream')->with('success', 'Stream deleted!');
        }else{
            return redirect('404');
        }
    }
}
