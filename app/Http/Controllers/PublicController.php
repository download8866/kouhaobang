<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-02 13:59:28
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Http\Controllers;

use App\Models\Secret;
use App\Traits\Msg;
use Illuminate\Http\Request;
use zgldh\QiniuStorage\QiniuStorage;

class PublicController extends Controller
{
    use Msg;
    protected $url = "http://wd.yaochuanbo.com/api/word2html";

    public function uploadImg(Request $request)
    {
        $maxSize = 10;
        $U12AC0 = array();
        $U12AC0[] = "png";
        $U12AC0[] = "jpg";
        $U12AC0[] = "gif";
        $allowed_extensions = $U12AC0;
        $U12AC0 = array();
        $U12AC0['code'] = 200;
        $U12AC0['msg'] = '上传失败';
        $U12AC0['data'] = '';
        $data = $U12AC0;
        $U12AC1 = array();
        $U12AC1[] = 'file';
        $U12AC2 = array();
        $U12AC2[] = $request;
        $U12AC2[] = "file";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $file = $U12AC0;
        $U12AC1 = array();
        $U12AC2 = array();
        $U12AC2[] = $file;
        $U12AC2[] = "isValid";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        if ($U12AC0) goto U12Bodyx2;
        goto U12Nextx2;
        U12Bodyx2:
        $U12AC1 = array();
        $U12AC2 = array();
        $U12AC2[] = $file;
        $U12AC2[] = "getClientOriginalExtension";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $ext = $U12AC0;
        $AAAA__ = "in_array";
        $U12AC0 = $AAAA__(strtolower($ext), $allowed_extensions);
        $U120 = !$U12AC0;
        if ($U120) goto U12Bodyx4;
        goto U12Nextx4;
        U12Bodyx4:
        $AAAA_A = "implode";
        $U12AC0 = $AAAA_A(",", $allowed_extensions);
        $U120 = "请上传" . $U12AC0;
        $U121 = $U120 . "格式的图片";
        $data['msg'] = $U121;
        return response()->json($data);
        goto U12x3;
        U12Nextx4:U12x3:
        $U12AC1 = array();
        $U12AC2 = array();
        $U12AC2[] = $file;
        $U12AC2[] = "getClientSize";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $U120 = $maxSize * 1024;
        $U121 = $U120 * 1024;
        $U122 = $U12AC0 > $U121;
        if ($U122) goto U12Bodyx6;
        goto U12Nextx6;
        U12Bodyx6:
        $U120 = "图片大小限制" . $maxSize;
        $U121 = $U120 . "M";
        $data['msg'] = $U121;
        return response()->json($data);
        goto U12x5;
        U12Nextx6:U12x5:
        goto U12x1;
        U12Nextx2:
        $U12AC1 = array();
        $U12AC2 = array();
        $U12AC2[] = $file;
        $U12AC2[] = "getErrorMessage";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $data['msg'] = $U12AC0;
        return response()->json($data);
        U12x1:
        $AAAAA_ = "date";
        $U12AC0 = $AAAAA_('Y-m-d');
        $U120 = $U12AC0 . "_";
        $AAAAAA = "time";
        $U12AC1 = $AAAAAA();
        $U121 = $U120 . $U12AC1;
        $U122 = $U121 . "_";
        $U123 = $U122 . uniqid();
        $U124 = $U123 . ".";
        $U12AC4 = array();
        $U12AC5 = array();
        $U12AC5[] = $file;
        $U12AC5[] = "getClientOriginalExtension";
        $U12AC3 = call_user_func_array($U12AC5, $U12AC4);
        $U125 = $U124 . $U12AC3;
        $newFile = $U125;
        $disk = QiniuStorage::disk('qiniu');
        $res = $disk->put($newFile, file_get_contents($file->getRealPath()));
        if ($res) goto U12Bodyx8;
        goto U12Nextx8;
        U12Bodyx8:
        $U12AC0 = array();
        $U12AC0['code'] = 0;
        $U12AC0['msg'] = '上传成功';
        $U12AC0['data'] = $newFile;
        $U12AC2 = array();
        $U12AC2[] =& $newFile;
        $U12AC3 = array();
        $U12AC3[] = $disk;
        $U12AC3[] = "downloadUrl";
        $U12AC1 = call_user_func_array($U12AC3, $U12AC2);
        $U12AC0['url'] = $U12AC1;
        $data = $U12AC0;
        goto U12x7;
        U12Nextx8:
        $U12AC1 = array();
        $U12AC2 = array();
        $U12AC2[] = $file;
        $U12AC2[] = "getErrorMessage";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $data['data'] = $U12AC0;
        U12x7:
        return response()->json($data);
    }

