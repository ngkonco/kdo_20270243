<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SecurityHeadersFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal running. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param array|null $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // No before action needed for security headers
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param array|null $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 1. Prevent Clickjacking
        $response->setHeader('X-Frame-Options', 'SAMEORIGIN');

        // 2. Prevent MIME-type sniffing
        $response->setHeader('X-Content-Type-Options', 'nosniff');

        // 3. Referrer Policy
        $response->setHeader('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 4. Cross-Site Scripting (legacy browsers fallback)
        $response->setHeader('X-XSS-Protection', '1; mode=block');

        // 5. Permissions Policy
        $response->setHeader('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // 6. Content Security Policy (allows CDNs for Bootstrap, FontAwesome, Chart.js, DataTables, UI-Avatars, and Sourcemaps)
        $csp = "default-src 'self'; "
            . "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://code.jquery.com https://cdn.datatables.net; "
            . "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.googleapis.com https://cdn.datatables.net; "
            . "font-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.gstatic.com data:; "
            . "img-src 'self' data: https: https://ui-avatars.com; "
            . "connect-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://cdn.datatables.net;";
        $response->setHeader('Content-Security-Policy', $csp);

        return $response;
    }
}

