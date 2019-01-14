<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AdvertisingStore;
use App\Http\Requests\AdvertisingUpdate;
use App\Services\AdvertisingServices;
use App\Http\Controllers\Controller;

class AdvertisingController extends Controller
{
    protected $advertisingServices;

    public function __construct(AdvertisingServices $advertisingServices)
    {
        parent::__construct();

        $this->advertisingServices = $advertisingServices;
    }

    /**
     * Get all advertising.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $advertising = $this->advertisingServices->getAllAdvertising();

        return view('backend.advertising.index', [
            'data' => $advertising
        ]);
    }

    /**
     * Create advertising.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.advertising.create');
    }

    /**
     * Store advertising.
     * @param AdvertisingStore $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(AdvertisingStore $request)
    {
        $respon = $this->advertisingServices->createAdvertising($request);

        return redirect()->route('advertising.index')->with([
            'success' => $respon
        ]);
    }

    /**
     * Edit advertising.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advertising = $this->advertisingServices->getAdvertisingById($id);

        return view('backend.advertising.update', [
            'data' => $advertising
        ]);
    }

    /**
     * Update advertising.
     * @param AdvertisingUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(AdvertisingUpdate $request, $id)
    {
        $response = $this->advertisingServices->updateAdvertising($request, $id);

        return redirect()->route('advertising.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Delete advertising.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->advertisingServices->deleteAdvertisingById($id);

        return redirect()->route('advertising.index')->with([
            'success' => 'Delete successful'
        ]);
    }
}
