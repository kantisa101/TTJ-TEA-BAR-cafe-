<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/manager.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet">
  <title>ระบบจัดการหมวดหมู่สินค้า</title>
</head>

<body>
  <?php
  session_start();
  require_once('script/script.php');
  $db_handle = new myDBControl();
  include('check1.php');

  $id = $_SESSION['id'] ?? '';
  $fname = $_SESSION['Fname'] ?? '';
  ?>

  <div class="container">
    <?php include('sidebar.php'); ?>

    <main class="main-content">
      <header class="header">
        <span>: ระบบจัดการหมวดหมู่สินค้า</span>
        <button class="add-employee" onclick="InsertClick()">➕ เพิ่มหมวดหมู่สินค้าใหม่</button>
      </header>

      <section class="table-container">
        <h3>รายการหมวดหมู่สินค้า</h3>
        <table>
          <thead>
            <tr>
              <th>รหัสหมวดหมู่</th>
              <th>ชื่อหมวดหมู่สินค้า</th>
              <th>คำอธิบายหมวดหมู่สินค้า</th>
              <th>รูปภาพหมวดหมู่สินค้า</th>
              <th>การจัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $rowsPerPage = 5;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            if ($page < 1) $page = 1;

            // นับจำนวนรายการทั้งหมด
            $totalRowsResult = $db_handle->Textquery("SELECT COUNT(*) as count FROM ProductCategory");
            $totalRows = $totalRowsResult[0]['count'];
            $totalPages = ceil($totalRows / $rowsPerPage);

            // คำนวณ offset สำหรับ SQL
            $offset = ($page - 1) * $rowsPerPage;

            // ดึงข้อมูลเฉพาะหน้าที่กำลังดู
            $data = $db_handle->Textquery("SELECT * FROM ProductCategory LIMIT $offset, $rowsPerPage");

            if (!empty($data)) {
              foreach ($data as $key => $value) {
                // ตรวจสอบว่าไฟล์ภาพมีอยู่จริงหรือไม่
                $CategoryImagePath = $value['Category_picture'];
                if (!file_exists($CategoryImagePath)) {
                  $CategoryImagePath = "img/about/02.jpg";
                }
                $value['Category_picture'] = $CategoryImagePath;
            ?>
                <tr>
                  <td><?= htmlspecialchars($value['Category_id'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Category_name'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Category_Description'], ENT_QUOTES); ?></td>
                  <td><img src="<?= htmlspecialchars($value['Category_picture'], ENT_QUOTES); ?>" alt="Category Picture"></td>
                  <td>
                    <button type="button" class="edit-button"
                      onclick="editClick(<?= $key; ?>, '<?= htmlspecialchars(json_encode($value), ENT_QUOTES); ?>')">
                      แก้ไขข้อมูล
                    </button>
                    <button type="button" class="delete-button"
                      onclick="if(confirm('กรุณายืนยันการลบข้อมูล ?')) location.href='PCategoryProcess.php?st=del&Category_id=<?= $value['Category_id']; ?>'">
                      ลบข้อมูล
                    </button>
                  </td>
                </tr>
            <?php }
            } else {
              echo "<tr><td colspan='6' style='text-align:center;'>ไม่พบหมวดหมู่สินค้าในปัจจุบัน...</td></tr>";
            } ?>
          </tbody>
        </table>
        <?php if ($totalPages > 1): ?>
          <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
              <a href="?page=<?= $i; ?>" class="<?= ($i == $page) ? 'active' : ''; ?>">
                <?= $i; ?>
              </a>
            <?php endfor; ?>
          </div>
        <?php endif; ?>
      </section>
    </main>
  </div>

  <form action="PCategoryProcess.php" method="post" enctype="multipart/form-data">
    <div id="info1" class="info_Member">
      <div class="info_Detail">
        <div class="infoLeft">
          <h4 id="topicname">เพิ่มข้อมูลหมวดหมู่สินค้าใหม่</h4>
          <input type="hidden" id="st" name="st">
          <div class="row">
            <label>รหัสหมวดหมู่</label>
            <input type="text" id="Catid" name="Catid" maxlength="8" placeholder="รหัสหมวดหมู่">
          </div>
          <div class="row">
            <label>ชื่อหมวดหมู่สินค้า</label>
            <input type="text" id="Catname" name="Catname" maxlength="50" placeholder="ชื่อหมวดหมู่สินค้า">
          </div>
          <div class="row">
            <label>คำอธิบายหมวดหมู่สินค้า</label>
            <input type="text" id="Catdes" name="Catdes" maxlength="20" placeholder="คำอธิบายหมวดหมู่สินค้า">
          </div>
          <div class="infoRight">
            <p>รูปภาพหมวดหมู่สินค้า</p>
            <img src="img/p2.jpg" id="profileImg">
            <input type="file" name="Category_picture" accept="image/jpeg">
            <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
            <button type="button" class="btn btn-secondary" onclick="cancelClick()">ยกเลิก</button>
          </div>
        </div>
      </div>
  </form>

  <script>
    function InsertClick() {
      document.getElementById("info1").style.display = "flex";
      document.getElementById("topicname").innerText = "เพิ่มข้อมูลหมวดหมู่สินค้าใหม่";
      document.getElementById("st").value = 'add';
      document.querySelector("form").reset();
      document.getElementById("profileImg").src = "img/p2.jpg";
    }

    function cancelClick() {
      document.getElementById("info1").style.display = "none";
    }

    function editClick(index, dataJson) {
      let data = JSON.parse(dataJson);
      document.getElementById("info1").style.display = "flex";
      document.getElementById("topicname").innerText = "แก้ไขข้อมูลหมวดหมู่สินค้า";
      document.getElementById("st").value = 'edit';
      document.getElementById("Catid").value = data.Category_id;
      document.getElementById("Catname").value = data.Category_name;
      document.getElementById("Catdes").value = data.Category_Description;
      document.getElementById("profileImg").src = data.Category_picture;
    }
  </script>
</body>

</html>