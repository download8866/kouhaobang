<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:44:33
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Traits;
trait Zip
{
    public function unzip()
    {
        $Ep0 = new \ZipArchive();
        $zip = $Ep0;
        $Ep0 = public_path() . "/Traits.zip";
        $zipfile = $Ep0;
        $EpAC1 = array();
        $EpAC1[] =& $zipfile;
        $EpAC2 = array();
        $EpAC2[] = $zip;
        $EpAC2[] = "open";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        $res = $EpAC0;
        $toDir = app_path();
        $A____AA_ = "file_exists";
        $EpAC0 = $A____AA_($toDir);
        $Ep0 = !$EpAC0;
        if ($Ep0) goto EpBodyx2;
        goto EpNextx2;
        EpBodyx2:
        $A____AAA = "mkdir";
        $EpAC0 = $A____AAA($toDir);
        goto Epx1;
        EpNextx2:Epx1:
        $docnum = $zip->numFiles;
        $i = 0;
        Epx3:
        $Ep0 = $i < $docnum;
        if ($Ep0) goto EpBodyxh;
        goto EpNextxh;
        EpBodyxh:
        $EpAC1 = array();
        $EpAC1[] =& $i;
        $EpAC2 = array();
        $EpAC2[] = $zip;
        $EpAC2[] = "statIndex";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        $statInfo = $EpAC0;
        dump($statInfo);
        $Ep0 = $statInfo['crc'] == 0;
        if ($Ep0) goto EpBodyxj;
        goto EpNextxj;
        EpBodyxj:
        goto EpBodyx7;
        goto Epxi;
        EpNextxj:Epxi:
        goto EpNextx7;
        EpBodyx7:
        $A___A___ = "file_exists";
        $EpAC0 = $A___A___($toDir . '/' . substr($statInfo['name'], 0, -1));
        $Ep0 = !$EpAC0;
        if ($Ep0) goto EpBodyxl;
        goto EpNextxl;
        EpBodyxl:
        goto EpBodyx9;
        goto Epxk;
        EpNextxl:Epxk:
        goto EpNextx9;
        EpBodyx9:
        $A___A__A = "mkdir";
        $EpAC0 = $A___A__A($toDir . '/' . substr($statInfo['name'], 0, -1));
        goto Epx8;
        EpNextx9:Epx8:
        goto Epx6;
        EpNextx7:
        $A___A_A_ = "copy";
        $EpAC0 = $A___A_A_('zip://' . $zipfile . '#' . $statInfo['name'], $toDir . '/' . $statInfo['name']);
        Epx6:
        $A___A_AA = "preg_match";
        $EpAC0 = $A___A_AA('/.+\/$/', $statInfo['name']);
        $Ep0 = !$EpAC0;
        if ($Ep0) goto EpBodyxn;
        goto EpNextxn;
        EpBodyxn:
        goto EpBodyxb;
        goto Epxm;
        EpNextxn:Epxm:
        goto EpNextxb;
        EpBodyxb:
        $A___AA__ = "explode";
        $EpAC0 = $A___AA__('/', $statInfo['name']);
        $name_arr = $EpAC0;
        $fileName = array_pop($name_arr);
        if ($fileName) goto EpBodyxp;
        goto EpNextxp;
        EpBodyxp:
        goto EpBodyxd;
        goto Epxo;
        EpNextxp:Epxo:
        goto EpNextxd;
        EpBodyxd:
        $extension = pathinfo($fileName)['extension'];
        $Ep0 = $extension == 'sql';
        if ($Ep0) goto EpBodyxr;
        goto EpNextxr;
        EpBodyxr:
        goto EpBodyxf;
        goto Epxq;
        EpNextxr:Epxq:
        goto EpNextxf;
        EpBodyxf:
        $Ep0 = $toDir . '/';
        $Ep1 = $Ep0 . $statInfo['name'];
        $sqlPath = $Ep1;
        $EpAC1 = array();
        $EpAC1[] =& $sqlPath;
        $EpAC2 = array();
        $EpAC2[] = $this;
        $EpAC2[] = "execSql";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        goto Epxe;
        EpNextxf:Epxe:
        goto Epxc;
        EpNextxd:Epxc:
        goto Epxa;
        EpNextxb:Epxa:Epx4:
        $i++;
        goto Epx3;
        goto Epxg;
        EpNextxh:Epxg:Epx5:
        dd('文件复制完成');
    }

