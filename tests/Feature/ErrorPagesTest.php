<?php

namespace Tests\Feature;

use Tests\TestCase;

class ErrorPagesTest extends TestCase
{
    public function test_404_error_page_renders_successfully(): void
    {
        $response = $this->get('/non-existent-page-url-xyz');

        $response->assertStatus(404);
        $response->assertSee('404');
        $response->assertSee('Page Not Found');
        $response->assertSee('AP Corporate CMS');
    }

    public function test_error_views_compile_without_errors(): void
    {
        $errorCodes = ['401', '403', '419', '500', '503'];

        foreach ($errorCodes as $code) {
            $view = view("errors.{$code}", [
                'exception' => new \Exception("Test message for {$code}")
            ]);
            
            $rendered = $view->render();
            
            $this->assertStringContainsString($code, $rendered);
            $this->assertStringContainsString('AP Corporate CMS', $rendered);
        }
    }
}
