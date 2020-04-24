function movePath(addBtn, shopCar) {
    var addBtnDom = null,
        shopCarDom = null;
    if(typeof addBtn === "string"){
        addBtnDom = document.querySelector(addBtn);
    } else if(addBtn instanceof HTMLElement){
        addBtnDom = addBtn
    } else {
        alert("传入的参数错误： 第一个参数应为增加按钮的dom元素或该元素的选择器。");
        return;
    }

    if(typeof shopCar === "string"){
        shopCarDom = document.querySelector(shopCar);
    } else if(shopCar instanceof HTMLElement){
        shopCarDom = shopCar;
    }else {
        alert("传入的参数错误： 第二个参数应为购物车的dom元素或该元素的选择器。");
        return;
    }

    // 获取两个dom的位置
    var addBtnposition = addBtnDom.getBoundingClientRect();
    var shopCarPosition = shopCarDom.getBoundingClientRect();
    var addBtnCenterX = (addBtnposition.left + addBtnposition.right) / 2;
    var addBtnCenterY = (addBtnposition.top + addBtnposition.bottom) / 2;
    var shopCarCenterX = (shopCarPosition.left + shopCarPosition.right) / 2;
    var shopCarCenterY = (shopCarPosition.top + shopCarPosition.bottom) / 2;
   
    
    //计算增加按钮 是在 相对于购物车的 左边还是右边（用于控制后面的移动方向）
    var relativePositionX = addBtnCenterX > shopCarCenterX ? -1 : 1;
    //计算增加按钮 是在 相对于购物车的 上边还是下边（用于控制后面的移动方向）
    var relativePositionY = addBtnCenterY > shopCarCenterY ? -1 : 1;
    // 获取连个dom之间的距离
    var xDistance = Math.abs(addBtnCenterX - shopCarCenterX);
    var yDistance = Math.abs(addBtnCenterY - shopCarCenterY);
    // 小球背景
    var imgurl = addBtnDom.getAttribute('data-imgurl');
    // 绘制小球并设置其位置
    var ballDom = drawBall(imgurl);
    ballDom.style.top = addBtnCenterY + "px";
    ballDom.style.left = addBtnCenterX + "px";
    document.body.appendChild(ballDom);
   
    /*
    * 根据一元二次方程的轨迹求出对象的系数 y = ax^2 + bx + c
    *  var coefficientC = 0;
    *  var coefficientB = 0;
    *  var coefficientA = yDistance / Math.pow(xDistance, 2);
    */
    //小球的横竖坐标
    var xAbscissa = 0, yAbscissa = 0, rate = 80;
    //设置移动路径
    var ballTimer = setInterval(function () {
        //每次重新坐标
        xAbscissa += 5 * relativePositionX;
        yAbscissa = (yDistance / Math.pow(xDistance, 2)) * Math.pow(xAbscissa, 2);
        ballDom.style.top = addBtnCenterY + relativePositionY * yAbscissa + "px";
        ballDom.style.left = addBtnCenterX + xAbscissa + "px";
        rate -= 1.2
        ballDom.style.width = rate + "px";
        // ballDom.style.height = rate + "px";
        //检查是否到达终点
        var surplusDistance = parseInt(ballDom.style.top) - shopCarCenterY;
        if (Math.abs(surplusDistance) <= 10) {
            clearInterval(ballTimer);
            ballDom.remove()
        }
    }, 18);
}

/*
* 绘制小球
* */
function drawBall(imgurl) {
    var img = document.createElement("img");
    var ballDom = document.createElement("div");
    img.style.display = "inline-block";
    img.style.width = "100%";
    img.style.float = "left";
    img.src = imgurl;
    ballDom.appendChild(img)
    // ballDom.style.height = "60px";
    // ballDom.style.lineHeight = "60px";
    ballDom.style.width = "80px";
    // ballDom.style.border = "1px solid #ccc";
    ballDom.style.background = "#ffffff";
    // ballDom.style.borderRadius = "50%";
    ballDom.style.position = "fixed";
    ballDom.style.zIndex = "1111";
    return ballDom;
}