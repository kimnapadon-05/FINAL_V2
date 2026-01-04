<?php
require_once "../db_connect.php";
require_once "../phpqrcode/qrlib.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $asset_id = $_POST['asset_id'];
    $equipment_name = $_POST['equipment_name'];
    $model_name = $_POST['model_name']; 
    $equipment_type = $_POST['equipment_type'];
    $serial_no = $_POST['serial_no'];
    $location = $_POST['location'];
    // --- จัดการรูปภาพอัปโหลด ---
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir);
    $imageName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $imageName;
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    // --- สร้างข้อมูลใน QR ---
    $qrData = "IT|$asset_id|$equipment_type|$serial_no|$equipment_name|$location";

    // --- สร้างไฟล์ QR Code 
    $qrDir = "qrcodes/";
    if (!is_dir($qrDir)) mkdir($qrDir);
    $qrFile = $qrDir . "QR_" . time() . ".png";
    QRcode::png($qrData, $qrFile, QR_ECLEVEL_L, 4);

    // --- บันทึกข้อมูลลงฐานข้อมูล ---
    $stmt = $conn->prepare("INSERT INTO equipment (asset_id, equipment_name, equipment_type, serial_no, location, image_path, qr_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $asset_id, $equipment_name, $equipment_type, $serial_no, $location, $targetFile, $qrFile);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    // --- เปิดหน้า Qr_list.php อัตโนมัติ ให้เลือกพิมพ์ ---
    echo "<script>
        alert('บันทึกข้อมูลและสร้าง QR Code สำเร็จ!');
        window.location.href='manage_equipment.php'; 
    </script>";
}
?>
