<?php



register_shutdown_function(function() {
    if ($error = error_get_last()) {
        var_dump($error);
    }
});

// Fatal error: Call to undefined function undefined_function()
undefined_function();

