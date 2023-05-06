<?php

namespace RachidLaasri\LaravelInstaller\Helpers;

use Exception;
use Illuminate\Http\Request;

class EnvironmentManager
{
    /**
     * @var string
     */
    private $envPath;

    /**
     * @var string
     */
    private $envExamplePath;

    /**
     * Set the .env and .env.example paths.
     */
    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
    }

    /**
     * Get the content of the .env file.
     *
     * @return string
     */
    public function getEnvContent()
    {
        if (!file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file_get_contents($this->envPath);
    }

    /**
     * Get the the .env file path.
     *
     * @return string
     */
    public function getEnvPath() {
        return $this->envPath;
    }

    /**
     * Get the the .env.example file path.
     *
     * @return string
     */
    public function getEnvExamplePath() {
        return $this->envExamplePath;
    }

    /**
     * Save the edited content to the .env file.
     *
     * @param Request $input
     * @return string
     */
    public function saveFileClassic(Request $input)
    {
        $results = ['is_success'=>true,'message'=>trans('installer_messages.environment.success')];
        try {
            file_put_contents($this->envPath, $input->get('envConfig'));
        }
        catch(Exception $e) {
            $results = ['is_success'=>false,'message'=>trans('installer_messages.environment.errors')];
        }

        return $results;
    }

    /**
     * Save the form content to the .env file.
     *
     * @param Request $request
     * @return string
     */
    public function saveFileWizard(Request $request)
    {
        $results = ['is_success'=>true,'message'=>trans('installer_messages.environment.success')];

        $envFileData =
            "\n".
            'APP_NAME=\'' . $request->app_name . "'\n" .
            'APP_ENV=' . $request->environment . "\n" .
            'APP_KEY=' . 'base64:bODi8VtmENqnjklBmNJzQcTTSC8jNjBysfnjQN59btE=' . "\n" .
            'APP_DEBUG=' . $request->app_debug . "\n" .
            'APP_LOG_LEVEL=' . $request->app_log_level . "\n" .
            'APP_URL=' . $request->app_url . "\n\n" .
            'DB_CONNECTION=' . $request->database_connection . "\n" .
            'DB_HOST=' . $request->database_hostname . "\n" .
            'DB_PORT=' . $request->database_port . "\n" .
            'DB_DATABASE=' . $request->database_name . "\n" .
            'DB_USERNAME=' . $request->database_username . "\n" .
            'DB_PASSWORD=' . $request->database_password . "\n\n" .
            'BROADCAST_DRIVER=' . $request->broadcast_driver . "\n" .
            'CACHE_DRIVER=' . $request->cache_driver . "\n" .
            'SESSION_DRIVER=' . $request->session_driver . "\n" .
            'QUEUE_DRIVER=' . $request->queue_driver . "\n\n" .
            'REDIS_HOST=' . $request->redis_hostname . "\n" .
            'REDIS_PASSWORD=' . $request->redis_password . "\n" .
            'REDIS_PORT=' . $request->redis_port . "\n\n" .
            "MAIL_DRIVER='" . $request->mail_driver . "'\n" .
            "MAIL_HOST='" . $request->mail_host . "'\n" .
            "MAIL_PORT='" . $request->mail_port . "'\n" .
            "MAIL_USERNAME=''\n" .
            "MAIL_PASSWORD=''\n" .
            "MAIL_ENCRYPTION=''\n\n" .
            "PUSHER_APP_ID=''\n" .
            "PUSHER_APP_KEY=''\n" .
            "PUSHER_APP_SECRET=''\n" .
            "PUSHER_APP_CLUSTER=''\n";
            "MAIL_FROM_ADDRESS=''\n";
            "MAIL_FROM_NAME=''\n";
            "CURRENCY_SYMBOL=''\n";
            "CURRENCY=''\n";
            "ENABLE_STRIPE='off'\n";
            "STRIPE_KEY=''\n";
            "STRIPE_SECRET=''\n";
            "STRIPE_WEBHOOK_SECRET=''\n";
            "ENABLE_PAYPAL='off'\n";
            "PAYPAL_MODE='sandbox'\n";
            "PAYPAL_CLIENT_ID=''\n";
            "PAYPAL_SECRET_KEY=''\n";
            "CHAT_MODULE=''\n";

        try {
            file_put_contents($this->envPath, $envFileData);

        }
        catch(Exception $e) {
            $results = ['is_success'=>false,'message'=>trans('installer_messages.environment.errors')];
        }
        return $results;
    }

    public function storageLink(){
        try{
            \Artisan::call('storage:link');
        }
        catch(Exception $e){
            return ['is_success'=>false,'message'=>$e->getMessage()];
        }
        return ['is_success'=>true];
    }
}
