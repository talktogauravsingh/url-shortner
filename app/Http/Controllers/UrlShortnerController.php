<?php

namespace App\Http\Controllers;

use App\Models\UrlShortner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UrlShortnerController extends Controller
{
    //
    private $length = 10;
    private $charachters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

    public $longUrl = '';
    public $url_tag = 'url-shortner';

    public $deviceType = [ 'desktop', 'mobile', 'tablet' ];

    private function generateShortUrlPrefix(){
        $this->length = 10;
        $urlPrefix = "";
        for ($i=0; $i < $this->length; $i++) {
            $urlPrefix .= $this->charachters[mt_rand(0, strlen($this->charachters)-1)];
        }

        return $this->checkPrefixExistanceAndSave($urlPrefix);
    }

    protected function bindPrefixWithUrl($urlPrefix){
        return url('').'/'.$urlPrefix;
    }

    private function checkPrefixExistanceAndSave($urlPrefix){
        try {
            $urlShortner = new UrlShortner();
            $urlShortner->url_tag = $this->url_tag;
            $urlShortner->url_prefix = $urlPrefix;
            $urlShortner->url = $this->longUrl;
            $urlShortner->short_url = $this->bindPrefixWithUrl($urlPrefix);
            if($urlShortner->save()){
                return $this->bindPrefixWithUrl($urlPrefix);
            }else{
                return $this->generateShortUrlPrefix();
            }
        } catch (\Exception $e) {
            return $this->generateShortUrlPrefix();
        }
    }

    public function getShortUrl(Request $request){
        try {

            $request->validate([
                'url' => 'required',
                'url_tag' => 'max:20',
            ]);

            $this->longUrl = $request->url;
            $this->url_tag = $request->url_tag;

            return response()->json([
                'status' => false,
                'message' => 'Everything is ok',
                'data' => [
                    'short_url' => $this->generateShortUrlPrefix()
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }

    private function getBrowserName($userAgent){
        $userAgent = strtolower($userAgent);
        if(str_contains($userAgent, 'chrome') || str_contains($userAgent, 'crios')){
            return 'chrome';
        }elseif(str_contains($userAgent, 'firefox') || str_contains($userAgent, 'fxios') || str_contains($userAgent, 'focus')){
            return 'firefox';
        }elseif(str_contains($userAgent, 'opr')){
            return 'opera';
        }else{
            return 'Not-Detected';
        }
    }

    private function deviceType($userAgent){
        $userAgent = strtolower($userAgent);
        if(str_contains($userAgent, 'mobile')){
            return $this->deviceType[1];
        }else{
            return $this->deviceType[0];
        }
    }

    // http://127.0.0.1:8000/EAQKxuz56m

    public function urlGateway(Request $request){
        // dd($request->prefix);
        $data = UrlShortner::where('url_prefix', $request->prefix)->first();

        if (!$data) {
            return abort(404);
        }

        // tracking data
        $urlInfo = [
            'click' => 1,
            'ip' => request()->ip(),
            'browserName' => $this->getBrowserName($request->header('user-agent')),
            'deviceType' => $this->deviceType($request->header('user-agent'))
        ];

        dd($request, $urlInfo);

        return Redirect::to($data->url);

    }


}
