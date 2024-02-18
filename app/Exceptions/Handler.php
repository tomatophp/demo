<?php

namespace App\Exceptions;

use App\Models\User;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Str;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if(Str::contains($e->getMessage(), 'Tenant could not be identified on domain')){
                abort(404, 'Tenant not found');
            }
        });

        $this->renderable(\ProtoneMedia\Splade\SpladeCore::exceptionHandler($this));

        $this->reportable(function (Throwable $e) {
            try {
                $user = User::first();
                $user->notifyDiscord(
                    title: "================= ERROR ================= \n".'MESSAGE: '.$e->getMessage() . ' | FILE: '.$e->getFile().' | LINE: '.$e->getLine().' | URL: ' . url()->current(),
                    webhook: config('services.discord.error-webhook')
                );
            }catch (\Exception $exception){
                // do nothing
            }
        });


    }
}
