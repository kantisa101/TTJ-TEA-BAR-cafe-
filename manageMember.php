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
  <title>ระบบจัดการสมาชิก</title>
</head>

<body>
  <?php
  session_start();
  require_once('script/script.php');
  $db_handle = new myDBControl();
  include('check2.php');

  $id = $_SESSION['id'] ?? '';
  $fname = $_SESSION['Fname'] ?? '';


  ?>

  <div class="container">
    <?php include('sidebar.php'); ?>

    <!-- Main Content -->
    <main class="main-content">
      <header class="header">
        <span>: ระบบจัดการข้อมูลสมาชิก</span>
        <button class="add-employee" onclick="InsertClick()">➕ เพิ่มสมาชิก</button>
      </header>

      <section class="table-container">
        <h3>รายชื่อสมาชิก</h3>
        <table>
          <thead>
            <tr>
              <th>รหัสสมาชิก</th>
              <th>ชื่อ นามสกุล</th>
              <th>เบอร์โทร</th>
              <th>ที่อยู่</th>
              <th>วันที่เป็นสมาชิก</th>
              <th>แก้วสะสม</th>
              <th>การจัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM Member";
            $data = $db_handle->Textquery($query);
            if (!empty($data)) {
              foreach ($data as $key => $value) {
                // ตรวจสอบว่าไฟล์ภาพมีอยู่จริงหรือไม่
                $MemImagePath = $value['Mem_image'];
                if (!file_exists($MemImagePath)) {
                  $MemImagePath = "img/p2.jpg";
                }
                $value['Mem_image'] = $MemImagePath;
            ?>
                <tr>
                  <td><?= htmlspecialchars($value['Mem_id'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Mem_fname'], ENT_QUOTES); ?> <?= htmlspecialchars($value['Mem_lname'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Mem_tel'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Mem_address'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Mem_day'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Mem_stamp'], ENT_QUOTES); ?></td>
                  <td>
                    <button type="button" class="edit-button"
                      onclick="editClick(<?= $key; ?>, '<?= htmlspecialchars(json_encode($value), ENT_QUOTES); ?>')">
                      แก้ไขข้อมูล
                    </button>
                    <button type="button" class="delete-button"
                      onclick="if(confirm('กรุณายืนยันการลบข้อมูล ?')) location.href='MemberProcess.php?st=del&Mem_id=<?= $value['Mem_id']; ?>'">
                      ลบข้อมูล
                    </button>
                  </td>
                </tr>
            <?php }
            } else {
              echo "<tr><td colspan='6' style='text-align:center;'>ไม่พบสมาชิกในปัจจุบัน...</td></tr>";
            } ?>
          </tbody>
        </table>
      </section>
    </main>
  </div>

  <form action="MemberProcess.php" method="post" enctype="multipart/form-data">
    <div id="info1" class="info_Member" style="display: none;">
      <div class="info_Detail">
        <div class="infoLeft">
          <h4 id="topicname">เพิ่มข้อมูลสมาชิกใหม่</h4>
          <input type="hidden" id="st" name="st">
          <div class="row">
            <label>รหัสสมาชิก</label>
            <input type="text" id="MBid" name="MBid" maxlength="8" placeholder="รหัสพนักงาน">
          </div>
          <div class="row">
            <label>ชื่อ นามสกุล</label>
            <input type="text" id="fname" name="fname" maxlength="50" placeholder="ชื่อ">
            <input type="text" id="lname" name="lname" maxlength="50" placeholder="นามสกุล">
          </div>
          <div class="row">
            <label>เบอร์โทร</label>
            <input type="text" id="tel" name="tel" maxlength="20" placeholder="เบอร์โทร">
          </div>
          <div class="row">
            <label>ที่อยู่</label>
            <textarea id="address" name="address" maxlength="255" placeholder="ที่อยู่"></textarea>
          </div>
          <div class="row">
            <label>วันที่เป็นสมาชิก</label>
            <input type="date" id="Memday" name="Memday" maxlength="20" placeholder="วันที่เป็นสมาชิก">
          </div>
          <div class="row">
            <label>แก้วสะสม</label>
            <input type="text" id="Mem_stamp" name="Mem_stamp" maxlength="20" placeholder="แก้วสะสม">
          </div>
          <div class="row">
            <label>User Name</label>
            <input type="text" id="Mem_username" name="Mem_username" maxlength="20" placeholder="User Name">
          </div>
          <div class="row">
            <label>Password</label>
            <input type="password" id="Mem_password" name="Mem_password" maxlength="20" placeholder="Password">
          </div>
        </div>
        <div class="infoRight">
          <p>รูปโปรไฟล์</p>
          <img src="img/p2.jpg" id="profileImg">
          <input type="file" name="Mem_image" accept="image/jpeg">
          <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
          <button type="button" class="btn btn-secondary" onclick="cancelClick()">ยกเลิก</button>
        </div>
      </div>
    </div>
  </form>

  <script>
    function InsertClick() {
      document.getElementById("info1").style.display = "flex";
      document.getElementById("topicname").innerText = "เพิ่มข้อมูลสมาชิกใหม่";
      document.getElementById("st").value = 'add';
      document.querySelector("form").reset();
      document.getElementById("profileImg").src = "img/p2.jpg";

      // ทำให้ช่อง Mem_stamp แก้ไขได้
      document.getElementById("Mem_stamp").readOnly = false;
    }

    function cancelClick() {
      document.getElementById("info1").style.display = "none";
    }

    function editClick(index, dataJson) {
      let data = JSON.parse(dataJson);
      document.getElementById("info1").style.display = "flex";
      document.getElementById("topicname").innerText = "แก้ไขข้อมูลสมาชิก";
      document.getElementById("st").value = 'edit';
      document.getElementById("MBid").value = data.Mem_id;
      document.getElementById("fname").value = data.Mem_fname;
      document.getElementById("lname").value = data.Mem_lname;
      document.getElementById("tel").value = data.Mem_tel;
      document.getElementById("address").value = data.Mem_address;
      document.getElementById("Memday").value = data.Mem_day;
      document.getElementById("Mem_stamp").value = data.Mem_stamp;
      document.getElementById("Mem_username").value = data.Mem_username;
      document.getElementById("Mem_password").value = data.Mem_password;
      document.getElementById("profileImg").src = data.Mem_image;

      // ห้ามแก้ไขแก้วสะสม
      document.getElementById("Mem_stamp").readOnly = true;
    }
  </script>
</body>

</html>