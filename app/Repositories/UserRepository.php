<?php
/**
 * Created by PhpStorm.
 * User: 科诺设计
 * Date: 2017/8/11
 * Time: 0:15
 */

namespace App\Repositories;


use App\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function byId($id)
    {
        return User::find($id);
    }
}