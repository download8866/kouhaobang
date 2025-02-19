<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:44:33
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Traits;

use App\Models\Version;

trait ApplyZip
{
    public function renewal($url, $filename)
    {
        $Ep0 = public_path() . "/file";
        $save_dir = $Ep0;
        $type = 1;
        $A_AA___ = "trim";
        $EpAC0 = $A_AA___($url);
        $Ep0 = $EpAC0 == '';
        if ($Ep0) goto EpBodyx2;
        goto EpNextx2;
        EpBodyx2:
        return false;
        goto Epx1;
        EpNextx2:Epx1:
        $A_AA__A = "trim";
        $EpAC0 = $A_AA__A($save_dir);
        $Ep0 = $EpAC0 == '';
        if ($Ep0) goto EpBodyx4;
        goto EpNextx4;
        EpBodyx4:
        $save_dir = './';
        goto Epx3;
        EpNextx4:Epx3:
        $A_AA_A_ = "strrpos";
        $EpAC0 = $A_AA_A_($save_dir, '/');
        $Ep0 = 0 !== $EpAC0;
        if ($Ep0) goto EpBodyx6;
        goto EpNextx6;
        EpBodyx6:
        $save_dir = $save_dir . '/';
        goto Epx5;
        EpNextx6:Epx5:
        $A_AA_AA = "file_exists";
        $EpAC0 = $A_AA_AA($save_dir);
        $Ep0 = !$EpAC0;
        $Ep2 = (bool)$Ep0;
        if ($Ep2) goto EpBodyx9;
        goto EpNextx9;
        EpBodyx9:
        $A_AAA__ = "mkdir";
        $EpAC1 = $A_AAA__($save_dir, 0777, true);
        $Ep1 = !$EpAC1;
        $Ep2 = (bool)$Ep1;
        goto Epx8;
        EpNextx9:Epx8:
        if ($Ep2) goto EpBodyxa;
        goto EpNextxa;
        EpBodyxa:
        return false;
        goto Epx7;
        EpNextxa:Epx7:
        $EpAC0 = array();
        $EpAC0[] = "Content-type: application/octet-stream";
        $this_header = $EpAC0;
        if ($type) goto EpBodyxc;
        goto EpNextxc;
        EpBodyxc:
        $ch = curl_init();
        $timeout = 20;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this_header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $content = curl_exec($ch);
        curl_close($ch);
        goto Epxb;
        EpNextxc:
        $A_AAA_A = "ob_start";
        $EpAC0 = $A_AAA_A();
        readfile($url);
        $content = ob_get_contents();
        ob_end_clean();
        Epxb:
        $A_AAAA_ = "strlen";
        $EpAC0 = $A_AAAA_($content);
        $size = $EpAC0;
        $fp2 = @fopen($save_dir . $filename, 'a');
        $AA_____ = "fwrite";
        $EpAC0 = $AA_____($fp2, $content);
        $AA____A = "fclose";
        $EpAC0 = $AA____A($fp2);
        unset($content, $url);
        $EpAC0 = array();
        $EpAC0['file_name'] = $filename;
        $Ep0 = $save_dir . $filename;
        $EpAC0['save_path'] = $Ep0;
        return $EpAC0;
    }

