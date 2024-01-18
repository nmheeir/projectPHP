<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
  <style>
    [class*="col"] {
      padding: 1rem;
      background-color: #33b5e5;
      border: 2px solid #fff;
      color: #fff;
    }
    .child{
      background-color: #2041d3;
    }
    body {
      background-color: #212529;
    }
  </style>
</head>
<body">

<div class="modal fade" id="onload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!-- Add this line to your code -->
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Do You Want Cookie? We Want Yours! 🍪</h5>
            </div>
            <div class="modal-body">
                This site uses cookies to personalies the content for you.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> 
<!-- Modal -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Bootstrap Bundle with Popper -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

<!--Modal JS Script -->
<script type="text/javascript">
    window.onload = () => {
      const myModal = new bootstrap.Modal('#onload');
      myModal.show();
    }
</script>
  <script src="./bootstrap/js/bootstrap.js"></script>
  <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>