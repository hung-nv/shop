<?php

namespace App\Services;


use App\Models\Article;
use Illuminate\Support\Facades\DB;

class OrderServices
{
    public function saveOrder($dataRequest)
    {
        try {
            DB::beginTransaction();

            $response = $this->saveOrderPackage($dataRequest);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    /**
     * @param $dataRequest
     * @return int
     */
    public function saveOrderPackage($dataRequest)
    {
        return Article::count('id');
    }
}