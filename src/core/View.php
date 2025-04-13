<?php
class View {
    public function render($view, $data = []) {
        extract($data);
        
        $layout = 'src/views/dashboard/layout.php';
        $content = 'src/views/' . $view . '.php';
        
        if (!file_exists($content)) {
            throw new Exception("View file not found: $content");
        }
        
        ob_start();
        require $content;
        $content = ob_get_clean();
        
        require $layout;
    }
} 