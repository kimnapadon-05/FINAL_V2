<?php 
// เช็คไฟล์เชื่อมต่อ
if (!file_exists('db_connect.php')) { die("<h1>❌ ไม่พบไฟล์ db_connect.php</h1>"); }
require_once 'db_connect.php'; 

if (empty($conn) || $conn->connect_error) { die("<h1>❌ Database Error</h1>"); }
$conn->set_charset("utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. รับค่าจากฟอร์ม (เพิ่ม device_model และ equipment_id)
    $reporter_name  = $_POST['reporter_name'] ?? '';
    $reporter_id    = $_POST['reporter_id'] ?? '';
    $reporter_phone = $_POST['reporter_phone'] ?? '';
    $reporter_email = $_POST['email'] ?? ''; 
    
    $device_type    = $_POST['device_type'] ?? '';
    $device_model   = $_POST['device_model'] ?? '';      // <--- เพิ่มใหม่
    $equipment_id   = $_POST['scanned_asset_id'] ?? '';  // <--- เพิ่มใหม่ (รหัสครุภัณฑ์)
    
    $building       = $_POST['building'] ?? '';
    $room           = isset($_POST['room']) ? $_POST['room'] : '-'; 
    $problem_detail = $_POST['problem_detail'] ?? '';

    // 2. สร้าง Tracking ID
    $tracking_id = "REP-" . date("Ymd") . "-" . rand(1000, 9999);
    $initial_status = "รอรับเรื่อง"; 

    // 3. จัดการรูปภาพ
    $image_path = "";
    if (isset($_FILES['repair_image']) && $_FILES['repair_image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        
        $ext = pathinfo($_FILES["repair_image"]["name"], PATHINFO_EXTENSION);
        $new_name = $tracking_id . "." . $ext;
        $target_file = $target_dir . $new_name;
        
        if (move_uploaded_file($_FILES["repair_image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        }
    }

    // 4. บันทึกข้อมูล (เพิ่มคอลัมน์ใหม่ลง SQL)
    $sql = "INSERT INTO requests (
        tracking_id, status, reported_by, asset_id, tel, reporter_email, 
        device_type, device_model, equipment_id, 
        building, room, problem_description, img_path, created_at
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // sssssssssssss (13 ตัว)
        $stmt->bind_param("sssssssssssss", 
            $tracking_id,    
            $initial_status, 
            $reporter_name,  
            $reporter_id,    
            $reporter_phone, 
            $reporter_email, 
            $device_type,
            $device_model,   // <---
            $equipment_id,   // <---
            $building,       
            $room,           
            $problem_detail, 
            $image_path      
        );

        if ($stmt->execute()) {
            header("Location: success.php?track_id=" . $tracking_id);
            exit();
        } else {
            die("<h1>❌ บันทึกไม่สำเร็จ</h1><p>" . $stmt->error . "</p>");
        }
        $stmt->close();
    } else {
        die("<h1>❌ SQL Error</h1><p>" . $conn->error . "</p>");
    }
    $conn->close();
}
?>