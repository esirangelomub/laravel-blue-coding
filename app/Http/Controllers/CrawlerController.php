<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrawlerSearchRequest;
use App\Jobs\CrawlerJob;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\JsonResponse;
use Spatie\Crawler\Crawler;
use Spatie\Crawler\CrawlProfiles\CrawlInternalUrls;
use App\Observers\CrawlerObserver;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CrawlerController extends Controller
{
    /**
     * @param CrawlerSearchRequest $request
     * @return JsonResponse
     */
    public function search(CrawlerSearchRequest $request): JsonResponse
    {
        $url = $request->input('url');

        CrawlerJob::dispatch($url);

        return response()->json([
            'status' => true,
            'message' => "Crawler Scheduled successfully!",
            'data' => $url
        ], ResponseAlias::HTTP_CREATED);
    }
}
