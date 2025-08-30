<?php

use App\Http\Controllers\Api\ActivationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BackupFilesController;
use App\Http\Controllers\Api\ConsultingCompanyController;
use App\Http\Controllers\Api\ConsultingEngineerController;
use App\Http\Controllers\Api\EngineerController;
use App\Http\Controllers\Api\EngineerSpecializationController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\Owner\OwnerController;
use App\Http\Controllers\Api\ProjectBillsController;
use App\Http\Controllers\Api\ProjectFilesController;

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProjectManagerController;
use App\Http\Controllers\Api\ProjectStageController;
use App\Http\Controllers\Api\ProjectParticipantController;
use App\Http\Controllers\Api\RealStateManagerController;
use App\Http\Controllers\Api\TaskContainerController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\ProjectContainerController;
use App\Http\Controllers\Api\ProjectSalesDetailsController;
use App\Http\Controllers\Api\PropertyBookController;
use App\Http\Controllers\Api\PropertyBookBillController;
use App\Http\Controllers\Api\ProjectNewsController;
use App\Http\Controllers\Api\ProjectMediaController;
use App\Http\Controllers\Api\UserInstallmentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PropertyUnitController;
use App\Http\Controllers\Api\PropertyUnitOrderController;
use App\Http\Controllers\Api\ContractFlowController;
use App\Http\Controllers\FirebaseNotificationController;
use App\Http\Controllers\Clients\stripeController;
use App\Http\Controllers\TestDocuSignController;
use App\Http\Controllers\View\ClientOrderController;

Route::post('login', [AuthController::class, 'login']);
Route::get('login', function () {
    return view('login-static');
});

Route::post('/testPayment/{orderId}', [StripeController::class, 'doFirstPayment'])->name('api.pay');
Route::prefix('specializations')->group(function () {
    Route::get('/', [EngineerSpecializationController::class, 'index']);
});