    public function unzip()
    {
        $U120 = new \ZipArchive();
        $zip = $U120;
        $U120 = public_path() . "/Traits.zip";
        $zipfile = $U120;
        $U12AC1 = array();
        $U12AC1[] =& $zipfile;
        $U12AC2 = array();
        $U12AC2[] = $zip;
        $U12AC2[] = "open";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $res = $U12AC0;
        $toDir = app_path();
        $A______ = "file_exists";
        $U12AC0 = $A______($toDir);
        $U120 = !$U12AC0;
        if ($U120) goto U12Bodyxa;
        goto U12Nextxa;
        U12Bodyxa:
        $A_____A = "mkdir";
        $U12AC0 = $A_____A($toDir);
        goto U12x9;
        U12Nextxa:U12x9:
        $docnum = $zip->numFiles;
        $i = 0;
        U12xb:
        $U120 = $i < $docnum;
        if ($U120) goto U12Bodyxj;
        goto U12Nextxj;
        U12Bodyxj:
        $U12AC1 = array();
        $U12AC1[] =& $i;
        $U12AC2 = array();
        $U12AC2[] = $zip;
        $U12AC2[] = "statIndex";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $statInfo = $U12AC0;
        $U120 = $statInfo['crc'] == 0;
        if ($U120) goto U12Bodyxl;
        goto U12Nextxl;
        U12Bodyxl:
        goto U12Bodyxf;
        goto U12xk;
        U12Nextxl:U12xk:
        goto U12Nextxf;
        U12Bodyxf:
        $A____A_ = "file_exists";
        $U12AC0 = $A____A_($toDir . '/' . substr($statInfo['name'], 0, -1));
        $U120 = !$U12AC0;
        if ($U120) goto U12Bodyxn;
        goto U12Nextxn;
        U12Bodyxn:
        goto U12Bodyxh;
        goto U12xm;
        U12Nextxn:U12xm:
        goto U12Nextxh;
        U12Bodyxh:
        $A____AA = "mkdir";
        $U12AC0 = $A____AA($toDir . '/' . substr($statInfo['name'], 0, -1));
        goto U12xg;
        U12Nextxh:U12xg:
        goto U12xe;
        U12Nextxf:
        $A___A__ = "copy";
        $U12AC0 = $A___A__('zip://' . $zipfile . '#' . $statInfo['name'], $toDir . '/' . $statInfo['name']);
        U12xe:U12xc:
        $i++;
        goto U12xb;
        goto U12xi;
        U12Nextxj:U12xi:U12xd:
        dd('文件复制完成');
    }

