<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreQuestionRequest;
use App\Repositories\QuestionRepository;
use App\Repositories\TopicRepository;
use Auth;
use Illuminate\Http\Request;

/**
 * Class QuestionsController
 * @package App\Http\Controllers
 */
class QuestionsController extends Controller
{
    protected $questionRepository;

    protected $topicRepository;

    public function __construct (QuestionRepository $questionRepository,TopicRepository $topicRepository)
    {
        $this->middleware('auth')->except('index','show');
        $this->questionRepository = $questionRepository;
        $this->topicRepository = $topicRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->questionRepository->getQuestionsFeed();
        return view('questions.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        $topics = $this->topicRepository->normalizeTopic($request->get('topics'));
        $data = [
            'title'=>$request->get('title'),
            'content'=>$request->get('content'),
            'user_id'=>\Auth::id(),
        ];

        $question = $this->questionRepository->create($data);

        $question->topics()->attach($topics);

        flash('发布问题成功!')->success()->important();

        return redirect(Route('questions.show',$question->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->questionRepository->byIdWithTopics($id);
        if(Auth::user()->owns($question))
        {
            return view('questions.show',compact('question'));
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->byId($id);
        if(Auth::user()->owns($question))
        {
            return view('questions.edit',compact('question'));
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = $this->questionRepository->byId($id);
        $topics = $this->topicRepository->normalizeTopic($request->get('topics'));
        $res = $question->update([
            'title'=>$request->get('title'),
            'content'=>$request->get('content')
        ]);

        $question->topics()->sync($topics);

        return redirect(Route('questions.show',$question->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
