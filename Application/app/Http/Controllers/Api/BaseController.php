<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

abstract class BaseController extends Controller
{
	public function __construct(Request $request)
	{
		parent::__construct($request);
		$this->verifyRequestAcceptsJson();
	}

	protected function verifyRequestAcceptsJson(): void
	{
		if (!$this->request->acceptsJson()) { // Verify Request Accepts JSON
			$this->errorResponse('Must accept JSON response', 406)->send();
			exit(); // Do Not Process Further
		} // End of Verify Request Accepts JSON
	}

	protected function okResponse(array $responsePayload, int $statusCode = 200): JsonResponse
	{
		return new JsonResponse($responsePayload, $statusCode);
	}

	protected function errorResponse(string $errorMessage, int $statusCode = 400): JsonResponse
	{
		return new JsonResponse(array('error' => $errorMessage), $statusCode);
	}

	protected function notFoundResponse(): JsonResponse
	{
		return $this->errorResponse('Not found', 404);
	}

	protected function invalidIdResponse(string $id, string $idResourceName = null): JsonResponse
	{
		return $this->errorResponse('Invalid ' . (!empty($idResourceName) ? $idResourceName . ' ' : null) . 'ID');
	}
}
