<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\FavoriteProvider;
use App\Models\Order;
use App\Models\Proposal;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteProvidersController extends ClientBaseController
{
    public function index()
    {
        $this->pageTitle = 'Favorite Providers';
        $this->breadCrumbs = ['Providers'];
        $this->providers = FavoriteProvider::whereUserId(auth()->id())->get();
        return view('client.providers.index',$this->data);
    }

    public function providerDetails(Request $req,$id)
    {
        
        if($req->proposal_id){
            $proposal = Proposal::find($req->proposal_id);
            if (!$proposal) return back()->with('error',"Proposal does not exist");
            $order = Order::whereUserId(auth()->id())->whereId($proposal->order_id)->first();
            if (!$order) return back()->with('error',"You do not have access to this proposal");
        }
        $this->provider = User::find($id);
        $this->type = $req->type ?? 'details';
        $this->proposal_id = $req->proposal_id ?? 0;

        $this->calculateAllRatings($id);

        return view('client.providers.details',$this->data);
    }

    public function calculateAllRatings($provider_id)
    {
        $this->totalScore = 0;
        $this->qualityRatingPerc = 0;
        $this->responseOnTimePerc = 0;
        $this->completeJobsPerc = 0;
        $this->cancelJobsPerc = 0;
        $totalRatingsCount = Rating::whereProviderId($provider_id)->count();
        $totalJobs = Order::whereAssignedTo($provider_id)->wherePaymentStatus(2)->whereIn('status',[2,3,4])->count();

        if ($totalRatingsCount) {
            $sumOfQualityRatings = Rating::whereProviderId($provider_id)->sum('quality_rating');
            $qualityRating = $sumOfQualityRatings / $totalRatingsCount;

            $sumOfResponseOnTimeRatings = Rating::whereProviderId($provider_id)->sum('response_time_rating');
            $responseOnTimeRating = $sumOfResponseOnTimeRatings / $totalRatingsCount;

            $this->responseOnTimePerc = ($responseOnTimeRating / 5) * 100;
            $this->qualityRatingPerc = ($qualityRating / 5) * 100;
            $this->totalScore = ($this->responseOnTimePerc + $this->qualityRatingPerc) / 2;
        }

        if ($totalJobs) {
            $completedJobs = Order::whereAssignedTo($provider_id)->wherePaymentStatus(2)->whereStatus(3)->latest()->count();
            $this->completeJobsPerc = ($completedJobs / $totalJobs) * 100;

            $canceledJobs = Order::whereAssignedTo($provider_id)->wherePaymentStatus(2)->whereStatus(4)->latest()->count();
            $this->cancelJobsPerc = ($canceledJobs / $totalJobs) * 100;
        }
    }
}
