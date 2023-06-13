<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Transaction;
use Illuminate\Http\Request;

class RatingsController extends ApiBaseController
{
    public function totalReviewsAndLevel()
    {
        try {
            $this->level = 0;
            $this->totalRating = 0;
            $this->reviewsDetail = Rating::with('user')->whereProviderId(auth()->user()->id)->latest()->get();
            $this->reviewsCount = $this->reviewsDetail->count();

            $totalReviews = Rating::whereProviderId(auth()->user()->id)->count();
            if ($totalReviews != 0) {
                $sumOfReviews = Rating::whereProviderId(auth()->user()->id)->sum('quality_rating');
                $this->totalRating = round($sumOfReviews / $totalReviews,1);
            }

            $this->level = getProviderLevel();

            return parent::resp(true, 'Here are your reviews and ratings.', $this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

}
