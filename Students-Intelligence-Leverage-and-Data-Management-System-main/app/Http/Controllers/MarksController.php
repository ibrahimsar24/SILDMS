<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Marks;
use App\Stream;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MarksController extends Controller
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
            $users = User::whereNotNull('rollno')
                ->pluck('rollno','id');
            $options = array('1' => 'Successful', '0' => 'Unsuccessful');
//            dd($users);
            return view('admin.result', compact('streams','users', 'options'));
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Show the role list with associate permissions.
     * Server side list view using yajra datatables
     */

    public function getResultList(Request $request)
    {

        $data  = Marks::get();

        return Datatables::of($data)
            ->addColumn('rollno', function($data){
                return $data->user->rollno;
            })
            ->addColumn('name', function($data){
                return $data->user->name;
            })
            ->addColumn('remark', function($data){
                return $data->result;
            })
            ->addColumn('action', function($data){
                if (Auth::user()->can('manage_branch')){
                    return '<div class="table-actions">
                                    <a href="'.url('result/delete/'.$data->id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </div>';
                }else{
                    return '';
                }
            })
            ->rawColumns([
                'rollno',
                'name',
                'remark',
                'action'])
            ->make(true);
    }

    /**
     * Store new roles with assigned permission
     * Associate permissions will be stored in table
     */

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'users' => 'required',
            'sem' => 'required',
            'sgpi' => 'required',
            'credits' => 'required',
            'cxgp' => 'required',
            'attempt' => 'required',
            'options' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try{
//            dd($request);
            $result = Marks::create([
                'user_id' => $request->users,
                'sem' => $request->sem,
                'sgpi' => $request->sgpi,
                'credits' => $request->credits,
                'cxgp' => $request->cxgp,
                'attempt' => $request->attempt,
                'result' => $request->options,
            ]);
            if($result){
                return redirect('result')->with('success', 'Result added succesfully!');
            }else{
                return redirect('result')->with('error', 'Failed to add result! Try again.');
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function uploadContent(Request $request)
    {
//        dd($request);
        $file = $request->file('uploaded_file');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes
//Check for file extension and size
            $this->checkUploadedFileProperties($extension, $fileSize);
//Where uploaded file will be stored on the server
            $location = 'uploads'; //Created an "uploads" folder for that
// Upload file
            $file->move($location, $filename);
// In case the uploaded file path is to be stored in the database
            $filepath = public_path($location . "/" . $filename);
// Reading file
            $file = fopen($filepath, "r");
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;
//Read the contents of the uploaded file
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
// Skip first row (Remove below comment if you want to skip the first row)
                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading
            $j = 0;
            foreach ($importData_arr as $importData) {
                $name = $importData[1]; //Get user names
                $email = $importData[3]; //Get the user emails
                $j++;
                dd($importData);
//                try {
//                    DB::beginTransaction();
//                    Player::create([
//                        'name' => $importData[1],
//                        'club' => $importData[2],
//                        'email' => $importData[3],
//                        'position' => $importData[4],
//                        'age' => $importData[5],
//                        'salary' => $importData[6]
//                    ]);
////Send Email
//                    $this->sendEmail($email, $name);
//                    DB::commit();
//                } catch (\Exception $e) {
////throw $th;
//                    DB::rollBack();
//                }
            }
            return response()->json([
                'message' => "$j records successfully uploaded"
            ]);
        } else {
//no file was uploaded
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
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
        $result = Marks::find($id);
        if($result){
            $result->delete();
            return redirect('result')->with('success', 'Result deleted!');
        }else{
            return redirect('404');
        }
    }
}
