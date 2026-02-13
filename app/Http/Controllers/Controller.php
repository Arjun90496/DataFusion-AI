<?php

namespace App\Http\Controllers;

/**
 * Base Controller
 * 
 * All application controllers extend this class.
 * It provides a central place for shared logic, although in Laravel 11
 * it is kept minimal by default.
 */
abstract class Controller
{
    /**
     * Standardized Success Response
     * 
     * Use this to send consistent JSON responses to your frontend.
     * 
     * @param mixed $data The data to return
     * @param string $message Success message
     * @param int $code HTTP status code
     */
    protected function success($data = null, string $message = 'Operation successful', int $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Standardized Error Response
     * 
     * Use this to handle failures in a uniform way across all controllers.
     * 
     * @param string $message Error message
     * @param int $code HTTP status code
     * @param mixed $errors Specific validation errors or details
     */
    protected function error(string $message = 'An error occurred', int $code = 400, $errors = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
