<?php

/*
 * NOTICE OF LICENSE
 *
 * Part of the Rinvex Support Package.
 *
 * This source file is subject to The MIT License (MIT)
 * that is bundled with this package in the LICENSE file.
 *
 * Package: Rinvex Support Package
 * License: The MIT License (MIT)
 * Link:    https://rinvex.com
 */

namespace Rinvex\Support\Http\Controllers;

use Illuminate\Routing\Controller;
use Rinvex\Support\Traits\Redirectable;
use Rinvex\Support\Traits\Validateable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Rinvex\Support\Contracts\ValidationContract;
use Rinvex\Support\Contracts\RedirectionContract;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class BasicController extends Controller implements ValidationContract, RedirectionContract
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, Validateable, Redirectable;

    /**
     * The current logged in user instance.
     *
     * @var \Rinvex\Fort\Models\User
     */
    protected $currentUser;

    /**
     * Create a new basic controller instance.
     *
     * @param \Illuminate\Contracts\Auth\Factory $auth
     *
     * @return void
     */
    public function __construct(AuthFactory $auth)
    {
        $this->currentUser = $auth->user();

        $this->setValidationFactory(app(ValidationFactory::class));

        view()->share(['currentUser' => $this->currentUser]);
    }
}
