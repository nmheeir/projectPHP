<div class="row row-cols-1 row-cols-md-3 p-2">
  <div class="col">
    <div class="card bg-transparent text-white border border-3 border-white">
      <div class="card-body">
        <h5 class="card-title">Số đơn đang làm</h5>
        <a class="card-text" href= <?echo "Order/userOrderList/0/{$data['shipper_id']}"?> >Xem tổng số <? echo ($data['order'][0]['total_orders']) ?> đơn hàng nhân viên này đang làm</a>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card bg-transparent text-white border border-3 border-white">
      <div class="card-body">
        <h5 class="card-title">Số đơn đã làm</h5>
        <a class="card-text" href=<?echo "Order/userOrderList/1/{$data['shipper_id']}"?>>Xem tổng số <? echo ($data['order'][1]['total_orders']) ?> đơn hàng nhân viên này đã làm</a>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card bg-transparent text-white border border-3 border-white">
      <div class="card-body">
        <h5 class="card-title">Các đơn không hoàn thành.</h5>
        <a class="card-text" href=<?echo "Order/userOrderList/2/{$data['shipper_id']}"?>>Xem tổng số <? echo ($data['order'][0]['total_orders']) ?> đơn hàng quá hạn của nhân viên</a>
      </div>
    </div>
  </div>
</div>