    function getFile($url, $save_dir = '', $filename = '', $type = 0)
    {
        $A___AA_A = "trim";
        $EpAC0 = $A___AA_A($url);
        $Ep0 = $EpAC0 == '';
        if ($Ep0) goto EpBodyxt;
        goto EpNextxt;
        EpBodyxt:
        return false;
        goto Epxs;
        EpNextxt:Epxs:
        $A___AAA_ = "trim";
        $EpAC0 = $A___AAA_($save_dir);
        $Ep0 = $EpAC0 == '';
        if ($Ep0) goto EpBodyxv;
        goto EpNextxv;
        EpBodyxv:
        $save_dir = './';
        goto Epxu;
        EpNextxv:Epxu:
        $A___AAAA = "strrpos";
        $EpAC0 = $A___AAAA($save_dir, '/');
        $Ep0 = 0 !== $EpAC0;
        if ($Ep0) goto EpBodyxx;
        goto EpNextxx;
        EpBodyxx:
        $save_dir = $save_dir . '/';
        goto Epxw;
        EpNextxx:Epxw:
        $A__A____ = "file_exists";
        $EpAC0 = $A__A____($save_dir);
        $Ep0 = !$EpAC0;
        $Ep2 = (bool)$Ep0;
        if ($Ep2) goto EpBodyx11;
        goto EpNextx11;
        EpBodyx11:
        $A__A___A = "mkdir";
        $EpAC1 = $A__A___A($save_dir, 0777, true);
        $Ep1 = !$EpAC1;
        $Ep2 = (bool)$Ep1;
        goto Epxz;
        EpNextx11:Epxz:
        if ($Ep2) goto EpBodyx12;
        goto EpNextx12;
        EpBodyx12:
        return false;
        goto Epxy;
        EpNextx12:Epxy:
        if ($type) goto EpBodyx14;
        goto EpNextx14;
        EpBodyx14:
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $content = curl_exec($ch);
        curl_close($ch);
        goto Epx13;
        EpNextx14:
        $A__A__A_ = "ob_start";
        $EpAC0 = $A__A__A_();
        readfile($url);
        $content = ob_get_contents();
        ob_end_clean();
        Epx13:
        $A__A__AA = "strlen";
        $EpAC0 = $A__A__AA($content);
        $size = $EpAC0;
        $fp2 = @fopen($save_dir . $filename, 'a');
        $A__A_A_A = "fwrite";
        $EpAC0 = $A__A_A_A($fp2, $content);
        $A__A_AA_ = "fclose";
        $EpAC0 = $A__A_AA_($fp2);
        unset($content, $url);
        $EpAC0 = array();
        $EpAC0['file_name'] = $filename;
        $Ep0 = $save_dir . $filename;
        $EpAC0['save_path'] = $Ep0;
        return $EpAC0;
    }

    public function downZip()
    {
        $url = "http://www.ikuyu.net/Traits.zip";
        $save_dir = public_path('/');
        $A__A_AAA = "explode";
        $EpAC0 = $A__A_AAA('/', $url);
        $name_arr = $EpAC0;
        $filename = array_pop($name_arr);
        $EpAC1 = array();
        $EpAC1[] =& $url;
        $EpAC1[] =& $save_dir;
        $EpAC1[] =& $filename;
        $EpAC1[] = 1;
        $EpAC2 = array();
        $EpAC2[] = $this;
        $EpAC2[] = "getFile";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        $res = $EpAC0;
        var_dump($res);
    }

    public function execSql($file_name)
    {
        $A__AA___ = "str_replace";
        $EpAC0 = $A__AA___('\\', '/', $file_name);
        $file_name = $EpAC0;
        $DB_HOST = getenv('DB_HOST');
        $DB_DATABASE = getenv('DB_DATABASE');
        $DB_USERNAME = getenv('DB_USERNAME');
        $DB_PASSWORD = getenv('DB_PASSWORD');
        set_time_limit(0);
        $fp = @fopen($file_name, "r");
        $Ep0 = (bool)$fp;
        $Ep1 = !$Ep0;
        if ($Ep1) goto EpBodyx16;
        goto EpNextx16;
        EpBodyx16:
        $Ep0 = (bool)die("不能打开SQL文件 " . $file_name);
        goto Epx15;
        EpNextx16:Epx15:
        @$conf = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $Ep0 = (bool)@$conf;
        $Ep1 = !$Ep0;
        if ($Ep1) goto EpBodyx18;
        goto EpNextx18;
        EpBodyx18:
        $Ep0 = (bool)die("不能连接数据库 " . $DB_HOST);
        goto Epx17;
        EpNextx18:Epx17:
        echo "<p>正在清空数据库,请稍等....<br>";
        $result = mysqli_query($conf, "SHOW tables");
        echo "<br>恭喜你清理MYSQL成功<br>";
        echo "正在执行导入数据库操作<br>";
        $A__AA_A_ = "file_get_contents";
        $EpAC0 = $A__AA_A_($file_name);
        $_sql = $EpAC0;
        $A__AA_AA = "explode";
        $EpAC0 = $A__AA_AA(';', $_sql);
        $_arr = $EpAC0;
        $EpEac1 = array();
        foreach ($_arr as $_value) {
            $EpEac1[] = $_value;
        };
        $Ep1i = 0;
        Epx19:
        $A__AAA__ = "count";
        $EpAC0 = $A__AAA__($EpEac1);
        $Ep0 = $Ep1i < $EpAC0;
        if ($Ep0) goto EpBodyx1d;
        goto EpNextx1d;
        EpBodyx1d:
        $Ep1Key = array_keys($EpEac1);
        $Ep1Key = $Ep1Key[$Ep1i];
        $_value = $EpEac1[$Ep1Key];
        mysqli_query($conf, "SET NAMES 'utf8'");
        mysqli_query($conf, $_value . ';');
        Epx1a:
        $Ep1i++;
        goto Epx19;
        goto Epx1c;
        EpNextx1d:Epx1c:Epx1b:
        echo "<br>导入完成！";
    }
}

?>