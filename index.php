<?php include 'includes/header.php'; ?>

<!-- เพิ่มฟอนต์และไลบรารี QR Code Scanner -->
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%);
        --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05); 
        --input-focus-shadow: 0 0 0 0.2rem rgba(78, 84, 200, 0.25);
    }

    .luxury-content-wrapper {
        font-family: 'Kanit', sans-serif;
        color: #495057;
        position: relative;
        min-height: 80vh;
        z-index: 10; 
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 1.5rem;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(255,255,255,0.8);
    }
    
    .custom-nav-pills {
        background: rgba(248, 249, 250, 0.8);
        border-radius: 1rem;
        padding: 0.5rem;
        backdrop-filter: blur(5px);
    }
    .custom-nav-pills .nav-link {
        border-radius: 0.8rem;
        color: #6c757d;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
    }
    .custom-nav-pills .nav-link.active {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 4px 10px rgba(78, 84, 200, 0.3);
    }
    
    #reader {
        width: 100%;
        min-height: 300px;
        border-radius: 1rem;
        background-color: #000;
        display: none;
    }
    
    .btn-rgb-active {
        background: var(--primary-gradient);
        border: none;
        color: white;
        border-radius: 1rem;
        padding: 12px 30px;
        font-weight: 600;
        box-shadow: 0 10px 20px rgba(78, 84, 200, 0.3);
        transition: transform 0.2s;
    }
    .btn-rgb-active:hover {
        transform: translateY(-2px);
        color: white;
    }

    .form-control, .form-select {
        border-radius: 1rem;
        border: 1px solid #dee2e6;
        padding: 0.75rem 1rem;
    }

    #statusModal {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5); /* พื้นหลังสีดำจางๆ */
        backdrop-filter: blur(5px);      /* เบลอฉากหลัง */
        z-index: 1050;                   /* อยู่บนสุด */
        display: none;                   /* ซ่อนไว้ก่อน */
        justify-content: center;
        align-items: center;             /* จัดกึ่งกลางจอ */
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    #statusModal.show {
        display: flex;
        opacity: 1;
    }
    
    .status-card-content {
        background: #fff;
        width: 90%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        border-radius: 1.5rem;
        box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        transform: translateY(20px);
        transition: transform 0.3s ease;
        position: relative;
    }
    #statusModal.show .status-card-content {
        transform: translateY(0);
    }

    .close-modal-btn {
        position: absolute;
        top: 15px; right: 15px;
        background: rgba(0,0,0,0.1);
        border: none;
        border-radius: 50%;
        width: 36px; height: 36px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: background 0.2s;
    }
    .close-modal-btn:hover { background: rgba(0,0,0,0.2); }
</style>

