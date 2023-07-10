<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Minmax\Article\Models\ArticleBlock;
use Minmax\Article\Models\ArticleCategory;
use Minmax\Article\Models\ArticleDownload;
use Minmax\Article\Models\ArticleIntro;
use Minmax\Base\Helpers\Log as LogHelper;
use Minmax\Base\Models\AdminUser;
use Minmax\Foundation\Contracts\WebController as BaseController;
use Minmax\Inbox\Web\InboxReceivedRepository;
use Minmax\Product\Models\ProductIntro;
use Minmax\World\Models\WorldCity;

/**
 * Class AjaxController
 *
 * @package App\Http\Controllers\Web
 */
class AjaxController extends BaseController
{


    public function getCaptcha(){

        session_start();
        //ob_clean();
        ob_start();

        header("Content-type:image/png");
        header("Content-Disposition:filename=image_code.png");

        // 開啟 session
        if (!isset($_SESSION)) { session_start(); }

        // 設定亂數種子
        mt_srand((double)microtime()*1000000);

        // 驗證碼變數
        $verification = '';

        // 定義顯示在圖片上的文字，可以再加上大寫字母
        $str = 'abcdefghijkmnpqrstuvwxyz123456789';
        //$str = '0123456789';

        $l = strlen($str); //取得字串長度

        //隨機取出 6 個字
        for($i=0; $i<4; $i++){
            $num=rand(0,$l-1);
            $verification.= $str[$num];
        }

        // 將驗證碼記錄在 session 中
        //$_SESSION['captcha'] = $verification;
        Session::put('captcha', $verification);

        // 圖片的寬度與高度
        $imageWidth = 80; $imageHeight = 33;
        // 建立圖片物件
        $im = @imagecreatetruecolor($imageWidth, $imageHeight)	or die("無法建立圖片！");

        $randbgColorSeed=rand(200, 245);
        $randbgColorR=$randbgColorSeed+rand(-10, 10);
        $randbgColorG=$randbgColorSeed+rand(-10, 10);
        $randbgColorB=$randbgColorSeed+rand(-10, 10);

        $randColorSeed=rand(70, 135);

        $randColorR=$randColorSeed+rand(-50, 20);
        $randColorG=$randColorSeed+rand(-50, 20);
        $randColorB=$randColorSeed+rand(-50, 20);

        //$randgray1R=rand(135, 145);
        //$randgray1R=$randColorSeed+rand(25, 50);
        //$randgray1G=$randColorSeed+rand(25, 50);
        //$randgray1B=$randColorSeed+rand(25, 50);
        $randgray1R=$randColorR+rand(50, 70);
        $randgray1G=$randColorG+rand(50, 70);
        $randgray1B=$randColorB+rand(50, 70);
        $randgray2R=rand(70, 145);
        $randgray2R=$randColorR+rand(-10,10);
        $randgray2G=$randColorG+rand(-10,10);
        $randgray2B=$randColorB+rand(-10,10);


        //主要色彩設定
        // 圖片底色
        // 圖片底色
        //$bgColor = imagecolorallocate($im, 255,239,239);
        //$bgColor = imagecolorallocate($im, 255,255,255);
        $bgColor = imagecolorallocate($im, $randbgColorR, $randbgColorG, $randbgColorB);
        // 文字顏色
        //$Color = imagecolorallocate($im, 255,100,100);
        //$Color = imagecolorallocate($im, 107,148,33);
        $Color = imagecolorallocate($im, $randColorR, $randColorG, $randColorB);
        // 干擾線條顏色
        //$gray1 = imagecolorallocate($im, 200,200,200);
        $gray1 = imagecolorallocate($im, $randgray1R, $randgray1G, $randgray1B);
        // 干擾像素顏色
        //$gray2 = imagecolorallocate($im, 200,200,200);
        $gray2 = imagecolorallocate($im, $randgray2R, $randgray2G, $randgray2B);



        //設定圖片底色
        imagefill($im,0,0,$bgColor);


        //底色干擾線條
        for($i=0; $i<20; $i++){
            imageline($im,rand(0,$imageWidth),rand(0,$imageHeight),
                rand($imageHeight,$imageWidth),rand(0,$imageHeight),$gray1);
        }

        $randFontSize = rand(18, 19);
        $randAngle = rand(-4, 7);
        $randXval = rand(3, 8);

        //imagettftext($im, 18, 0, 20, 25, $Color,'G:/xampp/htdocs/e000432/public/arial.ttf',$verification);
        imagettftext($im, $randFontSize, $randAngle, $randXval, 25, $Color,public_path('arial.ttf'),$verification);

        // 干擾像素
        for($i=0;$i<180;$i++){
            imagesetpixel($im, rand()%$imageWidth ,
                rand()%$imageHeight , $gray2);
        }


        imagepng($im);
        imagedestroy($im);

        $content = ob_get_clean();
        return $content;
    }




