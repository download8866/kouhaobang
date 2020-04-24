<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:42:50
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Http\Controllers\Admin;use App\Models\Member;use App\Models\MemberCharge;use App\Models\Website;use App\Traits\Financial;use Illuminate\Http\Request;use App\Http\Controllers\Controller;use Illuminate\Support\Facades\DB;class MemberChargeController extends Controller{use Financial;public function index(){return view('admin.charge.index');}public function data(Request $request){$model=MemberCharge::query();$res=$model->orderBy('created_at','desc')->paginate($request->get('limit',30))->toArray();$JoAC0=array();$JoAC0['code']=0;$JoAC0['msg']='正在请求中...';$JoAC0['count']=$res['total'];$JoAC0['data']=$res['data'];$data=$JoAC0;return response()->json($data);}}
?>