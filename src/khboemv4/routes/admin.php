<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| 后台公共路由部分
|
*/

Route::group(['namespace'=>'Admin','prefix'=>'admin'],function (){
    //登录、注销
    Route::get('login','LoginController@showLoginForm')->name('admin.loginForm');
    Route::post('login','LoginController@login')->name('admin.login');
    Route::get('logout','LoginController@logout')->name('admin.logout');
});
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| 后台需要授权的路由 admins
|
*/
Route::group(['middleware'=>['auth']],function (){
    Auth::routes();
    Route::post('uploadImage','Admin\PublicController@uploadImage')->name('uploadImage');
});
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'auth'],function (){
    //后台布局
    Route::get('/','IndexController@layout')->name('admin.layout');
    //后台首页
    Route::get('/index','IndexController@index')->name('admin.index');
    Route::get('/index1','IndexController@index1')->name('admin.index1');
    Route::get('/index2','IndexController@index2')->name('admin.index2');
    Route::get('/data2','IndexController@data2')->name('admin.data2');
    //图标
    Route::get('icons','IndexController@icons')->name('admin.icons');
    //下载更新包
    Route::post('download','IndexController@download')->name('admin.download');
    Route::post('echart/data','IndexController@echart_data')->name('admin.echart.data');
    //安装更新包
    Route::post('install','IndexController@install')->name('admin.install');

});

