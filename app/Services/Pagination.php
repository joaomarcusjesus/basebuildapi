<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class Pagination
{
	public function make($model, $page, $perPage, $request)
	{
		$collection = collect($model);

		$pagination = new Paginator($collection->forPage($page, $perPage), $collection->count(), $perPage, $page, 
			[
				'path' => $request->getPathInfo()
			]
		);
		
		return $pagination->appends($request->except('page'));
	}
}