    public function renewalInstall($id, $package)
    {
        $exist = Version::where(['id' => $id, 'install' => 0])->first();
        if ($exist) goto EpBodyxe;
        goto EpNextxe;
        EpBodyxe:
        $Ep0 = new \ZipArchive();
        $zip = $Ep0;
        $Ep0 = public_path() . "/file/";
        $Ep1 = $Ep0 . $package;
        $zipfile = $Ep1;
        $EpAC1 = array();
        $EpAC1[] =& $zipfile;
        $EpAC2 = array();
        $EpAC2[] = $zip;
        $EpAC2[] = "open";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        $res = $EpAC0;
        $toDir = base_path();
        $AA___A_ = "file_exists";
        $EpAC0 = $AA___A_($toDir);
        $Ep0 = !$EpAC0;
        if ($Ep0) goto EpBodyxg;
        goto EpNextxg;
        EpBodyxg:
        $AA___AA = "mkdir";
        $EpAC0 = $AA___AA($toDir, 0777);
        goto Epxf;
        EpNextxg:Epxf:
        $Ep0 = public_path() . "/file/";
        $EpAC2 = array();
        $EpAC2[] =& $zipfile;
        $EpAC2[] =& $Ep0;
        $EpAC2[] = true;
        $EpAC2[] = false;
        $EpAC3 = array();
        $EpAC3[] = $this;
        $EpAC3[] = "unzip";
        $EpAC0 = call_user_func_array($EpAC3, $EpAC2);
        $docnum = $zip->numFiles;
        $AA__A__ = "substr";
        $EpAC0 = $AA__A__($package, 0, strrpos($package, "."));
        $file_name_page = $EpAC0;
        $Ep0 = public_path() . "/file/";
        $Ep1 = $Ep0 . $file_name_page;
        $EpAC2 = array();
        $EpAC2[] =& $Ep1;
        $EpAC2[] =& $toDir;
        $EpAC2[] =& $file_name_page;
        $EpAC3 = array();
        $EpAC3[] = $this;
        $EpAC3[] = "list_file";
        $EpAC0 = call_user_func_array($EpAC3, $EpAC2);
        $exist->install = 1;
        $exist->download = 1;
        $EpAC1 = array();
        $EpAC2 = array();
        $EpAC2[] = $exist;
        $EpAC2[] = "save";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        $EpAC0 = array();
        $EpAC0['code'] = 0;
        $EpAC0['msg'] = '安装成功';
        return $EpAC0;
        goto Epxd;
        EpNextxe:
        $EpAC0 = array();
        $EpAC0['code'] = 01;
        $EpAC0['msg'] = '暂未发现需要安装的文件';
        return $EpAC0;
        Epxd:
    }

