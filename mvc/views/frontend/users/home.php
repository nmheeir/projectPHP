

<section>
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
          <div class="text-center">
            <img src="../TEST_3/public/upload/Kiki.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="mt-3 text-white"><? echo $data["fullname"] ?></h5>
            <p class="text-white mb-3">@<? echo $data["username"] ?></p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary">Follow</button>
              <button type="button" class="btn btn-outline-primary ms-1">Message</button>
            </div>
            <a type="button" class="btn btn-secondary w-50" href="Authenciation/logout">Sign out</a>
          </div>
        </div>
      <div class="col-lg-8 text-white">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Tên đầy đủ</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white mb-0"><? echo $data["fullname"] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white mb-0"><? echo $data["email"] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white mb-0">(097) 234-5678</p>
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
                <p class="text-white mb-0"><? echo $data["company"] ?></p>
              </div>
            </div>
      </div>

    </div>
  </div>
</section>
