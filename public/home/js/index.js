$(function(){
	// 头部导航按钮
	$(".nav_btn").click(function(e){
		var e=e||window.event;
		if (e.stopPropagation) {
            e.stopPropagation();
        }else{
            window.event.cancelBubble = true;
        };
        if($(".nav_list").is(":hidden")){
        	$(".nav_list").css("display","block");
        	$("body").click(function(){
        		$(".nav_list").css("display","none");
        	})
        }else{
        	$(".nav_list").css("display","none");
        }
	});

	// 底部导航样式
    var $share_url = $(".icon1").parent();
    if ($share_url[0].href == String(window.location)) {
        $(".icon1").removeClass("icon1_h").addClass("icon1_b");
        $share_url.find(".nav_text").css("color","#5d6dbc");
    };

    var $caiwu_url = $(".icon2").parent();
    if ($caiwu_url[0].href == String(window.location)) {
        $(".icon2").removeClass("icon2_h").addClass("icon2_b");
        $caiwu_url.find(".nav_text").css("color","#5d6dbc");
    };

    var $jc_url = $(".icon3").parent();
    if ($jc_url[0].href == String(window.location)) {
        $(".icon3").removeClass("icon3_h").addClass("icon3_b");
        $jc_url.find(".nav_text").css("color","#5d6dbc");
    };

    var $index_url = $(".icon4").parent();
    if ($index_url[0].href == String(window.location)) {
        $(".icon4").removeClass("icon4_h").addClass("icon4_b");
        $index_url.find(".nav_text").css("color","#5d6dbc");
    };

    // 提现中
    // $(".apply_btn").click(function(){
    // 	$("#failTip_bg").css("display","block");
    // 	$("#fail_tip").css("display","block");
    // 	if($("#fail_tip").is(":visible")){
    // 		$(".tip_close").click(function(){
    // 			$("#failTip_bg").css("display","none");
    // 			$("#fail_tip").css("display","none");
    // 			$(".tip_close").unbind("click");
    // 		})
    // 	};
    // });
    // $(".apply_btn").click(function(){
    //     $(this).text("提现中");
    //     $(this).css({"background":"#ffad42","border":"0.1rem solid #ffad42"});
    // });

    // 分享
    // $(".jiathis_style a").attr("class",function(i,cls){
    //     return cls.replace(/jtic\S+ /g,"");
    // })
    // $(".jiathis_style a span").removeClass();
    
})