<?php
/**
 * Created by PhpStorm.
 * User: 科诺设计
 * Date: 2017/7/24
 * Time: 23:47
 */

namespace App\Repositories;


use App\Answer;


/**
 * Class AnswerRepository
 * @package App\Repositories
 */
class AnswerRepository
{
    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }
}