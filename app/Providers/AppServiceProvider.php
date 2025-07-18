<?php

namespace App\Providers;

use App\Domain\Services\BackupFileService;
use App\Domain\Services\BaseServices\ActivationService;
use App\Domain\Services\BaseServices\AuthService;
use App\Domain\Services\BaseServices\ClientAuthService;
use App\Domain\Services\BaseServices\Contracts\ActivationServiceInterface;
use App\Domain\Services\BaseServices\Contracts\AuthServiceInterface;
use App\Domain\Services\BaseServices\Contracts\ClientAuthServiceInterface;
use App\Domain\Services\ConsultingCompanyService;
use App\Domain\Services\ConsultingEngineerService;
use App\Domain\Services\Contracts\BackupFileServiceInterface;
use App\Domain\Services\Contracts\ConsultingCompanyServiceInterface;
use App\Domain\Services\Contracts\ConsultingEngineerServiceInterface;
use App\Domain\Services\Contracts\EngineerServiceInterface;
use App\Domain\Services\Contracts\EngineerSpecializationServiceInterface;
use App\Domain\Services\Contracts\Owner\OwnerServiceInterface;
use App\Domain\Services\Contracts\ProjectBillDetailServiceInterface;
use App\Domain\Services\Contracts\ProjectBillServiceInterface;
use App\Domain\Services\Contracts\ProjectFileServiceInterface;
use App\Domain\Services\Contracts\ProjectManagerServiceInterface;
use App\Domain\Services\Contracts\ProjectServiceInterface;
use App\Domain\Services\Contracts\ProjectStageServiceInterface;

