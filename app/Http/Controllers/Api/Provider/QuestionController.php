<?php

namespace App\Http\Controllers\Api\Provider;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends ApiBaseController
{
    public function getQuestions($category)
    {
        try {
            $this->questions = Question::whereCategory($category)->get();

            return parent::resp(true, 'Questions returned successfully', $this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