//系统管理
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>['auth','permission:system.manage']],function (){
    //数据表格接口
    Route::get('data','IndexController@data')->name('admin.data')->middleware('permission:system.role|system.user|system.permission');
    //用户管理
    Route::group(['middleware'=>['permission:system.user']],function (){
        Route::get('user','UserController@index')->name('admin.user');
        //添加
        Route::get('user/create','UserController@create')->name('admin.user.create')->middleware('permission:system.user.create');
        Route::post('user/store','UserController@store')->name('admin.user.store')->middleware('permission:system.user.create');
        //编辑
        Route::get('user/{id}/edit','UserController@edit')->name('admin.user.edit')->middleware('permission:system.user.edit');
        Route::put('user/{id}/update','UserController@update')->name('admin.user.update')->middleware('permission:system.user.edit');
        //删除
        Route::delete('user/destroy','UserController@destroy')->name('admin.user.destroy')->middleware('permission:system.user.destroy');
        //分配角色
        Route::get('user/{id}/role','UserController@role')->name('admin.user.role')->middleware('permission:system.user.role');
        Route::put('user/{id}/assignRole','UserController@assignRole')->name('admin.user.assignRole')->middleware('permission:system.user.role');
        //分配权限
        Route::get('user/{id}/permission','UserController@permission')->name('admin.user.permission')->middleware('permission:system.user.permission');
        Route::put('user/{id}/assignPermission','UserController@assignPermission')->name('admin.user.assignPermission')->middleware('permission:system.user.permission');
    });
    //角色管理
    Route::group(['middleware'=>'permission:system.role'],function (){
        Route::get('role','RoleController@index')->name('admin.role');
        //添加
        Route::get('role/create','RoleController@create')->name('admin.role.create')->middleware('permission:system.role.create');
        Route::post('role/store','RoleController@store')->name('admin.role.store')->middleware('permission:system.role.create');
        //编辑
        Route::get('role/{id}/edit','RoleController@edit')->name('admin.role.edit')->middleware('permission:system.role.edit');
        Route::put('role/{id}/update','RoleController@update')->name('admin.role.update')->middleware('permission:system.role.edit');
        //删除
        Route::delete('role/destroy','RoleController@destroy')->name('admin.role.destroy')->middleware('permission:system.role.destroy');
        //分配权限
        Route::get('role/{id}/permission','RoleController@permission')->name('admin.role.permission')->middleware('permission:system.role.permission');
        Route::put('role/{id}/assignPermission','RoleController@assignPermission')->name('admin.role.assignPermission')->middleware('permission:system.role.permission');
    });
    //权限管理
    Route::group(['middleware'=>'permission:system.permission'],function (){
        Route::get('permission','PermissionController@index')->name('admin.permission');
        //添加
        Route::get('permission/create','PermissionController@create')->name('admin.permission.create')->middleware('permission:system.permission.create');
        Route::post('permission/store','PermissionController@store')->name('admin.permission.store')->middleware('permission:system.permission.create');
        //编辑
        Route::get('permission/{id}/edit','PermissionController@edit')->name('admin.permission.edit')->middleware('permission:system.permission.edit');
        Route::put('permission/{id}/update','PermissionController@update')->name('admin.permission.update')->middleware('permission:system.permission.edit');
        //删除
        Route::delete('permission/destroy','PermissionController@destroy')->name('admin.permission.destroy')->middleware('permission:system.permission.destroy');
    });
    //菜单管理
});
//资讯管理
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware' => ['auth', 'permission:zixun.manage']], function () {
    //分类管理
    Route::group(['middleware' => 'permission:zixun.category'], function () {
        Route::get('category/data', 'CategoryController@data')->name('admin.category.data');
        Route::get('category', 'CategoryController@index')->name('admin.category');
        //添加分类
        Route::get('category/create', 'CategoryController@create')->name('admin.category.create')->middleware('permission:zixun.category.create');
        Route::post('category/store', 'CategoryController@store')->name('admin.category.store')->middleware('permission:zixun.category.create');
        //编辑分类
        Route::get('category/{id}/edit', 'CategoryController@edit')->name('admin.category.edit')->middleware('permission:zixun.category.edit');
        Route::put('category/{id}/update', 'CategoryController@update')->name('admin.category.update')->middleware('permission:zixun.category.edit');
        //删除分类
        Route::delete('category/destroy', 'CategoryController@destroy')->name('admin.category.destroy')->middleware('permission:zixun.category.destroy');
    });
    //文章管理
    Route::group(['middleware' => 'permission:zixun.article'], function () {
        Route::get('article/data', 'ArticleController@data')->name('admin.article.data');
        Route::get('article', 'ArticleController@index')->name('admin.article');
        //添加
        Route::get('article/create', 'ArticleController@create')->name('admin.article.create')->middleware('permission:zixun.article.create');
        Route::post('article/store', 'ArticleController@store')->name('admin.article.store')->middleware('permission:zixun.article.create');
        //编辑
        Route::get('article/{id}/edit', 'ArticleController@edit')->name('admin.article.edit')->middleware('permission:zixun.article.edit');
        Route::put('article/{id}/update', 'ArticleController@update')->name('admin.article.update')->middleware('permission:zixun.article.edit');
        //删除
        Route::delete('article/destroy', 'ArticleController@destroy')->name('admin.article.destroy')->middleware('permission:zixun.article.destroy');
    });
    //标签管理
    Route::group(['middleware' => 'permission:zixun.tag'], function () {
        Route::get('tag/data', 'TagController@data')->name('admin.tag.data');
        Route::get('tag', 'TagController@index')->name('admin.tag');
        //添加
        Route::get('tag/create', 'TagController@create')->name('admin.tag.create')->middleware('permission:zixun.tag.create');
        Route::post('tag/store', 'TagController@store')->name('admin.tag.store')->middleware('permission:zixun.tag.create');
        //编辑
        Route::get('tag/{id}/edit', 'TagController@edit')->name('admin.tag.edit')->middleware('permission:zixun.tag.edit');
        Route::put('tag/{id}/update', 'TagController@update')->name('admin.tag.update')->middleware('permission:zixun.tag.edit');
        //删除
        Route::delete('tag/destroy', 'TagController@destroy')->name('admin.tag.destroy')->middleware('permission:zixun.tag.destroy');
    });
});
//配置管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:config.manage']], function () {
    //站点配置
    Route::group(['middleware' => 'permission:config.site'], function () {
        Route::get('site', 'SiteController@index')->name('admin.site');
        Route::put('site', 'SiteController@update')->name('admin.site.update')->middleware('permission:config.site.update');
    });
    /*短信配置*/
    Route::get('sms', 'SmsController@index')->name('admin.sysmsg');
    Route::get('version', 'SmsController@getVersion')->name('admin.version');
    Route::get('sms/data', 'SmsController@data')->name('admin.sysmsg.data');
    Route::get('sms/{id}/edit', 'SmsController@edit')->name('admin.sysmsg.edit');
    Route::post('sms/{id}/edit', 'SmsController@update')->name('admin.sysmsg.edit');
    Route::get('sms/create', 'SmsController@create')->name('admin.sysmsg.create');
    Route::post('sms/create', 'SmsController@store')->name('admin.sysmsg.create');
    Route::get('sms/recharge', 'SmsController@recharge')->name('admin.sysmsg.recharge');//充值列表
    Route::get('sms/recharge/data', 'SmsController@rechargeData')->name('admin.sysmsg.recharge.data');//充值列表
    Route::get('sms/charge', 'SmsController@charge')->name('admin.sysmsg.charge');//充值
    Route::get('sms/template', 'SmsController@getTemplate')->name('admin.sysmsg.template');//充值
    /*短信配置*/
    //广告位
    Route::group(['middleware' => 'permission:config.position'], function () {
        Route::get('position/data', 'PositionController@data')->name('admin.position.data');
        Route::get('position', 'PositionController@index')->name('admin.position');
        //添加
        Route::get('position/create', 'PositionController@create')->name('admin.position.create')->middleware('permission:config.position.create');
        Route::post('position/store', 'PositionController@store')->name('admin.position.store')->middleware('permission:config.position.create');
        //编辑
        Route::get('position/{id}/edit', 'PositionController@edit')->name('admin.position.edit')->middleware('permission:config.position.edit');
        Route::put('position/{id}/update', 'PositionController@update')->name('admin.position.update')->middleware('permission:config.position.edit');
        //删除
        Route::delete('position/destroy', 'PositionController@destroy')->name('admin.position.destroy')->middleware('permission:config.position.destroy');
    });
    //广告信息
    Route::group(['middleware' => 'permission:config.advert'], function () {
        Route::get('advert/data', 'AdvertController@data')->name('admin.advert.data');
        Route::get('advert', 'AdvertController@index')->name('admin.advert');
        //添加
        Route::get('advert/create', 'AdvertController@create')->name('admin.advert.create')->middleware('permission:config.advert.create');
        Route::post('advert/store', 'AdvertController@store')->name('admin.advert.store')->middleware('permission:config.advert.create');
        //编辑
        Route::get('advert/{id}/edit', 'AdvertController@edit')->name('admin.advert.edit')->middleware('permission:config.advert.edit');
        Route::put('advert/{id}/update', 'AdvertController@update')->name('admin.advert.update')->middleware('permission:config.advert.edit');
        //删除
        Route::delete('advert/destroy', 'AdvertController@destroy')->name('admin.advert.destroy')->middleware('permission:config.advert.destroy');
    });
    /*SEO设置*/
    Route::group(['middleware' => 'permission:seo.config'], function () {
        Route::get('seo/data', 'SeoController@data')->name('admin.seo.data');
        Route::get('seo', 'SeoController@index')->name('admin.seo');
        //编辑
        Route::get('seo/{id}/edit', 'SeoController@edit')->name('admin.seo.edit')->middleware('permission:seo.config');
        Route::put('seo/{id}/update', 'SeoController@update')->name('admin.seo.update')->middleware('permission:seo.config');

    });
    /*SEO设置*/
    Route::group(['middleware' => 'permission:page.config'], function () {
        Route::get('page/data', 'PageController@data')->name('admin.page.data');
        Route::get('page', 'PageController@index')->name('admin.page');
        //编辑
        Route::get('page/{id}/edit', 'PageController@edit')->name('admin.page.edit')->middleware('permission:page.config');
        Route::put('page/{id}/update', 'PageController@update')->name('admin.page.update')->middleware('permission:page.config');
    });
        /*友情链接设置*/
    Route::group(['middleware' => 'permission:link.config'], function () {
        Route::get('link/data', 'LinkController@data')->name('admin.link.data');
        Route::get('link', 'LinkController@index')->name('admin.link');

        /*添加*/
        Route::get('link/create', 'LinkController@create')->name('admin.link.create')->middleware('permission:link.config');
        Route::post('link/store', 'LinkController@store')->name('admin.link.store')->middleware('permission:link.config');
        //编辑
        Route::get('link/{id}/edit', 'LinkController@edit')->name('admin.link.edit')->middleware('permission:link.config');
        Route::put('link/{id}/update', 'LinkController@update')->name('admin.link.update')->middleware('permission:link.config');
        //删除
        Route::delete('link/destroy', 'LinkController@destroy')->name('admin.link.destroy')->middleware('permission:link.config');
});
});
//软文资源
Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware' => ['auth','permission:sarticle.manage']],function () {
    /*云资源列表*/
    Route::get('sarticle/cloud/data', 'SarticleCloudController@data')->name('admin.sarticle.cloud.data');
    Route::get('sarticle/cloud', 'SarticleCloudController@index')->name('admin.sarticle.cloud');
    /*同步云资源*/
    Route::post('sarticle/cloud/pull', 'SarticleCloudController@pullSarticle')->name('admin.sarticle.cloud.pull');
    /**/
    /*已下载云资源上下架列表*/
    Route::get('sarticle', 'SarticleController@index')->name('admin.sarticle');
    Route::get('sarticle/below', 'SarticleController@below')->name('admin.sarticle.below');
    Route::get('sarticle/up/data', 'SarticleController@downData')->name('admin.sarticle.down.data');
    /*批量调价*/
    Route::get('sarticle/batch', 'SarticleController@batch')->name('admin.sarticle.batch');
    Route::get('sarticle/batch/data', 'SarticleController@batchData')->name('admin.sarticle.batch.data');
    Route::get('sarticle/batch/set', 'SarticleController@batchSet')->name('admin.sarticle.batch.set');
    Route::post('sarticle/batch/set/data', 'SarticleController@sarticleData')->name('admin.sarticle.batch.set.data');
    Route::post('sarticle/batch/submit', 'SarticleController@sarticleBatchPrice')->name('admin.sarticle.batch.submit');
    /*上下架*/
    Route::post('sarticle/status', 'SarticleController@status')->name('admin.sarticle.status');
    Route::get('sarticle/export', 'SarticleController@export')->name('admin.sarticle.export');
    //编辑
    Route::get('sarticle/edit', 'SarticleController@edit')->name('admin.sarticle.edit');
    Route::put('sarticle/update', 'SarticleController@update')->name('admin.sarticle.update');
    //删除
    Route::delete('sarticle/destroy', 'SarticleController@destroy')->name('admin.sarticle.destroy');


});
//自媒体资源
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']],function () {
    /*Route::get('zimeiti/data', 'ZimeitiController@data')->name('admin.zimeiti.data');
    Route::get('zimeiti', 'ZimeitiController@index')->name('admin.zimeiti');
    //添加
    Route::get('zimeiti/create', 'ZimeitiController@create')->name('admin.zimeiti.create');
    Route::post('zimeiti/store', 'ZimeitiController@store')->name('admin.zimeiti.store');
    //编辑
    Route::get('zimeiti/{id}/edit', 'ZimeitiController@edit')->name('admin.zimeiti.edit');
    Route::put('zimeiti/{id}/update', 'ZimeitiController@update')->name('admin.zimeiti.update');
    //删除
    Route::delete('zimeiti/destroy', 'ZimeitiController@destroy')->name('admin.zimeiti.destroy');*/

    /*云资源列表*/
    Route::get('zimeiti/cloud/data', 'ZimeitiCloudController@data')->name('admin.zimeiti.cloud.data');
    Route::get('zimeiti/cloud', 'ZimeitiCloudController@index')->name('admin.zimeiti.cloud');
    /*同步云资源*/
    Route::post('zimeiti/cloud/pull', 'ZimeitiCloudController@pullZimeiti')->name('admin.zimeiti.cloud.pull');
    /**/
    /*已下载云资源上下架列表*/
    Route::get('zimeiti', 'ZimeitiController@index')->name('admin.zimeiti');
    Route::get('zimeiti/below', 'ZimeitiController@below')->name('admin.zimeiti.below');
    Route::get('zimeiti/up/data', 'ZimeitiController@downData')->name('admin.zimeiti.down.data');
    /*批量调价*/
    Route::get('zimeiti/batch', 'ZimeitiController@batch')->name('admin.zimeiti.batch');
    Route::get('zimeiti/batch/data', 'ZimeitiController@batchData')->name('admin.zimeiti.batch.data');
    Route::get('zimeiti/batch/set', 'ZimeitiController@batchSet')->name('admin.zimeiti.batch.set');
    Route::post('zimeiti/batch/set/data', 'ZimeitiController@zimeitiData')->name('admin.zimeiti.batch.set.data');
    Route::post('zimeiti/batch/submit', 'ZimeitiController@zimeitiBatchPrice')->name('admin.zimeiti.batch.submit');
    /*上下架*/
    Route::post('zimeiti/status', 'ZimeitiController@status')->name('admin.zimeiti.status');
    Route::get('zimeiti/export', 'ZimeitiController@export')->name('admin.zimeiti.export');
    //编辑
    Route::get('zimeiti/edit', 'ZimeitiController@edit')->name('admin.zimeiti.edit');
    Route::put('zimeiti/{id}/update', 'ZimeitiController@update')->name('admin.zimeiti.update');
    //删除
    Route::delete('zimeiti/destroy', 'ZimeitiController@destroy')->name('admin.zimeiti.destroy');

});
//会员管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:member.manage']], function () {
    //账号管理
    Route::group(['middleware' => 'permission:member.member'], function () {
        Route::get('member/data', 'MemberController@data')->name('admin.member.data');
        Route::get('member', 'MemberController@index')->name('admin.member');
        //添加
        Route::get('member/create', 'MemberController@create')->name('admin.member.create')->middleware('permission:member.member.create');
        Route::post('member/store', 'MemberController@store')->name('admin.member.store')->middleware('permission:member.member.create');
        //编辑
        Route::get('member/{id}/edit', 'MemberController@edit')->name('admin.member.edit')->middleware('permission:member.member.edit');
        Route::put('member/{id}/update', 'MemberController@update')->name('admin.member.update')->middleware('permission:member.member.edit');
        //删除
        Route::delete('member/destroy', 'MemberController@destroy')->name('admin.member.destroy')->middleware('permission:member.member.destroy');
        //启用/禁用
        Route::post('member/status','MemberController@status')->name('admin.member.status');
    });
});

