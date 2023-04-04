<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Marks;
use App\Railway;
use App\Stream;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RailwayController extends Controller
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
            $class = array('1' => 'First Class', '2' => 'Second Class');
            $period = array('1' => 'Monthly', '3' => 'Quarterly');
            $station = array(
                "	Airoli	" => "	Airoli	",
                "	Aman Lodge	" => "	Aman Lodge	",
                "	Ambernath	" => "	Ambernath	",
                "	Ambivli	" => "	Ambivli	",
                "	Andheri	" => "	Andheri	",
                "	Apta	" => "	Apta	",
                "	Asangaon	" => "	Asangaon	",
                "	Atgaon	" => "	Atgaon	",
                "	Badlapur	" => "	Badlapur	",
                "	Bamandongri	" => "	Bamandongri	",
                "	Bandra	" => "	Bandra	",
                "	Bhandup	" => "	Bhandup	",
                "	Bhayandar	" => "	Bhayandar	",
                "	Bhivpuri Road	" => "	Bhivpuri Road	",
                "	Bhiwandi Road	" => "	Bhiwandi Road	",
                "	Boisar	" => "	Boisar	",
                "	Borivali	" => "	Borivali	",
                "	Byculla	" => "	Byculla	",
                "	CBD Belapur	" => "	CBD Belapur	",
                "	Chhatrapati Shivaji Maharaj Terminus	" => "	Chhatrapati Shivaji Maharaj Terminus	",
                "	Charni Road	" => "	Charni Road	",
                "	Chembur	" => "	Chembur	",
                "	Chinchpokli	" => "	Chinchpokli	",
                "	Chunabhatti	" => "	Chunabhatti	",
                "	Churchgate	" => "	Churchgate	",
                "	Cotton Green	" => "	Cotton Green	",
                "	Currey Road	" => "	Currey Road	",
                "	Dadar	" => "	Dadar	",
                "	Dahanu Road	" => "	Dahanu Road	",
                "	Dahisar	" => "	Dahisar	",
                "	Dativali	" => "	Dativali	",
                "	Diva Junction	" => "	Diva Junction	",
                "	Dockyard Road	" => "	Dockyard Road	",
                "	Dolavli	" => "	Dolavli	",
                "	Dombivli	" => "	Dombivli	",
                "	Guru Tegh Bahadur Nagar	" => "	Guru Tegh Bahadur Nagar	",
                "	Ghansoli	" => "	Ghansoli	",
                "	Ghatkopar	" => "	Ghatkopar	",
                "	Goregaon	" => "	Goregaon	",
                "	Govandi	" => "	Govandi	",
                "	Grant Road	" => "	Grant Road	",
                "	Hamrapur	" => "	Hamrapur	",
                "	Jite	" => "	Jite	",
                "	Jogeshwari	" => "	Jogeshwari	",
                "	Juchandra	" => "	Juchandra	",
                "	Juinagar	" => "	Juinagar	",
                "	Jummapatti	" => "	Jummapatti	",
                "	Kalamboli	" => "	Kalamboli	",
                "	Kalwa	" => "	Kalwa	",
                "	Kalyan	" => "	Kalyan	",
                "	Kaman Road	" => "	Kaman Road	",
                "	Kandivali	" => "	Kandivali	",
                "	Kanjurmarg	" => "	Kanjurmarg	",
                "	Karjat	" => "	Karjat	",
                "	Kasara	" => "	Kasara	",
                "	Kasu	" => "	Kasu	",
                "	Kelavli	" => "	Kelavli	",
                "	Kelve Road	" => "	Kelve Road	",
                "	Khadavli	" => "	Khadavli	",
                "	Khandeshwar	" => "	Khandeshwar	",
                "	Khar Road	" => "	Khar Road	",
                "	Kharbao	" => "	Kharbao	",
                "	Khardi	" => "	Khardi	",
                "	Kharghar	" => "	Kharghar	",
                "	Kharkopar	" => "	Kharkopar	",
                "	Khopoli	" => "	Khopoli	",
                "	King's Circle	" => "	King's Circle	",
                "	Kopar	" => "	Kopar	",
                "	Kopar Khairane	" => "	Kopar Khairane	",
                "	Kurla	" => "	Kurla	",
                "	Lower Parel	" => "	Lower Parel	",
                "	Lowjee	" => "	Lowjee	",
                "	Mahalaxmi	" => "	Mahalaxmi	",
                "	Mahim Junction	" => "	Mahim Junction	",
                "	Malad	" => "	Malad	",
                "	Mansarovar	" => "	Mansarovar	",
                "	Mankhurd	" => "	Mankhurd	",
                "	Marine Lines	" => "	Marine Lines	",
                "	Masjid	" => "	Masjid	",
                "	Matheran	" => "	Matheran	",
                "	Matunga	" => "	Matunga	",
                "	Matunga Road	" => "	Matunga Road	",
                "	Mira Road	" => "	Mira Road	",
                "	Mulund	" => "	Mulund	",
                "	Mumbai Central	" => "	Mumbai Central	",
                "	Mumbra	" => "	Mumbra	",
                "	Nagothane	" => "	Nagothane	",
                "	Nahur	" => "	Nahur	",
                "	Naigaon	" => "	Naigaon	",
                "	Nallasopara	" => "	Nallasopara	",
                "	Navade Road	" => "	Navade Road	",
                "	Neral	" => "	Neral	",
                "	Nerul	" => "	Nerul	",
                "	Nidi	" => "	Nidi	",
                "	Nilaje	" => "	Nilaje	",
                "	Palasdari	" => "	Palasdari	",
                "	Palghar	" => "	Palghar	",
                "	Panvel	" => "	Panvel	",
                "	Parel	" => "	Parel	",
                "	Pen	" => "	Pen	",
                "	Prabhadevi	" => "	Prabhadevi	",
                "	Rabale	" => "	Rabale	",
                "	Ram Mandir	" => "	Ram Mandir	",
                "	Rasayani	" => "	Rasayani	",
                "	Reay Road	" => "	Reay Road	",
                "	Roha	" => "	Roha	",
                "	Sandhurst Road	" => "	Sandhurst Road	",
                "	Sanpada	" => "	Sanpada	",
                "	Santacruz	" => "	Santacruz	",
                "	Saphale	" => "	Saphale	",
                "	Seawoods-Darave	" => "	Seawoods-Darave	",
                "	Sewri	" => "	Sewri	",
                "	Shahad	" => "	Shahad	",
                "	Shelu	" => "	Shelu	",
                "	Sion	" => "	Sion	",
                "	Somtane	" => "	Somtane	",
                "	Taloja Panchnand	" => "	Taloja Panchnand	",
                "	Thakurli	" => "	Thakurli	",
                "	Thane	" => "	Thane	",
                "	Thansit	" => "	Thansit	",
                "	Tilak Nagar	" => "	Tilak Nagar	",
                "	Titwala	" => "	Titwala	",
                "	Turbhe	" => "	Turbhe	",
                "	Ulhasnagar	" => "	Ulhasnagar	",
                "	Umbermali	" => "	Umbermali	",
                "	Umroli	" => "	Umroli	",
                "	Vadala Road	" => "	Vadala Road	",
                "	Vaitarna	" => "	Vaitarna	",
                "	Vangani	" => "	Vangani	",
                "	Vangaon	" => "	Vangaon	",
                "	Vasai Road	" => "	Vasai Road	",
                "	Vashi	" => "	Vashi	",
                "	Vasind	" => "	Vasind	",
                "	Vidyavihar	" => "	Vidyavihar	",
                "	Vikhroli	" => "	Vikhroli	",
                "	Vile Parle	" => "	Vile Parle	",
                "	Virar	" => "	Virar	",
                "	Vithalwadi	" => "	Vithalwadi	",
                "	Water Pipe	" => "	Water Pipe	",
                "	Dronagiri	" => "	Dronagiri	",
                "	Gavan	" => "	Gavan	",
                "	Nhava Sheva	" => "	Nhava Sheva	",
                "	Ranjanpada	" => "	Ranjanpada	",
                "	Sagar Sangam	" => "	Sagar Sangam	",
                "	Targhar	" => "	Targhar	",
                "	Uran City	" => "	Uran City	"
            );
            return view('admin.railway.create', compact('streams','users', 'options','class','period','station'));
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Show the role list with associate permissions.
     * Server side list view using yajra datatables
     */

    public function getRailwayList(Request $request)
    {

        $data  = Railway::where('status',0)->where('user_id',Auth::user()->id)->get();

        return Datatables::of($data)
            ->addColumn('date', function($data){
                return $data->date;
            })
            ->addColumn('class', function($data){
                if ($data->class == 1) {
                    return "First Class";
                }
                return "Second Class";
            })
            ->addColumn('period', function($data){
                if ($data->period == 1) {
                    return "Monthly";
                }
                return "Quarterly";
            })
            ->addColumn('action', function($data){
                return '<div class="table-actions">
                                <a href="'.url('railway/delete/'.$data->id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
            })
            ->rawColumns([
                'date',
                'class',
                'period',
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
            "class" => "required",
            "period" => "required",
            "from" => "required",
            "to" => "required",
            "option" => "required",
            "ticket_no" => "sometimes",
            "prev_certi_no" => "sometimes",
            "date_of_expiry" => "sometimes",
            "prev_from" => "sometimes",
            "prev_to" => "sometimes",
            "prev_class" => "sometimes",
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try{
            if ($request->option == 0) {
                $railway = Railway::create([
                    'user_id' => Auth::user()->id,
                    'class' => $request->class,
                    'period' => $request->period,
                    'from' => $request->from,
                    'to' => $request->to,
                    'date' => date("Y-m-d"),
                ]);
            }else {
                $railway = Railway::create([
                    'user_id' => Auth::user()->id,
                    'class' => $request->class,
                    'period' => $request->period,
                    'from' => $request->from,
                    'to' => $request->to,
                    'ticket_no' => $request->ticket_no,
                    'prev_certi_no' => $request->prev_certi_no,
                    'date_of_expiry' => $request->date_of_expiry,
                    'prev_from' => $request->prev_from,
                    'prev_to' => $request->prev_to,
                    'prev_class' => $request->prev_class,
                    'date' => date("Y-m-d"),
                ]);
            }
            if($railway){
                return redirect('railway')->with('success', 'Application submitted successfully!');
            }else{
                return redirect('railway')->with('error', 'Failed to add application! Try again.');
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

//    public function update(Request $request)
//    {
//        $branch = Branch::find($request->id);
//        if ($request->name) {
//            $branch->name = $request->name;
//        }
//        if ($request->code) {
//            $branch->code = $request->code;
//        }
//        $branch->save();
//        return $branch;
//    }


    public function delete($id)
    {
        $railway = Railway::find($id);
        if($railway){
            $railway->delete();
            return redirect('railway')->with('success', 'Application deleted!');
        }else{
            return redirect('404');
        }
    }

    /**
     * Show the roles page
     *
     */
    public function checkIndex()
    {
        try{
            $streams = Stream::pluck('name','id');
            $users = User::whereNotNull('rollno')
                ->pluck('rollno','id');
            $options = array('1' => 'Successful', '0' => 'Unsuccessful');
            $class = array('1' => 'First Class', '2' => 'Second Class');
            $period = array('1' => 'Monthly', '3' => 'Quarterly');
            $station = array(
                "	Airoli	" => "	Airoli	",
                "	Aman Lodge	" => "	Aman Lodge	",
                "	Ambernath	" => "	Ambernath	",
                "	Ambivli	" => "	Ambivli	",
                "	Andheri	" => "	Andheri	",
                "	Apta	" => "	Apta	",
                "	Asangaon	" => "	Asangaon	",
                "	Atgaon	" => "	Atgaon	",
                "	Badlapur	" => "	Badlapur	",
                "	Bamandongri	" => "	Bamandongri	",
                "	Bandra	" => "	Bandra	",
                "	Bhandup	" => "	Bhandup	",
                "	Bhayandar	" => "	Bhayandar	",
                "	Bhivpuri Road	" => "	Bhivpuri Road	",
                "	Bhiwandi Road	" => "	Bhiwandi Road	",
                "	Boisar	" => "	Boisar	",
                "	Borivali	" => "	Borivali	",
                "	Byculla	" => "	Byculla	",
                "	CBD Belapur	" => "	CBD Belapur	",
                "	Chhatrapati Shivaji Maharaj Terminus	" => "	Chhatrapati Shivaji Maharaj Terminus	",
                "	Charni Road	" => "	Charni Road	",
                "	Chembur	" => "	Chembur	",
                "	Chinchpokli	" => "	Chinchpokli	",
                "	Chunabhatti	" => "	Chunabhatti	",
                "	Churchgate	" => "	Churchgate	",
                "	Cotton Green	" => "	Cotton Green	",
                "	Currey Road	" => "	Currey Road	",
                "	Dadar	" => "	Dadar	",
                "	Dahanu Road	" => "	Dahanu Road	",
                "	Dahisar	" => "	Dahisar	",
                "	Dativali	" => "	Dativali	",
                "	Diva Junction	" => "	Diva Junction	",
                "	Dockyard Road	" => "	Dockyard Road	",
                "	Dolavli	" => "	Dolavli	",
                "	Dombivli	" => "	Dombivli	",
                "	Guru Tegh Bahadur Nagar	" => "	Guru Tegh Bahadur Nagar	",
                "	Ghansoli	" => "	Ghansoli	",
                "	Ghatkopar	" => "	Ghatkopar	",
                "	Goregaon	" => "	Goregaon	",
                "	Govandi	" => "	Govandi	",
                "	Grant Road	" => "	Grant Road	",
                "	Hamrapur	" => "	Hamrapur	",
                "	Jite	" => "	Jite	",
                "	Jogeshwari	" => "	Jogeshwari	",
                "	Juchandra	" => "	Juchandra	",
                "	Juinagar	" => "	Juinagar	",
                "	Jummapatti	" => "	Jummapatti	",
                "	Kalamboli	" => "	Kalamboli	",
                "	Kalwa	" => "	Kalwa	",
                "	Kalyan	" => "	Kalyan	",
                "	Kaman Road	" => "	Kaman Road	",
                "	Kandivali	" => "	Kandivali	",
                "	Kanjurmarg	" => "	Kanjurmarg	",
                "	Karjat	" => "	Karjat	",
                "	Kasara	" => "	Kasara	",
                "	Kasu	" => "	Kasu	",
                "	Kelavli	" => "	Kelavli	",
                "	Kelve Road	" => "	Kelve Road	",
                "	Khadavli	" => "	Khadavli	",
                "	Khandeshwar	" => "	Khandeshwar	",
                "	Khar Road	" => "	Khar Road	",
                "	Kharbao	" => "	Kharbao	",
                "	Khardi	" => "	Khardi	",
                "	Kharghar	" => "	Kharghar	",
                "	Kharkopar	" => "	Kharkopar	",
                "	Khopoli	" => "	Khopoli	",
                "	King's Circle	" => "	King's Circle	",
                "	Kopar	" => "	Kopar	",
                "	Kopar Khairane	" => "	Kopar Khairane	",
                "	Kurla	" => "	Kurla	",
                "	Lower Parel	" => "	Lower Parel	",
                "	Lowjee	" => "	Lowjee	",
                "	Mahalaxmi	" => "	Mahalaxmi	",
                "	Mahim Junction	" => "	Mahim Junction	",
                "	Malad	" => "	Malad	",
                "	Mansarovar	" => "	Mansarovar	",
                "	Mankhurd	" => "	Mankhurd	",
                "	Marine Lines	" => "	Marine Lines	",
                "	Masjid	" => "	Masjid	",
                "	Matheran	" => "	Matheran	",
                "	Matunga	" => "	Matunga	",
                "	Matunga Road	" => "	Matunga Road	",
                "	Mira Road	" => "	Mira Road	",
                "	Mulund	" => "	Mulund	",
                "	Mumbai Central	" => "	Mumbai Central	",
                "	Mumbra	" => "	Mumbra	",
                "	Nagothane	" => "	Nagothane	",
                "	Nahur	" => "	Nahur	",
                "	Naigaon	" => "	Naigaon	",
                "	Nallasopara	" => "	Nallasopara	",
                "	Navade Road	" => "	Navade Road	",
                "	Neral	" => "	Neral	",
                "	Nerul	" => "	Nerul	",
                "	Nidi	" => "	Nidi	",
                "	Nilaje	" => "	Nilaje	",
                "	Palasdari	" => "	Palasdari	",
                "	Palghar	" => "	Palghar	",
                "	Panvel	" => "	Panvel	",
                "	Parel	" => "	Parel	",
                "	Pen	" => "	Pen	",
                "	Prabhadevi	" => "	Prabhadevi	",
                "	Rabale	" => "	Rabale	",
                "	Ram Mandir	" => "	Ram Mandir	",
                "	Rasayani	" => "	Rasayani	",
                "	Reay Road	" => "	Reay Road	",
                "	Roha	" => "	Roha	",
                "	Sandhurst Road	" => "	Sandhurst Road	",
                "	Sanpada	" => "	Sanpada	",
                "	Santacruz	" => "	Santacruz	",
                "	Saphale	" => "	Saphale	",
                "	Seawoods-Darave	" => "	Seawoods-Darave	",
                "	Sewri	" => "	Sewri	",
                "	Shahad	" => "	Shahad	",
                "	Shelu	" => "	Shelu	",
                "	Sion	" => "	Sion	",
                "	Somtane	" => "	Somtane	",
                "	Taloja Panchnand	" => "	Taloja Panchnand	",
                "	Thakurli	" => "	Thakurli	",
                "	Thane	" => "	Thane	",
                "	Thansit	" => "	Thansit	",
                "	Tilak Nagar	" => "	Tilak Nagar	",
                "	Titwala	" => "	Titwala	",
                "	Turbhe	" => "	Turbhe	",
                "	Ulhasnagar	" => "	Ulhasnagar	",
                "	Umbermali	" => "	Umbermali	",
                "	Umroli	" => "	Umroli	",
                "	Vadala Road	" => "	Vadala Road	",
                "	Vaitarna	" => "	Vaitarna	",
                "	Vangani	" => "	Vangani	",
                "	Vangaon	" => "	Vangaon	",
                "	Vasai Road	" => "	Vasai Road	",
                "	Vashi	" => "	Vashi	",
                "	Vasind	" => "	Vasind	",
                "	Vidyavihar	" => "	Vidyavihar	",
                "	Vikhroli	" => "	Vikhroli	",
                "	Vile Parle	" => "	Vile Parle	",
                "	Virar	" => "	Virar	",
                "	Vithalwadi	" => "	Vithalwadi	",
                "	Water Pipe	" => "	Water Pipe	",
                "	Dronagiri	" => "	Dronagiri	",
                "	Gavan	" => "	Gavan	",
                "	Nhava Sheva	" => "	Nhava Sheva	",
                "	Ranjanpada	" => "	Ranjanpada	",
                "	Sagar Sangam	" => "	Sagar Sangam	",
                "	Targhar	" => "	Targhar	",
                "	Uran City	" => "	Uran City	"
            );
            return view('admin.railway.verify', compact('streams','users', 'options','class','period','station'));
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Show the role list with associate permissions.
     * Server side list view using yajra datatables
     */

    public function getActiveRailwayApplicationsList(Request $request)
    {

        $data  = Railway::where('status',0)->get();

        return Datatables::of($data)
            ->addColumn('date', function($data){
                return $data->date;
            })
            ->addColumn('rollno', function($data){
                return $data->user->rollno;
            })
            ->addColumn('name', function($data){
                return $data->user->name;
            })
            ->addColumn('action', function($data){
                if (Auth::user()->can('manage_railway')){
                    return '<div class="table-actions">
                                    <a href="'.url('railway/view/'.$data->id).'" ><i class="ik ik-eye f-16 mr-15 text-blue"></i></a>
                                    <a href="'.url('railway/accept/'.$data->id).'" ><i class="ik ik-check-circle f-16 mr-15 text-green"></i></a>
                                    <a href="'.url('railway/delete/'.$data->id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </div>';
                }else{
                    return '';
                }
            })
            ->rawColumns([
                'date',
                'rollno',
                'name',
                'action'])
            ->make(true);
    }

    /**
     * Show the role list with associate permissions.
     * Server side list view using yajra datatables
     */

    public function getAcceptedRailwayApplicationsList(Request $request)
    {

        $data  = Railway::where('status',1)->get();

        return Datatables::of($data)
            ->addColumn('date', function($data){
                return $data->date;
            })
            ->addColumn('rollno', function($data){
                return $data->user->rollno;
            })
            ->addColumn('name', function($data){
                return $data->user->name;
            })
            ->addColumn('action', function($data){
                if (Auth::user()->can('manage_railway')){
                    return '<div class="table-actions">
                                    <a href="'.url('railway/view/'.$data->id).'" ><i class="ik ik-eye f-16 mr-15 text-blue"></i></a>
                                    <a href="'.url('railway/delete/'.$data->id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </div>';
                }else{
                    return '';
                }
            })
            ->rawColumns([
                'date',
                'rollno',
                'name',
                'action'])
            ->make(true);
    }

    public function acceptApplication($id){
        $railway = Railway::find($id);
        if($railway){
            $railway->status = 1;
            $railway->save();
            return redirect('railway/verify')->with('success', 'Application accepted!');
        }else{
            return redirect('404');
        }
    }

    /**
     * Show the roles page
     *
     */
    public function viewIndex($id)
    {
        try{
            $railway = Railway::find($id);
            if($railway){
                $datetime1 = date_create($railway->user->dob);
                $datetime2 = date_create(date('Y-m-d'));

                $age = date_diff($datetime1, $datetime2);
                return view('admin.railway.view', compact('railway','age'));
            }else{
                return redirect('404');
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
