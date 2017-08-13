<?php

namespace App;

use Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Naux\Mail\SendCloudTemplate;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar' ,'confirmation_token','api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function owns(Question $model)
    {
        return $this->id == $model->user_id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this->belongsToMany(Question::class,'user_question')->withTimestamps();
    }

    /**
     * @param $question
     *
     * @return array
     */
    public function followThis($question)
    {
        return $this->follows()->toggle($question);
    }

    /**
     * @param $question
     *
     * @return mixed
     */
    public function followed($question)
    {
        return !! $this->follows()->where('question_id',$question)->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(self::class,'followers','follower_id','followed_id')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followersUser()
    {
        return $this->belongsToMany(self::class,'followers','followed_id','follower_id')->withTimestamps();
    }

    /**
     * @param $userId
     *
     * @return array
     */
    public function followThisUser($userId)
    {
        return $this->followers()->toggle($userId);
    }

    /**
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $data = ['url' => url('password/reset',$token)];
        $template = new SendCloudTemplate('zhihu_app_reset', $data);

        Mail::raw($template, function ($message)
        {
            $message->from('1402992668@qq.com', 'yicms');
            $message->to($this->email);
        });
    }
}
