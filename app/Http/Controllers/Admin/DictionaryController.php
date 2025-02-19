<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:42:50
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Http\Controllers\Admin;

use App\Models\Dictionary;
use App\Models\SarticleChannel;
use App\Models\SarticleCollection;
use App\Models\SarticleEntrance;
use App\Models\SarticlePortal;
use App\Models\SarticlePrice;
use App\Models\SarticleSpecial;
use App\Models\SarticleTime;
use App\Models\SarticleWebsite;
use App\Models\ZimeitiIndustry;
use App\Models\ZimeitiPlat;
use App\Traits\Sms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class DictionaryController extends Controller
{
    use Sms;

    public function index()
    {
        return view('admin.dictionary.index');
    }

    public function data()
    {
        $res = Dictionary::where('status', 1)->get();
        $JoAC0 = array();
        $JoAC0['code'] = 0;
        $JoAC0['msg'] = '正在请求中...';
        $JoAC0['count'] = 1;
        $JoAC0['data'] = $res;
        $data = $JoAC0;
        return response()->json($data);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $info = Dictionary::find($id);
        $type = $info->slug;
        $JoSwitchx1 = $type;
        $Jo0 = $JoSwitchx1 == 'sarticle_website';
        if ($Jo0) goto JoBodyxy;
        goto JoNextxy;
        JoBodyxy:
        goto JoCasex2;
        goto Joxx;
        JoNextxy:Joxx:
        $Jo0 = $JoSwitchx1 == 'sarticle_channel';
        if ($Jo0) goto JoBodyxw;
        goto JoNextxw;
        JoBodyxw:
        goto JoCasex3;
        goto Joxv;
        JoNextxw:Joxv:
        $Jo0 = $JoSwitchx1 == 'sarticle_collect';
        if ($Jo0) goto JoBodyxu;
        goto JoNextxu;
        JoBodyxu:
        goto JoCasex4;
        goto Joxt;
        JoNextxu:Joxt:
        $Jo0 = $JoSwitchx1 == 'sarticle_special';
        if ($Jo0) goto JoBodyxs;
        goto JoNextxs;
        JoBodyxs:
        goto JoCasex5;
        goto Joxr;
        JoNextxs:Joxr:
        $Jo0 = $JoSwitchx1 == 'sarticle_entrance';
        if ($Jo0) goto JoBodyxq;
        goto JoNextxq;
        JoBodyxq:
        goto JoCasex6;
        goto Joxp;
        JoNextxq:Joxp:
        $Jo0 = $JoSwitchx1 == 'sarticle_portal';
        if ($Jo0) goto JoBodyxo;
        goto JoNextxo;
        JoBodyxo:
        goto JoCasex7;
        goto Joxn;
        JoNextxo:Joxn:
        $Jo0 = $JoSwitchx1 == 'sarticle_price';
        if ($Jo0) goto JoBodyxm;
        goto JoNextxm;
        JoBodyxm:
        goto JoCasex8;
        goto Joxl;
        JoNextxm:Joxl:
        $Jo0 = $JoSwitchx1 == 'sarticle_time';
        if ($Jo0) goto JoBodyxk;
        goto JoNextxk;
        JoBodyxk:
        goto JoCasex9;
        goto Joxj;
        JoNextxk:Joxj:
        $Jo0 = $JoSwitchx1 == 'zimeiti_industry';
        if ($Jo0) goto JoBodyxi;
        goto JoNextxi;
        JoBodyxi:
        goto JoCasexa;
        goto Joxh;
        JoNextxi:Joxh:
        $Jo0 = $JoSwitchx1 == 'zimeiti_plat';
        if ($Jo0) goto JoBodyxg;
        goto JoNextxg;
        JoBodyxg:
        goto JoCasexb;
        goto Joxf;
        JoNextxg:Joxf:
        goto JoDefaultAfterxc;
        $Jo0 = !$JoSwitchx1;
        if ($Jo0) goto JoBodyxe;
        goto JoNextxe;
        JoBodyxe:
        goto JoDefaultxc;
        goto Joxd;
        JoNextxe:Joxd:JoDefaultAfterxc:
        goto JoDefaultxc;
        goto Jox1;
        JoCasex2:
        $diction = SarticleWebsite::all();
        $view = 'website';
        goto Jox1;
        JoCasex3:
        $diction = SarticleChannel::all();
        $view = 'channel';
        goto Jox1;
        JoCasex4:
        $diction = SarticleCollection::all();
        $view = 'collect';
        goto Jox1;
        JoCasex5:
        $diction = SarticleSpecial::all();
        $view = 'special';
        goto Jox1;
        JoCasex6:
        $diction = SarticleEntrance::all();
        $view = 'entrance';
        goto Jox1;
        JoCasex7:
        $diction = SarticlePortal::all();
        $view = 'portal';
        goto Jox1;
        JoCasex8:
        $diction = SarticlePrice::all();
        $view = 'price';
        goto Jox1;
        JoCasex9:
        $diction = SarticleTime::all();
        $view = 'time';
        goto Jox1;
        JoCasexa:
        $diction = ZimeitiIndustry::all();
        $view = 'industry';
        goto Jox1;
        JoCasexb:
        $diction = ZimeitiPlat::all();
        $view = 'plat';
        goto Jox1;
        JoDefaultxc:
        $diction = SarticleChannel::all();
        $view = 'channel';
        goto Jox1;
        Jox1:
        return view('admin.dictionary.' . $view, compact('diction', 'info'));
    }

    public function update(Request $request)
    {
        $data = $request->data;
        $type = $request->type;
        DB::enableQueryLog();
        $JoEac1 = array();
        foreach ($data as $item) {
            $JoEac1[] = $item;
        };
        $Jo1i = 0;
        Jox38:
        $A___A___ = "count";
        $JoAC0 = $A___A___($JoEac1);
        $Jo0 = $Jo1i < $JoAC0;
        if ($Jo0) goto JoBodyx4v;
        goto JoNextx4v;
        JoBodyx4v:
        $Jo1Key = array_keys($JoEac1);
        $Jo1Key = $Jo1Key[$Jo1i];
        $item = $JoEac1[$Jo1Key];
        $A____AA_ = "substr";
        $JoAC0 = $A____AA_($item['id'], 0, 3);
        $Jo0 = $JoAC0 == 'old';
        if ($Jo0) goto JoBodyx4x;
        goto JoNextx4x;
        JoBodyx4x:
        goto JoBodyx3c;
        goto Jox4w;
        JoNextx4x:Jox4w:
        goto JoNextx3c;
        JoBodyx3c:
        goto JoBodyx11;
        goto Jox3b;
        JoNextx3c:Jox3b:
        goto JoNextx11;
        JoBodyx11:
        $id = 0;
        $A____AAA = "preg_match";
        $JoAC0 = $A____AAA('/\d+/', $item['id'], $arr);
        if ($JoAC0) goto JoBodyx5z;
        goto JoNextx5z;
        JoBodyx5z:
        goto JoBodyx3e;
        goto Jox4y;
        JoNextx5z:Jox4y:
        goto JoNextx3e;
        JoBodyx3e:
        goto JoBodyx13;
        goto Jox3d;
        JoNextx3e:Jox3d:
        goto JoNextx13;
        JoBodyx13:
        $id = $arr[0];
        goto Jox12;
        JoNextx13:Jox12:
        if ($id) goto JoBodyx52;
        goto JoNextx52;
        JoBodyx52:
        goto JoBodyx3g;
        goto Jox51;
        JoNextx52:Jox51:
        goto JoNextx3g;
        JoBodyx3g:
        goto JoBodyx15;
        goto Jox3f;
        JoNextx3g:Jox3f:
        goto JoNextx15;
        JoBodyx15:
        $Jo0 = $type != 'sarticle_price';
        $Jo2 = (bool)$Jo0;
        if ($Jo2) goto JoBodyx54;
        goto JoNextx54;
        JoBodyx54:
        goto JoBodyx3i;
        goto Jox53;
        JoNextx54:Jox53:
        goto JoNextx3i;
        JoBodyx3i:
        goto JoBodyx18;
        goto Jox3h;
        JoNextx3i:Jox3h:
        goto JoNextx18;
        JoBodyx18:
        $Jo1 = $type != 'sarticle_time';
        $Jo2 = (bool)$Jo1;
        goto Jox17;
        JoNextx18:Jox17:
        if ($Jo2) goto JoBodyx56;
        goto JoNextx56;
        JoBodyx56:
        goto JoBodyx3k;
        goto Jox55;
        JoNextx56:Jox55:
        goto JoNextx3k;
        JoBodyx3k:
        goto JoBodyx19;
        goto Jox3j;
        JoNextx3k:Jox3j:
        goto JoNextx19;
        JoBodyx19:
        $Jo0 = (int)$item['val'];
        $data_info['sort'] = $Jo0;
        $data_info['name'] = $item['name'];
        goto Jox16;
        JoNextx19:
        $Jo0 = (int)$item['val'];
        $data_info['min'] = $Jo0;
        $Jo0 = (int)$item['sort'];
        $data_info['max'] = $Jo0;
        Jox16:
        $JoSwitchx1a = $type;
        $Jo0 = $JoSwitchx1a == 'sarticle_website';
        if ($Jo0) goto JoBodyx58;
        goto JoNextx58;
        JoBodyx58:
        goto JoBodyx3m;
        goto Jox57;
        JoNextx58:Jox57:
        goto JoNextx3m;
        JoBodyx3m:
        goto JoBodyx28;
        goto Jox3l;
        JoNextx3m:Jox3l:
        goto JoNextx28;
        JoBodyx28:
        goto JoCasex1b;
        goto Jox27;
        JoNextx28:Jox27:
        $Jo0 = $JoSwitchx1a == 'sarticle_channel';
        if ($Jo0) goto JoBodyx5a;
        goto JoNextx5a;
        JoBodyx5a:
        goto JoBodyx3o;
        goto Jox59;
        JoNextx5a:Jox59:
        goto JoNextx3o;
        JoBodyx3o:
        goto JoBodyx26;
        goto Jox3n;
        JoNextx3o:Jox3n:
        goto JoNextx26;
        JoBodyx26:
        goto JoCasex1c;
        goto Jox25;
        JoNextx26:Jox25:
        $Jo0 = $JoSwitchx1a == 'sarticle_collect';
        if ($Jo0) goto JoBodyx5c;
        goto JoNextx5c;
        JoBodyx5c:
        goto JoBodyx3q;
        goto Jox5b;
        JoNextx5c:Jox5b:
        goto JoNextx3q;
        JoBodyx3q:
        goto JoBodyx24;
        goto Jox3p;
        JoNextx3q:Jox3p:
        goto JoNextx24;
        JoBodyx24:
        goto JoCasex1d;
        goto Jox23;
        JoNextx24:Jox23:
        $Jo0 = $JoSwitchx1a == 'sarticle_portal';
        if ($Jo0) goto JoBodyx5e;
        goto JoNextx5e;
        JoBodyx5e:
        goto JoBodyx3s;
        goto Jox5d;
        JoNextx5e:Jox5d:
        goto JoNextx3s;
        JoBodyx3s:
        goto JoBodyx22;
        goto Jox3r;
        JoNextx3s:Jox3r:
        goto JoNextx22;
        JoBodyx22:
        goto JoCasex1e;
        goto Jox21;
        JoNextx22:Jox21:
        $Jo0 = $JoSwitchx1a == 'sarticle_special';
        if ($Jo0) goto JoBodyx5g;
        goto JoNextx5g;
        JoBodyx5g:
        goto JoBodyx3u;
        goto Jox5f;
        JoNextx5g:Jox5f:
        goto JoNextx3u;
        JoBodyx3u:
        goto JoBodyx2z;
        goto Jox3t;
        JoNextx3u:Jox3t:
        goto JoNextx2z;
        JoBodyx2z:
        goto JoCasex1f;
        goto Jox1y;
        JoNextx2z:Jox1y:
        $Jo0 = $JoSwitchx1a == 'sarticle_entrance';
        if ($Jo0) goto JoBodyx5i;
        goto JoNextx5i;
        JoBodyx5i:
        goto JoBodyx3w;
        goto Jox5h;
        JoNextx5i:Jox5h:
        goto JoNextx3w;
        JoBodyx3w:
        goto JoBodyx1x;
        goto Jox3v;
        JoNextx3w:Jox3v:
        goto JoNextx1x;
        JoBodyx1x:
        goto JoCasex1g;
        goto Jox1w;
        JoNextx1x:Jox1w:
        $Jo0 = $JoSwitchx1a == 'sarticle_price';
        if ($Jo0) goto JoBodyx5k;
        goto JoNextx5k;
        JoBodyx5k:
        goto JoBodyx3y;
        goto Jox5j;
        JoNextx5k:Jox5j:
        goto JoNextx3y;
        JoBodyx3y:
        goto JoBodyx1v;
        goto Jox3x;
        JoNextx3y:Jox3x:
        goto JoNextx1v;
        JoBodyx1v:
        goto JoCasex1h;
        goto Jox1u;
        JoNextx1v:Jox1u:
        $Jo0 = $JoSwitchx1a == 'sarticle_time';
        if ($Jo0) goto JoBodyx5m;
        goto JoNextx5m;
        JoBodyx5m:
        goto JoBodyx41;
        goto Jox5l;
        JoNextx5m:Jox5l:
        goto JoNextx41;
        JoBodyx41:
        goto JoBodyx1t;
        goto Jox4z;
        JoNextx41:Jox4z:
        goto JoNextx1t;
        JoBodyx1t:
        goto JoCasex1i;
        goto Jox1s;
        JoNextx1t:Jox1s:
        $Jo0 = $JoSwitchx1a == 'zimeiti_industry';
        if ($Jo0) goto JoBodyx5o;
        goto JoNextx5o;
        JoBodyx5o:
        goto JoBodyx43;
        goto Jox5n;
        JoNextx5o:Jox5n:
        goto JoNextx43;
        JoBodyx43:
        goto JoBodyx1r;
        goto Jox42;
        JoNextx43:Jox42:
        goto JoNextx1r;
        JoBodyx1r:
        goto JoCasex1j;
        goto Jox1q;
        JoNextx1r:Jox1q:
        $Jo0 = $JoSwitchx1a == 'zimeiti_plat';
        if ($Jo0) goto JoBodyx5q;
        goto JoNextx5q;
        JoBodyx5q:
        goto JoBodyx45;
        goto Jox5p;
        JoNextx5q:Jox5p:
        goto JoNextx45;
        JoBodyx45:
        goto JoBodyx1p;
        goto Jox44;
        JoNextx45:Jox44:
        goto JoNextx1p;
        JoBodyx1p:
        goto JoCasex1k;
        goto Jox1o;
        JoNextx1p:Jox1o:
        goto JoDefaultAfterx1l;
        $Jo0 = !$JoSwitchx1a;
        if ($Jo0) goto JoBodyx5s;
        goto JoNextx5s;
        JoBodyx5s:
        goto JoBodyx47;
        goto Jox5r;
        JoNextx5s:Jox5r:
        goto JoNextx47;
        JoBodyx47:
        goto JoBodyx1n;
        goto Jox46;
        JoNextx47:Jox46:
        goto JoNextx1n;
        JoBodyx1n:
        goto JoDefaultx1l;
        goto Jox1m;
        JoNextx1n:Jox1m:JoDefaultAfterx1l:
        goto JoDefaultx1l;
        goto Jox1a;
        JoCasex1b:
        SarticleWebsite::where('id', $id)->update($data_info);
        goto Jox1a;
        JoCasex1c:
        SarticleChannel::where('id', $id)->update($data_info);
        goto Jox1a;
        JoCasex1d:
        SarticleCollection::where('id', $id)->update($data_info);
        goto Jox1a;
        JoCasex1e:
        SarticlePortal::where('id', $id)->update($data_info);
        goto Jox1a;
        JoCasex1f:
        SarticleSpecial::where('id', $id)->update($data_info);
        goto Jox1a;
        JoCasex1g:
        SarticleEntrance::where('id', $id)->update($data_info);
        goto Jox1a;
        JoCasex1h:
        SarticlePrice::where('id', $id)->update($data_info);
        goto Jox1a;
        JoCasex1i:
        SarticleTime::where('id', $id)->update($data_info);
        goto Jox1a;
        JoCasex1j:
        ZimeitiIndustry::where('id', $id)->update($data_info);
        goto Jox1a;
        JoCasex1k:
        ZimeitiPlat::where('id', $id)->update($data_info);
        goto Jox1a;
        JoDefaultx1l:
        SarticleChannel::where('id', $id)->update($data_info);
        goto Jox1a;
        Jox1a:
        goto Jox14;
        JoNextx15:Jox14:
        goto Joxz;
        JoNextx11:
        $JoSwitchx29 = $type;
        $Jo0 = $JoSwitchx29 == 'sarticle_website';
        if ($Jo0) goto JoBodyx5u;
        goto JoNextx5u;
        JoBodyx5u:
        goto JoBodyx49;
        goto Jox5t;
        JoNextx5u:Jox5t:
        goto JoNextx49;
        JoBodyx49:
        goto JoBodyx37;
        goto Jox48;
        JoNextx49:Jox48:
        goto JoNextx37;
        JoBodyx37:
        goto JoCasex2a;
        goto Jox36;
        JoNextx37:Jox36:
        $Jo0 = $JoSwitchx29 == 'sarticle_channel';
        if ($Jo0) goto JoBodyx5w;
        goto JoNextx5w;
        JoBodyx5w:
        goto JoBodyx4b;
        goto Jox5v;
        JoNextx5w:Jox5v:
        goto JoNextx4b;
        JoBodyx4b:
        goto JoBodyx35;
        goto Jox4a;
        JoNextx4b:Jox4a:
        goto JoNextx35;
        JoBodyx35:
        goto JoCasex2b;
        goto Jox34;
        JoNextx35:Jox34:
        $Jo0 = $JoSwitchx29 == 'sarticle_collect';
        if ($Jo0) goto JoBodyx5y;
        goto JoNextx5y;
        JoBodyx5y:
        goto JoBodyx4d;
        goto Jox5x;
        JoNextx5y:Jox5x:
        goto JoNextx4d;
        JoBodyx4d:
        goto JoBodyx33;
        goto Jox4c;
        JoNextx4d:Jox4c:
        goto JoNextx33;
        JoBodyx33:
        goto JoCasex2c;
        goto Jox32;
        JoNextx33:Jox32:
        $Jo0 = $JoSwitchx29 == 'sarticle_portal';
        if ($Jo0) goto JoBodyx61;
        goto JoNextx61;
        JoBodyx61:
        goto JoBodyx4f;
        goto Jox6z;
        JoNextx61:Jox6z:
        goto JoNextx4f;
        JoBodyx4f:
        goto JoBodyx31;
        goto Jox4e;
        JoNextx4f:Jox4e:
        goto JoNextx31;
        JoBodyx31:
        goto JoCasex2d;
        goto Jox3z;
        JoNextx31:Jox3z:
        $Jo0 = $JoSwitchx29 == 'sarticle_special';
        if ($Jo0) goto JoBodyx63;
        goto JoNextx63;
        JoBodyx63:
        goto JoBodyx4h;
        goto Jox62;
        JoNextx63:Jox62:
        goto JoNextx4h;
        JoBodyx4h:
        goto JoBodyx2y;
        goto Jox4g;
        JoNextx4h:Jox4g:
        goto JoNextx2y;
        JoBodyx2y:
        goto JoCasex2e;
        goto Jox2x;
        JoNextx2y:Jox2x:
        $Jo0 = $JoSwitchx29 == 'sarticle_entrance';
        if ($Jo0) goto JoBodyx65;
        goto JoNextx65;
        JoBodyx65:
        goto JoBodyx4j;
        goto Jox64;
        JoNextx65:Jox64:
        goto JoNextx4j;
        JoBodyx4j:
        goto JoBodyx2w;
        goto Jox4i;
        JoNextx4j:Jox4i:
        goto JoNextx2w;
        JoBodyx2w:
        goto JoCasex2f;
        goto Jox2v;
        JoNextx2w:Jox2v:
        $Jo0 = $JoSwitchx29 == 'sarticle_price';
        if ($Jo0) goto JoBodyx67;
        goto JoNextx67;
        JoBodyx67:
        goto JoBodyx4l;
        goto Jox66;
        JoNextx67:Jox66:
        goto JoNextx4l;
        JoBodyx4l:
        goto JoBodyx2u;
        goto Jox4k;
        JoNextx4l:Jox4k:
        goto JoNextx2u;
        JoBodyx2u:
        goto JoCasex2g;
        goto Jox2t;
        JoNextx2u:Jox2t:
        $Jo0 = $JoSwitchx29 == 'sarticle_time';
        if ($Jo0) goto JoBodyx69;
        goto JoNextx69;
        JoBodyx69:
        goto JoBodyx4n;
        goto Jox68;
        JoNextx69:Jox68:
        goto JoNextx4n;
        JoBodyx4n:
        goto JoBodyx2s;
        goto Jox4m;
        JoNextx4n:Jox4m:
        goto JoNextx2s;
        JoBodyx2s:
        goto JoCasex2h;
        goto Jox2r;
        JoNextx2s:Jox2r:
        $Jo0 = $JoSwitchx29 == 'zimeiti_industry';
        if ($Jo0) goto JoBodyx6b;
        goto JoNextx6b;
        JoBodyx6b:
        goto JoBodyx4p;
        goto Jox6a;
        JoNextx6b:Jox6a:
        goto JoNextx4p;
        JoBodyx4p:
        goto JoBodyx2q;
        goto Jox4o;
        JoNextx4p:Jox4o:
        goto JoNextx2q;
        JoBodyx2q:
        goto JoCasex2i;
        goto Jox2p;
        JoNextx2q:Jox2p:
        $Jo0 = $JoSwitchx29 == 'zimeiti_plat';
        if ($Jo0) goto JoBodyx6d;
        goto JoNextx6d;
        JoBodyx6d:
        goto JoBodyx4r;
        goto Jox6c;
        JoNextx6d:Jox6c:
        goto JoNextx4r;
        JoBodyx4r:
        goto JoBodyx2o;
        goto Jox4q;
        JoNextx4r:Jox4q:
        goto JoNextx2o;
        JoBodyx2o:
        goto JoCasex2j;
        goto Jox2n;
        JoNextx2o:Jox2n:
        goto JoDefaultAfterx2k;
        $Jo0 = !$JoSwitchx29;
        if ($Jo0) goto JoBodyx6f;
        goto JoNextx6f;
        JoBodyx6f:
        goto JoBodyx4t;
        goto Jox6e;
        JoNextx6f:Jox6e:
        goto JoNextx4t;
        JoBodyx4t:
        goto JoBodyx2m;
        goto Jox4s;
        JoNextx4t:Jox4s:
        goto JoNextx2m;
        JoBodyx2m:
        goto JoDefaultx2k;
        goto Jox2l;
        JoNextx2m:Jox2l:JoDefaultAfterx2k:
        goto JoDefaultx2k;
        goto Jox29;
        JoCasex2a:
        SarticleWebsite::create(['name' => $item['name'], 'sort' => $item['val']]);
        goto Jox29;
        JoCasex2b:
        SarticleChannel::create(['name' => $item['name'], 'sort' => $item['val']]);
        goto Jox29;
        JoCasex2c:
        SarticleCollection::create(['name' => $item['name'], 'sort' => $item['val']]);
        goto Jox29;
        JoCasex2d:
        SarticleSpecial::create(['name' => $item['name'], 'sort' => $item['val']]);
        goto Jox29;
        JoCasex2e:
        SarticleCollection::create(['name' => $item['name'], 'sort' => $item['val']]);
        goto Jox29;
        JoCasex2f:
        SarticleEntrance::create(['name' => $item['name'], 'sort' => $item['val']]);
        goto Jox29;
        JoCasex2g:
        SarticlePrice::create(['min' => $item['name'], 'max' => $item['val']]);
        goto Jox29;
        JoCasex2h:
        SarticleTime::create(['name' => $item['name'], 'sort' => $item['val']]);
        goto Jox29;
        JoCasex2i:
        ZimeitiIndustry::create(['name' => $item['name'], 'sort' => $item['val']]);
        goto Jox29;
        JoCasex2j:
        ZimeitiPlat::create(['name' => $item['name'], 'sort' => $item['val']]);
        goto Jox29;
        JoDefaultx2k:
        SarticleChannel::create(['name' => $item['name'], 'sort' => $item['val']]);
        goto Jox29;
        Jox29:Joxz:Jox39:
        $Jo1i++;
        goto Jox38;
        goto Jox4u;
        JoNextx4v:Jox4u:Jox3a:
        return response(['code' => 1, 'info' => '编辑成功']);
    }

    public function sync(Request $request)
    {
        $type = $request->type;
        $A___A__A = "in_array";
        $JoAC0 = $A___A__A($type, ['sarticle_website', 'sarticle_channel', 'sarticle_collect', 'sarticle_portal', 'sarticle_special', 'sarticle_entrance', 'zimeiti_industry', 'zimeiti_plat']);
        if ($JoAC0) goto JoBodyx6h;
        goto JoNextx6h;
        JoBodyx6h:
        $JoSwitchx6i = $type;
        $Jo0 = $JoSwitchx6i == 'sarticle_website';
        if ($Jo0) goto JoBodyx7a;
        goto JoNextx7a;
        JoBodyx7a:
        goto JoCasex6j;
        goto Jox79;
        JoNextx7a:Jox79:
        $Jo0 = $JoSwitchx6i == 'sarticle_channel';
        if ($Jo0) goto JoBodyx78;
        goto JoNextx78;
        JoBodyx78:
        goto JoCasex6k;
        goto Jox77;
        JoNextx78:Jox77:
        $Jo0 = $JoSwitchx6i == 'sarticle_collect';
        if ($Jo0) goto JoBodyx76;
        goto JoNextx76;
        JoBodyx76:
        goto JoCasex6l;
        goto Jox75;
        JoNextx76:Jox75:
        $Jo0 = $JoSwitchx6i == 'sarticle_portal';
        if ($Jo0) goto JoBodyx74;
        goto JoNextx74;
        JoBodyx74:
        goto JoCasex6m;
        goto Jox73;
        JoNextx74:Jox73:
        $Jo0 = $JoSwitchx6i == 'sarticle_special';
        if ($Jo0) goto JoBodyx72;
        goto JoNextx72;
        JoBodyx72:
        goto JoCasex6n;
        goto Jox71;
        JoNextx72:Jox71:
        $Jo0 = $JoSwitchx6i == 'sarticle_entrance';
        if ($Jo0) goto JoBodyx7z;
        goto JoNextx7z;
        JoBodyx7z:
        goto JoCasex6o;
        goto Jox6y;
        JoNextx7z:Jox6y:
        $Jo0 = $JoSwitchx6i == 'zimeiti_industry';
        if ($Jo0) goto JoBodyx6x;
        goto JoNextx6x;
        JoBodyx6x:
        goto JoCasex6p;
        goto Jox6w;
        JoNextx6x:Jox6w:
        $Jo0 = $JoSwitchx6i == 'product_zimeiti';
        if ($Jo0) goto JoBodyx6v;
        goto JoNextx6v;
        JoBodyx6v:
        goto JoCasex6q;
        goto Jox6u;
        JoNextx6v:Jox6u:
        goto JoDefaultAfterx6r;
        $Jo0 = !$JoSwitchx6i;
        if ($Jo0) goto JoBodyx6t;
        goto JoNextx6t;
        JoBodyx6t:
        goto JoDefaultx6r;
        goto Jox6s;
        JoNextx6t:Jox6s:JoDefaultAfterx6r:
        goto JoDefaultx6r;
        goto Jox6i;
        JoCasex6j:
        $view = 'product_website';
        goto Jox6i;
        JoCasex6k:
        $view = 'product_channel';
        goto Jox6i;
        JoCasex6l:
        $view = 'product_collection';
        goto Jox6i;
        JoCasex6m:
        $view = 'product_portal';
        goto Jox6i;
        JoCasex6n:
        $view = 'sarticle_special';
        goto Jox6i;
        JoCasex6o:
        $view = 'sarticle_entrance';
        goto Jox6i;
        JoCasex6p:
        $view = 'zimeiti_industry';
        goto Jox6i;
        JoCasex6q:
        $view = 'plat';
        goto Jox6i;
        JoDefaultx6r:
        $view = 'product_channel';
        goto Jox6i;
        Jox6i:
        $data = json_decode(json_decode($this->cloudCurl('/api/v4/sync/dictionary', ['type' => $view])));
        $Jo0 = $data->code == 200;
        if ($Jo0) goto JoBodyx7c;
        goto JoNextx7c;
        JoBodyx7c:
        $res = $data->data->data;
        $JoSwitchx7d = $view;
        $Jo0 = $JoSwitchx7d == 'product_website';
        if ($Jo0) goto JoBodyx9a;
        goto JoNextx9a;
        JoBodyx9a:
        goto JoCasex7e;
        goto Jox99;
        JoNextx9a:Jox99:
        $Jo0 = $JoSwitchx7d == 'product_collection';
        if ($Jo0) goto JoBodyx98;
        goto JoNextx98;
        JoBodyx98:
        goto JoCasex7k;
        goto Jox97;
        JoNextx98:Jox97:
        $Jo0 = $JoSwitchx7d == 'product_channel';
        if ($Jo0) goto JoBodyx96;
        goto JoNextx96;
        JoBodyx96:
        goto JoCasex7q;
        goto Jox95;
        JoNextx96:Jox95:
        $Jo0 = $JoSwitchx7d == 'product_portal';
        if ($Jo0) goto JoBodyx94;
        goto JoNextx94;
        JoBodyx94:
        goto JoCasex7w;
        goto Jox93;
        JoNextx94:Jox93:
        $Jo0 = $JoSwitchx7d == 'sarticle_special';
        if ($Jo0) goto JoBodyx92;
        goto JoNextx92;
        JoBodyx92:
        goto JoCasex83;
        goto Jox91;
        JoNextx92:Jox91:
        $Jo0 = $JoSwitchx7d == 'sarticle_entrance';
        if ($Jo0) goto JoBodyx9z;
        goto JoNextx9z;
        JoBodyx9z:
        goto JoCasex89;
        goto Jox8y;
        JoNextx9z:Jox8y:
        $Jo0 = $JoSwitchx7d == 'product_zimeiti';
        if ($Jo0) goto JoBodyx8x;
        goto JoNextx8x;
        JoBodyx8x:
        goto JoCasex8f;
        goto Jox8w;
        JoNextx8x:Jox8w:
        $Jo0 = $JoSwitchx7d == 'zimeiti_industry';
        if ($Jo0) goto JoBodyx8v;
        goto JoNextx8v;
        JoBodyx8v:
        goto JoCasex8l;
        goto Jox8u;
        JoNextx8v:Jox8u:
        goto JoDefaultAfterx8r;
        $Jo0 = !$JoSwitchx7d;
        if ($Jo0) goto JoBodyx8t;
        goto JoNextx8t;
        JoBodyx8t:
        goto JoDefaultx8r;
        goto Jox8s;
        JoNextx8t:Jox8s:JoDefaultAfterx8r:
        goto JoDefaultx8r;
        goto Jox7d;
        JoCasex7e:
        $JoEac2 = array();
        foreach ($res as $item) {
            $JoEac2[] = $item;
        };
        $Jo2i = 0;
        Jox7f:
        $A___A_A_ = "count";
        $JoAC0 = $A___A_A_($JoEac2);
        $Jo0 = $Jo2i < $JoAC0;
        if ($Jo0) goto JoBodyx7j;
        goto JoNextx7j;
        JoBodyx7j:
        $Jo2Key = array_keys($JoEac2);
        $Jo2Key = $Jo2Key[$Jo2i];
        $item = $JoEac2[$Jo2Key];
        $JoAC0 = array();
        $JoAC0['name'] = $item->name;
        $data = $JoAC0;
        SarticleWebsite::firstOrCreate($data);
        Jox7g:
        $Jo2i++;
        goto Jox7f;
        goto Jox7i;
        JoNextx7j:Jox7i:Jox7h:
        goto Jox7d;
        JoCasex7k:
        $JoEac3 = array();
        foreach ($res as $item) {
            $JoEac3[] = $item;
        };
        $Jo3i = 0;
        Jox7l:
        $A___A_AA = "count";
        $JoAC0 = $A___A_AA($JoEac3);
        $Jo0 = $Jo3i < $JoAC0;
        if ($Jo0) goto JoBodyx7p;
        goto JoNextx7p;
        JoBodyx7p:
        $Jo3Key = array_keys($JoEac3);
        $Jo3Key = $Jo3Key[$Jo3i];
        $item = $JoEac3[$Jo3Key];
        $JoAC0 = array();
        $JoAC0['name'] = $item->name;
        $data = $JoAC0;
        SarticleCollection::firstOrCreate($data);
        Jox7m:
        $Jo3i++;
        goto Jox7l;
        goto Jox7o;
        JoNextx7p:Jox7o:Jox7n:
        goto Jox7d;
        JoCasex7q:
        $JoEac4 = array();
        foreach ($res as $item) {
            $JoEac4[] = $item;
        };
        $Jo4i = 0;
        Jox7r:
        $A___AA__ = "count";
        $JoAC0 = $A___AA__($JoEac4);
        $Jo0 = $Jo4i < $JoAC0;
        if ($Jo0) goto JoBodyx7v;
        goto JoNextx7v;
        JoBodyx7v:
        $Jo4Key = array_keys($JoEac4);
        $Jo4Key = $Jo4Key[$Jo4i];
        $item = $JoEac4[$Jo4Key];
        $JoAC0 = array();
        $JoAC0['name'] = $item->name;
        $data = $JoAC0;
        SarticleChannel::firstOrCreate($data);
        Jox7s:
        $Jo4i++;
        goto Jox7r;
        goto Jox7u;
        JoNextx7v:Jox7u:Jox7t:
        goto Jox7d;
        JoCasex7w:
        $JoEac5 = array();
        foreach ($res as $item) {
            $JoEac5[] = $item;
        };
        $Jo5i = 0;
        Jox7x:
        $A___AA_A = "count";
        $JoAC0 = $A___AA_A($JoEac5);
        $Jo0 = $Jo5i < $JoAC0;
        if ($Jo0) goto JoBodyx82;
        goto JoNextx82;
        JoBodyx82:
        $Jo5Key = array_keys($JoEac5);
        $Jo5Key = $Jo5Key[$Jo5i];
        $item = $JoEac5[$Jo5Key];
        $JoAC0 = array();
        $JoAC0['name'] = $item->name;
        $data = $JoAC0;
        SarticlePortal::firstOrCreate($data);
        Jox7y:
        $Jo5i++;
        goto Jox7x;
        goto Jox81;
        JoNextx82:Jox81:Jox8z:
        goto Jox7d;
        JoCasex83:
        $JoEac6 = array();
        foreach ($res as $item) {
            $JoEac6[] = $item;
        };
        $Jo6i = 0;
        Jox84:
        $A___AAA_ = "count";
        $JoAC0 = $A___AAA_($JoEac6);
        $Jo0 = $Jo6i < $JoAC0;
        if ($Jo0) goto JoBodyx88;
        goto JoNextx88;
        JoBodyx88:
        $Jo6Key = array_keys($JoEac6);
        $Jo6Key = $Jo6Key[$Jo6i];
        $item = $JoEac6[$Jo6Key];
        $JoAC0 = array();
        $JoAC0['name'] = $item->name;
        $data = $JoAC0;
        SarticleSpecial::firstOrCreate($data);
        Jox85:
        $Jo6i++;
        goto Jox84;
        goto Jox87;
        JoNextx88:Jox87:Jox86:
        goto Jox7d;
        JoCasex89:
        $JoEac7 = array();
        foreach ($res as $item) {
            $JoEac7[] = $item;
        };
        $Jo7i = 0;
        Jox8a:
        $A___AAAA = "count";
        $JoAC0 = $A___AAAA($JoEac7);
        $Jo0 = $Jo7i < $JoAC0;
        if ($Jo0) goto JoBodyx8e;
        goto JoNextx8e;
        JoBodyx8e:
        $Jo7Key = array_keys($JoEac7);
        $Jo7Key = $Jo7Key[$Jo7i];
        $item = $JoEac7[$Jo7Key];
        $JoAC0 = array();
        $JoAC0['name'] = $item->name;
        $data = $JoAC0;
        SarticleEntrance::firstOrCreate($data);
        Jox8b:
        $Jo7i++;
        goto Jox8a;
        goto Jox8d;
        JoNextx8e:Jox8d:Jox8c:
        goto Jox7d;
        JoCasex8f:
        $JoEac8 = array();
        foreach ($res as $item) {
            $JoEac8[] = $item;
        };
        $Jo8i = 0;
        Jox8g:
        $A__A____ = "count";
        $JoAC0 = $A__A____($JoEac8);
        $Jo0 = $Jo8i < $JoAC0;
        if ($Jo0) goto JoBodyx8k;
        goto JoNextx8k;
        JoBodyx8k:
        $Jo8Key = array_keys($JoEac8);
        $Jo8Key = $Jo8Key[$Jo8i];
        $item = $JoEac8[$Jo8Key];
        $JoAC0 = array();
        $JoAC0['name'] = $item->name;
        $data = $JoAC0;
        ZimeitiPlat::firstOrCreate($data);
        Jox8h:
        $Jo8i++;
        goto Jox8g;
        goto Jox8j;
        JoNextx8k:Jox8j:Jox8i:
        goto Jox7d;
        JoCasex8l:
        $JoEac9 = array();
        foreach ($res as $item) {
            $JoEac9[] = $item;
        };
        $Jo9i = 0;
        Jox8m:
        $A__A___A = "count";
        $JoAC0 = $A__A___A($JoEac9);
        $Jo0 = $Jo9i < $JoAC0;
        if ($Jo0) goto JoBodyx8q;
        goto JoNextx8q;
        JoBodyx8q:
        $Jo9Key = array_keys($JoEac9);
        $Jo9Key = $Jo9Key[$Jo9i];
        $item = $JoEac9[$Jo9Key];
        $JoAC0 = array();
        $JoAC0['name'] = $item->name;
        $data = $JoAC0;
        ZimeitiIndustry::firstOrCreate($data);
        Jox8n:
        $Jo9i++;
        goto Jox8m;
        goto Jox8p;
        JoNextx8q:Jox8p:Jox8o:
        goto Jox7d;
        JoDefaultx8r:
        goto Jox7d;
        Jox7d:
        return response(['code' => 1, 'info' => '更新成功']);
        goto Jox7b;
        JoNextx7c:
        return response(['code' => 1, 'info' => '暂无数据']);
        Jox7b:
        goto Jox6g;
        JoNextx6h:
        response(['code' => 0, 'info' => '请检查更新项']);
        Jox6g:
    }
}

?>