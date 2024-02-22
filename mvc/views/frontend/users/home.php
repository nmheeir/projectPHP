<script src = "../TEST_3/public/js/fetchActiveControl.js"></script>
<?
  $buttons = "";
  $user = $data['user'];
  if ($_SESSION['user']['role_id'] < $user['role_id']) {
    if($user['active'] == 1) {
      $activeControllerButton = "<button type='button' class='btn btn-secondary w-25 m-1' onclick='activeUpdate({$user['id']}, 0)'>Chặn</button>";
    }
    else {
      $activeControllerButton = "<button type='button' class='btn btn-secondary w-25 m-1' onclick='activeUpdate({$user['id']}, 1)'>Bỏ chặn</button>";
    }
    $buttons = "
      <a type='button' class='btn btn-secondary w-25 m-1' href='User/deleteUser/{$user['id']}'>Sa thải</a>
      {$activeControllerButton}
    ";
  }
  else if($_SESSION['user']['id'] == $user['id']) {
    $buttons = "<a type='button' class='btn btn-secondary w-50' href='Authenciation/logout'>Sign out</a>";
  }
?>

<section>
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
          <div class="text-center">
            <img src="../TEST_3/public/upload/Kiki.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="mt-3 text-white"><? echo $user["fullname"] ?></h5>
            <p class="text-white mb-3">@<? echo $user["username"] ?></p>
            <div class="row justify-content-center">
              <? echo $buttons ?>
            </div>
          </div>
        </div>
      <div class="col-lg-8 text-white">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Tên đầy đủ</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white mb-0"><? echo $user["fullname"] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white mb-0"><? echo $user["email"] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Chức vụ</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white mb-0"><? echo $user["role"] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mobile</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white mb-0">(098) 765-4321</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Công ty</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white mb-0"><? echo $user["company"] ?></p>
              </div>
            </div>
      </div>
    </div>
  </div>
</section>

<?
  if(isset($data['order'])) {
    $this->loadView("frontend.users.process", [
      'data' => ['order' => $data['order'], 'shipper_id' => $user['id']]
    ]);
  }
?>

