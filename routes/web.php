<?php
//文件上传接口，前后台共用
Route::post('uploadImg', 'PublicController@uploadImg')->name('uploadImg');
Route::post('uploadFile', 'PublicController@uploadFile')->name('uploadFile');
//发送短信
Route::post('/sendMsg', 'PublicController@sendMsg')->name('sendMsg');
Route::get('/','Home\IndexController@index')->name('home');
//支付
Route::group(['namespace' => 'Home'], function () {
    //自动更新测试
    Route::get('renewal', 'IndexController@renewal')->name('home.renewal');
    Route::get('renewal/install', 'IndexController@renewalInstall')->name('home.renewal.install');

    //微信支付
    Route::get('/wechatPay', 'PayController@wechatPay')->name('wechatPay');
    //微信支付回调
    Route::any('alipay/notify','PayController@aliNotify');//支付宝回调
    Route::any('/wechat/Notify', 'PayController@wechatNotify')->name('wechatNofity');

    Route::get('/success', 'PayController@success')->name('home.success');//成功页面回调
    //软文模块
    Route::get('sarticle','SarticleController@index')->name('home.sarticle');
    //软文获取数据
    Route::get('sarticle/data','SarticleController@data')->name('home.sarticle.data');
    //口号帮推送订单
    Route::any('sarticle/data/pull','SarticleController@pullOrderStatus')->name('home.sarticle.data.pull');
    //查看详情
    Route::get('sarticle/show/{id}','SarticleController@show')->name('home.sarticle.show');
    Route::get('active/view/{id}','IndexController@activeView')->name('home.active.view');
    //新闻列表
    Route::get('new/', 'NewController@data')->name('home.new');
    //新闻详情
    Route::get('new/{id}', 'NewController@show')->name('home.new.show');
    Route::get('about/us', 'IndexController@aboutUs')->name('home.about');
	Route::post('/get/server/clause/','LoginController@serverClause')->name('home.get.server.clause');
	Route::post('/get/server/register/','LoginController@serverRegister')->name('home.get.server.register');
});
//会员-不需要认证
Route::group(['namespace'=>'Home','prefix'=>'member'],function (){

    Route::post('verify', 'LoginController@verify')->name('home.verify');
    //注册
    Route::get('register', 'LoginController@register')->name('home.register');
    Route::post('register', 'LoginController@store')->name('home.register.store');
    //登录
    Route::get('login', 'LoginController@login')->name('home.login');
    Route::post('login', 'LoginController@loginCheck')->name('home.login.check');
    Route::post('login/phone', 'LoginController@phoneLogin')->name('home.login.phone');
   //找回密码
    Route::get('forgot', 'LoginController@forgot')->name('home.forgot');

});
//会员-需要认证-个人中心
Route::group(['namespace'=>'Home\Member','prefix'=>'member','middleware'=>'member'],function (){//
    //个人中心(
    Route::get('/','MemberController@index')->name('home.member');
    Route::get('/basic','MemberController@basicInfo')->name('home.member.basic');
    Route::post('/member/info','MemberController@getUserInfo')->name('home.member.info');
    Route::post('/basic/update','MemberController@basicUpdate')->name('home.member.basic.update');
    //订单列表和数据
    Route::get('/sarticle/order','SarticleOrderController@index')->name('home.member.sarticle.order');
    Route::get('/sarticle/order/data','SarticleOrderController@data')->name('home.member.sarticle.order.data');
    Route::post('/sarticle/order/destroy','SarticleOrderController@destroy')->name('home.member.sarticle.order.destroy');//删除
    Route::get('/sarticle/order/export','SarticleOrderController@export')->name('home.member.sarticle.order.export');
    Route::post('/sarticle/order/back','SarticleOrderController@orderBack')->name('home.member.sarticle.order.back');//删除

    //财务列表和数据
    Route::get('/finance','MemberFinanceController@index')->name('home.member.finance');
    Route::get('/finance/date','MemberFinanceController@data')->name('home.member.finance.data');
    Route::get('/finance/export','MemberFinanceController@export')->name('home.member.finance.export');
    //充值下单页面
    Route::get('/finance/pay','PayController@index')->name('home.member.finance.pay');
    Route::post('/finance/pay/create','PayController@create')->name('home.member.finance.pay.create');
    //支付宝支付
    Route::get('/pay/alipay/{order_no}','PayController@alipay')->name('home.member.pay.alipay');
    //微信支付
    Route::get('/pay/wechat/{order_no}','PayController@wechat')->name('home.member.pay.wechat');

    //软文列表
    Route::get('/sarticle','SarticleController@index')->name('home.member.sarticle');
    //购物车
    Route::get('/sarticle/cart','SarticleCartController@index')->name('home.member.sarticle.cart');
    Route::get('/sarticle/cart/data','SarticleCartController@data')->name('home.member.sarticle.cart.data');
    Route::post('sarticle/cart/store', 'SarticleCartController@store')->name('home.sarticle.cart.store');
    Route::post('/sarticle/cart/destroy','SarticleCartController@destroy')->name('home.member.sarticle.cart.destroy');

    //下单页面
    Route::get('/sarticle/order/create','SarticleOrderController@create')->name('home.member.sarticle.order.create');
    Route::post('/sarticle/order/store','SarticleOrderController@store')->name('home.member.sarticle.order.store');
    //收藏
    Route::post('/enshrine/store','MemberEnshrineController@store')->name('home.member.enshrine.store');
    //密码验证
    Route::post('/sarticle/order/store','SarticleOrderController@store')->name('home.member.sarticle.order.store');
    //下单扣款
    Route::post('/sarticle/order/pay','SarticleOrderController@orderPay')->name('home.member.sarticle.order.pay');
    Route::post('/set/paypass','MemberController@setPayPass')->name('home.member.set.paypass');
    //直接下单
    Route::post('/sarticle/order/direct/pay','SarticleOrderController@directPay')->name('home.member.sarticle.order.direct');
    /*导出*/
    Route::get('sarticle/export','SarticleController@export')->name('home.sarticle.export');
    /*素材*/
    Route::get('/active','OrderActiveController@index')->name('home.member.active');
    Route::get('/active/data','OrderActiveController@data')->name('home.member.active.data');
    Route::get('/active/create','OrderActiveController@create')->name('home.member.active.create');
    Route::post('/active/store','OrderActiveController@store')->name('home.member.active.store');
    Route::post('/get/active/','OrderActiveController@getActive')->name('home.member.active.get');//删除

    //退出
    Route::get('logout', 'MemberController@logout')->name('home.member.logout');




    /*公告*/
    Route::get('/message','MemberController@message')->name('home.member.message');
    Route::get('/message/data','MemberController@messageData')->name('home.member.message.data');
});

