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
$route['portal/membership'] = 'Welcome/admin_membership';
$route['portal/dashboard'] = 'Welcome/admin_dashboard';
$route['portal/management-staff'] = 'Welcome/admin_management_staff';
$route['portal/attendance'] = 'Welcome/admin_attendance';
$route['portal/upgrade-akun'] = 'Welcome/admin_upgrade_akun';
$route['portal/register'] = 'Welcome/register_page';

$route['account/register'] = 'Works/register';
$route['account/activate'] = 'Works/activate';
// called by email link clicks 

$route['staff/add'] = 'Works/add_staff';
$route['staff/delete'] = 'Works/delete_staff';
$route['staff/edit'] = 'Works/edit_staff';
$route['staff/update'] = 'Works/update_staff';
$route['staff/activate'] = 'Works/activate_staff';

$route['install'] = 'Welcome/install';
$route['test'] = 'Welcome/test';

// this is for mobile device -scanner
$route['device'] = 'Welcome/device';
$route['device/add-absensi'] = 'Works/add_absensi';