    public function uploadFile(Request $request)
    {
        $U12AC1 = array();
        $U12AC1[] = 'file';
        $U12AC2 = array();
        $U12AC2[] = $request;
        $U12AC2[] = "file";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $file = $U12AC0;
        $U12AC1 = array();
        $U12AC2 = array();
        $U12AC2[] = $request;
        $U12AC2[] = "all";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $data = $U12AC0;
        $U12AC0 = array();
        $U12AC0["file"] = 'max:10240';
        $rules = $U12AC0;
        $U12AC0 = array();
        $U12AC0["file.max"] = '文件过大,文件大小不得超出5MB';
        $messages = $U12AC0;
        $validator = Validator($data, $rules, $messages);
        $U12AC1 = array();
        $U12AC2 = array();
        $U12AC2[] = $validator;
        $U12AC2[] = "fails";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $U120 = !$U12AC0;
        if ($U120) goto U12Bodyxp;
        goto U12Nextxp;
        U12Bodyxp:
        $U12AC0 = array();
        $U12AC0[] = "doc";
        $U12AC0[] = "docx";
        $allowed_extensions = $U12AC0;
        $U121 = (bool)$file->getClientOriginalExtension();
        if ($U121) goto U12Bodyxs;
        goto U12Nextxs;
        U12Bodyxs:
        $U120 = !in_array($file->getClientOriginalExtension(), $allowed_extensions);
        $U121 = (bool)$U120;
        goto U12xr;
        U12Nextxs:U12xr:
        if ($U121) goto U12Bodyxt;
        goto U12Nextxt;
        U12Bodyxt:
        $U12AC0 = array();
        $U12AC0['error'] = '仅支持上传docx或doc文件';
        return $U12AC0;
        goto U12xq;
        U12Nextxt:U12xq:
        $U120 = public_path() . '/uploads/file/';
        $A___A_A = "date";
        $U12AC1 = $A___A_A('Y', time());
        $U121 = $U120 . $U12AC1;
        $U122 = $U121 . '/';
        $A___AA_ = "date";
        $U12AC2 = $A___AA_('m', time());
        $U123 = $U122 . $U12AC2;
        $U124 = $U123 . '/';
        $A___AAA = "date";
        $U12AC3 = $A___AAA('d', time());
        $U125 = $U124 . $U12AC3;
        $U126 = $U125 . '/';
        $destinationPath = $U126;
        $U12AC1 = array();
        $U12AC2 = array();
        $U12AC2[] = $file;
        $U12AC2[] = "getClientOriginalExtension";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $extension = $U12AC0;
        $U12AC1 = array();
        $U12AC1[] =& $destinationPath;
        $U12AC2 = array();
        $U12AC2[] = $this;
        $U12AC2[] = "makeDirs";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $U12AC1 = array();
        $U12AC2 = array();
        $U12AC2[] = $file;
        $U12AC2[] = "getClientOriginalName";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $originName = $U12AC0;
        $A__A___ = "time";
        $U12AC0 = $A__A___();
        $A__A__A = "rand";
        $U12AC1 = $A__A__A(1000, 9999);
        $U120 = $U12AC0 . $U12AC1;
        $U121 = $U120 . '.';
        $U122 = $U121 . $extension;
        $fileName = $U122;
        $U12AC1 = array();
        $U12AC1[] =& $destinationPath;
        $U12AC1[] =& $fileName;
        $U12AC2 = array();
        $U12AC2[] = $file;
        $U12AC2[] = "move";
        $U12AC0 = call_user_func_array($U12AC2, $U12AC1);
        $A__A_A_ = "str_replace";
        $U12AC0 = $A__A_A_(public_path(), '', $destinationPath . $fileName);
        $res = $U12AC0;
        $U120 = env('APP_URL') . $res;
        $U12AC2 = array();
        $U12AC2[] =& $U120;
        $U12AC3 = array();
        $U12AC3[] = $this;
        $U12AC3[] = "activeCurl";
        $U12AC0 = call_user_func_array($U12AC3, $U12AC2);
        $remote_word = $U12AC0;
        $U12AC0 = array();
        $U12AC0['code'] = 0;
        $U12AC0['msg'] = '上传成功';
        $U12AC1 = array();
        $U12AC1['path'] = $res;
        $U12AC1['content'] = $remote_word;
        $U12AC1['originName'] = $fileName;
        $U12AC0['data'] = $U12AC1;
        $data = $U12AC0;
        goto U12xo;
        U12Nextxp:
        $U12AC0 = array();
        $data = $U12AC0;
        U12xo:
        return response()->json($data);
    }

    public function makeDirs($dir)
    {
        $A__A_AA = "is_dir";
        $U12AC0 = $A__A_AA($dir);
        $U120 = !$U12AC0;
        if ($U120) goto U12Bodyxv;
        goto U12Nextxv;
        U12Bodyxv:
        $A__AA__ = "dirname";
        $U12AC1 = $A__AA__($dir);
        $U12AC2 = array();
        $U12AC2[] =& $U12AC1;
        $U12AC3 = array();
        $U12AC3[] = $this;
        $U12AC3[] = "makeDirs";
        $U12AC0 = call_user_func_array($U12AC3, $U12AC2);
        $U120 = !$U12AC0;
        if ($U120) goto U12Bodyxx;
        goto U12Nextxx;
        U12Bodyxx:
        return false;
        goto U12xw;
        U12Nextxx:U12xw:
        $A__AA_A = "mkdir";
        $U12AC0 = $A__AA_A($dir, 0777);
        $U120 = !$U12AC0;
        if ($U120) goto U12Bodyxz;
        goto U12Nextxz;
        U12Bodyxz:
        return false;
        goto U12xy;
        U12Nextxz:U12xy:
        goto U12xu;
        U12Nextxv:U12xu:
        return true;
    }

    public function activeCurl($path)
    {
        $url = $this->url;
        $secret = Secret::find(1);
        $data['appKey'] = $secret->key;
        $data['appSecret'] = $secret->secret;
        $data['phone'] = auth('member')->user()->phone;
        $data['url'] = $path;
        $data['limitType'] = 0;
        $data['limitNum'] = 100;
        $U12AC0 = array();
        $U12AC0[] = "content-type: application/json;";
        $this_header = $U12AC0;
        $data = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this_header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $data = curl_exec($ch);
        if (curl_errno($ch)) goto U12Bodyx12;
        goto U12Nextx12;
        U12Bodyx12:
        return curl_error($ch);
        goto U12x11;
        U12Nextx12:U12x11:
        curl_close($ch);
        return $data;
    }

    public function pullTicket(Request $request)
    {
    }
}

?>