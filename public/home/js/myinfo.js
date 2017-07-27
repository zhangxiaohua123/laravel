$(function() {
    $(".all_input").each(function() {
        $(this).focus(function() {
            $(this).parent(".oInputs").addClass("oInputs_hover");
        });
        $(".all_input").blur(function() {
            $(".oInputs").removeClass("oInputs_hover");
        });
    });

    // 信息验证
    var boo1 = false;
    
    $("#info_name").blur(function() {
        if ($("#info_name").val() == "") {
            $("#infoName_tip").text("姓名不能为空");
        } else {
            $("#infoName_tip").text("");
            boo1 = true;
            var $name=$("#info_name").val()
            $("#info_sk").val($name);
        };
    });

    var boo2 = false;
    $("#info_id").blur(function() {
        if ($("#info_id").val() == "") {
            $("#infoId_tip").text("身份证号不能为空");
        } else {
            $("#infoId_tip").text("");
            boo2 = true;
        };
    });
    var boo3 = false;
    $("#info_mb").blur(function() {
        var telRegs = /^1[3|4|5|7|8][0-9]{9}$/;
        var $mbVal = $("#info_mb").val();
        if (!telRegs.test($mbVal) && ($mbVal != "")) {
            $("#infoMb_tip").text("手机号码格式不正确");
        } else if ($mbVal == "") {
            $("#infoMb_tip").text("请输入您的手机号");
        } else {
            $("#infoMb_tip").text("");
            boo3 = true;
        }
    });
    var boo4 = false;
    $("#info_email").blur(function() {
        var emRegs = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
        var $emVal = $("#info_email").val();
        if (!emRegs.test($emVal) && ($emVal != "")) {
            $("#infoEmail_tip").text("邮箱格式不正确");
        } else if ($emVal == "") {
            $("#infoEmail_tip").text("请输入您的邮箱");
        } else {
            $("#infoEmail_tip").text("");
            boo4 = true;
        }
    });

    var boo5=false;
    $("#location_p2").blur(function(){
        if($("#location_p2").val()==0){
            $("#infoCity_tip").text("所属省市不能为空");
        }else{
            $("#infoCity_tip").text("");
            boo5=true;
        }
    });


    var boo6 = false;
    $("#info_kh").blur(function() {
        var khRegs = /^(\d{16}|\d{17}|\d{18}|\d{19}|\d{20}|\d{21})$/;
        var $khVal = $("#info_kh").val();
        if (!khRegs.test($khVal) && ($khVal != "")) {
            $("#infoKH_tip").text("银行卡号格式不正确");
        } else if ($khVal == "") {
            $("#infoKH_tip").text("请输入收款银行卡号");
        } else {
            $("#infoKH_tip").text("");
            boo6 = true;
        }
    });
    var boo7 = false;
    $("#info_bank").blur(function() {
        if ($("#info_bank").val() == "") {
            $("#infoBank_tip").text("收款银行不能为空");
        } else {
            $("#infoBank_tip").text("");
            boo7 = true;
        };
    });

    var boo9 = false;
    $("#info_bank2").blur(function() {
        if ($("#info_bank2").val() == "") {
            $("#infoBank_tip2").text("支行不能为空");
        } else {
            $("#infoBank_tip2").text("");
            boo9 = true;
        };
    });
    $("#set_finish").click(function() {
        $("#info_name").trigger("blur");
        $("#info_id").trigger("blur");
        $("#info_mb").trigger("blur");
        $("#info_email").trigger("blur");
        $("#info_kh").trigger("blur");
        $("#info_bank").trigger("blur");
        $("#info_bank2").trigger("blur");
        $("#location_p2").trigger("blur");
        if(boo6&&boo7&&boo5&&boo9){
            $(".mbyz_bg").css("display", "block");
            $(".yz_boxBg").css("display", "block");
            $("body").animate({
                scrollTop: "0"
            }, 200);
            $("#yz_mb").val($("#info_mb").val());
            $("#yz_mb").attr("disabled", true);
            return true;
        } else {
            return false;
        }
    });

    // 弹窗手机验证
    $(".mb_close").click(function() {
        $(".mbyz_bg").css("display", "none");
        $(".yz_boxBg").css("display", "none");
    });
    var boo11 = false;
    $("#yz_number").blur(function() {
        if ($("#yz_number").val() == "") {
            $("#number_tip").text("验证码不能为空");
        } else {
            $("#number_tip").text("");
            boo11 = true;
        };
    });

    // // 点击验证码发送倒计时
    // $("#get_yzNum").click(function() {
    //     var $getYzVal = $("#get_yzNum");
    //     var timer = null;
    //     var second = 60;
    //     timer = setInterval(function() {
    //         second--;
    //         if (second >= 0) {
    //             $getYzVal.text(second);
    //             $getYzVal.attr("disabled", true);
    //             $getYzVal.css("background","#ffad42")
    //         } else {
    //             clearInterval(timer);
    //             $getYzVal.text("点击重新发送");
    //         }
    //     }, 1000);
    // });


    $("#yz_tijiao").click(function() {
        $("#yz_number").trigger("blur");
        if (boo11) {
            return true;
        } else {
            return false;
        }
    });

});