//财务管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:finance.manage']], function () {
    //财务流水
    Route::group(['middleware' => 'permission:finance.manage'], function () {
        Route::get('finance/data', 'MemberFinanceController@data')->name('admin.finance.data');
        Route::get('finance', 'MemberFinanceController@index')->name('admin.finance');
        //添加
        Route::get('finance/create', 'MemberFinanceController@create')->name('admin.finance.create');
        Route::post('finance/store', 'MemberFinanceController@store')->name('admin.finance.store');
        //导出
        Route::get('finance/export', 'MemberFinanceController@export')->name('admin.finance.export');
    });
});
//订单管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:order.manage']], function () {
    //软文订单
    Route::get('sarticle/order/data', 'SarticleOrderController@data')->name('admin.sarticle.order.data');
    Route::get('sarticle/order', 'SarticleOrderController@index')->name('admin.sarticle.order');
    //添加
    Route::get('sarticle/order/edit', 'SarticleOrderController@edit')->name('admin.sarticle.order.edit');
    Route::post('sarticle/order/update', 'SarticleOrderController@update')->name('admin.sarticle.order.update');
    //导出
    Route::get('sarticle/order/export', 'SarticleOrderController@export')->name('admin.sarticle.order.export');
    //订单删除
    Route::delete('sarticle/order/destroy', 'SarticleOrderController@destroy')->name('admin.sarticle.order.destroy');
    //订单退单
    Route::post('sarticle/order/back', 'SarticleOrderController@orderToBack')->name('admin.sarticle.order.back');
});