Route::middleware('auth:sanctum')->group(function () {
    ///// my-permissions api /////

    Route::get('my-permissions', [AuthController::class, 'myPermissions']);
    ///// activation api /////
    Route::put('users/activate', [ActivationController::class, 'activate']);
    Route::put('users/deactivate', [ActivationController::class, 'deactivate']);
    ///// activation api /////

    Route::prefix('engineers')->group(function () {
        Route::get('/', [EngineerController::class, 'index']);
        Route::get('/all', [EngineerController::class, 'getAll']);
        Route::post('/create', [EngineerController::class, 'create']);
        Route::get('/{id}', [EngineerController::class, 'show']);
        Route::put('update/{id}', [EngineerController::class, 'update']);
        Route::delete('delete/{id}', [EngineerController::class, 'delete']);
    });
    Route::prefix('consultingEngineers')->group(function () {
        Route::get('/{company?}', [ConsultingEngineerController::class, 'index']); //TODO :: FIX THAT 2 ROUTES WITH SAME URL
        Route::get('/all', [ConsultingEngineerController::class, 'getAll']);
        Route::post('/create', [ConsultingEngineerController::class, 'create']); //TODO :: FIX THAT 2 ROUTES WITH SAME URL
        Route::get('/{id}', [ConsultingEngineerController::class, 'show']);
        Route::put('update/{id}', [ConsultingEngineerController::class, 'update']);
        Route::delete('delete/{id}', [ConsultingEngineerController::class, 'delete']);
    });
    Route::prefix('owner')->group(function () {
        Route::get('/', [OwnerController::class, 'index']);
        Route::get('/all', [OwnerController::class, 'getAll']);
        Route::post('/create', [OwnerController::class, 'create']);
        Route::get('/{id}', [OwnerController::class, 'show']);
        Route::put('update/{id}', [OwnerController::class, 'update']);
        Route::delete('delete/{id}', [OwnerController::class, 'delete']);
    });
    Route::prefix('consultingCompany')->group(function () {
        Route::get('/all', [ConsultingCompanyController::class, 'getAll']);
        Route::get('/', [ConsultingCompanyController::class, 'index']);
        Route::get('/{id}', [ConsultingCompanyController::class, 'show']);
        Route::post('/create', [ConsultingCompanyController::class, 'create']);
        Route::put('update/{id}', [ConsultingCompanyController::class, 'update']);
        Route::delete('delete/{id}', [ConsultingCompanyController::class, 'delete']);
    });
    Route::prefix('realStateManager')->group(function () {
        Route::get('/all', [RealStateManagerController::class, 'getAll']);
        Route::get('/', [RealStateManagerController::class, 'index']);
        Route::get('/{id}', [RealStateManagerController::class, 'show']);
        Route::post('/create', [RealStateManagerController::class, 'create']);
        Route::put('update/{id}', [RealStateManagerController::class, 'update']);
        Route::delete('delete/{id}', [RealStateManagerController::class, 'delete']);
    });
    Route::prefix('projectManagers')->group(function () {
        Route::get('/', [ProjectManagerController::class, 'index']);
        Route::get('/all', [ProjectManagerController::class, 'getAll']);
        Route::post('/create', [ProjectManagerController::class, 'create']);
        Route::get('/{id}', [ProjectManagerController::class, 'show']);
        Route::put('update/{id}', [ProjectManagerController::class, 'update']);
        Route::delete('delete/{id}', [ProjectManagerController::class, 'delete']);
    });
    Route::prefix('project')->group(function () {
        Route::get('/all', [ProjectController::class, 'getAll']);
        Route::get('/', [ProjectController::class, 'index']);
        Route::get('/{id}', [ProjectController::class, 'show']);
        Route::post('/create', [ProjectController::class, 'create']);
        Route::put('update/{id}', [ProjectController::class, 'update']);
        Route::delete('delete/{id}', [ProjectController::class, 'delete']);
    });
    Route::prefix('projectStage')->group(function () {
        Route::get('/all/{projectId}', [ProjectStageController::class, 'getAll']);
        Route::get('/{projectId}', [ProjectStageController::class, 'index']); //TODO :: FIX THAT 2 ROUTES WITH SAME URL
        Route::get('/{id}', [ProjectStageController::class, 'show']); //TODO :: FIX THAT 2 ROUTES WITH SAME URL
        Route::post('/create', [ProjectStageController::class, 'create']);
        Route::put('update/{id}', [ProjectStageController::class, 'update']);
        Route::delete('delete/{id}', [ProjectStageController::class, 'delete']);
    });

    Route::prefix('task')->group(function () {
        Route::get('/all/{stageId}', [TaskController::class, 'getAll']);
        Route::get('/{stageId}', [TaskController::class, 'index']); //TODO :: FIX THAT 2 ROUTES WITH SAME URL
        Route::get('/{id}', [TaskController::class, 'show']); //TODO :: FIX THAT 2 ROUTES WITH SAME URL
        Route::post('/create', [TaskController::class, 'create']);
        Route::put('update/{id}', [TaskController::class, 'update']);
        Route::delete('delete/{id}', [TaskController::class, 'delete']);
        //        Route::patch('updateStatusOfTask/{id}', [TaskController::class, 'markTaskAsDone']);
        //        Route::patch('refuseTask/{id}', [TaskController::class, 'refuseTask']);
        //        Route::patch('makeTaskAsDone/{id}', [TaskController::class, 'markTaskAsDoneByExecutionEngineer']);
        Route::put('/{task}/change-status', [TaskController::class, 'changeStatus']);
    });

    Route::prefix('taskContainer')->group(function () {
        Route::get('/all', [TaskContainerController::class, 'getAll']);
        Route::get('/', [TaskContainerController::class, 'index']);
        Route::get('/{id}', [TaskContainerController::class, 'show']);
        Route::post('/create', [TaskContainerController::class, 'create']);
        Route::put('update/{id}', [TaskContainerController::class, 'update']);
        Route::delete('delete/{id}', [TaskContainerController::class, 'delete']);
    });
    Route::prefix('item')->group(function () {
        Route::get('/all', [ItemController::class, 'getAll']);
        Route::get('/', [ItemController::class, 'index']);
        Route::get('/{id}', [ItemController::class, 'show']);
        Route::post('/create', [ItemController::class, 'create']);
        Route::put('update/{id}', [ItemController::class, 'update']);
        Route::delete('delete/{id}', [ItemController::class, 'delete']);
    });

    Route::prefix('projectParticipant')->group(function () {
        Route::get('/all', [ProjectParticipantController::class, 'getAll']);
        Route::get('/', [ProjectParticipantController::class, 'index']);
        Route::get('/{id}', [ProjectParticipantController::class, 'show']);
        Route::post('/create', [ProjectParticipantController::class, 'create']);
        Route::put('update/{id}', [ProjectParticipantController::class, 'update']);
        Route::delete('delete/{id}', [ProjectParticipantController::class, 'delete']);
    });

    Route::prefix('ticket')->group(function () {
        Route::get('/all', [TicketController::class, 'getAll']);
        Route::get('/', [TicketController::class, 'index']);
        Route::get('/{id}', [TicketController::class, 'show']);
        Route::post('/create', [TicketController::class, 'create']);
        Route::put('update/{id}', [TicketController::class, 'update']);
        Route::delete('delete/{id}', [TicketController::class, 'delete']);
        Route::patch('closingTicket/{id}', [TicketController::class, 'changeTicketStatus']);
    });
    Route::prefix('projectFiles')->group(function () {
        Route::get('/{id}/all', [ProjectFilesController::class, 'getAllProjectFiles']);
        Route::get('/paginated/{id}', [ProjectFilesController::class, 'paginate']);
        Route::get('/{id}', [ProjectFilesController::class, 'show']);
        Route::post('/{id}/create', [ProjectFilesController::class, 'create']);
        Route::delete('delete/{id}', [ProjectFilesController::class, 'delete']);
    });
    Route::prefix('BackupFiles')->group(function () {
        Route::get('{id}/all', [BackupFilesController::class, 'getAll']);
        Route::get('{id}', [BackupFilesController::class, 'show']);
        Route::post('/create/{id}', [BackupFilesController::class, 'create']);
    });
    Route::prefix('projectFiles')->group(function () {
        Route::get('/{id}/all', [ProjectFilesController::class, 'getAllProjectFiles']);
        Route::get('/paginated/{id}', [ProjectFilesController::class, 'paginate']);
        Route::get('/{id}', [ProjectFilesController::class, 'show']);
        Route::post('/{id}/create', [ProjectFilesController::class, 'create']);
        Route::delete('delete/{id}', [ProjectFilesController::class, 'delete']);
    });
    Route::prefix('BackupFiles')->group(function () {
        Route::get('{id}/all', [BackupFilesController::class, 'getAll']);
        Route::get('{id}', [BackupFilesController::class, 'show']);
        Route::post('/create/{id}', [BackupFilesController::class, 'create']);
    });
    Route::prefix('projectContainer')->group(function () {
        Route::post('/createNewItems/{id}', [ProjectContainerController::class, 'createIfNotExisit']);
        Route::post('/create/{id}', [ProjectContainerController::class, 'createIfExisit']);
        Route::get('/{id}/all', [ProjectContainerController::class, 'getAll']);
        Route::get('/{id}', [ProjectContainerController::class, 'show']);
        Route::delete('delete/{id}', [ProjectContainerController::class, 'delete']);
        Route::get('{id}/reports', [ProjectContainerController::class, 'getProjectContainerAsReports']);
        Route::get('{id}/warehouse', [ProjectContainerController::class, 'getProjectWareHouseContent']);
        Route::post('{id}/addItemsToWarehouse', [ProjectContainerController::class, 'addItemsToWarehouse']);
    });
    Route::prefix('projectBills')->group(function () {
        Route::get('{projectId}', [ProjectBillsController::class, 'getBillsOfProject']);
        Route::get('DetailsOfBill/{billId}', [ProjectBillsController::class, 'getBillDetails']);
        Route::post('create', [ProjectBillsController::class, 'create']);
    });

    Route::prefix('projectSalesDetails')->group(function () {
        Route::get('/all', [ProjectSalesDetailsController::class, 'getAll']);
        Route::get('/', [ProjectSalesDetailsController::class, 'index']);
        Route::get('/{id}', [ProjectSalesDetailsController::class, 'show']);
        Route::post('/create', [ProjectSalesDetailsController::class, 'create']);
        Route::put('update/{id}', [ProjectSalesDetailsController::class, 'update']);
        Route::delete('delete/{id}', [ProjectSalesDetailsController::class, 'delete']);
    });
    Route::prefix('propertyBook')->group(function () {
        Route::get('/all/{projectId}', [PropertyBookController::class, 'getAll']);
        Route::get('/{projectId}', [PropertyBookController::class, 'index']);
        Route::get('/{id}', [PropertyBookController::class, 'show']);
        Route::post('/create', [PropertyBookController::class, 'create']);
        Route::put('update/{id}', [PropertyBookController::class, 'update']);
        Route::delete('delete/{id}', [PropertyBookController::class, 'delete']);
    });
    Route::prefix('propertyBookBill')->group(function () {
        Route::get('/all/{propertyBookId}', [PropertyBookBillController::class, 'getAll']);
        Route::get('/{propertyBookId}', [PropertyBookBillController::class, 'index']);
        Route::get('/getOne/{id}', [PropertyBookBillController::class, 'show']);
        Route::post('/create', [PropertyBookBillController::class, 'create']);
        Route::put('update/{id}', [PropertyBookBillController::class, 'update']);
        Route::delete('delete/{id}', [PropertyBookBillController::class, 'delete']);
    });
    Route::prefix('projectNews')->group(function () {
        Route::get('/all/{projectId?}', [ProjectNewsController::class, 'getAll']);
        Route::get('/{projectId?}', [ProjectNewsController::class, 'index']);
        Route::get('/{id}', [ProjectNewsController::class, 'show']);
        Route::post('/create', [ProjectNewsController::class, 'create']);
        Route::put('update/{id}', [ProjectNewsController::class, 'update']);
        Route::delete('delete/{id}', [ProjectNewsController::class, 'delete']);
    });
    Route::prefix('projectMedia')->group(function () {
        Route::get('/all/{projectId?}', [ProjectMediaController::class, 'getAll']);
        Route::get('/{projectId?}', [ProjectMediaController::class, 'index']);
        Route::get('/{id}', [ProjectMediaController::class, 'show']);
        Route::post('/create', [ProjectMediaController::class, 'create']);
        Route::put('update/{id}', [ProjectMediaController::class, 'update']);
        Route::delete('delete/{id}', [ProjectMediaController::class, 'delete']);
    });
    Route::prefix('propertyUnit')->group(function () {
        Route::get('/all/{bookId}', [PropertyUnitController::class, 'getPropertyUnitOfBook']);
    });
    Route::prefix('installments')->group(function () {
        Route::get('/{propertyUnitId}/{clientId}', [UserInstallmentsController::class, 'getClientInstallments']);
    });


    Route::prefix('propertyUnitOrder')->group(function () {
        Route::get('/all/{bookId?}', [PropertyUnitOrderController::class, 'getAll']);
        Route::get('/{bookId?}', [PropertyUnitOrderController::class, 'index']);
        Route::get('{id}/orderDetails', [PropertyUnitOrderController::class, 'show']);
        //        Route::post('/create', [PropertyUnitOrderController::class, 'create']);
        //        Route::put('update/{id}', [PropertyUnitOrderController::class, 'update']);
        Route::delete('delete/{id}', [PropertyUnitOrderController::class, 'delete']);
    });

    // تدفق العقد - Contract Flow
    Route::prefix('contract-flow')->group(function () {
        Route::get('/{orderId}/status', [ContractFlowController::class, 'getOrderStatus']);

        // مسارات المدير
        Route::put('/{orderId}/disicion/{status}', [ContractFlowController::class, 'approveOrRejecrOrder']);
        Route::put('/{orderId}/cancel', [ContractFlowController::class, 'cancel']);

        Route::post('/{orderId}/generate-contract', [ContractFlowController::class, 'generateContract']);
        Route::post('/{orderId}/send-signature-code', [ContractFlowController::class, 'sendSignatureCode']);
        Route::put('/{orderId}/sign-by-company', [ContractFlowController::class, 'signContractByCompany']);


        // مسارات العميل
        Route::post('/{orderId}/create-payment-intent', [ContractFlowController::class, 'createPaymentIntent']);
        Route::post('/{orderId}/confirm-payment', [ContractFlowController::class, 'confirmPayment']);
        Route::post('/{orderId}/sign-by-client', [ContractFlowController::class, 'signContractByClient']);
    });
});
Route::prefix('contract-flow')->group(function () {
    Route::get('/activate-account', [ContractFlowController::class, 'activateAccount']);
});


Route::post('/send-notification', [FirebaseNotificationController::class, 'send']);
Route::post('verify-my-contract/{orderId}', [ClientOrderController::class, 'verifyMyContract'])->name('verify-my-contract');

Route::post('/testGetSignedFile/{id}',[TestDocuSignController::class,'downloadSignedDoc'])->name('download');
