<?php

$router = $di->getRouter();

// Define your routes here

//Router for the root folder
$router->add("/",
[
  'namespace' => 'Hms\Modules\Account\Controllers',
  'module' => 'account',
  'controller' => 'account', 
  'action' => 'index',    
]
);

$router->add("/AuthentificationController",
[
  'namespace' => 'Hms\Modules\Account\Controllers',
  'module' => 'account',
  'controller' => 'authentification',
  'action' => 'login',
]
);

$router->notFound(
    [
  'namespace' => 'Hms\Modules\Account\Controllers',
  'module' => 'account',
  'controller' => 'account', 
  'action' => 'index',    
    ]
);

$router->add("/AuthentificationController/authentificated/selectAccount",
[
  'namespace' => 'Hms\Modules\Account\Controllers',
  'module' => 'account',
  'controller' => 'authentification', 
  'action' => 'select',
]
);

//Dashboard
/*$router->add("/Dashboard/",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'administrator', 
  'action' => 'dashboard',
]
);*/

//Administrator Routes
$router->add("/modules/Admin/Dashboard",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'administrator', 
  'action' => 'dashboard',    
]
);

$router->add("/modules/Admin/managePatients",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'administrator', 
  'action' => 'manage_patients',    
]
);

$router->add("/modules/Admin/viewPatient/:params",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'administrator', 
  'action' => 'view',    
  'params' => 1,
]
);

$router->add("/modules/Admin/manageStaffs",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'administrator', 
  'action' => 'manage_staffs',    
]
);

$router->add("/modules/Admin/addNewStaff",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'administrator', 
  'action' => 'add_new_staff',    
]
);

$router->add("/modules/Admin/addNewStaffController",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'staff', 
  'action' => 'create',    
]
);

$router->add("/modules/Admin/viewStaff/:params",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'staff', 
  'action' => 'view',    
  'params' => 1
]
);


$router->add("/modules/Admin/editStaff/:params",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'staff', 
  'action' => 'edit',    
  'params' => 1
]
);

$router->add("/modules/Admin/editStaffController",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'staff', 
  'action' => 'save', 
]
);

$router->add("/modules/Admin/deleteStaffController/:params",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'staff', 
  'action' => 'delete',    
  'params' => 1
]
);

$router->add("/modules/Admin/scheduleDuties",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'administrator', 
  'action' => 'schedule_duties',    
]
);

$router->add("/modules/Admin/getDuties",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'administrator', 
  'action' => 'get_duties',    
]
);

//Receptionist routes
$router->add("/modules/Receptionist/Dashboard",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'receptionist', 
  'action' => 'dashboard',    
]
);

$router->add("/modules/Receptionist/addPatient",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'receptionist', 
  'action' => 'add_new_patient',    
]
);

$router->add("/modules/Receptionist/addNewPatientController",
[
  'namespace' => 'Hms\Modules\Administrator\Controllers',
  'module' => 'administrator',
  'controller' => 'patient', 
  'action' => 'create',    
]
);

$router->add("/modules/Receptionist/viewPatients",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'receptionist', 
  'action' => 'manage_patients',    
]
);

$router->add("/modules/Receptionist/viewPatient/:params",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'patient', 
  'action' => 'view',    
  'params' => 1,
]
);

$router->add("/modules/Receptionist/markPatient",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'patient', 
  'action' => 'mark_patient',    
]
);

$router->add("/modules/Receptionist/manageRooms",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'rooms', 
  'action' => 'manage_rooms',
]
);

$router->add("/modules/Receptionist/viewRoom/:params",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'rooms', 
  'action' => 'view',    
  'params' => 1,
]
);

$router->add("/modules/Receptionist/addNewRoom",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'rooms', 
  'action' => 'add_new_room',
]
);

$router->add("/modules/Receptionist/viewRoom/allocateBed/:params",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'rooms', 
  'action' => 'allocate_bed',    
  'params' => 1,
]
);

$router->add("/modules/Receptionist/viewRoom/allocateBedController/{id}/patient/{p_id}",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'rooms', 
  'action' => 'bed_allocator',    
]
);

$router->add("/modules/Receptionist/viewRoom/deallocateBed/{id}",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'rooms', 
  'action' => 'deallocate_bed',
]
);

