<?php
/**
 * Created by PhpStorm.
 * User: 科诺设计
 * Date: 2017/7/22
 * Time: 18:38
 */

namespace App\Repositories;

use App\Question;

/**
 * Class QuestionRepositories
 * @package App\Repositories
 */
class QuestionRepository
{

    /**
     * @param $id
     *
     * @return mixed
     */
    public function byIdWithTopics($id)
    {
        return Question::where('id',$id)->with('topics')->first();
    }

    /**
     * @param array $attributes
     */
    public function create(array $attributes)
    {
        return Question::create($attributes);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function byId($id)
    {
        return Question::find($id);
    }

    /**
     * @return mixed
     */
    public function getQuestionsFeed()
    {
        return  Question::published()->latest('updated_at')->with('user')->get();
    }
}