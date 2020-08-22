<?php
namespace App\Http\Traits;
use App\Apartment;
use App\ApartmentPackage;
use Carbon\Carbon;

trait DivideApartments
{
	function DivideApartments()
	{
		$sponsoredApartments = [];
		$allApartmentPackage = ApartmentPackage::all();
		foreach ($allApartmentPackage as $apartmentpkg) {
			if (Carbon::parse($apartmentpkg->start)->lt(Carbon::now()) && Carbon::parse($apartmentpkg->end)->gt(Carbon::now())) {
				$sponsoredApartments[] = $apartmentpkg->apartment_id;
			}
		}
		$advApt = Apartment::where('active', '1')->whereIn('id', $sponsoredApartments)->latest()->get();
		$noAdvApt = Apartment::where('active', '1')->whereNotIn('id', $sponsoredApartments)->latest()->get();
		return [$advApt, $noAdvApt];
	}
}
