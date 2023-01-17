<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortLinkRequest;
use App\Http\Resources\UrlResource;
use App\Models\ShortLink;
use App\Services\UrlService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ShortLinkController extends Controller
{
    private UrlService $service;

    public function __construct(UrlService $service)
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $shortLinks = ShortLink::get();
        return response()->json(UrlResource::collection($shortLinks));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreShortLinkRequest $request
     * @return JsonResponse
     */
    public function store(StoreShortLinkRequest $request): JsonResponse
    {
        $link = $request->input('link');
        $title = $this->service->getTitleFromUrl($link);

        $shortLink = ShortLink::create([
            'code' => Str::random(6),
            'title' => $title,
            'link' => $link,
        ]);

        return response()->json([
            'status' => true,
            'message' => "Short Link Created successfully!",
            'link' => url($shortLink->code)
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * @param $code
     * @return \Illuminate\Routing\Redirector|Application|\Illuminate\Http\RedirectResponse
     */
    public function redirect($code): \Illuminate\Routing\Redirector|Application|\Illuminate\Http\RedirectResponse
    {
        $find = ShortLink::where('code', $code)->first();

        $find->access = $find->access + 1;
        $find->save();

        return redirect($find->link);
    }
}
