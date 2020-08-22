<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\ApartmentPackage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\View;
use App\Http\Traits\DivideApartments;


class ApartmentController extends Controller
{
	use DivideApartments;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		$advApt = $this->DivideApartments()[0];
		$noAdvApt = $this->DivideApartments()[1];

		$data = [
			'advApt' => $advApt,
			'noAdvApt' => $noAdvApt
			];

		return view('home', $data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Apartment  $apartment
	 * @return \Illuminate\Http\Response
	 */
	public function show(Apartment $apartment, Request $request)
	{
		if (empty($apartment)) {
			abort('400');
		}

		if (!empty(Auth::user()->id)) {
			if ($apartment->user->id == Auth::user()->id) {
				return redirect()->route('upr.apartment.show', $apartment);
			}
		}

		$searchIp = View::where('ip', $request->ip())->latest()->first();
		if (empty($searchIp) || Carbon::parse($searchIp->created_at)->lt(Carbon::now()->subMinutes(10))) {
			$view = new View;
			$view->apartment_id = $apartment->id;
			$view->ip = $request->ip();
			$view->save();
		}
			return view('show', compact('apartment'));
	}
}
