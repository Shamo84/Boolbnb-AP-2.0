<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\ApartmentPackage;
use Carbon\Carbon;
use App\Service;
use App\Image;
use App\Http\Traits\CalcDistance;
use App\Http\Traits\DivideApartments;



class SearchController extends Controller
	{
		use CalcDistance;
		use DivideApartments;


		public function index(Request $request)
		{
			if (!$request->has('address') || empty($request->address) || !$request->has('latitude') || empty($request->latitude) || !$request->has('longitude') || empty($request->longitude)) {
				return redirect()->route('home');
			}
			$data = $request->all();

			$advApt = $this->DivideApartments()[0];
			$noAdvApt = $this->DivideApartments()[1];

			$apartmentsInRadius = $this->DistanceFilter($noAdvApt, $data["latitude"], $data["longitude"]);
			$advApt = $this->DistanceFilter($advApt, $data["latitude"], $data["longitude"]);
			$services = Service::all();
			$data =[
				"address" => $data["address"],
				"apartmentsInRadius" => $apartmentsInRadius,
				"sponsoredApartments" => $advApt,
				"centerLatitude" => $data["latitude"],
				"centerLongitude" => $data["longitude"],
				"services" => $services
			];
			return view('search', $data);
		}
	}
