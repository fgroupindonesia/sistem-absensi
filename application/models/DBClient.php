<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DBClient extends CI_Model {

    protected $db2;

    // NOTES :
    // $this->db is actually db_fgi_portal_v2
    // whereas
    // $this->db2 is actually db_fgi_sistem_absensi_v1

    public function __construct() {
        parent::__construct();
        $this->reload();
    }



  public function getAllStaffAttendanceByToken($token)
{
    $this->db2->select('a.id, s.name as staff_name, c.name as checkpoint_name, a.signature_pic, a.status, a.date_created');
    $this->db2->from('table_attendance a');
    $this->db2->join('table_staff s', 's.id = a.staff_id', 'left');
    $this->db2->join('table_checkpoint c', 'c.id = a.checkpoint_id', 'left');
    $this->db2->where('a.public_token', $token);
    $query = $this->db2->get();

    return $query->result(); // kembalikan array objek untuk view
}

public function getSpecificStaffAttendanceByToken($filter)
{

    $id = $filter['staff_id'];
    $token = $filter['public_token'];

    $this->db2->select('a.id, s.name as staff_name, c.name as checkpoint_name, a.signature_pic, a.status, a.date_created');
    $this->db2->from('table_attendance a');
    $this->db2->join('table_staff s', 's.id = a.staff_id', 'left');
    $this->db2->join('table_checkpoint c', 'c.id = a.checkpoint_id', 'left');
    $this->db2->where('a.public_token', $token);
    $this->db2->where('a.staff_id', $id);

    $query = $this->db2->get();

    return $query->result(); // kembalikan array objek untuk view
}



    public function deleteUser($id, $token){

        $this->db2->where('public_token', $token)->delete('table_membership');

        return $this->db2->where('id', $id)->delete('table_user');


    }

    public function addNewUser($data_insert, $data_membership){

            $this->db2->insert('table_user', $data_insert);
            $hasil = $this->db2->insert_id(); 

            if(!empty($data_membership)){
                $this->db2->insert('table_membership', $data_membership);
                //$hasil = $this->db2->insert_id();                 
            }

            return $hasil;
    }

   public function getAllUsers()
    {
        //$query = $this->db2->get('table_user'); 
        //return $query->result(); // bisa result() atau result_array()
        $this->db2->select('u.*, m.name as membership');
        $this->db2->from('table_membership m');
        $this->db2->join('table_user u','u.public_token = m.public_token', 'right');
        $query = $this->db2->get();

    if ($query->num_rows() > 0) {
        return $query->result();
    }

     return false;

    }

 public function getSpecificUser($id)
{
    $this->db2->select('u.*, m.name as membership');
    $this->db2->from('table_user u');
    $this->db2->join('table_membership m', 'u.public_token = m.public_token', 'left');
    $this->db2->where('u.id', $id);
    $query = $this->db2->get();

    if ($query->num_rows() > 0) {
        return $query->row();
    }

    return false;
}



    public function getAllMembershipOrders(){
        $this->db2->select('o.*, u.username');
        $this->db2->from('table_order_membership o');
        $this->db2->join('table_user u','u.public_token = o.public_token', 'left');
        $query = $this->db2->get();

    if ($query->num_rows() > 0) {
        return $query->result();
    }

     return false;

    }

   public function updateMembershipOrder($orderId, $data) {
    // Validasi input
    if(!$orderId || empty($data['status']) || empty($data['public_token']) || empty($data['membership_name'])) {
        return false;
    }

    $newStatus  = $data['status'];
    $token      = $data['public_token'];
    $membership = $data['membership_name'];

    $quota_final = $data['quota_final'];

    // clear dulu karena ga ada columnya di order table
    unset($data['quota_final']);

    // Ambil order sebelumnya (untuk history)
    $order = $this->db2->get_where('table_order_membership', ['id' => $orderId])->row();

    if(!$order) {
        return false;
    }

    // Update status order
    $this->db2->where('id', $orderId);
    $update = $this->db2->update('table_order_membership', ['status' => $newStatus]);

    if(!$update) {
        return false;
    }

    // Insert history
    $historyData = [
        'order_id'       => $orderId,
        'status'         => $newStatus,
        'membership_name'=> $membership,
        'public_token'   => $token
    ];

    $this->db2->insert('table_order_membership_history', $historyData);

    $membership_update = [
        'name' => $membership,
        'quota_limit' => $quota_final
    ];

    $membership_filter = [
        'public_token' => $token
    ];

    $this->db2->where($membership_filter)->update('table_membership', $membership_update);

    return true;
}


    public function getUpgradeAccountsOrdered(){

         $this->db2->from('table_order_membership');
         $row = $this->db2->count_all_results();
        return $row;

    }


public function getAllOrderHistoryByToken($token){

       $query = $this->db2
        ->where('public_token', $token)
        ->order_by('date_created', 'DESC') // urut dari terbaru
        ->get('table_order_membership_history'); // nama tabelnya

    if ($query->num_rows() > 0) {
        return $query->result();
    }

     return false;

}

public function update_order_membership($id, $data)
{

    // update dulu table_order_membership
     // update data utama di table_order_membership
    $this->db2->where('id', $id)
              ->update('table_order_membership', $data);

    // trus insert data history ke table_order_membership_history
    $history = array(
        'order_id'          => $id,
        'status'            => $data['status'],
        'membership_name'   => $data['membership_name'],
        'public_token'      => $data['public_token']
    );

    $this->db2->insert('table_order_membership_history', $history);

    return true;    


}

public function order_upgrade_membership($akun, $token)
{
    // filter berdasarkan token
    $filter = ['public_token' => $token];

    // cek apakah sudah ada data order membership
    $data = $this->db2->where($filter)
                      ->get('table_order_membership')
                      ->row();

    // data baru yang mau diinsert
    $data_insert = [
        'membership_name' => $akun,
        'status' => 'pending',
        'public_token' => $token
    ];

    $hasil = false;

    if (empty($data)) {
        // insert data baru
        $this->db2->insert('table_order_membership', $data_insert);
        $hasil = $this->db2->insert_id(); // id terakhir yang diinsert

        // insert lagi ke history jaga jaga doang
        unset($data_insert['user_id']);
        $data_insert['order_id'] = $hasil;
        $this->db2->insert('table_order_membership_history', $data_insert);
    } 

    return $hasil;
}


public function activateCheckpoint($data_filter){

    $data_update = array(
        'status' => $data_filter['status']
    );


    unset($data_filter['status']);


        $this->db2->where($data_filter);
        return $this->db2->update('table_checkpoint', $data_update);

}

public function activateStaff($data_filter, $kondisi){

    $data_update = array(
        'status' => 'active'
    );


    if($kondisi == false){

        $data_update = array(
        'status' => 'inactive'
        );

    }

        $this->db2->where($data_filter);
        return $this->db2->update('table_staff', $data_update);

}

public function getTotalUsers(){
    $this->db2->where('user_type !=', 'admin');
     return $this->db2->count_all_results('table_user'); 
}

public function get_unit_divisionname_by_ids($unit_id)
{
    $this->db2->select('id, division_name');
    $this->db2->from('table_division');

    if (is_array($unit_id)) {
        $this->db2->where_in('id', $unit_id);
    } else {
        $this->db2->where('id', $unit_id);
    }

    $query = $this->db2->get();

    if ($query->num_rows() > 0) {
        // return array dengan key = id, value = division_name
        $result = [];
        foreach ($query->result_array() as $row) {
            $result[] = $row['division_name'];
        }
        return $result;
    }

    return [];
}



public function update_checkpoint($data_filter, $data_update) {
    
    if(isset($data_update['division'])){
        $division = $data_update['division'];
    }

    $id = $data_filter['id'];

    // hapus division biar gak ikut ke table_checkpoint
    if(isset($data_update['division'])){
        unset($data_update['division']);    
    }
    
    // update checkpoint
    $this->db2->where($data_filter);
    $hasil = $this->db2->update('table_checkpoint', $data_update);

    if ($hasil) {
        // hapus relasi lama
        $this->db2->where('checkpoint_id', $id)
                  ->delete('table_checkpoint_division');

        // insert relasi baru
    if(isset($division)){
        foreach ($division as $div) {
            $data_anyar = [
                'checkpoint_id' => $id,
                'division_id'   => $div
            ];
            $this->db2->insert('table_checkpoint_division', $data_anyar);
        }

    }

    }

    return $hasil;
}


 public function update_avatar($user_id, $filename) {
        $this->db2->where('id', $user_id);
        return $this->db2->update('table_user', ['avatar' => $filename]);
    }

public function get_checkpoint_by_url($data){

    return $this->db2
        ->get_where('table_checkpoint', [
            'url' => $data['url']
        ])
        ->row();
}

  public function get_all_request_consultation($token)
{
    return $this->db2
        ->get_where('table_bugs_consultation', [
            'type_work' => 'consultation',
            'public_token' => $token
        ])
        ->result();
}

public function get_all_bugs_report($token)
{
    return $this->db2
        ->get_where('table_bugs_consultation', [
            'type_work' => 'bugs',
            'public_token' => $token
        ])
        ->result();
}


    public function save_request_consultation($judul, $deskripsi, $token)
    {
        $data = [
            'title' => $judul,
            'description' => $deskripsi,
            'status' => 'pending',
            'type_work' => 'consultation',
            'public_token' => $token
        ];

        return $this->db2->insert('table_bugs_consultation', $data);
    }

    public function save_report_bug($data, $files)
{
    $screenshot = 'none.jpg';
    if (!empty($files['screenshot']['name'])) {
        $config['upload_path'] = './assets/uploads/bugs_report_consultation/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('screenshot')) {
            $uploadData = $this->upload->data();
            // later location viewed by UI we just store the filename only
            $screenshot = $uploadData['file_name'];
        }
    }

    $insertData = [
        'title' => $data['title'],
        'priority_bugs' => $data['priority_bugs'],
        'description' => $data['description'],
        'url' => $data['url'],
        'screenshot' => $screenshot,
        'status' => 'pending',
        'type_work' => 'bugs',
        'public_token' => $data['public_token']
    ];

    $insert = $this->db2->insert('table_bugs_consultation', $insertData);

    if ($insert) {
        return ['status' => 'success', 'message' => 'Laporan berhasil dikirim!'];
    } else {
        return ['status' => 'failed', 'message' => 'Gagal menyimpan laporan.'];
    }
}


  public function get_staff_quota_data($public_token)
{
    // Ambil data membership
    $membership = $this->db2->get_where('table_membership', ['public_token' => $public_token])->row();
    if (!$membership) {
        return ['status' => false, 'message' => 'Token not found'];
    }

    $quota_used = (int)$membership->quota_used;
    $quota_limit = (int)$membership->quota_limit;

    // Ambil jumlah staff per divisi via table_staff_division
    $this->db2->select('d.division_name, COUNT(s.id) as staff_count');
    $this->db2->from('table_staff_division sd');
    $this->db2->join('table_staff s', 's.id = sd.staff_id');
    $this->db2->join('table_division d', 'd.id = sd.division_id');
    $this->db2->where('s.public_token', $public_token);
    $this->db2->group_by('sd.division_id');

    $query = $this->db2->get();
    $staff_data = $query->result();

    $divisions = [];
    $total_staff = 0;

    foreach ($staff_data as $row) {
        $total_staff += $row->staff_count;
    }

    foreach ($staff_data as $row) {
        $percentage = $quota_limit > 0 ? round(($row->staff_count / $quota_limit) * 100, 2) : 0;
        $divisions[] = [
            'division_name' => $row->division_name,
            'staff_count'   => $row->staff_count,
            'percentage'    => $percentage
        ];
    }

    $datana = [
        'quota_used'   => $quota_used,
        'quota_limit'  => $quota_limit,
        'divisions'    => $divisions,
        'total_staff'  => $total_staff
    ];

    return [
        'status' => true,
        'data' => $datana
    ];
}


     public function getAllDivisionsByToken($arrayCome){
        $hasil = false;
        
        $this->db2->where($arrayCome);
        $query =  $this->db2->get('table_division');

        if($query->num_rows() > 0){
            //$hasil = $query->row();
            $hasil = $query->result();
        }

        return $hasil;
    }

    public function add_new_division($data){

     
        $insert_id = null;

        // Cek apakah nama sudah ada
        $this->db2->where($data);
        $query = $this->db2->get('table_division');

        if ($query->num_rows() == 0) {
            
            $this->db2->insert('table_division', $data);
            $insert_id = $this->db2->insert_id();
        } 

        return $insert_id;

    }

    public function getSummaryAttendanceBy($filterNa){

       $this->db2->select('
        s.name,
        COUNT(CASE WHEN a.status = "hadir" THEN 1 END) as total_hadir,
        COUNT(CASE WHEN a.status != "hadir" THEN 1 END) as total_tidak_hadir,
        (COUNT(CASE WHEN a.status = "hadir" THEN 1 END) / COUNT(a.id) * 100) as persentase_hadir
    ');
    $this->db2->from('table_attendance a');
    $this->db2->join('table_staff s', 'a.staff_id = s.id', 'left');
    
    if(!empty($filterNa))
    $this->db2->where($filterNa);
    // Filter untuk bulan ini
    $this->db2->where('YEAR(a.date_created)', date('Y'));
    $this->db2->where('MONTH(a.date_created)', date('m'));
    $this->db2->group_by('s.id, s.name');
    $query = $this->db2->get();
    
    return $query->result();

    }

    public function getSummaryStaffCountAttendance($filterNa) {
    // Subquery untuk mendapatkan waktu absen pertama setiap staff per hari
    $this->db2->select('
        s.id as staff_id,
        s.name,
        DATE(a.date_created) as attendance_date,
        MIN(TIME(a.date_created)) as first_checkin_time
    ');
    $this->db2->from('table_attendance a');
    $this->db2->join('table_staff s', 'a.staff_id = s.id', 'left');
    $this->db2->where('a.status', 'hadir');
    if (!empty($filterNa)) {
        $this->db2->where($filterNa); // Terapkan filter, misalnya a.public_token
    }
    $this->db2->where('YEAR(a.date_created)', date('Y'));
    $this->db2->where('MONTH(a.date_created)', date('m'));
    $this->db2->group_by('s.id, DATE(a.date_created)');
    
    // Membungkus subquery
    $subquery = $this->db2->get_compiled_select();
    
    // Query utama untuk menghitung jumlah staff di setiap kategori
    $this->db2->select('
        COUNT(DISTINCT CASE WHEN first_checkin_time < "07:30:00" THEN staff_id END) as total_early,
        COUNT(DISTINCT CASE WHEN first_checkin_time BETWEEN "07:25:00" AND "07:35:00" THEN staff_id END) as total_ontime,
        COUNT(DISTINCT CASE WHEN first_checkin_time > "07:35:00" THEN staff_id END) as total_late
    ');
    $this->db2->from("($subquery) as sub");
    
    $query = $this->db2->get();
    
    // Log query untuk debugging
    //log_message('debug', 'SQL Query: ' . $this->db2->last_query());
    
    return $query->row(); // Mengembalikan satu baris dengan total_early, total_ontime, total_late
}

public function getSummaryAverageAttendanceBy($data) {
       
        // Tentukan rentang waktu 7 hari terakhir
        $end_date = date('Y-m-d');
        $start_date = date('Y-m-d', strtotime('-6 days')); // 7 hari termasuk hari ini

        // 1. Hitung total staf aktif berdasarkan public_token
        $this->db2->select('COUNT(*) as total_active_staff');
        $this->db2->from('table_staff');
        $this->db2->where($data);
        $this->db2->where('status', 'active'); // Asumsi hanya staf aktif yang dihitung
        $query = $this->db2->get();
        $total_active_staff = $query->row()->total_active_staff;

        // 2. Hitung total kehadiran (status = 'present') dalam 7 hari terakhir
        $this->db2->select('COUNT(*) as total_attendance');
        $this->db2->from('table_attendance a');
        $this->db2->where($data);
        $this->db2->where('a.date_created >=', $start_date);
        $this->db2->where('a.date_created <=', $end_date);
        $this->db2->where('a.status', 'hadir');
        $query = $this->db2->get();
        $total_attendance = $query->row()->total_attendance;

        // 3. Hitung jumlah staf yang aktif (memiliki setidaknya 1 kehadiran)
        $this->db2->select('COUNT(DISTINCT a.staff_id) as active_staff_count');
        $this->db2->from('table_attendance a');
        $this->db2->where($data);
        $this->db2->where('a.date_created >=', $start_date);
        $this->db2->where('a.date_created <=', $end_date);
        $this->db2->where('a.status', 'hadir');
        $query = $this->db2->get();
        $active_staff_count = $query->row()->active_staff_count;

        // 4. Hitung staf yang tidak terdata (tidak ada catatan kehadiran)
        $this->db2->select('COUNT(*) as non_recorded_staff');
        $this->db2->from('table_staff s');
        $this->db2->where($data);
        $this->db2->where('s.status', 'active');
        $this->db2->where("NOT EXISTS (
            SELECT 1 FROM table_attendance a
            WHERE a.staff_id = s.id
            AND a.date_created >= '$start_date'
            AND a.date_created <= '$end_date'
        )");
        $query = $this->db2->get();
        $non_recorded_staff = $query->row()->non_recorded_staff;

        // 5. Hitung persentase
        $total_possible_attendance = $total_active_staff * 7; // Total hari kerja mungkin (staf aktif × 7 hari)
        $attendance_percentage = ($total_possible_attendance > 0) ? 
            round(($total_attendance / $total_possible_attendance) * 100, 2) : 0;
        $non_recorded_percentage = ($total_active_staff > 0) ? 
            round(($non_recorded_staff / $total_active_staff) * 100, 2) : 0;

        // 6. Siapkan hasil
        $result = array(
            'attendance_percentage' => $attendance_percentage, // Persentase kehadiran
            'non_recorded_percentage' => $non_recorded_percentage, // Persentase staf tidak terdata
            'active_staff_count' => $active_staff_count // Jumlah staf aktif
        );

        return $result;
    }

    public function verifyStaff($filter){
        $hasil = false;

      
        
       $this->db2->where($filter);
       $query = $this->db2->get('table_staff');

        if($query->num_rows() > 0){
            $hasil = $query->row();
        }

        return $hasil;

    }

     public function verifyByColumn($col, $val){

        $hasil = false;

        $filterNa = array(
                        $col => $val
        );
        
       $this->db2->where($filterNa);
       $query = $this->db2->get('table_staff');

        if($query->num_rows() > 0){
            $hasil = $query->row();
        }

        return $hasil;

    }

    public function verifySpecificByColumn($table, $col, $val){

        $hasil = false;

        $filterNa = array(
                        $col => $val
        );
        
       $this->db2->where($filterNa);
       $query = $this->db2->get($table);

        if($query->num_rows() > 0){
            $hasil = $query->row();
        }

        return $hasil;

    }

     public function getCheckpointByTokenAndID($dataArray)
{
    // ambil checkpoint dulu
    $this->db2->where([
        'public_token' => $dataArray['public_token'],
        'id'           => $dataArray['id']
    ]);
    
    $checkpoint = $this->db2->get('table_checkpoint')->row();

    return $checkpoint;
}

    public function getStaffByTokenAndID($dataArray)
{
    // ambil staff dulu
    $this->db2->where([
        'public_token' => $dataArray['public_token'],
        'id'           => $dataArray['id']
    ]);
    $staff = $this->db2->get('table_staff')->row();

    if ($staff) {
        // ambil divisi terkait
        $this->db2->select('d.id, d.division_name');
        $this->db2->from('table_staff_division sd');
        $this->db2->join('table_division d', 'sd.division_id = d.id');
        $this->db2->where('sd.staff_id', $staff->id);
        $query = $this->db2->get();
        $staff->divisions = $query->result(); // array of object
    }

    return $staff;
}

public function clearStaffTagBy($dataFilter){

    $data = array(
        'device_tag' => null 
    );

    $this->db2->where($dataFilter);
        $this->db2->update('table_staff', $data);
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;

}

 public function getAllStaffWithDivision($public_token) {
    $this->db2->select('
        s.name, 
        s.whatsapp, 
        s.email, 
        s.status,
        s.device_tag, 
        s.notes, 
        s.public_token, 
        s.id, 
        GROUP_CONCAT(d.division_name SEPARATOR ", ") AS unit_division
    ', FALSE);
    $this->db2->from('table_staff s');
    $this->db2->join('table_staff_division sd', 's.id = sd.staff_id', 'left');
    $this->db2->join('table_division d', 'sd.division_id = d.id', 'left');
    $this->db2->where('s.public_token', $public_token);
    $this->db2->group_by('s.id');

    $query = $this->db2->get();
    return $query->result();
}



    public function getAllStaffByToken($ptoken){
        $hasil = false;
        $selection = array('public_token' => $ptoken);

        $this->db2->where($selection);
        $query =  $this->db2->get('table_staff');

        if($query->num_rows() > 0){
            //$hasil = $query->row();
            $hasil = $query->result();
        }

        return $hasil;
    }

      public function getStaffByTokenAndWa($arrayCome){
        $hasil = false;
        $selection = array(
            'public_token' => $arrayCome['public_token'],
            'whatsapp'     => $arrayCome['whatsapp']
        );

        $this->db2->where($selection);
        $query =  $this->db2->get('table_staff');

        if($query->num_rows() > 0){
            //$hasil = $query->row();
            $hasil = $query->row();
        }

        return $hasil;
    }

     public function getAllStaffByTokenLimit($ptoken, $limit){
        $hasil = false;

         $this->db2->select('s.*, GROUP_CONCAT(d.division_name SEPARATOR ", ") as unit_division');
    $this->db2->from('table_staff s');
    $this->db2->join('table_staff_division sd', 's.id = sd.staff_id', 'left');
    $this->db2->join('table_division d', 'sd.division_id = d.id', 'left');
    $this->db2->where('s.public_token', $public_token);
    $this->db2->limit($limit);
    $this->db2->group_by('s.id');

    $query = $this->db2->get();

        if($query->num_rows() > 0){
            //$hasil = $query->row();
            $hasil = $query->result();
        }

        return $hasil;
    }

    public function getSpecificBy($table_name, $filter){

        $this->db2->where($filter);
        $query =  $this->db2->get($table_name);

        $hasil = false;
        
        if($query->num_rows() > 0){
            $hasil = $query->row();
            //$hasil = $query->result();
            
        }

        return $hasil;

    }

      public function getMembershipByToken($ptoken){
        $hasil = false;
        $selection = array('public_token' => $ptoken);

        $this->db2->where($selection);
        $query =  $this->db2->get('table_membership');

        if($query->num_rows() > 0){
            $hasil = $query->row();
            //$hasil = $query->result();
            
        }

        return $hasil;
    }

    public function update_existing_checkpoint($data){

        $this->reload();

        $id = $data['id'];
        $dataFilter = array('id' => $id);

        $this->db2->where($dataFilter);
        $this->db2->update('table_checkpoint', $data);
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;

    }

 public function getTotalStaffByToken($ptoken) {
    $this->db2->where('public_token', $ptoken);
    $query = $this->db2->get('table_staff');

    $count = $query->num_rows();

   
    return $count;
}


    public function getAllCheckpointByToken($ptoken){

         $hasil = false;
        $selection = array('public_token' => $ptoken);

        $this->db2->where($selection);
        $query =  $this->db2->get('table_checkpoint');

        if($query->num_rows() > 0){
            //$hasil = $query->row();
            $hasil = $query->result();
            
        }

        return $hasil;

    }

public function update_existing_attendance($data)
{
    $id = $data['id'];
    $staff_id = $id;

    $token = $data['public_token'];

    // update table_attendance utama
    $this->db2->where('id', $id);
    $updated = $this->db2->update('table_attendance', $data);

    return ($updated);
}

  public function update_existing_staff($data)
{
    $id = $data['id'];
    $staff_id = $id;

    $token = $data['public_token'];

    $unit_division = $data['unit_division'] ?? [];

    unset($data['unit_division']);

    // update staff utama
    $this->db2->where('id', $id);
    $updated = $this->db2->update('table_staff', $data);

    // clear data relasi lama
    $this->db2->where('staff_id', $staff_id);
    $deleted = $this->db2->delete('table_staff_division');

    // insert data relasi baru
    $inserted = true;
    if (!empty($unit_division) && is_array($unit_division)) {
        foreach ($unit_division as $division_id) {
            if (!empty($division_id) && is_numeric($division_id)) {
                $inserted = $this->db2->insert('table_staff_division', [
                    'staff_id' => $staff_id,
                    'division_id' => $division_id,
                    'public_token' => $token
                ]) && $inserted;
            }
        }
    }

    return ($updated || $deleted || $inserted);
}


     public function delete_existing_staff($data){

       // $this->reload();

        $id = $data['id'];
        $dataFilter = array('id' => $id);

        $this->db2->where($dataFilter);
        $this->db2->delete('table_staff');
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;

    }

     public function delete_existing_attendance($data){

       // $this->reload();

        $id = $data['id'];
        $dataFilter = array('id' => $id);

        $this->db2->where($dataFilter);
        $this->db2->delete('table_attendance');
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;

    }

    public function update_user($data) {
        

        $dataFilter = array('id' => $data['id']);

        $this->db2->where($dataFilter);
        $this->db2->update('table_user', $data);
        return $this->db2->affected_rows() > 0;
 

}

  public function update_membership($public_token, $membershipData) {
        
        $this->db2->where('public_token', $public_token);
        $this->db2->update('table_membership', $membershipData);
        return $this->db2->affected_rows() > 0;
 
}



public function update_division($data) {
    

    $dataFilter = array('id' => $data['id']);

        $this->db2->where($dataFilter);
        $this->db2->update('table_division', $data);
        return $this->db2->affected_rows() > 0;
 

}

public function add_checkpoint_division($data){

    $checkpoint_id  = $data['checkpoint_id'];
    $division_id    = $data['division_id'];
    $public_token   = $data['public_token'];

    $this->db->insert('table_checkpoint_division', [
        'checkpoint_id' => $checkpoint_id,
        'division_id'   => $division_id,
        'public_token'  => $public_token
    ]);
}


  public function delete_division($data){

       $this->reload();

$id = $data['id'];
$dataFilter = array('division_id' => $id); // for related tables

// Start transaction
$this->db2->trans_start();

// Delete from main division table
$this->db2->where('id', $id);
$this->db2->delete('table_division');

// Delete from checkpoint division table
$this->db2->where($dataFilter);
$this->db2->delete('table_checkpoint_division');

// Delete from staff division table
$this->db2->where($dataFilter);
$this->db2->delete('table_staff_division');

// Complete the transaction
$this->db2->trans_complete();

// Return true if all deletions succeeded
return $this->db2->trans_status();

    }


    public function add_new_user($data){

        $this->reload();

        $email = $data['email'];
        $dataFilter = array('email' => $email);

        $existing_data = $this->db2->get_where('table_user', $dataFilter)->row();

        if(!$existing_data){

        $this->db2->insert('table_user', $data);
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;
        }

        return false;

    }

    public function delete_checkpoint($data)
{
    if (!isset($data['id']) || !isset($data['public_token'])) {
        return false; // Data tidak lengkap
    }

        $this->db2->where($data);
        $this->db2->delete('table_checkpoint');

         return $this->db2->affected_rows() > 0;

}


   public function check_status_checkpoint($dataFilter)
{
    // timezone jakarta
    date_default_timezone_set('Asia/Jakarta');
    $now = new DateTime();

    $existing_data = $this->db2->get_where('table_checkpoint', $dataFilter)->row();

    //echo "<pre>";
    //echo "FILTER:\n";
    //print_r($dataFilter);

    //echo "EXISTING DATA:\n";
    //print_r($existing_data);

    if (!$existing_data) {
        //echo "Data tidak ditemukan\n";
        return false;
    }

    // Build starting datetime
    $startDatetime = DateTime::createFromFormat(
        'Y-m-d H:i:s',
        $existing_data->starting_date . ' ' . $existing_data->starting_time
    );

    //echo "NOW: " . $now->format('Y-m-d H:i:s') . "\n";
    //echo "START: " . $startDatetime->format('Y-m-d H:i:s') . "\n";

    $expireDatetime = null;

    switch ($existing_data->expired_mode) {
        case 'unlimited':
            //echo "EXPIRED MODE: unlimited\n";
            $expireDatetime = null;
            break;
        case '1 hour after':
            //echo "EXPIRED MODE: 1 hour\n";
            $expireDatetime = clone $startDatetime;
            $expireDatetime->modify('+1 hour');
            break;
        case '2 hour after':
            //echo "EXPIRED MODE: 2 hour\n";
            $expireDatetime = clone $startDatetime;
            $expireDatetime->modify('+2 hour');
            break;
    }

    if ($expireDatetime) {
        //echo "EXPIRE: " . $expireDatetime->format('Y-m-d H:i:s') . "\n";
    } else {
        //echo "EXPIRE: unlimited\n";
    }

    // cek expire
    if ($expireDatetime !== null && $now > $expireDatetime) {
        //echo "STATUS: Expired -> set inactive\n";
        $this->db2->where('id', $existing_data->id)
                  ->update('table_checkpoint', ['status' => 'inactive']);
        return false;
    }

    //echo "STATUS: masih " . $existing_data->status . "\n";
    return $existing_data->status === 'active';
}



    public function add_new_checkpoint($data){

        $this->reload();

        $dataFilter = array(
            'name' => $data['name']
        );
        
        $existing_data = $this->db2->get_where('table_checkpoint', $dataFilter)->row();

        if(!$existing_data){

        $this->db2->insert('table_checkpoint', $data);
        // Check if the insertion was successful
        //return $this->db2->affected_rows() > 0;
        return $this->db2->insert_id();
        }

        return false;

    }

public function delete_quota_membership($token)
{
    // Ambil data membership berdasarkan token
    $membership = $this->db2->get_where('table_membership', ['public_token' => $token])->row();

    if (!$membership) {
        return false;
    }

    // Jika quota_used sudah 0, tidak bisa dikurangi lagi
    if ((int)$membership->quota_used <= 0) {
        return false;
    }

    // Kurangi quota_used
    $this->db2->where('public_token', $token);
    $this->db2->set('quota_used', 'quota_used - 1', false); // false: agar ekspresi tidak di-escape
    $update = $this->db2->update('table_membership');

    return $update ? true : false;
}


    public function use_quota_membership($token)
{
    // Ambil data membership berdasarkan token
    $membership = $this->db2->get_where('table_membership', ['public_token' => $token])->row();

    // Jika tidak ditemukan, return false
    if (!$membership) {
        return false;
    }

    // Jika quota sudah penuh, return false
    if ((int)$membership->quota_used >= (int)$membership->quota_limit) {
        return false;
    }

    // Increment quota_used
    $this->db2->where('public_token', $token);
    $this->db2->set('quota_used', 'quota_used + 1', false); // false agar tidak di-escape
    $update = $this->db2->update('table_membership');

    return $update ? true : false;
}


   public function add_new_staff($data) {

    $this->reload();

    $email = $data['email'];
    $token = $data['public_token'];
    
    $unit_division = isset($data['unit_division']) ? $data['unit_division'] : [];
    $dataFilter = array('email' => $email);

    // cek apakah staff sudah ada
    //$existing_data = $this->db2->get_where('table_staff', $dataFilter)->row();
    //if ($existing_data) {
    //    return false; // email sudah ada
    //}

    // hapus unit_division dari data sebelum insert ke table_staff
    unset($data['unit_division']);

    // insert staff
    $this->db2->insert('table_staff', $data);

    if ($this->db2->affected_rows() > 0) {
        $staff_id = $this->db2->insert_id();

        // insert ke table_staff_division (relasi)
        if (!empty($unit_division) && is_array($unit_division)) {
            foreach ($unit_division as $division_id) {
                if (!empty($division_id) && is_numeric($division_id)) {
                    $this->db2->insert('table_staff_division', [
                        'staff_id' => $staff_id,
                        'division_id' => $division_id,
                        'public_token' => $token
                    ]);
                }
            }
        }

        return $staff_id; // kembalikan ID staff baru
    }

    return false; // gagal insert
}


   public function get_staff_by_email_wa($dataFilter) {
      $existing_data = $this->db2->get_where('table_staff', $dataFilter)->row();
      if(!empty($existing_data)){
        return $existing_data;
      }

      return false;
    }

    public function get_user_by_email_wa($dataFilter) {
      $existing_data = $this->db2->get_where('table_user', $dataFilter)->row();
      if(!empty($existing_data)){
        return $existing_data;
      }

      return false;
    }

  public function get_all_attendance($dataFilter = [], $isAdmin = false) {
    $this->reload();

    $this->db2->select('table_attendance.*, table_checkpoint.name AS checkpoint_name');
    $this->db2->from('table_attendance');
    $this->db2->join('table_checkpoint', 'table_checkpoint.id = table_attendance.checkpoint_id', 'left');

    if (!$isAdmin) {
        // Staff => wajib ada public_token
        if (empty($dataFilter['public_token'])) {
            return false;
        }
        $this->db2->where('table_attendance.public_token', $dataFilter['public_token']);
        $this->db2->where('table_attendance.staff_id', $dataFilter['staff_id']);
    }

    $query = $this->db2->get();
    return $query->result();
}

public function get_all_staff($dataFilter = [], $isAdmin = false)
{
    $this->reload();

    $this->db2->select('table_staff.*, table_division.division_name');
    $this->db2->from('table_staff');
    $this->db2->join('table_staff_division', 'table_staff_division.staff_id = table_staff.id', 'left');
    $this->db2->join('table_division', 'table_division.id = table_staff_division.division_id', 'left');

    if (!$isAdmin) {
        // Staff => wajib ada public_token
        if (empty($dataFilter['public_token'])) {
            return false;
        }
        $this->db2->where('table_staff.public_token', $dataFilter['public_token']);
    }

    $query = $this->db2->get();
    return $query->result();
}





     public function add_new_attendance($data){

        $this->reload();

        $idStaff = $data['staff_id'];
        $idCheckpoint = $data['checkpoint_id'];
        $status = $data['status'];
        $pToken       = $data['public_token'];

        // status is either 1 :
        // 'hadir','pulang','lembur','izin sakit', 'izin acara', 'tugas'

        
        date_default_timezone_set('Asia/Jakarta');
        $date    = date('Y-m-d H:i:s');
        
        $newData = array(
            'staff_id'      => $idStaff,
            'checkpoint_id' => $idCheckpoint,
            'public_token'  => $pToken,
            'status'        => $status,
            'date_created' => $date
        );

        $this->db2->insert('table_attendance', $newData);
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;


    }



    public function add_new_membership($data){

        $this->reload();

        $pToken = $data['public_token'];
        $dataFilter = array('public_token' => $pToken);

        $existing_data = $this->db2->get_where('table_membership', $dataFilter)->row();

        if(!$existing_data){

        $this->db2->insert('table_membership', $data);
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;
        }

        return false;

    }

    public function reload(){
        $this->db2 = $this->load->database('client', TRUE);
    }

    public function getSpecific($username){
          $hasil = false;

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $datana = explode('@', $username);
            $username = $datana[0];
        }

        $data = array(
            'username' => $username
        );

         $this->db2->where($data);
       $query =  $this->db2->get('table_user');

        if($query->num_rows() > 0){
            $hasil = $query->row();
        }

        return $hasil;
    }

    public function is_activated($token){
        $hasil = false;

        $data = array(
            'public_token'  => $token,
            'status'        => 'active'
        );

       $this->db2->where($data);
       $query =  $this->db2->get('table_user');

        if($query->num_rows() > 0){
            //$hasil = $query->row();
            $hasil = true;
        }

        return $hasil;
    }

    public function isTokenExist($val){

        $data = array(
            'public_token' => $val
        );

        $hasil = false;

        $this->db2->where($data);
        $query =  $this->db2->get('table_checkpoint');
 
         if($query->num_rows() > 0){
             //$hasil = $query->row();
             $hasil = true;
         }
 
         return $hasil;

    }

    public function nextCheckPointID(){

        $query = $this->db2->query("SHOW TABLE STATUS LIKE 'table_checkpoint'");
        $result = $query->row();
        $next_id = $result->Auto_increment;
        return $next_id;
        
    }

    public function activate($token){
        $hasil = false;
    
        $data = array(
            'public_token'  => $token
        );
    
        $dataUpdate = array(
            'status' => 'active'
        );
    
        $this->db2->where($data);
        $this->db2->update('table_staff', $dataUpdate); // <-- sebelumnya salah kirim $data, sekarang $dataUpdate
    
        if ($this->db2->affected_rows() > 0) {
            $hasil = true;
        }
    
        return $hasil;
    }
    

    public function verify($username, $pass){

        $hasil = false;

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $datana = explode('@', $username);
            $username = $datana[0];
        }

        $data = array(
            'username' => $username,
            'pass' => $pass
        );

		 $this->db2->where($data);
       $query =  $this->db2->get('table_user');

        if($query->num_rows() > 0){
        	//$hasil = $query->row();
            $hasil = true;
        }

        return $hasil;

    }
}