    public function list_file($date, $toDir, $package)
    {
        $temp = scandir($date);
        $EpEac1 = array();
        foreach ($temp as $v) {
            $EpEac1[] = $v;
        };
        $Ep1i = 0;
        Epxs:
        $AA_AAA_ = "count";
        $EpAC0 = $AA_AAA_($EpEac1);
        $Ep0 = $Ep1i < $EpAC0;
        if ($Ep0) goto EpBodyx19;
        goto EpNextx19;
        EpBodyx19:
        $Ep1Key = array_keys($EpEac1);
        $Ep1Key = $Ep1Key[$Ep1i];
        $v = $EpEac1[$Ep1Key];
        $Ep0 = $v !== '.';
        $Ep2 = (bool)$Ep0;
        if ($Ep2) goto EpBodyx1b;
        goto EpNextx1b;
        EpBodyx1b:
        goto EpBodyxw;
        goto Epx1a;
        EpNextx1b:Epx1a:
        goto EpNextxw;
        EpBodyxw:
        goto EpBodyxj;
        goto Epxv;
        EpNextxw:Epxv:
        goto EpNextxj;
        EpBodyxj:
        $Ep1 = $v != "..";
        $Ep2 = (bool)$Ep1;
        goto Epxi;
        EpNextxj:Epxi:
        if ($Ep2) goto EpBodyx1d;
        goto EpNextx1d;
        EpBodyx1d:
        goto EpBodyxy;
        goto Epx1c;
        EpNextx1d:Epx1c:
        goto EpNextxy;
        EpBodyxy:
        goto EpBodyxk;
        goto Epxx;
        EpNextxy:Epxx:
        goto EpNextxk;
        EpBodyxk:
        $Ep0 = $date . '/';
        $Ep1 = $Ep0 . $v;
        $a = $Ep1;
        $AA__A_A = "strstr";
        $EpAC0 = $AA__A_A($a, $package);
        $luyou_file = $EpAC0;
        $AA__AA_ = "str_replace";
        $EpAC0 = $AA__AA_($package . '/', "", $luyou_file);
        $luyou_file = $EpAC0;
        $AA__AAA = "is_dir";
        $EpAC0 = $AA__AAA($a);
        if ($EpAC0) goto EpBodyx1f;
        goto EpNextx1f;
        EpBodyx1f:
        goto EpBodyx11;
        goto Epx1e;
        EpNextx1f:Epx1e:
        goto EpNextx11;
        EpBodyx11:
        goto EpBodyxm;
        goto Epxz;
        EpNextx11:Epxz:
        goto EpNextxm;
        EpBodyxm:
        $AA_A___ = "file_exists";
        $EpAC0 = $AA_A___($toDir . '/' . $luyou_file);
        $Ep0 = !$EpAC0;
        if ($Ep0) goto EpBodyx1h;
        goto EpNextx1h;
        EpBodyx1h:
        goto EpBodyx13;
        goto Epx1g;
        EpNextx1h:Epx1g:
        goto EpNextx13;
        EpBodyx13:
        goto EpBodyxo;
        goto Epx12;
        EpNextx13:Epx12:
        goto EpNextxo;
        EpBodyxo:
        $AA_A__A = "mkdir";
        $EpAC0 = $AA_A__A($toDir . '/' . $luyou_file, 0777);
        goto Epxn;
        EpNextxo:Epxn:
        $EpAC1 = array();
        $EpAC1[] =& $a;
        $EpAC1[] =& $toDir;
        $EpAC1[] =& $package;
        $EpAC2 = array();
        $EpAC2[] = $this;
        $EpAC2[] = "list_file";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        goto Epxl;
        EpNextxm:
        $AA_A_A_ = "substr";
        $EpAC0 = $AA_A_A_($a, strripos($a, ".") + 1);
        $suffix = $EpAC0;
        $AA_A_AA = "strstr";
        $EpAC0 = $AA_A_AA($a, $package);
        $luyou_file = $EpAC0;
        $AA_AA__ = "str_replace";
        $EpAC0 = $AA_AA__($package . '/', "", $luyou_file);
        $luyou_file = $EpAC0;
        $Ep0 = $suffix != 'sql';
        if ($Ep0) goto EpBodyx1j;
        goto EpNextx1j;
        EpBodyx1j:
        goto EpBodyx15;
        goto Epx1i;
        EpNextx1j:Epx1i:
        goto EpNextx15;
        EpBodyx15:
        goto EpBodyxq;
        goto Epx14;
        EpNextx15:Epx14:
        goto EpNextxq;
        EpBodyxq:
        $AA_AA_A = "copy";
        $EpAC0 = $AA_AA_A(iconv("UTF-8", "GBK//IGNORE", $a), $toDir . '/' . $luyou_file);
        goto Epxp;
        EpNextxq:
        $Ep0 = $suffix == 'sql';
        if ($Ep0) goto EpBodyx1l;
        goto EpNextx1l;
        EpBodyx1l:
        goto EpBodyx17;
        goto Epx1k;
        EpNextx1l:Epx1k:
        goto EpNextx17;
        EpBodyx17:
        goto EpBodyxr;
        goto Epx16;
        EpNextx17:Epx16:
        goto EpNextxr;
        EpBodyxr:
        $EpAC1 = array();
        $EpAC1[] =& $a;
        $EpAC2 = array();
        $EpAC2[] = $this;
        $EpAC2[] = "execSql";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        goto Epxp;
        EpNextxr:Epxp:Epxl:
        goto Epxh;
        EpNextxk:Epxh:Epxt:
        $Ep1i++;
        goto Epxs;
        goto Epx18;
        EpNextx19:Epx18:Epxu:
    }

