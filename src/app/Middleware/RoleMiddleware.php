<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Core\Auth;
use App\Core\Response;

abstract class RoleMiddleware
{
    /** @var string[] */
    protected array $roles = [];

    public function handle(): void
    {
        if (!Auth::check() || !Auth::hasRole(...$this->roles)) {
            Response::abort(403, 'You do not have permission to access this page.');
        }
    }
}

class AdminOnly extends RoleMiddleware { protected array $roles = ['admin']; }
class StaffAccess extends RoleMiddleware { protected array $roles = ['admin', 'staff']; }
class ClinicAccess extends RoleMiddleware { protected array $roles = ['admin', 'staff', 'dentist']; }
