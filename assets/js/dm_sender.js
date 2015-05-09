/**
 * Created by NimitzDEV on 2015/5/1 0001.
 */
/*ajax模块*/
$(function(){
    $("#btn_submit").click(function(){
        isOn();
        var getErr = false;
        var phonenumber = $("#input_phonenumber");
        var dm = $("#input_dm");
        /*ajax*/
        /*手机验证*/
        if(isMobileNo(phonenumber.val()) == false){
            getErr = true;
            isFailed("手机号码验证失败");
        }
        /*内容验证*/
        if(dm.val().trim() == ''){
            getErr = true;
            isFailed("请输入内容")
        }
        /*提交数据*/
        if(!getErr){
            $.ajax({
                type:'POST',
                url:'assets/ajax/ajax.php',
                data:{
                    'pn':phonenumber.val(),
                    'dm':dm.val()
                },
                dataType:'json',
                success: $.proxy(function(data) {
                    if (data.error == false){
                        isOk(data.response);
                        dm.val('');
                    }else{
                        isFailed(data.response);
                    }
                }, this)
            });
        }
    });
    /*ISON*/
    function isOn(){
        $("#status").removeClass("am-alert-danger").removeClass("am-alert-success").removeClass("am-hide").addClass("am-alert-warning").html("上墙中...");
        $("#btn_submit").addClass("am-hide");
    }
    /*OK*/
    function isOk(htmlvar){
        $("#status").removeClass("am-alert-danger").removeClass("am-hide").removeClass("am-alert-warning").addClass("am-alert-success").html(htmlvar);
        $("#btn_submit").removeClass("am-hide");
    }
    /*FAIL*/
    function isFailed(htmlvar){
        $("#status").removeClass("am-alert-success").removeClass("am-hide").removeClass("am-alert-warning").addClass("am-alert-danger").html(htmlvar);
        $("#btn_submit").removeClass("am-hide");
    }
    /*VAL PN*/
    function isMobileNo(sMobile){
        if(sMobile.length != 11){
            return false;
        }
        var testString = /^134|135|136|137|138|139|150|151|152|157|158|159|182|183|184|187|188|178|147|130|131|132|155|156|185|186|176|145|133|153|180|181|189|177|170/;
        if (!testString.test(sMobile)){
            return false;
        }
    }
});

