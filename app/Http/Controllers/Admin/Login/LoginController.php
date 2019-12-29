<?php

namespace App\Http\Controllers\Admin\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Admin\User;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    # 控制器中绑定
//    public function __construct()
//    {
//        $this->middleware(['cklogin']);
//    }

    # 登录页面
    public function index()
    {
        return view('admin.login.login');
    }

    # 提交验证
    public function login(Request $request)
    {

        if(cache()->has('admin.login'.$request->get("username"))) {
            if (cache('admin.login' . $request->get("username")) >= 3) {
                return redirect(route('admin.login.index'))->with('message', '登录错误3次，30分钟内禁止登录！');
            }
        }

        $data = $this->validate($request,[
            'username' => 'required',
            'password' => 'required',
            'code' => 'required|captcha'
        ]);
        unset($data['code']);

        $res = User::where($data)->first();

        # 限制一天内只能登录10次
        if($res['login_time']){
            # 非第一次登录
            $now = date('d');
            $old = date('d',$res['login_time']);
            if($now == $old){
                # 同一天
                if($res['login_num'] >= 10){
                    return redirect(route('admin.login.index'))->with('message','今天已经登录超过10次了，不能登录了！');
                }else{
                    $newdata['login_num'] = $res['login_num'] + 1;
                    $newdata['login_time'] = time();
                }
            }else{
                # 不是同一天
                $newdata['login_time'] = time();
                $newdata['login_num'] = 1;
            }
        }else{
            # 第一次登录
            $newdata['login_time'] = time();
            $newdata['login_num'] = 1;
        }
        # 限制一天内只能登录10次

        User::where('id',$res['id'])->update($newdata);

        # 获取当前 IP
//        echo request()->getClientIp();
        # 获取当前浏览器
//        $this->userBrowser();

        if($res){
            $user = $res->toArray();
            $message = "账号：" . $user['username'] . "，浏览器：" . $this->userBrowser() . "，IP地址：" . request()->getClientIp() . "，登录时间：" . date('Y-m-d H:i:s');
            Log::info($message);
            unset($user['password']);
            session(['admin.user' => $user]);
            return redirect(route('admin.user.index'))->with('message','登录成功！');
        }

        # 登录失败3次禁止登录  【有问题，在登录之后验证这样做没有意义，】
        if(cache()->has('admin.login'.$request->get("username"))){
            if(cache('admin.login'.$request->get("username")) >= 3){
                return redirect(route('admin.login.index'))->with('message','登录错误3次，30分钟内禁止登录！');
            }else{
                cache(['admin.login'.$request->get("username") => cache('admin.login'.$request->get("username"))+1],30);
            }
        }else{
            cache(['admin.login'.$request->get("username") =>'1'],30);
        }
//        $error_num = cache('admin.login'.$request->get("username"));


        return redirect(route('admin.login.index'))->with('message','登录失败！');
    }

    public function userBrowser() {
        $user_OSagent = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($user_OSagent, "Maxthon") && strpos($user_OSagent, "MSIE")) {
            $visitor_browser = "Maxthon(Microsoft IE)";
        } elseif (strpos($user_OSagent, "Maxthon 2.0")) {
            $visitor_browser = "Maxthon 2.0";
        } elseif (strpos($user_OSagent, "Maxthon")) {
            $visitor_browser = "Maxthon";
        } elseif (strpos($user_OSagent, "MSIE 9.0")) {
            $visitor_browser = "MSIE 9.0";
        } elseif (strpos($user_OSagent, "MSIE 8.0")) {
            $visitor_browser = "MSIE 8.0";
        } elseif (strpos($user_OSagent, "MSIE 7.0")) {
            $visitor_browser = "MSIE 7.0";
        } elseif (strpos($user_OSagent, "MSIE 6.0")) {
            $visitor_browser = "MSIE 6.0";
        } elseif (strpos($user_OSagent, "MSIE 5.5")) {
            $visitor_browser = "MSIE 5.5";
        } elseif (strpos($user_OSagent, "MSIE 5.0")) {
            $visitor_browser = "MSIE 5.0";
        } elseif (strpos($user_OSagent, "MSIE 4.01")) {
            $visitor_browser = "MSIE 4.01";
        } elseif (strpos($user_OSagent, "MSIE")) {
            $visitor_browser = "MSIE 较高版本";
        } elseif (strpos($user_OSagent, "NetCaptor")) {
            $visitor_browser = "NetCaptor";
        } elseif (strpos($user_OSagent, "Netscape")) {
            $visitor_browser = "Netscape";
        } elseif (strpos($user_OSagent, "Chrome")) {
            $visitor_browser = "Chrome";
        } elseif (strpos($user_OSagent, "Lynx")) {
            $visitor_browser = "Lynx";
        } elseif (strpos($user_OSagent, "Opera")) {
            $visitor_browser = "Opera";
        } elseif (strpos($user_OSagent, "Konqueror")) {
            $visitor_browser = "Konqueror";
        } elseif (strpos($user_OSagent, "Mozilla/5.0")) {
            $visitor_browser = "Mozilla";
        } elseif (strpos($user_OSagent, "Firefox")) {
            $visitor_browser = "Firefox";
        } elseif (strpos($user_OSagent, "U")) {
            $visitor_browser = "Firefox";
        } else {
            $visitor_browser = "其它";
        }
        return $visitor_browser;
    }
}