    public function execSql($file_name)
    {
        $AA_AAAA = "str_replace";
        $EpAC0 = $AA_AAAA('\\', '/', $file_name);
        $file_name = $EpAC0;
        $DB_HOST = getenv('DB_HOST');
        $DB_DATABASE = getenv('DB_DATABASE');
        $DB_USERNAME = getenv('DB_USERNAME');
        $DB_PASSWORD = getenv('DB_PASSWORD');
        set_time_limit(0);
        $fp = @fopen($file_name, "r");
        $Ep0 = (bool)$fp;
        $Ep1 = !$Ep0;
        if ($Ep1) goto EpBodyx1n;
        goto EpNextx1n;
        EpBodyx1n:
        $Ep0 = (bool)die("不能打开SQL文件 " . $file_name);
        goto Epx1m;
        EpNextx1n:Epx1m:
        @$conf = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $Ep0 = (bool)@$conf;
        $Ep1 = !$Ep0;
        if ($Ep1) goto EpBodyx1p;
        goto EpNextx1p;
        EpBodyx1p:
        $Ep0 = (bool)die("不能连接数据库 " . $DB_HOST);
        goto Epx1o;
        EpNextx1p:Epx1o:
        $AAA___A = "file_get_contents";
        $EpAC0 = $AAA___A($file_name);
        $_sql = $EpAC0;
        $AAA__A_ = "explode";
        $EpAC0 = $AAA__A_(';', $_sql);
        $_arr = $EpAC0;
        $EpEac1 = array();
        foreach ($_arr as $_value) {
            $EpEac1[] = $_value;
        };
        $Ep1i = 0;
        Epx1q:
        $AAA__AA = "count";
        $EpAC0 = $AAA__AA($EpEac1);
        $Ep0 = $Ep1i < $EpAC0;
        if ($Ep0) goto EpBodyx1u;
        goto EpNextx1u;
        EpBodyx1u:
        $Ep1Key = array_keys($EpEac1);
        $Ep1Key = $Ep1Key[$Ep1i];
        $_value = $EpEac1[$Ep1Key];
        mysqli_query($conf, "SET NAMES 'utf8'");
        mysqli_query($conf, $_value . ';');
        Epx1r:
        $Ep1i++;
        goto Epx1q;
        goto Epx1t;
        EpNextx1u:Epx1t:Epx1s:
    }

    public function create_dirs($path)
    {
        $AAA_A__ = "is_dir";
        $EpAC0 = $AAA_A__($path);
        $Ep0 = !$EpAC0;
        if ($Ep0) goto EpBodyx1w;
        goto EpNextx1w;
        EpBodyx1w:
        $directory_path = "";
        $AAA_A_A = "explode";
        $EpAC0 = $AAA_A_A("/", $path);
        $directories = $EpAC0;
        array_pop($directories);
        $EpEac1 = array();
        foreach ($directories as $directory) {
            $EpEac1[] = $directory;
        };
        $Ep1i = 0;
        Epx2z:
        $AAAA___ = "count";
        $EpAC0 = $AAAA___($EpEac1);
        $Ep0 = $Ep1i < $EpAC0;
        if ($Ep0) goto EpBodyx26;
        goto EpNextx26;
        EpBodyx26:
        $Ep1Key = array_keys($EpEac1);
        $Ep1Key = $Ep1Key[$Ep1i];
        $directory = $EpEac1[$Ep1Key];
        $Ep0 = $directory . "/";
        $Ep0 = $directory_path . $Ep0;
        $directory_path = $Ep0;
        $AAA_AA_ = "is_dir";
        $EpAC0 = $AAA_AA_($directory_path);
        $Ep0 = !$EpAC0;
        if ($Ep0) goto EpBodyx28;
        goto EpNextx28;
        EpBodyx28:
        goto EpBodyx24;
        goto Epx27;
        EpNextx28:Epx27:
        goto EpNextx24;
        EpBodyx24:
        goto EpBodyx1y;
        goto Epx23;
        EpNextx24:Epx23:
        goto EpNextx1y;
        EpBodyx1y:
        $AAA_AAA = "mkdir";
        $EpAC0 = $AAA_AAA($directory_path);
        chmod($directory_path, 0777);
        goto Epx1x;
        EpNextx1y:Epx1x:Epx21:
        $Ep1i++;
        goto Epx2z;
        goto Epx25;
        EpNextx26:Epx25:Epx22:
        goto Epx1v;
        EpNextx1w:Epx1v:
    }

