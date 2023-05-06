<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager;
use RachidLaasri\LaravelInstaller\Events\EnvironmentSaved;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Artisan;

class EnvironmentController extends Controller
{
    /**
     * @var EnvironmentManager
     */
    protected $EnvironmentManager;

    /**
     * @param EnvironmentManager $environmentManager
     */
    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->EnvironmentManager = $environmentManager;
    }

    /**
     * Display the Environment menu page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentMenu()
    {
        return view('vendor.installer.environment');
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentWizard()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();

        return view('vendor.installer.environment-wizard', compact('envConfig'));
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentClassic()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();

        return view('vendor.installer.environment-classic', compact('envConfig'));
    }

    /**
     * Processes the newly saved environment configuration (Classic).
     *
     * @param Request $input
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveClassic(Request $input, Redirector $redirect)
    {
        $results = $this->EnvironmentManager->saveFileClassic($input);
        if($results['is_success']) {
            event(new EnvironmentSaved($input));
            Artisan::call('config:cache');
            return $redirect->route('LaravelInstaller::environmentClassic')->with(['message' => $results['message']]);
        }else{
            \Session::put('error_message', $results['message']);
            return  $redirect->route('LaravelInstaller::environmentClassic');
        }
    }

    /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param Request $request
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveWizard(Request $request, Redirector $redirect)
    {
        try {
            $conn = new \mysqli($request->database_hostname, $request->database_username, $request->database_password, $request->database_name, $request->database_port);
        }
        catch(\Exception $e) {
            \Session::put('error_message', $e->getMessage());
            return  $redirect->route('LaravelInstaller::environmentWizard');
        }

        $rules = config('installer.environment.form.rules');
        $messages = [
            'environment_custom.required_if' => trans('installer_messages.environment.wizard.form.name_required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return view('vendor.installer.environment-wizard', compact('errors'));
        }

        $results = $this->EnvironmentManager->saveFileWizard($request);

        if($results['is_success']) {
            event(new EnvironmentSaved($request));
            Artisan::call('config:cache');
            return $redirect->route('LaravelInstaller::database')->with(['results' => $results['message']]);
        }else{
            \Session::put('error_message', $results['message']);
            return  $redirect->route('LaravelInstaller::environmentWizard');
        }
    }
}
