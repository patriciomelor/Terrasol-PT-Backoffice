<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for Cross-Origin Resource Sharing
    | (CORS). You can enable and configure the allowed origins, headers, and
    | methods for your API endpoints.
    |
    */

    /*
     * The paths to which CORS should be applied. The default value is `['api/*']`,
     * which means CORS will be applied to all API routes.
     */
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    /*
     * Allowed methods for cross-origin requests. You can specify multiple methods.
     * The default is `['*']` (allow all methods), but you can restrict it to specific ones like:
     * `['GET', 'POST', 'PUT', 'DELETE']`.
     */
    'allowed_methods' => ['*'],  // Allow all HTTP methods (GET, POST, PUT, DELETE, etc.)

    /*
     * The allowed origins for cross-origin requests. You can specify multiple origins.
     * By default, it is set to `['*']`, which means any domain can access your API.
     * You can replace `*` with specific domains like:
     * `['https://mywebsite.com', 'https://anotherdomain.com']`
     */
    'allowed_origins' => ['*'],  // Replace * with specific origins if necessary

    /*
     * The allowed headers for cross-origin requests. Set to `['*']` by default, which
     * allows all headers to be sent with the request. You can restrict this list if needed.
     */
    'allowed_headers' => ['*'],  // Allow all headers

    /*
     * List of headers that are exposed to the browser.
     * Leave empty for no exposed headers.
     */
    'exposed_headers' => [],  // You can add headers here, e.g., 'X-Auth-Token'

    /*
     * The maximum time (in seconds) that the preflight response can be cached by the browser.
     * The default is `0`, meaning no caching.
     */
    'max_age' => 0,  // Default 0 means no caching

    /*
     * Whether or not to support credentials (cookies, HTTP authentication).
     * If you are dealing with cookies, set this to `true`.
     */
    'supports_credentials' => false,  // Change to true if your app requires credentials (cookies, etc.)

];