    public function unzip($src_file, $dest_dir = false, $create_zip_name_dir = true, $overwrite = true)
    {
        $zip = zip_open($src_file);
        if ($zip) goto EpBodyx2a;
        goto EpNextx2a;
        EpBodyx2a:
        if ($zip) goto EpBodyx2c;
        goto EpNextx2c;
        EpBodyx2c:
        $Ep0 = $create_zip_name_dir === true;
        if ($Ep0) goto EpBodyx2e;
        goto EpNextx2e;
        EpBodyx2e:
        $Ep1 = ".";
        goto Epx2d;
        EpNextx2e:
        $Ep1 = "/";
        Epx2d:
        $splitter = $Ep1;
        $Ep0 = $dest_dir === false;
        if ($Ep0) goto EpBodyx2g;
        goto EpNextx2g;
        EpBodyx2g:
        $AAAA__A = "substr";
        $EpAC0 = $AAAA__A($src_file, 0, strrpos($src_file, $splitter));
        $Ep0 = $EpAC0 . "/";
        $dest_dir = $Ep0;
        goto Epx2f;
        EpNextx2g:Epx2f:
        $EpAC1 = array();
        $EpAC1[] =& $dest_dir;
        $EpAC2 = array();
        $EpAC2[] = $this;
        $EpAC2[] = "create_dirs";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        Epx2h:
        $zip_entry = zip_read($zip);
        if ($zip_entry) goto EpBodyx2u;
        goto EpNextx2u;
        EpBodyx2u:
        $AAAA_A_ = "strrpos";
        $EpAC0 = $AAAA_A_(zip_entry_name($zip_entry), "/");
        $pos_last_slash = $EpAC0;
        $Ep0 = $pos_last_slash !== false;
        if ($Ep0) goto EpBodyx2w;
        goto EpNextx2w;
        EpBodyx2w:
        goto EpBodyx2k;
        goto Epx2v;
        EpNextx2w:Epx2v:
        goto EpNextx2k;
        EpBodyx2k:
        $AAAA_AA = "substr";
        $EpAC1 = $AAAA_AA(zip_entry_name($zip_entry), 0, $pos_last_slash + 1);
        $Ep0 = $dest_dir . $EpAC1;
        $EpAC2 = array();
        $EpAC2[] =& $Ep0;
        $EpAC3 = array();
        $EpAC3[] = $this;
        $EpAC3[] = "create_dirs";
        $EpAC0 = call_user_func_array($EpAC3, $EpAC2);
        goto Epx2j;
        EpNextx2k:Epx2j:
        if (zip_entry_open($zip, $zip_entry, "r")) goto EpBodyx2y;
        goto EpNextx2y;
        EpBodyx2y:
        goto EpBodyx2m;
        goto Epx2x;
        EpNextx2y:Epx2x:
        goto EpNextx2m;
        EpBodyx2m:
        $Ep0 = $dest_dir . zip_entry_name($zip_entry);
        $file_name = $Ep0;
        $Ep0 = $overwrite === true;
        $Ep4 = (bool)$Ep0;
        $Ep0 = !$Ep4;
        if ($Ep0) goto EpBodyx31;
        goto EpNextx31;
        EpBodyx31:
        goto EpBodyx2r;
        goto Epx3z;
        EpNextx31:Epx3z:
        goto EpNextx2r;
        EpBodyx2r:
        $Ep1 = $overwrite === false;
        $Ep3 = (bool)$Ep1;
        if ($Ep3) goto EpBodyx33;
        goto EpNextx33;
        EpBodyx33:
        goto EpBodyx2p;
        goto Epx32;
        EpNextx33:Epx32:
        goto EpNextx2p;
        EpBodyx2p:
        $AAAAA__ = "is_file";
        $EpAC0 = $AAAAA__($file_name);
        $Ep2 = !$EpAC0;
        $Ep3 = (bool)$Ep2;
        goto Epx2o;
        EpNextx2p:Epx2o:
        $Ep4 = (bool)$Ep3;
        goto Epx2q;
        EpNextx2r:Epx2q:
        if ($Ep4) goto EpBodyx35;
        goto EpNextx35;
        EpBodyx35:
        goto EpBodyx2s;
        goto Epx34;
        EpNextx35:Epx34:
        goto EpNextx2s;
        EpBodyx2s:
        $fstream = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
        @file_put_contents($file_name, $fstream);
        goto Epx2n;
        EpNextx2s:Epx2n:
        zip_entry_close($zip_entry);
        goto Epx2l;
        EpNextx2m:Epx2l:
        goto Epx2h;
        goto Epx2t;
        EpNextx2u:Epx2t:Epx2i:
        zip_close($zip);
        goto Epx2b;
        EpNextx2c:Epx2b:
        goto Epx29;
        EpNextx2a:
        return false;
        Epx29:
        return true;
    }

