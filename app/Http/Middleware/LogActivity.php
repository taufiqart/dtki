<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\UserSystemInfoHelper;
use Illuminate\Support\Facades\Auth;

class LogActivity
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */

	public function handle(Request $request, Closure $next)
	{
		$response = $next($request);
		// if(app()->environment('local')){
		// }
		$ip = UserSystemInfoHelper::get_ip();
		$os = UserSystemInfoHelper::get_os();
		$browser = UserSystemInfoHelper::get_browsers();
		$device = UserSystemInfoHelper::get_device();
		$user_agent = UserSystemInfoHelper::get_user_agent();
		
		$credentials = [
			'username' => $request->username,
			'password' => $request->password
		];

		if(Auth::attempt($credentials)){
			$request_data = [
				'URL' => $request->getUri(),
				'METHOD' => $request->getMethod(),
			];
		}else{
			$request_data = [
				'URL' => $request->getUri(),
				'METHOD' => $request->getMethod(),
				'BODY' => $request->all(),
				'RESPONSE' => $request->getContent(),
			];
		}
		$location = geoip()->getLocation($ip)->toArray();
		$info = [
			'os' => $os,
			'browser' => $browser,
			'device' => $device,
			'user_agent' => $user_agent
		];
		$location += $info;
		
		Log::channel('logactivity')->info(json_encode($location),$request_data);
		
		return $response;
	}
}
