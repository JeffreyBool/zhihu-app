<?php
/**
 * Created by PhpStorm.
 * User: 科诺设计
 * Date: 2017/7/22
 * Time: 19:16
 */

namespace App\Repositories;

use App\Topic;

/**
 * Class TopicRepository
 * @package App\Repositories
 */
class TopicRepository
{

    /**
     * @param array $topics
     *
     * @return array 数组集合
     */
    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topics){
            if(is_numeric($topics))
            {
                Topic::find($topics)->increment('questions_count');
                return (int)$topics;
            }
            $topicData = Topic::where('name','=',$topics)->first();
            if(!empty($topicData))
            {
                Topic::find($topicData->id)->increment('questions_count');
                return $topicData->id;
            }

            $newTopic = Topic::create(['name'=>$topics,'questions_count'=>1]);
            return $newTopic->id;
        })->toArray();
    }
}