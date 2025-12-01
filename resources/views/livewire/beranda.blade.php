<div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12 mb-4">
                <h2 class="fw-bold text-dark">Dashboard</h2>
                <p class="text-muted">Ringkasan aktivitas toko Anda hari ini.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white mb-3 shadow border-0"
                    style="background: linear-gradient(45deg, #4361ee, #3f37c9);">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-uppercase opacity-75 mb-1"
                                    style="font-size: 0.8rem; letter-spacing: 1px;">Total User</h6>
                                <h2 class="mb-0 fw-bold">{{ $totalUsers }}</h2>
                            </div>
                            <div class="p-3 rounded-circle bg-white bg-opacity-25">
                                <i class="bi bi-people fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white mb-3 shadow border-0"
                    style="background: linear-gradient(45deg, #4cc9f0, #4895ef);">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-uppercase opacity-75 mb-1"
                                    style="font-size: 0.8rem; letter-spacing: 1px;">Total Produk</h6>
                                <h2 class="mb-0 fw-bold">{{ $totalProducts }}</h2>
                            </div>
                            <div class="p-3 rounded-circle bg-white bg-opacity-25">
                                <i class="bi bi-box-seam fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white mb-3 shadow border-0"
                    style="background: linear-gradient(45deg, #f72585, #b5179e);">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-uppercase opacity-75 mb-1"
                                    style="font-size: 0.8rem; letter-spacing: 1px;">Transaksi</h6>
                                <h2 class="mb-0 fw-bold">{{ $totalTransactions }}</h2>
                            </div>
                            <div class="p-3 rounded-circle bg-white bg-opacity-25">
                                <i class="bi bi-cart-check fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white mb-3 shadow border-0"
                    style="background: linear-gradient(45deg, #f8961e, #f9c74f);">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-uppercase opacity-75 mb-1"
                                    style="font-size: 0.8rem; letter-spacing: 1px;">Total Stok</h6>
                                <h2 class="mb-0 fw-bold">{{ $totalStock }}</h2>
                            </div>
                            <div class="p-3 rounded-circle bg-white bg-opacity-25">
                                <i class="bi bi-boxes fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>