    /**
     * @param  Request $request
     * @param  InboxReceivedRepository $repository
     * @return \Illuminate\Http\Response
     * @throws  \Exception
     */
    public function contactForm(Request $request, InboxReceivedRepository $repository)
    {
        $input = array_except($request->input(), ['_token']);


        if (blank($captcha = array_pull($input, 'contact.verification')) || session::pull('captcha') !== $captcha) {
            return redirect()->back()->withErrors(trans('web.contact.verificationCode_error'))->withInput();
        }

        $input['contact']['category_id'] = 'service-contact';

        $input['contact']['inquiry'] = '';
        if(session::has('inquiry')) {
            $inquiry = session('inquiry');

            $products = ProductIntro::query()
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedActive()
                ->whereIn('id', $inquiry)
                ->distributedActive()->pluck('serial')->toArray() ?? [];


            $input['contact']['inquiry'] = implode(',',$products);
        }

        /*
        $bcc = array();

        $adminUser = AdminUser::query()->where('active',true)
            ->whereNotNull('email')->where('username','!=','sysadmin')->get();
        $bcc = $adminUser ? $adminUser->pluck('email')->toArray() : [];
        */


        try {
            if (blank($repository->createAndTriggerEvent($input['contact']))) {
                return redirect()->back()->withErrors(trans('web.contact.send_error'))->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(trans('web.contact.send_error'))->withInput();
        }

        session::forget('inquiry');


        return redirect()->route("web.page.web-contact")->with('msg',trans('web.contact.send_ok'));

    }


    /**
     * @param  Request $request
     * @param  InboxReceivedRepository $repository
     * @return \Illuminate\Http\Response
     * @throws  \Exception
     */
    public function getProductCategory(Request $request)
    {
        $input = array_except($request->input(), ['_token']);

        $category = ArticleCategory::query()
                ->with([
                    'articleCategories' => function($query){
                        $query->distributedActive()->orderBy('sort');
                    },
                ])
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->where('id',array_get($input,'id'))->distributedOrWhere('code',array_get($input,'id'))
                ->distributedActive()
                ->first() ?? [];


        $html = '';

        foreach(array_get($category,'articleCategories') ?? [] as $key => $item){
            $html .= '<div class="selectOption secCategorySelect FilterSelManuBtn jsFilterMenuBtn"
             data-value="'.array_get($item,'id').'"
             data-title="'.array_get($item,'title').'"
             >
            <div class="FilterSelManuBtnText">'.array_get($item,'title').'</div>
          </div>';
        }


        $arr['re'] = '1';
        $arr['html'] = $html;
        $arr['option'] = array_get($category,'articleCategories.0.title');
        $arr['val'] = array_get($category,'articleCategories.0.id');

        return $arr;


    }



    /**
     * @param  Request $request
     * @return \Illuminate\Http\Response
     * @throws  \Exception
     */
    public function saveAgree(Request $request){
        Session::put('agree-cookie', '1');
        $arr['re'] = '1';

        return $arr;
    }


    /**
     * @param  Request $request
     * @return \Illuminate\Http\Response
     * @throws  \Exception
     */
    public function saveTrack(Request $request){

        $input = array_except($request->input(), ['_token']);
        $type = 'downloaded';

        switch($input['table']){
            case 'download':

                $article = ArticleDownload::where('id',array_get($input,'id'))->first();
                break;
        }

        LogHelper::track($article, $type);
    }





}