$router->add("/modules/Receptionist/createNewRoomController",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'rooms', 
  'action' => 'create_new_room',    
]
);

$router->add("/modules/Receptionist/scheduleAppointments",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'receptionist', 
  'action' => 'schedule_appointments',    
]
);

$router->add("/modules/Receptionist/getAppointments",
[
  'namespace' => 'Hms\Modules\Receptionist\Controllers',
  'module' => 'receptionist',
  'controller' => 'receptionist', 
  'action' => 'get_appointments',    
]
);
//Laboratory Attendant Routes
$router->add("/modules/Laboratory/Dashboard",
[
  'namespace' => 'Hms\Modules\Laboratory\Controllers',
  'module' => 'laboratory',
  'controller' => 'laboratory', 
  'action' => 'dashboard',    
]
);

$router->add("/modules/Laboratory/createLabResult",
[
  'namespace' => 'Hms\Modules\Laboratory\Controllers',
  'module' => 'laboratory',
  'controller' => 'laboratory', 
  'action' => 'view',    
]
);

$router->add("/modules/Laboratory/createLabResult/patient/:params",
[
  'namespace' => 'Hms\Modules\Laboratory\Controllers',
  'module' => 'laboratory',
  'controller' => 'laboratory', 
  'action' => 'create_new',    
  'params' => 1,
]
);

$router->add("/modules/Laboratory/createNewLabResultController",
[
  'namespace' => 'Hms\Modules\Laboratory\Controllers',
  'module' => 'laboratory',
  'controller' => 'laboratory', 
  'action' => 'create',    
]
);

$router->add("/modules/Laboratory/checkPatientRecords",
[
  'namespace' => 'Hms\Modules\Laboratory\Controllers',
  'module' => 'laboratory',
  'controller' => 'laboratory', 
  'action' => 'view_patients',    
]
);

$router->add("/modules/Laboratory/checkPatientRecords/patient/:params",
[
  'namespace' => 'Hms\Modules\Laboratory\Controllers',
  'module' => 'laboratory',
  'controller' => 'laboratory', 
  'action' => 'view_records',    
  'params' => 1,
]
);

//Accountant Routes
$router->add("/modules/Accountant/Dashboard",
[
  'namespace' => 'Hms\Modules\Accountant\Controllers',
  'module' => 'accountant',
  'controller' => 'accountant', 
  'action' => 'Dashboard',    
]
);

$router->add("/modules/Accountant/printReceipt",
[
  'namespace' => 'Hms\Modules\Accountant\Controllers',
  'module' => 'accountant',
  'controller' => 'accountant', 
  'action' => 'print_receipt',    
]
);

$router->add("/modules/Accountant/createBill",
[
  'namespace' => 'Hms\Modules\Accountant\Controllers',
  'module' => 'accountant',
  'controller' => 'accountant', 
  'action' => 'create_bill',    
]
);

$router->add("/modules/Accountant/createNewBill/patient/:params",
[
  'namespace' => 'Hms\Modules\Accountant\Controllers',
  'module' => 'accountant',
  'controller' => 'accountant', 
  'action' => 'create_new',
  'params' => 1,    
]
);

$router->add("/modules/Accountant/createNewBillController",
[
  'namespace' => 'Hms\Modules\Accountant\Controllers',
  'module' => 'accountant',
  'controller' => 'accountant', 
  'action' => 'create',    
]
);

$router->add("/modules/Accountant/manageMedicalBills",
[
  'namespace' => 'Hms\Modules\Accountant\Controllers',
  'module' => 'accountant',
  'controller' => 'accountant', 
  'action' => 'view',    
]
);

$router->add("/modules/Accountant/checkPatientBills",
[
  'namespace' => 'Hms\Modules\Accountant\Controllers',
  'module' => 'accountant',
  'controller' => 'accountant', 
  'action' => 'select_patient',    
]
);

$router->add("/modules/Accountant/checkPatientBills/patient/:params",
[
  'namespace' => 'Hms\Modules\Accountant\Controllers',
  'module' => 'accountant',
  'controller' => 'accountant', 
  'action' => 'view_records',    
  'params' => 1
]
);

$router->handle();
