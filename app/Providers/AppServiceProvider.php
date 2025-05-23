<?php

namespace App\Providers;

use App\Domain\Services\BaseServices\ActivationService;
use App\Domain\Services\BaseServices\Contracts\ActivationServiceInterface;
use App\Domain\Services\ConsultingEngineerService;
use App\Domain\Services\Contracts\ConsultingEngineerServiceInterface;
use App\Domain\Services\Contracts\EngineerServiceInterface;
use App\Domain\Services\Contracts\EngineerSpecializationServiceInterface;
use App\Domain\Services\Contracts\UserServiceInterface;
use App\Domain\Services\EngineerService;
use App\Domain\Services\EngineerSpecializationService;
use App\Domain\Services\UserService;
use App\Infrastructure\Repositories\BaseRepository;
use App\Infrastructure\Repositories\ConsultingEngineerRepository;
use App\Infrastructure\Repositories\Contracts\BaseRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ConsultingEngineerRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\EngineerRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\EngineerSpecializationRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\UserRepositoryInterface;
use App\Infrastructure\Repositories\EngineerRepository;
use App\Infrastructure\Repositories\EngineerSpecializationRepository;
use App\Infrastructure\Repositories\ProjectRepository;
use App\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindRepositories();
        $this->bindServices();
    }

    /**
     * Bind repository interfaces to implementations.
     */
    private function bindRepositories(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(EngineerRepositoryInterface::class, EngineerRepository::class);
        $this->app->bind(EngineerSpecializationRepositoryInterface::class, EngineerSpecializationRepository::class);

        $this->app->bind(ConsultingEngineerRepositoryInterface::class, ConsultingEngineerRepository::class);

    }

    /**
     * Bind service interfaces to implementations.
     */
    private function bindServices(): void
    {
        $this->app->bind(ActivationServiceInterface::class, ActivationService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(EngineerServiceInterface::class, EngineerService::class);
        $this->app->bind(EngineerSpecializationServiceInterface::class, EngineerSpecializationService::class);
        $this->app->bind(ConsultingEngineerServiceInterface::class, ConsultingEngineerService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
