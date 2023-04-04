<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Course;
use App\Stream;
use App\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
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
            $branches = Branch::pluck('name','id');
            return view('admin.course', compact('branches'));
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Show the role list with associate permissions.
     * Server side list view using yajra datatables
     */

    public function getCourseList(Request $request)
    {

        $data  = Course::get();

        return Datatables::of($data)
            ->addColumn('code', function($data){
                return $data->code;
            })
            ->addColumn('name', function($data){
                return $data->name;
            })
            ->addColumn('credits', function($data){
                return $data->credits;
            })
            ->addColumn('ut1', function($data){
                return $data->ut1;
            })
            ->addColumn('ut2', function($data){
                return $data->ut2;
            })
            ->addColumn('ese', function($data){
                return $data->ese;
            })
            ->addColumn('tw', function($data){
                return $data->tw;
            })
            ->addColumn('oral', function($data){
                return $data->oral;
            })
            ->addColumn('oral_practical', function($data){
                return $data->oral_practical;
            })
            ->addColumn('branches', function($data){
                return $data->branch->name;
            })
            ->addColumn('action', function($data){
                if (Auth::user()->can('manage_course')){
                    return '<div class="table-actions">
                                    <a href="'.url('course/delete/'.$data->id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </div>';
                }else{
                    return '';
                }
            })
            ->rawColumns(['code','name','credits','ut1','ut2','ese','tw','oral','oral_practical','branches','action'])
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
            'course' => 'required',
            'credits' => 'required',
            'ut1' => 'sometimes',
            'ut2' => 'sometimes',
            'ese' => 'sometimes',
            'tw' => 'sometimes',
            'oral' => 'sometimes',
            'oral_practical' => 'sometimes',
            'branch' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try{
            $course = Course::create([
                'name' => $request->course,
                'code' => $request->code,
                'credits' => $request->credits,
                'branch_id' => $request->branch,
                'ut1' => $request->ut1,
                'ut2' => $request->ut2,
                'ese' => $request->ese,
                'tw' => $request->tw,
                'oral' => $request->oral,
                'oral_practical' => $request->oral_practical,
            ]);

            if($course){
                return redirect('course')->with('success', 'Course created succesfully!');
            }else{
                return redirect('course')->with('error', 'Failed to create course! Try again.');
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    public function update(Request $request)
    {
        $course = Course::find($request->id);
        if ($request->name) {
            $course->name = $request->name;
        }
        if ($request->code) {
            $course->code = $request->code;
        }
        if ($request->credits) {
            $course->credits = $request->credits;
        }
        $course->save();
        return $course;
    }


    public function delete($id)
    {
        $course = Course::find($id);
        if($course){
            $course->delete();
            return redirect('course')->with('success', 'Course deleted!');
        }else{
            return redirect('404');
        }
    }

    public function uploadCourses(Request $request){
        $file = $request->file('file');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes
            $this->checkUploadedFileProperties($extension, $fileSize);
            $location = 'uploads'; //Created an "uploads" folder for that
            $file->move($location, $filename);
            $filepath = public_path($location . "/" . $filename);
            $file = fopen($filepath, "r");
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
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
//            dd($importData_arr);
            foreach ($importData_arr as $importData) {
//                dd($importData);
//                $name = $importData[1]; //Get user names
//                $email = $importData[3]; //Get the user emails
                $j++;
                try {
                    DB::beginTransaction();
                    $course = Course::create([
                        'name'      => $this->null_convert($importData[1]),
                        'code'      => $this->null_convert($importData[0]),
                        'credits'   => $this->null_convert($importData[2]),
                        'ut1'   => $this->null_convert($importData[3]),
                        'ut2'   => $this->null_convert($importData[4]),
                        'ese'   => $this->null_convert($importData[5]),
                        'tw'   => $this->null_convert($importData[6]),
                        'oral'   => $this->null_convert($importData[7]),
                        'oral_practical'   => $this->null_convert($importData[8]),
                        'branch_id' => $this->null_convert($importData[9]),
                    ]);
                    DB::commit();
                } catch (\Exception $e) {
//                    return response()->json([
//                        'message' => $e
//                    ]);
                    DB::rollBack();
                }
            }
            return response()->json([
                'message' => "$j records successfully uploaded"
            ]);
        } else {
            throw new \Exception('No file was uploaded', 404);
        }
    }

    public function null_convert($str){
        if ($str == '') {
            return null;
        }
        return $str;
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
}
