<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:44:33
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Providers;use App\Models\Message;use App\Models\MyApply;use App\Models\MyTemplate;use App\Models\Seo;use App\Models\Website;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Schema;use Illuminate\Support\ServiceProvider;class AppServiceProvider extends ServiceProvider{public function boot(){Schema::defaultStringLength(191);view()->composer('admin.layout',function($view){$menus=\App\Models\Permission::with(['childs'=>function($query){$query->where('status',0)->with('icon');},'icon'])->where('status',0)->where('parent_id',0)->orderBy('sort','desc')->get();$unreadMessage=\App\Models\Message::count();$view->with('menus',$menus);$view->with('unreadMessage',$unreadMessage);});$seo=Seo::find(1);$website=Website::where('id',1)->first(['company','logo','three','record_num','qq','phone','username','qrcode','job_time','email']);view()->share('seo',$seo);view()->share('website',$website);$template=MyTemplate::where('status',1)->first(['id','scope']);$scope=explode(',',$template->scope);$apply=MyApply::where(['status'=>1])->orderBy('sort','desc')->get(['id','tag'])->toArray();$apply=array_column($apply,'tag');view()->share('my_apply',implode(',',$apply));$apply=array_intersect($scope,$apply);$A__AAA_A="implode";$EpAC0=$A__AAA_A(',',$apply);$apply=$EpAC0;view()->share('apply',$apply);$notice=Message::where('flag',2)->orderBy('id','desc')->first();view()->share('notice',$notice);}public function register(){}}
?>