    function deldir($dir)
    {
        $dh = opendir($dir);
        Epx36:
        $file = readdir($dh);
        if ($file) goto EpBodyx3f;
        goto EpNextx3f;
        EpBodyx3f:
        $Ep0 = $file != ".";
        $Ep2 = (bool)$Ep0;
        if ($Ep2) goto EpBodyx3h;
        goto EpNextx3h;
        EpBodyx3h:
        goto EpBodyx3a;
        goto Epx3g;
        EpNextx3h:Epx3g:
        goto EpNextx3a;
        EpBodyx3a:
        $Ep1 = $file != "..";
        $Ep2 = (bool)$Ep1;
        goto Epx39;
        EpNextx3a:Epx39:
        if ($Ep2) goto EpBodyx3j;
        goto EpNextx3j;
        EpBodyx3j:
        goto EpBodyx3b;
        goto Epx3i;
        EpNextx3j:Epx3i:
        goto EpNextx3b;
        EpBodyx3b:
        $Ep0 = $dir . "/";
        $Ep1 = $Ep0 . $file;
        $fullpath = $Ep1;
        $AAAAAAA = "is_dir";
        $EpAC0 = $AAAAAAA($fullpath);
        $Ep0 = !$EpAC0;
        if ($Ep0) goto EpBodyx3l;
        goto EpNextx3l;
        EpBodyx3l:
        goto EpBodyx3d;
        goto Epx3k;
        EpNextx3l:Epx3k:
        goto EpNextx3d;
        EpBodyx3d:
        $A_______ = "unlink";
        $EpAC0 = $A_______($fullpath);
        goto Epx3c;
        EpNextx3d:
        $EpAC1 = array();
        $EpAC1[] =& $fullpath;
        $EpAC2 = array();
        $EpAC2[] = $this;
        $EpAC2[] = "deldir";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        Epx3c:
        goto Epx38;
        EpNextx3b:Epx38:
        goto Epx36;
        goto Epx3e;
        EpNextx3f:Epx3e:Epx37:
        closedir($dh);
        $A______A = "rmdir";
        $EpAC0 = $A______A($dir);
        if ($EpAC0) goto EpBodyx3n;
        goto EpNextx3n;
        EpBodyx3n:
        return true;
        goto Epx3m;
        EpNextx3n:
        return false;
        Epx3m:
    }
}

?>