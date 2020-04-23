<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:42:50
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Console;use App\Http\Controllers\Admin\SetTimeController;use Illuminate\Console\Scheduling\Schedule;use Illuminate\Foundation\Console\Kernel as ConsoleKernel;class Kernel extends ConsoleKernel{protected $commands=[];protected function schedule(Schedule $schedule){$JoAC1=array();$JoAC1[]=function(SetTimeController $message){$message->sarticleToZero();};$JoAC2=array();$JoAC2[]=$schedule;$JoAC2[]="call";$JoAC0=call_user_func_array($JoAC2,$JoAC1);$JoAC4=array();$JoAC4[]='23:59';$JoAC5=array();$JoAC5[]=$JoAC0;$JoAC5[]="dailyAt";$JoAC3=call_user_func_array($JoAC5,$JoAC4);}protected function commands(){$Jo0=__DIR__ . '/Commands';$JoAC1=array();$JoAC1[]=&$Jo0;$JoAC2=array();$JoAC2[]=$this;$JoAC2[]="load";$JoAC0=call_user_func_array($JoAC2,$JoAC1);$Jo0=require base_path('routes/console.php');}}
?>