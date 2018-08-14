<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/13
 * Time: 16:54
 * common: cloud.tencent sms https://github.com/qcloudsms/qcloudsms_php
 */

require __DIR__ . "/../src/index.php";

use Qcloud\Sms\SmsSingleSender;
use Qcloud\Sms\SmsMultiSender;
use Qcloud\Sms\SmsVoiceVerifyCodeSender;
use Qcloud\Sms\SmsVoicePromptSender;
use Qcloud\Sms\SmsStatusPuller;
use Qcloud\Sms\SmsMobileStatusPuller;

use Qcloud\Sms\VoiceFileUploader;
use Qcloud\Sms\FileVoiceSender;
use Qcloud\Sms\TtsVoiceSender;


class ModelMessageQcloudsms
{

    protected $appid = 1400122063;
    protected $appkey = "ed9ae16ea56f86e170ba1c71ad57a5f0";
    protected $smsSign = "宝履科技";

    /**
     * 指定模板单发
     *
     * 普通单发需明确指定内容，如果有多个签名，请在内容中以【】的方式添加到信息内容中，否则系统将使用默认签名。
     *
     * @param string $phoneNumber 不带国家码的手机号
     * @param int    $templId     模板 id
     * @param array  $params      模板参数列表，如模板 {1}...{2}...{3}，那么需要带三个参数
     * @param string $extend      扩展码，可填空串
     * @param string $ext         服务端原样返回的参数，可填空串
     * @return string 应答json字符串，详细内容参见腾讯云协议文档
     *                 {"result":0,"errmsg":"OK","ext":"","sid":"8:1yxdCMWN0bpmDVxcQoF20180813","fee":1}
     *                 {"result":1014,"errmsg":"package format error, template params error","ext":""}
     *
     */

    public function SmsSingleByTemplate($phoneNumber, $templId=0, $smsParams, $extend = "", $ext = "")
    {
        try {
            $ssender = new SmsSingleSender($this->appid, $this->appkey);
            $result = $ssender->sendWithParam("86", $phoneNumber, $templId, $smsParams, $this->smsSign, $extend , $ext);
            return $result;
        } catch (\Exception $e) {
            return json_encode(array("result"=>9999, errmsg=>$e));
        }
    }
    /**
     * 指定模板群发
     *
     *
     * @param  array  $phoneNumbers 不带国家码的手机号列表
     * @param  int    $templId      模板id
     * @param  array  $params       模板参数列表，如模板 {1}...{2}...{3}，那么需要带三个参数
     * @param  string $extend       扩展码，可填空串
     * @param  string $ext          服务端原样返回的参数，可填空串
     * @return string 应答json字符串，详细内容参见腾讯云协议文档
     * {"result":0,"errmsg":"OK","ext":"","detail":
     * [{"result":0,"errmsg":"OK","mobile":"15692198190","nationcode":"86","sid":"8:WKy6k5J4UBrdf9sZkkM20180813","fee":1},
     * {"result":0,"errmsg":"OK","mobile":"13795467304","nationcode":"86","sid":"8:GdEjvS766zAhn6Sn0ua20180813","fee":1}]}
     */

    public function SmsMultiByTemplate($phoneNumbers, $templId=0, $smsParams, $extend = "", $ext = "")
    {
        try {
            $msender = new SmsMultiSender($this->appid, $this->appkey);
            $result = $msender->sendWithParam("86", $phoneNumbers, $templId, $smsParams,  $this->smsSign, $extend , $ext);
            return $result;
        } catch (\Exception $e) {
            return json_encode(array("result"=>9999, errmsg=>$e));
        }
    }

}