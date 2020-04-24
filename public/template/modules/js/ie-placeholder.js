// =======================关闭弹框=============================

// =======================处理placeholder不正常显示问题=============================
function placeholderSupport() {
    return 'placeholder' in document.createElement('input');
}
$(function(){
    // if(!placeholderSupport()){   // 判断浏览器是否支持 placeholder
    //     $("[placeholder]").each(function(){
    //         console.log(';')
    //         var _this = $(this);
    //         var left = _this.css("padding-left");
    //         var height = _this.css("height");
    //         var spn = "height:"+height+";line-height:"+height+';';
    //         _this.parent().append('<span class="placeholder fz14" data-type="placeholder" style="left: ' + left + ';'+spn+'">' + _this.attr("placeholder") + '</span>');
    //         if(_this.val() != ""){
    //             _this.parent().find("span.placeholder").hide();
    //         }
    //         else{
    //             _this.parent().find("span.placeholder").show();
    //         }
    //     }).on("focus", function(){
    //         $(this).parent().find("span.placeholder").hide();
    //     }).on("blur", function(){
    //         var _this = $(this);
    //         if(_this.val() != ""){
    //             _this.parent().find("span.placeholder").hide();
    //         }
    //         else{
    //             _this.parent().find("span.placeholder").show();
    //         }
    //     });
    //     // 点击表示placeholder的标签相当于触发input
    //     $("span.placeholder").on("click", function(){
    //         $(this).hide();
    //         $(this).siblings("[placeholder]").trigger("click");
    //         $(this).siblings("[placeholder]").trigger("focus");
    //     });
    // }
    // handleCheck()
})
// 手动触发 placeholder 检测
function handleCheck() {
    if(!placeholderSupport()){   // 判断浏览器是否支持 placeholder
        $("[placeholder]").each(function(){
            var _this = $(this);
            var left = _this.css("padding-left");
            var height = _this.css("height");
            var spn = "height:"+height+";line-height:"+height+';';
            _this.parent().append('<span class="placeholder fz14" data-type="placeholder" style="left: ' + left + ';'+spn+'">' + _this.attr("placeholder") + '</span>');
            if(_this.val() != ""){
                _this.parent().find("span.placeholder").hide();
            }
            else{
                _this.parent().find("span.placeholder").show();
            }
        }).on("focus", function(){
            $(this).parent().find("span.placeholder").hide();
        }).on("blur", function(){
            var _this = $(this);
            if(_this.val() != ""){
                _this.parent().find("span.placeholder").hide();
            }
            else{
                _this.parent().find("span.placeholder").show();
            }
        });
        // 点击表示placeholder的标签相当于触发input
        $("span.placeholder").on("click", function(){
            $(this).hide();
            $(this).siblings("[placeholder]").trigger("click");
            $(this).siblings("[placeholder]").trigger("focus");
        });
    }
}
