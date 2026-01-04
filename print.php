<?php
require_once "../db_connect.php";

// เช็คว่ามีการเลือกมาไหม
if (!isset($_POST['selected_ids']) || empty($_POST['selected_ids'])) {
    die("<h3 style='text-align:center; margin-top:50px;'>⚠️ กรุณาเลือกรายการอย่างน้อย 1 รายการก่อนสั่งพิมพ์</h3>");
}

$selected_ids = $_POST['selected_ids'];

// สร้างเงื่อนไข SQL สำหรับดึงข้อมูลหลาย ID พร้อมกัน (WHERE asset_id IN (...))
$ids_string = "'" . implode("','", $selected_ids) . "'";
$sql = "SELECT * FROM equipment WHERE asset_id IN ($ids_string)";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Print Selected Assets</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500;700&family=Sarabun:wght@600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        @page { size: A4; margin: 0; }
        
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #555;
            margin: 0; padding: 20px;
            display: flex; justify-content: center;
        }

        .a4-page {
            width: 210mm; min-height: 297mm;
            background: white;
            padding: 10mm;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
            display: grid;
            grid-template-columns: 1fr 1fr; /* 2 คอลัมน์ */
            grid-auto-rows: min-content;
            gap: 5mm;
            align-content: start;
        }

        /* --- สติกเกอร์ --- */
        .sticker-strip {
            width: 100%; height: 20mm;
            background-color: #FFEA00;
            border: 1px solid #d4c600;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 2mm; box-sizing: border-box;
            border-radius: 2px;
            page-break-inside: avoid; /* ห้ามตัดบรรทัด */
            color: black;
        }

        .qr-box {
            width: 16mm; height: 16mm;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid #000;
        }
        .qr-box img { width: 90%; height: 90%; object-fit: contain; }

        .info-box {
            flex-grow: 1;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            line-height: 1; overflow: hidden;
        }
        .asset-id {
            font-family: 'Roboto Mono', monospace;
            font-size: 14pt; font-weight: 700;
            letter-spacing: 0.5px; margin-bottom: 2px;
        }
        .dept-text { font-size: 8pt; font-weight: 800; text-transform: uppercase; }

        @media print {
            body { background: none; padding: 0; }
            .a4-page { box-shadow: none; margin: 0; width: 100%; }
            .no-print { display: none !important; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="position: fixed; top: 20px; left: 20px;">
        <button onclick="window.print()" class="btn btn-dark btn-lg shadow">🖨️ สั่งพิมพ์ (Print)</button>
        <div class="mt-2 text-white">*Margins: None / Scale: 100%</div>
    </div>

    <div class="a4-page">
        <?php 
        if ($result->num_rows > 0): 
            while($row = $result->fetch_assoc()):
                // เช็คว่ามีไฟล์ QR ไหม (ถ้าไม่มีใช้ภาพ Placeholder)
                $qrPath = !empty($row['qr_path']) ? $row['qr_path'] : 'https://placehold.co/100x100?text=NoQR';
        ?>
            <div class="sticker-strip">
                <div class="qr-box">
                    <img src="<?php echo $qrPath; ?>" alt="QR">
                </div>
                <div class="info-box">
                    <div class="asset-id"><?php echo $row['asset_id']; ?></div>
                    <div class="dept-text">IT DEPARTMENT</div>
                </div>
                <div class="qr-box">
                    <img src="<?php echo $qrPath; ?>" alt="QR">
                </div>
            </div>
            <?php 
            endwhile;
        endif; 
        ?>
    </div>

</body>
</html>