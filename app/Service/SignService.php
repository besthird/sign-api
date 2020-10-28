<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Service;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Model\Sign;
use App\Service\Dao\MeetingDao;
use App\Service\Dao\SignDao;
use App\Service\Formatter\SignFormatter;
use Carbon\Carbon;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Codec\Json;
use HyperfX\Utils\Service;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SignService extends Service
{
    /**
     * @Inject
     * @var MeetingDao
     */
    protected $meeting;

    /**
     * @Inject
     * @var SignDao
     */
    protected $dao;

    /**
     * @Inject
     * @var SignFormatter
     */
    protected $formatter;

    public function index(int $userId, int $offset, int $limit)
    {
        [$count, $models] = $this->dao->find($userId, $offset, $limit);

        $result = $this->formatter->formatList($models);

        return [$count, $result];
    }

    /**
     * @param $input = [
     *     'type' => 1, // 1签到 2签退
     *     'nickname' => '', // 昵称
     *     'mobile' => '', // 手机号
     *     'wechat_code' => '', // 微信号
     *     'data' => [], // 其他字段
     * ]
     */
    public function sign(int $id, int $userId, array $input)
    {
        $type = $input['type'];
        $meeting = $this->meeting->first($id, true);
        $now = Carbon::now();
        if (! $meeting->isOnline($type, $now)) {
            throw new BusinessException(ErrorCode::SIGN_TIME_INVALID);
        }

        $sign = $this->dao->first($id, $userId);
        if (empty($sign)) {
            $sign = new Sign();
            $sign->meeting_id = $id;
            $sign->user_id = $userId;
            $sign->type = $type;
            $sign->last_sign_at = $now;
        } elseif ($type === Sign::TYPE_OUT) {
            $sign->last_sign_at = $now;
        }

        $sign->nickname = $input['nickname'];
        $sign->mobile = $input['mobile'] ?? '';
        $sign->wechat_code = $input['wechat_code'] ?? '';
        $sign->data = Json::encode((object) ($input['data'] ?? []));
        return $sign->save();
    }

    //用户参与的会议
    public function getUserMeeting(int $userId, int $offset, int $limit)
    {
        [$count, $models] = $this->dao->findByUserMeeting($userId, $offset, $limit);

        $result = $this->formatter->formatList($models);

        return [$count, $result];
    }

    //会议下的签到数据
    public function getMeetingSign(int $meetingId, int $offset, int $limit)
    {
        [$count, $models] = $this->dao->findByMeetingSign($meetingId, $offset, $limit);

        $result = $this->formatter->formatList($models);

        return [$count, $result];
    }


    //签到所有数据
    public function download($filename,$format){

        $data = $this->dao->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        //设置第一行的表头
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', '姓名');
        $sheet->setCellValue('C1', '签到类型');
        $sheet->setCellValue('D1', '手机号');
        $sheet->setCellValue('E1', '微信号');
        //把数据循环写入到excel里
        foreach ($data as $k => $v) {
            $num = $k + 2;
            //从第二行开始写
            $sheet->setCellValue('A' . $num, $v['id']);
            $sheet->setCellValue('B' . $num, $v['nickname']);
            $sheet->setCellValue('C'. $num, $v['type']);
            $sheet->setCellValue('D'.$num,$v['mobile']);
            $sheet->setCellValue('E'.$num, $v['wechat_code']);
        }

        $writer   = new Xlsx($spreadsheet);
        //这里可以写绝对路径，其他框架到这步就结束了
        $writer->save($filename.'.'.strtolower($format));
        //关闭连接，销毁变量
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
    }
}
