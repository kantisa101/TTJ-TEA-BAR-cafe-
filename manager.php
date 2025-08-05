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
  <title>ระบบจัดการพนักงาน</title>
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

    <main class="main-content">
      <header class="header">
        <span>: ระบบจัดการข้อมูลเจ้าของร้านและพนักงาน</span>
        <button class="add-employee" onclick="InsertClick()">➕ เพิ่มพนักงาน</button>
      </header>

      <section class="table-container">
        <h3>รายชื่อพนักงาน</h3>
        <table>
          <thead>
            <tr>
              <th>รหัสพนักงาน</th>
              <th>ชื่อ นามสกุล</th>
              <th>เบอร์โทร</th>
              <th>ที่อยู่</th>
              <th>สถานะ</th>
              <th>การจัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $data = $db_handle->Textquery("SELECT * FROM Employee");
            if (!empty($data)) {
              foreach ($data as $key => $value) {
                // ตรวจสอบว่าไฟล์ภาพมีอยู่จริงหรือไม่
                $empImagePath = $value['Emp_image'];
                if (!file_exists($empImagePath)) {
                  $empImagePath = "img/p2.jpg";
                }
                $value['Emp_image'] = $empImagePath;
            ?>
                <tr>
                  <td><?= htmlspecialchars($value['Emp_id'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Emp_fname'] . " " . $value['Emp_lname'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Emp_tel'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Emp_address'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Emp_status'], ENT_QUOTES); ?></td>
                  <td>
                    <button type="button" class="edit-button"
                      onclick="editClick(<?= $key; ?>, '<?= htmlspecialchars(json_encode($value), ENT_QUOTES); ?>')">
                      แก้ไขข้อมูล
                    </button>
                    <button type="button" class="delete-button"
                      onclick="if(confirm('กรุณายืนยันการลบข้อมูล ?')) location.href='managerProcess.php?st=del&Emp_id=<?= $value['Emp_id']; ?>'">
                      ลบข้อมูล
                    </button>
                  </td>
                </tr>
            <?php }
            } else {
              echo "<tr><td colspan='6' style='text-align:center;'>ไม่พบพนักงานในปัจจุบัน...</td></tr>";
            } ?>
          </tbody>
        </table>
      </section>
    </main>
  </div>

  <form action="managerProcess.php" method="post" enctype="multipart/form-data">
    <div id="info1" class="info_Member" style="display: none;">
      <div class="info_Detail">
        <div class="infoLeft">
          <h4 id="topicname">เพิ่มข้อมูลพนักงานใหม่</h4>
          <input type="hidden" id="st" name="st">
          <div class="row">
            <label>รหัสพนักงาน</label>
            <input type="text" id="EMPid" name="EMPid" maxlength="8" placeholder="รหัสพนักงาน">
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
            <label>สถานะ</label>
            <input type="radio" id="status" name="status" value="1">
            <label for="status">เจ้าของ</label><br>
            <input type="radio" id="status" name="status" value="2">
            <label for="status">พนักงาน</label><br>
          </div>
          <div class="row">
            <label>User Name</label>
            <input type="text" id="un" name="un" maxlength="20" placeholder="User Name">
          </div>
          <div class="row">
            <label>Password</label>
            <input type="password" id="pw" name="pw" maxlength="20" placeholder="Password">
          </div>
        </div>
        <div class="infoRight">
          <p>รูปโปรไฟล์</p>
          <img src="img/p2.jpg" id="profileImg">
          <input type="file" name="Emp_image" accept="image/jpeg">
          <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
          <button type="button" class="btn btn-secondary" onclick="cancelClick()">ยกเลิก</button>
        </div>
      </div>
    </div>
  </form>

  <script>
    function InsertClick() {
      document.getElementById("info1").style.display = "flex";
      document.getElementById("topicname").innerText = "เพิ่มข้อมูลพนักงานใหม่";
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
      document.getElementById("topicname").innerText = "แก้ไขข้อมูลพนักงาน";
      document.getElementById("st").value = 'edit';
      document.getElementById("EMPid").value = data.Emp_id;
      document.getElementById("fname").value = data.Emp_fname;
      document.getElementById("lname").value = data.Emp_lname;
      document.getElementById("tel").value = data.Emp_tel;
      document.getElementById("address").value = data.Emp_address;

      // กำหนดสถานะ (radio)
      const statusRadios = document.getElementsByName("status");
      statusRadios.forEach(radio => {
        radio.checked = (radio.value === data.Emp_status);
      });

      document.getElementById("un").value = data.Emp_username;
      document.getElementById("pw").value = data.Emp_password;

      // กำหนด path รูปภาพ
      let imagePath = "img/p2.jpg"; // default
      if (data.Emp_image && data.Emp_image.trim() !== "") {
        imagePath = data.Emp_image; // เช่น img/Emp/EMP008.jpg
      }
      document.getElementById("profileImg").src = imagePath;
    }
  </script>
</body>

</html>