use App\Domain\Services\Contracts\RealStateManagerServiceInterface;
use App\Domain\Services\Contracts\TaskContainerServiceInterface;
use App\Domain\Services\Contracts\TaskServiceInterface;
use App\Domain\Services\Contracts\UserServiceInterface;
use App\Domain\Services\EngineerService;
use App\Domain\Services\EngineerSpecializationService;
use App\Domain\Services\Owner\OwnerService;
use App\Domain\Services\ProjectBillDetailService;
use App\Domain\Services\ProjectBillService;
use App\Domain\Services\ProjectManagerService;
use App\Domain\Services\ProjectService;
use App\Domain\Services\ProjectStageService;
use App\Domain\Services\ProjectFileService;
use App\Domain\Services\RealStateManagerService;
use App\Domain\Services\TaskContainerService;
use App\Domain\Services\TaskService;
use App\Domain\Services\UserService;
use App\Domain\Services\Contracts\ItemServiceInterface;
use App\Domain\Services\Contracts\ProjectContainerServiceInterface;
use App\Domain\Services\Contracts\ProjectParticipantServiceInterface;
use App\Domain\Services\Contracts\TicketServiceInterface;
use App\Domain\Services\Contracts\ProjectSalesDetailsServiceInterface;
use App\Domain\Services\Contracts\PropertyBookServiceInterface;
use App\Domain\Services\Contracts\PropertyBookBillServiceInterface;
use App\Domain\Services\Contracts\ProjectNewsServiceInterface;
use App\Domain\Services\Contracts\ProjectMediaServiceInterface;
use App\Domain\Services\ItemService;
use App\Domain\Services\ProjectContainerService;
use App\Domain\Services\ProjectParticipantService;
use App\Domain\Services\ProjectSalesDetailsService;
use App\Domain\Services\PropertyBookService;
use App\Domain\Services\PropertyBookBillService;
use App\Domain\Services\ProjectNewsService;
use App\Domain\Services\ProjectMediaService;
use App\Domain\Services\TicketService;
use App\Domain\Services\Contracts\PropertyUnitServiceInterface;
use App\Domain\Services\PropertyUnitService;
use App\Infrastructure\Repositories\Contracts\PropertyUnitRepositoryInterface;
use App\Infrastructure\Repositories\PropertyUnitRepository;
use App\Infrastructure\Repositories\BackupFileRepository;
use App\Infrastructure\Repositories\BaseRepository;
use App\Infrastructure\Repositories\ClientRepository;
use App\Infrastructure\Repositories\ConsultingCompanyRepository;
use App\Infrastructure\Repositories\ConsultingEngineerRepository;
use App\Infrastructure\Repositories\Contracts\BackupFileRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\BaseRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ClientRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ConsultingCompanyRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ConsultingEngineerRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\EngineerRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\EngineerSpecializationRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ItemRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\OwnerRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectBillDetailRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectBillRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectContainerRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectFileRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectManagerRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectParticipantRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectStageRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\RealStateManagerRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\TaskContainerRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\TaskRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\TicketRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectSalesDetailsRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\PropertyBookRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\PropertyBookBillRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectNewsRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectMediaRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\UserRepositoryInterface;
use App\Infrastructure\Repositories\EngineerRepository;
use App\Infrastructure\Repositories\EngineerSpecializationRepository;
use App\Infrastructure\Repositories\ItemRepository;
use App\Infrastructure\Repositories\OwnerRepository;
use App\Infrastructure\Repositories\ProjectBillDetailRepository;
use App\Infrastructure\Repositories\ProjectBillRepository;
use App\Infrastructure\Repositories\ProjectContainerRepository;
use App\Infrastructure\Repositories\ProjectManagerRepository;
use App\Infrastructure\Repositories\ProjectParticipantRepository;
use App\Infrastructure\Repositories\ProjectFileRepository;
use App\Infrastructure\Repositories\ProjectRepository;
use App\Infrastructure\Repositories\ProjectStageRepository;
use App\Infrastructure\Repositories\RealStateManagerRepository;
use App\Infrastructure\Repositories\TaskContainerRepository;
use App\Infrastructure\Repositories\TaskRepository;
use App\Infrastructure\Repositories\ProjectSalesDetailsRepository;
use App\Infrastructure\Repositories\PropertyBookRepository;
use App\Infrastructure\Repositories\PropertyBookBillRepository;
use App\Infrastructure\Repositories\ProjectNewsRepository;
use App\Infrastructure\Repositories\ProjectMediaRepository;
use App\Infrastructure\Repositories\TicketRepository;
use App\Infrastructure\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use App\Domain\Services\Contracts\PropertyUnitOrderServiceInterface;
use App\Domain\Services\Contracts\StripeServiceInterface;
use App\Domain\Services\Contracts\UserPropertyUnitInstallmentsServiceInterface;
use App\Domain\Services\PropertyUnitOrderService;
use App\Domain\Services\StripeService;
use App\Domain\Services\UserPropertyUnitInstallmentsService;
use App\Infrastructure\Repositories\Contracts\PropertyUnitOrderRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\UserPropertyUnitInstallmentsRepositoryInterface;
use App\Infrastructure\Repositories\PropertyUnitOrderRepository;
use App\Infrastructure\Repositories\UserPropertyUnitInstallmentsRepository;
use App\Domain\Services\Contracts\IPFSServiceServiceInterface;
use App\Domain\Services\IPFSServiceService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindRepositories();
        $this->bindServices();
        $this->app->bind(IPFSServiceServiceInterface::class, IPFSServiceService::class);
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
        $this->app->bind(OwnerRepositoryInterface::class, OwnerRepository::class);
        $this->app->bind(ConsultingCompanyRepositoryInterface::class, ConsultingCompanyRepository::class);
        $this->app->bind(RealStateManagerRepositoryInterface::class, RealStateManagerRepository::class);
        $this->app->bind(ProjectManagerRepositoryInterface::class, ProjectManagerRepository::class);


        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(ProjectStageRepositoryInterface::class, ProjectStageRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(TaskContainerRepositoryInterface::class, TaskContainerRepository::class);
        $this->app->bind(ItemRepositoryInterface::class, ItemRepository::class);
        // In the bindRepositories method
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(ProjectParticipantRepositoryInterface::class, ProjectParticipantRepository::class);
        $this->app->bind(ProjectFileRepositoryInterface::class, ProjectFileRepository::class);
        $this->app->bind(BackupFileRepositoryInterface::class, BackupFileRepository::class);
        $this->app->bind(ProjectFileRepositoryInterface::class, ProjectFileRepository::class);
        $this->app->bind(ProjectContainerRepositoryInterface::class, ProjectContainerRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(ProjectBillRepositoryInterface::class, ProjectBillRepository::class);
        $this->app->bind(ProjectBillDetailRepositoryInterface::class, ProjectBillDetailRepository::class);
        $this->app->bind(ProjectSalesDetailsRepositoryInterface::class, ProjectSalesDetailsRepository::class);
        $this->app->bind(PropertyBookRepositoryInterface::class, PropertyBookRepository::class);
        $this->app->bind(PropertyBookBillRepositoryInterface::class, PropertyBookBillRepository::class);
        $this->app->bind(ProjectNewsRepositoryInterface::class, ProjectNewsRepository::class);
        $this->app->bind(ProjectMediaRepositoryInterface::class, ProjectMediaRepository::class);
        $this->app->bind(PropertyUnitRepositoryInterface::class, PropertyUnitRepository::class);
        $this->app->bind(PropertyUnitOrderRepositoryInterface::class, PropertyUnitOrderRepository::class);
        $this->app->bind(UserPropertyUnitInstallmentsRepositoryInterface::class, UserPropertyUnitInstallmentsRepository::class);
    }

    /**
     * Bind service interfaces to implementations.
     */
    private function bindServices(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(ActivationServiceInterface::class, ActivationService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(EngineerServiceInterface::class, EngineerService::class);
        $this->app->bind(EngineerSpecializationServiceInterface::class, EngineerSpecializationService::class);
        $this->app->bind(ConsultingEngineerServiceInterface::class, ConsultingEngineerService::class);
        $this->app->bind(ConsultingCompanyServiceInterface::class, ConsultingCompanyService::class);
        $this->app->bind(OwnerServiceInterface::class, OwnerService::class);
        $this->app->bind(RealStateManagerServiceInterface::class, RealStateManagerService::class);
        $this->app->bind(ProjectManagerServiceInterface::class, ProjectManagerService::class);

        $this->app->bind(ProjectFileServiceInterface::class, ProjectFileService::class);
        $this->app->bind(BackupFileServiceInterface::class, BackupFileService::class);

        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);
        $this->app->bind(ProjectStageServiceInterface::class, ProjectStageService::class);
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        $this->app->bind(TaskContainerServiceInterface::class, TaskContainerService::class);
        $this->app->bind(ItemServiceInterface::class, ItemService::class);
        // In the bindServices method
        $this->app->bind(TicketServiceInterface::class, TicketService::class);
        $this->app->bind(ProjectParticipantServiceInterface::class, ProjectParticipantService::class);
        $this->app->bind(ProjectContainerServiceInterface::class, ProjectContainerService::class);
        $this->app->bind(ClientAuthServiceInterface::class, ClientAuthService::class);
        $this->app->bind(ProjectBillServiceInterface::class, ProjectBillService::class);
        $this->app->bind(ProjectBillDetailServiceInterface::class, ProjectBillDetailService::class);
        $this->app->bind(ProjectSalesDetailsServiceInterface::class, ProjectSalesDetailsService::class);
        $this->app->bind(PropertyBookServiceInterface::class, PropertyBookService::class);
        $this->app->bind(PropertyBookBillServiceInterface::class, PropertyBookBillService::class);
        $this->app->bind(ProjectNewsServiceInterface::class, ProjectNewsService::class);
        $this->app->bind(ProjectMediaServiceInterface::class, ProjectMediaService::class);
        $this->app->bind(PropertyUnitServiceInterface::class, PropertyUnitService::class);
        $this->app->bind(PropertyUnitOrderServiceInterface::class, PropertyUnitOrderService::class);
        $this->app->bind(UserPropertyUnitInstallmentsServiceInterface::class, UserPropertyUnitInstallmentsService::class);
        $this->app->bind(\App\Domain\Services\Contracts\EmailServiceServiceInterface::class, \App\Domain\Services\EmailServiceService::class);
        $this->app->bind(\App\Domain\Services\Contracts\PaymentServiceServiceInterface::class, \App\Domain\Services\PaymentServiceService::class);
        $this->app->bind(\App\Domain\Services\Contracts\ContractServiceServiceInterface::class, \App\Domain\Services\ContractServiceService::class);
        $this->app->bind(StripeServiceInterface::class,StripeService::class);
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'consulting_engineer' => \App\Models\ConsultingEngineer::class,
            'engineer' => \App\Models\Engineer::class,
            'project_manager' => \App\Models\ProjectManager::class,
        ]);
    }
}
