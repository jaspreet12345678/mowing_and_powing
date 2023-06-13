<?php

namespace App\Http\Controllers\Client;

use App\Models\Cleanup;
use App\Models\CornerLot;
use App\Models\Fence;
use App\Models\LawnHeight;
use App\Models\LawnSize;
use App\Models\Order;
use App\Models\Property;
use App\Models\RecurringHistory;
use App\Models\ServicePeriod;
use App\Traits\OrderTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends ClientBaseController
{
    use OrderTrait;

    public function selectService(Request $req)
    {
        $req->validate([
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $this->address = $req->address;
        $this->lat = $req->lat;
        $this->lng = $req->lng;

        return view('client.select-service.index',$this->data);
    }

    public function start(Request $req)
    {
        $req->validate([
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $data = $req->except('_token');
        $data['category_id'] = 1;

        $property = Property::whereCategoryId($data['category_id'])->whereUserId(null)->whereLat($data['lat'])->whereLng($data['lng'])->first();

        if(!$property) {
            $property = Property::create($data);
        }

        return redirect(route('guest.order.lawn-mowing.steps',$property->id));
    }

}
