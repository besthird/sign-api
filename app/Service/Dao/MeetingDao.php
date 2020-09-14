<?php


namespace App\Service\Dao;


use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Model\Meeting;
use HyperfX\Utils\Service;

class MeetingDao extends Service
{

    public function first(int $id,$throw = false)
    {
        $model = Meeting::query()->where('id',$id)->first();

        if (empty($model) && $throw) {
            throw new BusinessException(ErrorCode::MEETING_NOT_EXIST_ERROR);
        }

        return $model;
    }

    /**
     * @param $userId
     * @return null|Meeting
     */
    public function getUserMeeting($userId)
    {
        return Meeting::query()->where('user_id','=',$userId)->get();

    }
}