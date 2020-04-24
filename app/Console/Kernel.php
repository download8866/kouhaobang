<?php
/*
 �������� �ںŰ� ����
 ����ʱ�� 2020-03-01 19:42:50
 ����֧�� �ںŰ� 
 �Ͻ������롢������κ���ʽ����Ȩ��Ϊ��Υ�߽�׷����������
*/

namespace App\Console;

use App\Http\Controllers\Admin\SetTimeController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [];

    protected function schedule(Schedule $schedule)
    {
        $JoAC1 = array();
        $JoAC1[] = function (SetTimeController $message) {
            $message->sarticleToZero();
        };
        $JoAC2 = array();
        $JoAC2[] = $schedule;
        $JoAC2[] = "call";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $JoAC4 = array();
        $JoAC4[] = '23:59';
        $JoAC5 = array();
        $JoAC5[] = $JoAC0;
        $JoAC5[] = "dailyAt";
        $JoAC3 = call_user_func_array($JoAC5, $JoAC4);
    }

    protected function commands()
    {
        $Jo0 = __DIR__ . '/Commands';
        $JoAC1 = array();
        $JoAC1[] =& $Jo0;
        $JoAC2 = array();
        $JoAC2[] = $this;
        $JoAC2[] = "load";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $Jo0 = require base_path('routes/console.php');
    }
}

?>