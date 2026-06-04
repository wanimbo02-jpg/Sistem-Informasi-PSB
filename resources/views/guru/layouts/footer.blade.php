<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <span class="text-muted">
                    &copy; {{ date('Y') }} PPDB SMA Negeri Karubaga - Panel Guru
                </span>
            </div>
            <div class="col-md-6 text-end">
                <span class="text-muted">
                    <i class="bi bi-clock"></i> {{ now()->format('d M Y H:i') }}
                </span>
            </div>
        </div>
    </div>
</footer>
