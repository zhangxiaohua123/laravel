$(function(){
    // 选项卡切换
	var $tabs={};
    $tabs.tabPlugin=function(data){
        $(data.tab).each(function(){
            $(this).bind(data.event,function(){
                $(this).addClass(data.tabActive).siblings().removeClass(data.tabActive);
                var _index=$(this).index();
                $(data.page).eq(_index).addClass(data.pageActive).siblings(data.pageEle).removeClass(data.pageActive);
            })
        })
    };

    var $tabs_c={
        tab:".tabs",
        page:".pages",
        pageActive:"active",
        tabActive:"on",
        event:"click",
        pageEle:".pages"
    };
    $tabs.tabPlugin($tabs_c);

    // 登录验证
    var boo1=false;
    $("#mb_input").blur(function(){
        var telRegs = /^1[3|4|5|7|8][0-9]{9}$/;
        var $mbVal=$("#mb_input").val();
        if(!telRegs.test($mbVal)&&($mbVal!="")){
            $("#mb_tip").text("*手机号码格式不正确");
        }else if($mbVal==""){
            $("#mb_tip").text("*请输入您的手机号");
        }else{
            $("#mb_tip").text("");
            boo1=true;
        }
    });
    var boo2=false;
    $("#pw_input").blur(function(){
        if($("#pw_input").val()==""){
            $("#pw_tip").text("*请输入密码");
        }else{
            $("#pw_tip").text("");
            boo2=true;
        }
    });
    $("#login_btn").click(function(){
        $("#mb_input").trigger("blur");
        $("#pw_input").trigger("blur");
        if(boo1&&boo2){
            return true;
        }else{
            return false;
        }
    });
    // 注册验证
    var boo3=false;
    $("#Rmb_input").blur(function(){
        var telRegs = /^1[3|4|5|7|8][0-9]{9}$/;
        var $RmbVal=$("#Rmb_input").val();
        if(!telRegs.test($RmbVal)&&($RmbVal!="")){
            $("#Rmb_tip").text("*手机号码格式不正确");
        }else if($RmbVal==""){
            $("#Rmb_tip").text("*请输入您的手机号");
        }else{
            $("#Rmb_tip").text("");
            boo3=true;
        }
    });
    var boo4=false;
    $("#reg_pw").blur(function(){
        if($("#reg_pw").val()==""){
            $("#regPw_tip").text("*请输入密码");
        }else if($("#reg_pw").val().length<6){
            $("#regPw_tip").text("*密码不能少于6位");
        }else{
            $("#regPw_tip").text("");
            boo4=true;
        }
    });
    var boo5=false;
    $("#reg_pw2").blur(function(){
        if($("#reg_pw2").val()==""){
            $("#regPw_tip2").text("*请再次输入密码");
        }else if($("#reg_pw2").val()!=$("#reg_pw").val()){
            $("#regPw_tip2").text("*密码输入不一致");
        }else{
            $("#regPw_tip2").text("");
            boo5=true;
        }
    });
    var boo6=false;
    $("#yz_input").blur(function(){
        if($("#yz_input").val()==""){
            $("#yz_tip").text("*请输入验证码");
        }else{
            $("#yz_tip").text("");
            boo6=true;
        }
    });
    $("#reg_btn").click(function(){
        $("#Rmb_input").trigger("blur");
        $("#reg_pw").trigger("blur");
        $("#reg_pw2").trigger("blur");
        $("#yz_input").trigger("blur");
        if(boo3&&boo4&&boo5&&boo6){
            return true;
        }else{
            return false;
        }
    });
})