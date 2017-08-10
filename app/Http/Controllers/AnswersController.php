<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Http\Requests\StoreAnswerRequest;
use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    protected $answer;

    /**
     * AnswersController constructor.
     *
     * @param $answers
     */
    public function __construct (AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    public function  store(StoreAnswerRequest $request,$question)
    {
        $answer = $this->answer->create([
            'question_id'=>$question,
            'user_id'=>\Auth::id(),
            'body'=>$request->get('body')
        ]);
        $answer->question()->increment('answers_count');
        flash('回答成功!')->success()->important();
        return back();
    }
}
