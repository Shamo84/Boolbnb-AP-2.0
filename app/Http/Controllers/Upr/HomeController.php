<?php

namespace App\Http\Controllers\Upr;
use DB;
use App\Apartment;
use App\Service;
use App\Image;
use App\View;
use Carbon\Carbon;
use App\Message;
use App\Package;
use App\ApartmentPackage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get();

        $totalViews = DB::table('apartments')
          ->join('views', 'apartments.id', '=', 'views.apartment_id')
          ->where('user_id', Auth::id())
          ->get();

        $messages = DB::table('apartments')
          ->join('messages', 'apartments.id', '=', 'messages.apartment_id')
          ->where('user_id', Auth::id())
          ->get();

        // $activePackages = DB::table('apartment_package')
        //   ->join('apartments', 'apartment_package.apartment_id', '=', 'apartments.id')
        //   ->join('packages', 'apartment_package.package_id', '=', 'packages.id')
        //   ->where('user_id', Auth::id())
        //   ->get();

        $activePackages = ApartmentPackage::where("end", ">", Carbon::now())->get();
        $activePackagesArray = [];
        $activePackagesID = [];
        for ($i = count($activePackages) - 1; $i >= 0 ; $i--) {
          if (!in_array($activePackages[$i]["apartment_id"], $activePackagesID)) {
            $activePackagesArray[] = [
              "title" => Apartment::find($activePackages[$i]["apartment_id"])["title"],
              "end" => Carbon::parse($activePackages[$i]["end"])->format("d/m/Y H:i:s")
            ];
            $activePackagesID[] = $activePackages[$i]["apartment_id"];
          }
        }

        $data =[
          "messages" => $messages,
          "apartments" => $apartments,
          "activePackages" => array_reverse($activePackagesArray),
          "totalViews" => $totalViews
        ];
        return view('upr.dashboard', $data);
    }
}
