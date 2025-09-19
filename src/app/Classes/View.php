<?php

namespace App\Classes;

class View
{
    public static function render(string $view, array $data = []): void
    {
        // Define base URL for assets and navigation
        $baseUrl = '/Dev25Expenies';
        $publicUrl = $baseUrl . '/public';
        $assetsUrl = $baseUrl . '/public/assets';
        
        // Add to data array
        $data['baseUrl'] = $publicUrl;
        $data['assetsUrl'] = $assetsUrl;
        
        // Extract variables for the view
        extract($data);
        
        ob_start();
        require BASE_PATH . "/src/app/Views/{$view}.php";
        $content = ob_get_clean();
        
        require BASE_PATH . "/src/app/Views/layouts/main.php";
    }
}