//消息管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:message.manage']], function () {
    //消息管理
    Route::group(['middleware' => 'permission:message.message'], function () {
        Route::get('message/data', 'MessageController@data')->name('admin.message.data');
        Route::get('message', 'MessageController@index')->name('admin.message');
        //添加
        Route::get('message/create', 'MessageController@create')->name('admin.message.create')->middleware('permission:message.message.create');
        Route::post('message/store', 'MessageController@store')->name('admin.message.store')->middleware('permission:message.message.create');
        Route::get('message/{id}/edit', 'MessageController@edit')->name('admin.message.edit');
        Route::post('message/update', 'MessageController@update')->name('admin.message.update');
        //删除
        Route::delete('message/destroy', 'MessageController@destroy')->name('admin.message.destroy')->middleware('permission:message.message.destroy');
    });

});
/*基础数据*/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:data.manage']], function () {
    //支付配置
    Route::group(['middleware' => 'permission:pay.message'], function () {
        Route::get('pay/index', 'PayController@index')->name('admin.pay')->middleware('permission:pay.message');
        Route::get('pay/data', 'PayController@data')->name('admin.pay.data')->middleware('permission:pay.message');
        Route::get('pay/{id}/edit', 'PayController@edit')->name('admin.pay.edit')->middleware('permission:pay.message');
        Route::post('pay/{id}/edit', 'PayController@update')->name('admin.pay.edit')->middleware('permission:pay.message');
    });

    //密匙配置
    Route::group(['middleware' => 'permission:secret.message'], function () {
        Route::get('secret/index', 'SecretController@index')->name('admin.secret')->middleware('permission:secret.message');
        Route::post('secret/update', 'SecretController@update')->name('admin.secret.update')->middleware('permission:secret.message');
    });
    //资源属性
    Route::group(['middleware' => ['permission:dictionary.message']],function () {
        Route::get('dictionary', 'DictionaryController@index')->name('admin.dictionary')->middleware('permission:dictionary.message');
        Route::get('dictionary/data', 'DictionaryController@data')->name('admin.dictionary.data');
        //编辑
        Route::get('dictionary/edit', 'DictionaryController@edit')->name('admin.dictionary.edit')->middleware('permission:dictionary.message');
        //更新
        Route::post('dictionary/update', 'DictionaryController@update')->name('admin.dictionary.update')->middleware('permission:dictionary.message');
        //同步
        Route::post('dictionary/sync', 'DictionaryController@sync')->name('admin.dictionary.sync')->middleware('permission:dictionary.message');


    });

});
/*应用市场*/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware' => ['auth','permission:apply.manage']],function () {
    /*云应用*/
    Route::get('apply', 'ApplyController@index')->name('admin.apply');
    Route::get('apply/template', 'ApplyController@template')->name('admin.apply.template');
    Route::get('apply/part', 'ApplyController@part')->name('admin.apply.part');
    Route::get('apply/data', 'ApplyController@data')->name('admin.apply.data');
    //详情页
    Route::get('apply/{id}/edit', 'ApplyController@edit')->name('admin.apply.edit');
    Route::get('apply/template/{id}/edit', 'ApplyController@editTemplate')->name('admin.apply.template.edit');
    Route::get('/apply/part/{id}/edit', 'ApplyController@editPart')->name('admin.apply.part.edit');
    //模板、应用、组件更新
    Route::post('apply/update', 'ApplyController@applyUpdate')->name('admin.apply.update');
});
/*我的应用市场*/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware' => ['auth','permission:myapply.manage']],function () {
    /*云应用*/
    Route::get('my/apply', 'MyApplyController@index')->name('admin.my.apply');
    Route::get('my/apply/data', 'MyApplyController@data')->name('admin.my.apply.data');
    Route::get('my/apply/template', 'MyApplyController@template')->name('admin.my.apply.template');
    Route::get('my/apply/part', 'MyApplyController@part')->name('admin.my.apply.part');
    Route::get('my/apply/data', 'MyApplyController@data')->name('admin.my.apply.data');

    //详情页
    Route::get('my/apply/{id}/edit', 'MyApplyController@edit')->name('admin.my.apply.edit');
    Route::get('my/apply/template/{id}/edit', 'MyApplyController@editTemplate')->name('admin.my.apply.template.edit');
    Route::get('my/apply/part/{id}/edit', 'MyApplyController@editPart')->name('admin.my.apply.part.edit');

    Route::post('my/apply/template/store', 'MyApplyController@installTemplate')->name('admin.my.apply.template.install');
    Route::post('my/apply/store', 'MyApplyController@installApply')->name('admin.my.apply.install');
    Route::post('my/apply/part/store', 'MyApplyController@installPart')->name('admin.my.apply.part.install');

    //模板、应用、组件更新
    Route::post('my/apply/update', 'MyApplyController@applyUpdate')->name('admin.my.apply.update');


});

/*工单*/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('ticket/data', 'TicketController@data')->name('admin.ticket.data');
    Route::get('ticket', 'TicketController@index')->name('admin.ticket');
    //添加
    Route::get('ticket/create', 'TicketController@create')->name('admin.ticket.create');
    Route::post('ticket/store', 'TicketController@store')->name('admin.ticket.store');
});
