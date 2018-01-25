# AsseticBundle v2.0 Adapter for ZF Expressive

## Installation
 * Register module in your `config/config.php` with `AsseticModule\ConfigProvider::class`
 * Add `AsseticMiddleware` to list in `config/pipeline.php` before `$app->pipeDispatchMiddleware()` 
   with `$app->pipe(AsseticModule\AsseticMiddleware::class);`.
   