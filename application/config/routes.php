<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Welcome/business_page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['portal'] = 'Works/portal';
$route['portal/verifikasi'] = 'Works/verifikasi';
$route['portal/verifikasiwa'] = 'Works/verifikasiwa';
$route['portal/absen/all'] = 'Works/absen_sebelumnya';
$route['portal/admin'] = 'Welcome/admin_page';
$route['portal/admin/login'] = 'Works/admin_login';
$route['portal/admin/logout'] = 'Works/admin_logout';
$route['portal/settings'] = 'Welcome/admin_settings';
$route['portal/settings/update'] = 'Works/update_admin_settings';
$route['portal/settings/change-avatar'] = 'Works/change_avatar_admin_settings';
$route['portal/membership'] = 'Welcome/admin_membership';
$route['portal/dashboard'] = 'Welcome/admin_dashboard';
$route['portal/management-staff'] = 'Welcome/admin_management_staff';
$route['portal/management-checkpoint'] = 'Welcome/admin_management_checkpoint';
$route['portal/management-attendance'] = 'Welcome/admin_management_attendance';
$route['portal/settings/membership'] = 'Welcome/admin_settings_membership';

$route['portal/upgrade-akun'] = 'Welcome/admin_upgrade_akun';
$route['portal/register'] = 'Welcome/register_page';

// superadmin
$route['portal/management-user'] = 'Welcome/superadmin_management_user';
$route['portal/management-order'] = 'Welcome/superadmin_management_order';
$route['portal/management-order/update-status'] = 'Works/superadmin_management_order_update_stat';
$route['portal/superadmin/login'] = 'Works/superadmin_login';
$route['portal/superadmin/logout'] = 'Works/superadmin_logout';

$route['purchase-membership/update'] = 'Welcome/superadmin_po_update';

$route['attendance/add'] 		= 'Works/add_attendance';
$route['attendance/delete'] 	= 'Works/delete_attendance';
$route['attendance/edit'] 	= 'Works/edit_attendance';
$route['attendance/all'] 		= 'Works/all_attendance';
$route['attendance/update'] 	= 'Works/update_attendance';

$route['user/add'] 		= 'Works/add_user';
$route['user/delete'] 	= 'Works/delete_user';
$route['user/edit'] 	= 'Works/edit_user';
$route['user/all'] 		= 'Works/all_user';
$route['user/update'] 	= 'Works/update_user';
$route['user/upgrade-membership'] 	= 'Works/upgrade_membership';
$route['user/check/email'] 	= 'Works/check_email_user';

// user usage
$route['upgrade-akun/(:any)'] = 'Works/client_upgrade_akun/$1';
$route['purchase-membership/order'] = 'Works/client_po_order';
$route['purchase-membership/order/checkout'] = 'Works/client_po_order_checkout';
$route['purchase-membership/upload-payment'] = 'Works/client_po_upload_payment';

// user activities
$route['portal/bugs/report'] = 'Works/report_bugs';
$route['portal/consultation/request'] = 'Works/request_consultation';
$route['portal/history/consultation'] = 'Welcome/display_all_user_request_bugs';
$route['portal/history/bugs-report'] = 'Welcome/display_all_user_request_bugs';
$route['portal/history/all'] = 'Welcome/display_all_user_history';


$route['checkpoint/add'] 		= 'Works/add_checkpoint';
$route['checkpoint/delete'] 	= 'Works/delete_checkpoint';
$route['checkpoint/edit'] 		= 'Works/edit_checkpoint';
$route['checkpoint/download/pdf'] 		= 'Works/download_pdf_checkpoint';
$route['checkpoint/update'] 	= 'Works/update_checkpoint';
$route['checkpoint/recalibrate'] 	= 'Works/recalibrate_checkpoint';
$route['checkpoint/view'] 	= 'Welcome/display_checkpoint'; // for dynamic iframe


// ini untuk dashboard
$route['summary/dashboard/average'] 	= 'Works/summary_dashboard_average'; 
$route['summary/dashboard/lowest-top'] 	= 'Works/summary_dashboard_lowest_top'; 
$route['summary/dashboard/attendance'] 	= 'Works/summary_dashboard_attendance'; 
$route['summary/dashboard/staff-quota'] 	= 'Works/summary_dashboard_staff_quota'; 

$route['staff/add'] = 'Works/add_staff';
$route['staff/delete'] = 'Works/delete_staff';
$route['staff/edit'] = 'Works/edit_staff';
$route['staff/all'] = 'Works/all_staff';
$route['staff/update'] = 'Works/update_staff';
$route['staff/activate'] = 'Works/activate_staff';
$route['staff/clear-tag'] = 'Works/clear_tag';
$route['staff/division/all'] = 'Works/all_division';
$route['staff/division/add'] = 'Works/add_division';
$route['staff/division/delete'] = 'Works/delete_division';
$route['staff/division/update'] = 'Works/update_division';

// called by email link clicks 
$route['account/register'] = 'Works/register';
$route['account/activate'] = 'Works/activate';


// by client 
$route['install'] = 'Welcome/install';
$route['test'] = 'Welcome/test';

// this is for mobile device -scanner + QRCode
// and also end users
$route['device'] = 'Welcome/device';
$route['device/add-absensi'] = 'Works/add_absensi';
$route['device/all-absensi'] = 'Works/all_absensi';
$route['device/all-staff'] = 'Works/all_staff';

$route['device/initiate-device'] = 'Works/initiate_device';

$route['device/check-code'] = 'Works/check_code';
$route['device/check-qrcode'] = 'Works/check_qrcode';
$route['device/check-device-tag'] = 'Works/check_device_tag';

$route['device/checkpoint/display/(:any)/(:any)'] = 'Works/display_checkpoint_qr/$1/$2';
$route['device/checkpoint/download/(:any)/(:any)'] 	= 'Works/download_checkpoint/$1/$2';
$route['device/signature/new'] = 'Welcome/new_signature';
$route['device/signature/add'] = 'Works/add_signature';

