<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache; 
use Illuminate\Http\Request;

 


class InstagramController extends Controller
{

    public function getFeed()
    {
        $cacheKey = 'instagram_feed';

        if (Cache::has($cacheKey)) {
            $data = Cache::get($cacheKey);
        } else {
            $client = new Client([
               // 'base_uri' => 'https://graph.instagram.com',
            ]);
 


            $url_insta = "https://graph.instagram.com/17841447835661193/media?fields=id,media_type,media_url,permalink,thumbnail_url,username,caption&access_token=IGQVJXdzNmQzRFLUdPUGRsVW5EMUdYd2NtQ3dpUGIyWTdFd2VUNEN1UC1Lak9KdFlqN3dNRjVCbTA3aHlWdzFRT01jSHFwdkFPVHJjLXNZAUGNsaC1PZADVaQzdtdUZAxZA3BuUHpBQzJn";

            
            $response = $client->get($url_insta);

 
            $data = json_decode($response->getBody()->getContents(), true);
            Cache::put($cacheKey, $data, 60); // 캐시 유효 시간 (60초)
        }  
        //return view('instagramfeed', compact('data') ); 
        return view('instagramfeed', ['feed' => $data ]);
    }

    public function getFeed_2()
    {
        $cacheKey = 'instagram_feed';

        if (Cache::has($cacheKey)) {
            $data = Cache::get($cacheKey);
        } else {
            $client = new Client([
                'base_uri' => 'https://api.instagram.com',
            ]);

          //  https://graph.instagram.com/17841447835661193/media?fields=id,media_type,media_url,permalink,thumbnail_url,username,caption&access_token=".$appToken;



            $response = $client->get('/v1/users/self/media/recent', [
                'query' => [
                    'access_token' => config('services.instagram.access_token'),
                    'count' => 10, // 가져올 피드 수
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            Cache::put($cacheKey, $data, 60); // 캐시 유효 시간 (60초)
        }

        return view('welcome', ['data' => $data]);
    }
}
?>