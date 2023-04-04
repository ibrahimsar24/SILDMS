<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Course;
use App\Result;
use App\Semester;
use App\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class SemesterController extends Controller
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
//            $role = Role::where('name','Admin')->first()->users;
//            $nonmembers = $users->reject(function ($user, $key) {
//                return $user->hasRole('Member');
//            });
            $branches = Branch::pluck('name','id');
            $courses = Course::pluck('name','id');
            return view('admin.semester', compact('branches','courses'));
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function getSemesterInfo($id)
    {
        try{
            $branches = Branch::pluck('name','id');
            $courses = Course::pluck('name','id');
            $prof = User::get()->reject(function ($user, $key) {
                return $user->hasRole('Student');
            });
//            $students = Role::where('name','Student')->first()->users;
            $semester = Semester::find($id);

//            dd($students);

            if($semester){
                $students = User::where('branch_id',$semester->branch_id)->get()->reject(function ($user, $key) {
                    return !$user->hasRole('Student');
                })->pluck('name','id');
                return view('admin.semester.list', compact('branches','courses','semester','prof','students'));
            }else{
                return redirect('404');
            }

        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function getCoursesList($id){
        $courses = Course::where('branch_id',$id)->get();
        $html = '';
        foreach ($courses as $course){
            $html .= '<option value="'.$course->id.'">'.$course->name.'</option>';
        }
        return $html;
    }

    public function getCourses($id)
    {
//        dd("Hello");
//        Log::useDailyFiles(storage_path().'/logs/debug.log');
//        Log::channel("single")->info("Hello");
//        Log::info('message');
//        error_log('message here.');
//        Log::build([
//            'driver' => 'single',
//            'path' => storage_path('logs/custom.log'),
//        ])->info('Something happened!');
        $data  = DB::table('semester_has_courses')->where('semester_id',$id)->get();
//        dd($data);
        return Datatables::of($data)
            ->addColumn('courses', function($data){
                return Course::find($data->course_id)->name;
            })
            ->addColumn('prof', function($data){
//                return User::find($data->prof_id);
//                return $data->prof_id;
                if ($data->prof_id != null) {
                    return User::find($data->prof_id)->name;
                }
                return "Assign a Professor";
            })

//            ->addColumn('branches', function($data){
//                return $data->branch->name;
//            })
//            ->addColumn('courses', function($data){
//                $list = DB::table('semester_has_courses')->where('semester_id',$data->id)->pluck('course_id');
//                $courses = Course::whereIn('id',$list)->get();
//                $badges = '';
//                foreach ($courses as $key => $course) {
//                    $badges .= '<span class="badge badge-dark m-1">'.$course->name.'</span>';
//                }
//
//                return $badges;
//            })
            ->addColumn('action', function($data){
                if (Auth::user()->can('manage_semester')){
                    return '<div class="table-actions">
                                    <a href="'.url('semester/'.$data->semester_id.'/course/view/'.$data->id).'" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                </div>';
                }else{
                    return '';
                }
            })
            ->rawColumns(['courses','prof','action'])
            ->make(true);
    }

    public function getSemesterList()
    {

        $data  = Semester::get();

        return Datatables::of($data)
            ->addColumn('batch', function($data){
                return $data->batch;
            })
            ->addColumn('number', function($data){
                return $data->number;
            })
            ->addColumn('branches', function($data){
                return $data->branch->name;
            })
            ->addColumn('courses', function($data){
                $list = DB::table('semester_has_courses')->where('semester_id',$data->id)->pluck('course_id');
                $courses = Course::whereIn('id',$list)->get();
                $badges = '';
                foreach ($courses as $key => $course) {
                    $badges .= '<span class="badge badge-dark m-1">'.$course->name.'</span>';
                }

                return $badges;
            })
            ->addColumn('action', function($data){
//                if (Auth::user()->can('manage_semester')){
                    return '<div class="table-actions">
                                    <a href="'.url('semester/view/'.$data->id).'" ><i class="ik ik-eye f-16 mr-15 text-blue"></i></a>
                                    <a href="'.url('semester/delete/'.$data->id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </div>';
//                }else{
//                    return '';
//                }
            })
            ->rawColumns(['batch','number','branches','courses','action'])
            ->make(true);
    }

    /**
     * Store new roles with assigned permission
     * Associate permissions will be stored in table
     */

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'batch' => 'required',
            'branch' => 'required',
            'course' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try{
            $semester = Semester::create([
                'number' => $request->number,
                'batch' => $request->batch,
                'branch_id' => $request->branch,
            ]);
            foreach ($request->course as $course){
                DB::table('semester_has_courses')->insert([
                    'semester_id' => $semester->id,
                    'course_id' => $course
                ]);
            }
            if($semester){
                return redirect('semester')->with('success', 'Semester created successfully!');
            }else{
                return redirect('semester')->with('error', 'Failed to create semester! Try again.');
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function update(Request $request)
    {
        if ($request->prof){
            $semester = DB::table('semester_has_courses')->where('id',$request->id)->update([
                'prof_id' => $request->prof
            ]);
        }

//        if ($request->prof) {
//            $semester->update([
//                'prof_id' => $request->prof
//            ]);
////            $semester->prof_id = $request->prof;
//        }
//        if ($request->batch) {
//            $semester->batch = $request->batch;
//        }

//        $semester->save();
//        dd($semester);
        return $semester;
    }


    public function delete($id)
    {
        $semester = Semester::find($id);
        if($semester){
            $semester->delete();
            return redirect('semester')->with('success', 'Semester deleted!');
        }else{
            return redirect('404');
        }
    }

    public function uploadStudentList(Request $request){
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
//                $j++;
                try {
                    DB::beginTransaction();
                    $user = User::where('rollno',$importData[0])->get()->first();
                    $courses = Course::whereIn('id',DB::table('semester_has_courses')->where('semester_id',$request->semester_id)->pluck('course_id'))->get();
                    if (!Result::where('user_id', '=', $user->id)->where('semester_id',$request->semester_id)->exists()) {
                        foreach ($courses as $course){
                            $result = Result::create([
                                'user_id' => $user->id,
                                'semester_id' => $request->semester_id,
                                'course_id' => $course->id,
                            ]);
                        }
                    }
                    DB::commit();
                } catch (\Exception $e) {
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

    public function addStudent(Request $request)
    {
//        dd($request);
        $validator = Validator::make($request->all(), [
            'students' => 'required',
            'semester_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try{
//            dd($request->semester_id);
            $courses = Course::whereIn('id',DB::table('semester_has_courses')->where('semester_id',$request->semester_id)->pluck('course_id'))->get();
//            dd($courses);
            if (!Result::where('user_id', '=', $request->students)->where('semester_id',$request->semester_id)->exists()) {
//                dd($courses);
                foreach ($courses as $course){
                    $result = Result::create([
                        'user_id' => $request->students,
                        'semester_id' => $request->semester_id,
                        'course_id' => $course->id,
                    ]);
                }
            }else{
                return redirect()->back()->with('error', 'Student already added!');
            }
            if($courses){
                return redirect()->back()->with('success', 'Student added successfully!');
            }else{
                return redirect()->back()->with('error', 'Failed to add student! Try again.');
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function getStudents($id)
    {
        $data  = Result::where('semester_id',$id)->get()->unique('user_id');
//        dd($data);
        return Datatables::of($data)
            ->addColumn('rollno', function($data){
//                return Course::find($data->course_id)->name;
                return User::find($data->user_id)->rollno;
            })
            ->addColumn('name', function($data){
//                return User::find($data->prof_id);
//                return $data->prof_id;
//                if ($data->prof_id != null) {
//                    return User::find($data->prof_id)->name;
//                }
//                return "Assign a Professor";
                return User::find($data->user_id)->name;
            })

//            ->addColumn('branches', function($data){
//                return $data->branch->name;
//            })
//            ->addColumn('courses', function($data){
//                $list = DB::table('semester_has_courses')->where('semester_id',$data->id)->pluck('course_id');
//                $courses = Course::whereIn('id',$list)->get();
//                $badges = '';
//                foreach ($courses as $key => $course) {
//                    $badges .= '<span class="badge badge-dark m-1">'.$course->name.'</span>';
//                }
//
//                return $badges;
//            })
            ->addColumn('action', function($data){
                if (Auth::user()->can('manage_semester')){
                    return '<div class="table-actions">
                                    <a href="'.url('semester/student/delete/'.$data->user_id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </div>';
                }else{
                    return '';
                }
            })
            ->rawColumns(['courses','prof','action'])
            ->make(true);
    }

    public function deleteStudent($id)
    {
        $results = Result::where('user_id',$id)->get();
        if($results){
            foreach ($results as $result){
                $result->delete();
            }
            return redirect()->back()->with('success', 'Semester deleted!');
        }else{
            return redirect('404');
        }
    }

    public function getCourseInfo($id,$code)
    {
        try{
            $branches = Branch::pluck('name','id');
            $courses = Course::pluck('name','id');
            $prof = User::get()->reject(function ($user, $key) {
                return $user->hasRole('Student');
            });
//            $students = Role::where('name','Student')->first()->users;
            $semester = Semester::find($id);

//            dd($students);

            if($semester){
                $students = User::where('branch_id',$semester->branch_id)->get()->reject(function ($user, $key) {
                    return !$user->hasRole('Student');
                })->pluck('name','id');
//                $course_id = DB::table('semester_has_courses')->find($code)->course_id;
                $course = Course::find(DB::table('semester_has_courses')->find($code)->course_id);
//                $data = Result::where('semester_id',$id)
//                    ->where('course_id',$course_id)
//                    ->get();
                return view('admin.semester.course.index', compact('branches','courses','semester','prof','students','code','course'));
            }else{
                return redirect('404');
            }

        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function getStudentMarks($id,$code)
    {
//        $d = DB::table('semester_has_courses')->find($code);
//        dd($id);
        $course_id = DB::table('semester_has_courses')->find($code)->course_id;
        $course = Course::find($course_id);
        $data = Result::where('semester_id',$id)
            ->where('course_id',$course_id)
            ->get();
//        dd($code);
        return Datatables::of($data)
            ->addColumn('rollno', function($data){
//                return Course::find($data->course_id)->name;
                return User::find($data->user_id)->rollno;
            })
            ->addColumn('name', function($data){
//                return User::find($data->prof_id);
//                return $data->prof_id;
//                if ($data->prof_id != null) {
//                    return User::find($data->prof_id)->name;
//                }
//                return "Assign a Professor";
                return User::find($data->user_id)->name;
            })
            ->addColumn('ut1', function($data){
                return $data->ut1;
            })
            ->addColumn('ut2', function($data){
                return $data->ut2;
            })
            ->addColumn('average', function($data){
                if ($data->ut1 != null) {
                    if ($data->ut2 != null) {
                        return ceil(($data->ut1+$data->ut2)/2);
                    }else {
                        return ceil($data->ut1/2);
                    }
                }
                return '';
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
//            ->addColumn('courses', function($data){
//                $list = DB::table('semester_has_courses')->where('semester_id',$data->id)->pluck('course_id');
//                $courses = Course::whereIn('id',$list)->get();
//                $badges = '';
//                foreach ($courses as $key => $course) {
//                    $badges .= '<span class="badge badge-dark m-1">'.$course->name.'</span>';
//                }
//
//                return $badges;
//            })
//            ->addColumn('action', function($data){
//                if (Auth::user()->can('manage_semester')){
//                    return '<div class="table-actions">
//                                    <a href="'.url('semester/student/delete/'.$data->user_id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
//                                </div>';
//                }else{
//                    return '';
//                }
//            })
            ->rawColumns(['rollno','name','ut1','ut2','average','ese','tw','oral','oral_practical'])
            ->make(true);
    }

    public function updateResult(Request $request)
    {
        $result = Result::find($request->id);
        if ($request->ut1) {
            $result->ut1 = $request->ut1;
        }
        if ($request->ut2) {
            $result->ut2 = $request->ut2;
        }
        if ($request->ese) {
            $result->ese = $request->ese;
        }
        if ($request->tw) {
            $result->tw = $request->tw;
        }
        if ($request->oral) {
            $result->oral = $request->oral;
        }
        if ($request->oral_practical) {
            $result->oral_practical = $request->oral_practical;
        }
        $result->save();
        return $result;
    }

    public function studentIndex()
    {
        try{
//            $role = Role::where('name','Admin')->first()->users;
//            $nonmembers = $users->reject(function ($user, $key) {
//                return $user->hasRole('Member');
//            });
//            $result = Semester::whereIn('id',Result::where('user_id',Auth::user()->id)
//                ->distinct()->get(['semester_id'])->pluck('id'))->get();
//            dd($result);
//            $result = Result::where('user_id',Auth::user()->id)
//                ->distinct()->get(['semester_id']);
//            $semList = array();
//            foreach ($result as $r){
//                array_push($semList,$r->semester_id);
//            }
//            $sem = Semester::whereIn('id',$semList)->get();
//            dd($sem);
            $branches = Branch::pluck('name','id');
            $courses = Course::pluck('name','id');
            return view('admin.student.semester', compact('branches','courses'));
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function getStudentSemesterList()
    {
        $result = Result::where('user_id',Auth::user()->id)
            ->distinct()->get(['semester_id']);
        $semList = array();
        foreach ($result as $r){
            array_push($semList,$r->semester_id);
        }
        $data = Semester::whereIn('id',$semList)->get();
//        $data  = Result::where('user_id',Auth::user()->id)
//            ->distinct()->get(['semester_id'])->pluck('id');

        return Datatables::of($data)
            ->addColumn('batch', function($data){
                return $data->batch;
            })
            ->addColumn('number', function($data){
                return $data->number;
            })
//            ->addColumn('branches', function($data){
//                return $data->branch->name;
//            })
            ->addColumn('courses', function($data){
                $list = DB::table('semester_has_courses')->where('semester_id',$data->id)->pluck('course_id');
                $courses = Course::whereIn('id',$list)->get();
                $badges = '';
                foreach ($courses as $key => $course) {
                    $badges .= '<span class="badge badge-dark m-1">'.$course->name.'</span>';
                }

                return $badges;
            })
            ->addColumn('action', function($data){
//                if (Auth::user()->can('manage_semester')){
                return '<div class="table-actions">
                                    <a href="'.url('semesters/view/'.$data->id).'" ><i class="ik ik-eye f-16 mr-15 text-blue"></i></a>
                                </div>';
//                }else{
//                    return '';
//                }
            })
            ->rawColumns(['batch','number','courses','action'])
            ->make(true);
    }

    public function getStudentSemesterInfo($id)
    {
        try{
            $branches = Branch::pluck('name','id');
            $courses = Course::pluck('name','id');
            $prof = User::get()->reject(function ($user, $key) {
                return $user->hasRole('Student');
            });
//            $students = Role::where('name','Student')->first()->users;
            $semester = Semester::find($id);
//            dd($students);
            if($semester){
                $students = User::where('branch_id',$semester->branch_id)->get()->reject(function ($user, $key) {
                    return !$user->hasRole('Student');
                })->pluck('name','id');
                $results = Result::where('semester_id',$semester->id)
                    ->where('user_id',Auth::user()->id)
                    ->get();
                $data = array();
                $results->ia_flag = false;
                foreach ($results as $result){
                    $c = Course::find($result->course_id);
                    $result->course_name = $c->name;
                    $result->course = $c;
                    if ($result->ut1 != null) {
                        $results->ia_flag = true;
                    }
                    $result->ia_flag = $c->ut1 == null ? false : true;
                    $result->tw_flag = $c->tw == null ? false : true;
                    $result->ese_flag = $c->ese == null ? false : true;
                    $result->oral_flag = $c->oral == null ? false : true;
                    $result->oral_prac_flag = $c->oral_practical == null ? false : true;
                    if ($result->ut1 == null) {
                        if ($result->ut2 == null) {
                            $result->ia = 0;
                        }else{
                            $result->ia = ceil($result->ut2/2);
                        }
                    }else {
                        if ($result->ut2 == null) {
                            $result->ia = ceil($result->ut1/2);
                        }else{
                            $result->ia = ceil(($result->ut1+$result->ut2)/2);
                        }
                    }
                }
//                dd($results);
                return view('admin.student.result', compact('branches','courses','semester','prof','students','results'));
            }else{
                return redirect('404');
            }

        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

}