<div class="luxury-content-wrapper py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <!-- Tabs เมนู -->
            <ul class="nav nav-pills nav-fill custom-nav-pills mb-5" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active py-3" id="submit-tab" data-bs-toggle="tab" data-bs-target="#submit-pane" type="button" role="tab">
                        <i class="bi bi-send-plus-fill me-2 h5"></i> แจ้งซ่อมใหม่
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-3" id="track-tab" data-bs-toggle="tab" data-bs-target="#track-pane" type="button" role="tab">
                        <i class="bi bi-qr-code-scan me-2 h5"></i> ติดตามสถานะ
                    </button>
                </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
                
                <!-- ส่วนที่ 1: ฟอร์มแจ้งซ่อม -->
                <div class="tab-pane fade show active" id="submit-pane" role="tabpanel">
                    <div class="glass-card p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h2 class="h3 fw-bold text-primary">แบบฟอร์มแจ้งซ่อม</h2>
                            <p class="text-muted small">กรุณากรอกข้อมูลให้ครบถ้วน</p>
                        </div>
                        
                        <form action="save_repair.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="email" id="emailInputHidden"> 
                            
                            <h5 class="mb-3 text-secondary border-bottom pb-2"><i class="bi bi-person-badge me-2"></i>ข้อมูลผู้แจ้ง</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="reporter_name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">รหัสบุคลากร <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="reporter_id" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">เบอร์โทรติดต่อ <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="reporter_phone" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">อีเมล <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="emailUsernameInput" placeholder="Username" required>
                                        <span class="input-group-text">@lbtech.ac.th</span>
                                    </div>
                                </div>
                            </div>

                            <h5 class="mb-3 text-secondary border-bottom pb-2"><i class="bi bi-pc-display me-2"></i>รายละเอียดการซ่อม</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">ประเภทการซ่อม <span class="text-danger">*</span></label>
                                    <select class="form-select" name="device_type" required>
                                        <option value="">-- เลือกประเภท --</option>
                                        <option value="Computer">คอมพิวเตอร์</option>
                                        <option value="Projector">โปรเจคเตอร์</option>
                                        <option value="AccessPoint">Access point</option>
                                        <option value="Other">อื่นๆ</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">ตึก <span class="text-danger">*</span></label>
                                    <select class="form-select" id="buildingSelect" name="building" required>
                                        <option value="">-- เลือกตึก --</option>
                                        <option value="ตึก 14">ตึก 14</option>
                                        <option value="ตึก 26">ตึก 26</option>
                                        <option value="Other">ตึกอื่นๆ</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-3"> 
                                <div class="col-md-6" id="roomDropdownContainer" style="display: none;">
                                    <label class="form-label">ห้อง <span class="text-danger">*</span></label>
                                    <select class="form-select" id="roomSelect" name="room">
                                        <option value="">-- เลือกห้อง --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
                                <div class="col-12">
                                    <label class="form-label">รายละเอียดปัญหา <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="4" name="problem_detail" placeholder="อธิบายอาการเสีย..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">แนบรูปภาพประกอบ</label>
                                    <input class="form-control" type="file" name="repair_image" accept="image/*">
                                </div>
                            </div>

                            <div class="d-grid mt-4 pt-2">
                                <button type="submit" class="btn btn-rgb-active btn-lg">
                                    <i class="bi bi-send-fill me-2"></i> ยืนยันการแจ้งซ่อม
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ส่วนที่ 2: ติดตามสถานะ (หน้าสแกน + อัปโหลดรูป) -->
                <div class="tab-pane fade" id="track-pane" role="tabpanel">
                    <div class="glass-card p-0 overflow-hidden">
                        
                        <!-- หน้าจอสแกน -->
                        <div id="scanView" class="p-4 p-md-5 text-center">
                            <div class="mb-4">
                                <i class="bi bi-qr-code-scan display-1 text-primary"></i>
                                <h2 class="h3 fw-bold mt-3">สแกน QR Code</h2>
                                <p class="text-muted">ใช้กล้องสแกน หรืออัปโหลดรูป QR Code เพื่อติดตามสถานะ</p>
                            </div>

                            <!-- พื้นที่กล้อง -->
                            <div id="reader" class="mb-4 mx-auto border border-2 border-primary shadow-sm" style="max-width: 100%;"></div>
                            
                            <!-- ปุ่มควบคุม -->
                            <div class="d-grid gap-3 col-md-<button class="btn btn-secondary mx-auto">
                                <button id="startScanBtn" class="btn btn-primary btn-lg rounded-pill">
                                    <i class="bi bi-camera-fill me-2"></i> เปิดกล้องสแกน
                                </button>
                                <button id="stopScanBtn" class="btn btn-danger btn-lg rounded-pill d-none">
                                    <i class="bi bi-stop-circle-fill me-2"></i> ปิดกล้อง
                                </button>

                                <div class="text-muted my-2">- หรือ -</div>

                                <!-- *** (สำคัญ) Input File ซ่อนอยู่ตรงนี้ *** -->
                                <input type="file" id="qrInputFile" accept="image/*" style="display: none;">
                                
                                <button id="uploadQrBtn" class="btn btn-outline-primary btn-lg rounded-pill">
                                    <i class="bi bi-image me-2"></i> อัปโหลดรูป QR Code
                                </button>
                            </div>
                            
                            <!-- Fallback กรอกรหัส -->
                            <div class="mt-4 pt-4 border-top">
                                <p class="small text-muted mb-2">หรือกรอกรหัสด้วยตนเอง:</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <input type="text" id="manualTrackingId" class="form-control w-50 text-center" placeholder="REP-XXXX">
                                    <button class="btn btn-secondary" onclick="fetchStatus(document.getElementById('manualTrackingId').value)">ค้นหา</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div id="statusModal">
    <div class="status-card-content">
        <!-- ปุ่มปิดมุมขวาบน -->
        <button class="close-modal-btn" onclick="closeModal()">
            <i class="bi bi-x-lg"></i>
        </button>
        
        <!-- พื้นที่แสดงข้อมูล (จะถูกแทนที่ด้วย HTML จาก get_status.php) -->
        <div id="modalContent">
            <!-- Loading State -->
            <div class="text-center p-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-3 text-muted">กำลังโหลดข้อมูล...</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // --- 1. Dropdown ห้อง ---
        const roomData = {
            "ตึก 14": ["1411", "1412", "1413", "1414", "1415", "1421", "1422", "1423", "1424", "1425", "1431", "1432", "1433", "1434", "1435", "1441", "1442", "1443", "1444", "1445"],
            "ตึก 26": ["TC201", "TC202", "TC203", "TC204", "TC205"],
            "Other": ["ห้อง IOT", "อื่นๆ"]
        };

        const buildingSelect = document.getElementById('buildingSelect');
        const roomContainer = document.getElementById('roomDropdownContainer');
        const roomSelect = document.getElementById('roomSelect');
        const repairForm = document.querySelector('form[action="save_repair.php"]');
        const emailUsernameInput = document.getElementById('emailUsernameInput');
        const emailInputHidden = document.getElementById('emailInputHidden');
        const requiredDomain = '@lbtech.ac.th';

        function loadRooms() {
            if (!buildingSelect) return;
            const selectedBuilding = buildingSelect.value;
            if (roomSelect) roomSelect.innerHTML = '<option value="">-- เลือกห้อง --</option>';
            
            if (selectedBuilding && roomData[selectedBuilding] && roomSelect) {
                roomData[selectedBuilding].forEach(room => {
                    const option = document.createElement('option');
                    option.value = room;
                    option.textContent = room;
                    roomSelect.appendChild(option);
                });
                if (roomContainer) roomContainer.style.display = 'block';
                roomSelect.required = true;
            } else {
                if (roomContainer) roomContainer.style.display = 'none';
                if (roomSelect) roomSelect.required = false;
            }
        }

        if (repairForm) {
            repairForm.addEventListener('submit', function(event) {
                const username = emailUsernameInput.value.trim();
                if (username === '' || username.includes('@')) {
                    event.preventDefault();
                    alert('โปรดกรอกแค่ชื่อผู้ใช้ (ไม่ต้องใส่ @lbtech.ac.th)');
                    emailUsernameInput.focus();
                    return;
                }
                emailInputHidden.value = username + requiredDomain;
                
                if (buildingSelect.value && roomContainer.style.display !== 'none' && !roomSelect.value) {
                    event.preventDefault();
                    alert('โปรดเลือกห้อง');
                    roomSelect.focus();
                    return;
                }
            });
        }

        if (buildingSelect) buildingSelect.addEventListener('change', loadRooms);
        loadRooms();


        // --- 2. Scanner & Modal (แก้ไข JS Error แล้ว) ---
        
        // ฟังก์ชันดึงข้อมูล (Global)
        window.fetchStatus = function(trackingId) {
            if (!trackingId) return alert("กรุณาระบุรหัสติดตาม");

            // ค้นหา Element ใหม่ทุกครั้ง เพื่อความชัวร์
            const modal = document.getElementById('statusModal');
            const content = document.getElementById('modalContent');

            if (modal && content) {
                modal.classList.add('show');
                content.innerHTML = `
                    <div class="text-center p-5">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-3 text-muted">กำลังค้นหาข้อมูล...</p>
                    </div>`;

                fetch('get_status.php?id=' + trackingId)
                    .then(response => response.text())
                    .then(html => {
                        content.innerHTML = html;
                        const homeBtn = content.querySelector('button[onclick="resetScanner()"]');
                        if(homeBtn) {
                            homeBtn.setAttribute('onclick', 'closeModal()');
                            homeBtn.innerHTML = '<i class="bi bi-x-circle me-2"></i> ปิดหน้านี้';
                        }
                    })
                    .catch(error => {
                        content.innerHTML = `<div class="alert alert-danger m-4">Error: ${error} <br><button onclick="closeModal()" class="btn btn-sm btn-outline-danger mt-2">ปิด</button></div>`;
                    });
            } else {
                console.error("Modal element not found");
                alert("เกิดข้อผิดพลาดในการแสดงผล");
            }
        };

        // --- ส่วนจัดการ Modal และ AJAX ---
    const statusModal = document.getElementById('statusModal');
    const modalContent = document.getElementById('modalContent');

    // ฟังก์ชันเปิด Modal และดึงข้อมูล
    window.fetchStatus = function(trackingId) {
        if (!trackingId) return alert("กรุณาระบุรหัสติดตาม");

        // 1. แสดง Modal (Loading state)
        statusModal.classList.add('show');
        modalContent.innerHTML = `
            <div class="text-center p-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-3 text-muted">กำลังค้นหาข้อมูล...</p>
            </div>`;

        // 2. ดึงข้อมูล AJAX
        fetch('get_status.php?id=' + trackingId)
            .then(response => response.text())
            .then(html => {
                modalContent.innerHTML = html; // ใส่ HTML ที่ได้ลงใน Modal
                
                // แปลงปุ่ม "หน้าแรก" ใน Modal ให้เป็นปุ่มปิด Modal
                const homeBtn = modalContent.querySelector('button[onclick="resetScanner()"]');
                if(homeBtn) {
                    homeBtn.setAttribute('onclick', 'closeModal()');
                    homeBtn.innerHTML = '<i class="bi bi-x-circle me-2"></i> ปิดหน้านี้';
                }
            })
            .catch(error => {
                modalContent.innerHTML = `<div class="alert alert-danger m-4 text-center">
                    <i class="bi bi-exclamation-triangle-fill display-1 text-danger mb-3"></i><br>
                    เกิดข้อผิดพลาด: ${error} 
                    <br><button onclick="closeModal()" class="btn btn-outline-secondary mt-3">ปิด</button>
                </div>`;
            });
    };

    // ฟังก์ชันปิด Modal
    window.closeModal = function() {
        statusModal.classList.remove('show');
    };

    // ปิด Modal เมื่อคลิกพื้นที่ว่างๆ รอบนอก
    statusModal.addEventListener('click', function(e) {
        if (e.target === statusModal) {
            closeModal();
        }
    });

        // Scanner Variables
        const startScanBtn = document.getElementById('startScanBtn');
        const stopScanBtn = document.getElementById('stopScanBtn');
        const uploadQrBtn = document.getElementById('uploadQrBtn');
        const qrInputFile = document.getElementById('qrInputFile');
        const readerDiv = document.getElementById('reader');
        let html5QrCode = null;

        // ฟังก์ชันสั่งปิดกล้อง
        const stopCamera = () => {
            if (html5QrCode && html5QrCode.isScanning) {
                html5QrCode.stop().then(() => {
                    readerDiv.style.display = 'none';
                    stopScanBtn.classList.add('d-none');
                    startScanBtn.classList.remove('d-none');
                }).catch(err => console.log("Failed to stop camera:", err));
            }
        };

        if (typeof Html5Qrcode !== 'undefined') {
            try {
                html5QrCode = new Html5Qrcode("reader");
            } catch (e) { console.log("Scanner init error:", e); }
        }

        const onScanSuccess = (decodedText) => {
            // 1. สั่งปิดกล้องทันที (Stop Camera) เพื่อไม่ให้สแกนซ้ำๆ รัวๆ
            stopCamera(); 

            let trackingId = decodedText;
            
            // 2. ถ้าสแกนได้เป็น URL (เช่น http://.../track.php?tracking_id=REP-1234)
            // ให้ตัดเอาเฉพาะรหัส REP-1234 ออกมา
            if (decodedText.includes('tracking_id=')) {
                try {
                    trackingId = decodedText.split('tracking_id=')[1].split('&')[0];
                } catch (e) {
                    trackingId = decodedText; // ถ้าตัดไม่ได้ ก็ใช้ค่าเดิม
                }
            }
            
            console.log("Scanned ID:", trackingId);
            
            // 3. ส่งรหัสที่ได้ ไปเปิด Modal แสดงสถานะทันที
            // (ต้องมั่นใจว่ามีฟังก์ชัน fetchStatus อยู่ในหน้าเว็บนี้แล้ว)
            fetchStatus(trackingId); 
        };

        // --- Event Listeners ปุ่ม ---
        if (startScanBtn) {
            startScanBtn.addEventListener('click', () => {
                if (location.protocol !== 'https:' && location.hostname !== 'localhost') {
                    alert("⚠️ กล้องใช้งานไม่ได้บน HTTP\nกรุณาเข้าผ่าน HTTPS");
                    return;
                }
                readerDiv.style.display = 'block';
                startScanBtn.classList.add('d-none');
                stopScanBtn.classList.remove('d-none');

                if (html5QrCode) {
                    html5QrCode.start(
                        { facingMode: "environment" }, 
                        { fps: 10, qrbox: 250 },
                        onScanSuccess
                    ).catch(err => {
                        alert("ไม่สามารถเปิดกล้องได้: " + err);
                        readerDiv.style.display = 'none';
                        startScanBtn.classList.remove('d-none');
                        stopScanBtn.classList.add('d-none');
                    });
                }
            });
        }

        if (stopScanBtn) {
            stopScanBtn.addEventListener('click', stopCamera);
        }

        if (uploadQrBtn && qrInputFile) {
            uploadQrBtn.addEventListener('click', () => { qrInputFile.click(); });

            qrInputFile.addEventListener('change', e => {
                if (e.target.files.length == 0) return;
                const imageFile = e.target.files[0];
                const originalText = uploadQrBtn.innerHTML;
                
                uploadQrBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> กำลังสแกน...';
                uploadQrBtn.disabled = true;

                if (html5QrCode) {
                    html5QrCode.scanFile(imageFile, true)
                    .then(decodedText => {
                        uploadQrBtn.innerHTML = originalText;
                        uploadQrBtn.disabled = false;
                        onScanSuccess(decodedText);
                    })
                    .catch(err => {
                        uploadQrBtn.innerHTML = originalText;
                        uploadQrBtn.disabled = false;
                        alert("❌ ไม่พบ QR Code ในรูปภาพนี้");
                        console.error(err);
                    });
                }
            });
        }
    });
</script>

<?php include 'includes/footer.php'; ?>