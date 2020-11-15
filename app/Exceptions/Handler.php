<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];

	/**
	 * Report or log an exception.
	 *
	 * @throws \Exception
	 *
	 * @return void
	 */
	public function report(Throwable $exception)
	{
		parent::report($exception);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @throws \Throwable
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function render($request, Throwable $exception)
	{
		if ($exception instanceof MethodNotAllowedHttpException) {
			abort(404);
		}

		return parent::render($request, $exception);
	}
}
