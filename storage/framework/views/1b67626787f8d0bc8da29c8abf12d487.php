<nav>
    <ul class="pagination">
        
        <li class="page-item <?php echo e($paginator->currentPage() == 1 ? 'active' : ''); ?>">
            <?php if($paginator->currentPage() == 1): ?>
                <span class="page-link">1</span>
            <?php else: ?>
                <a class="page-link" href="<?php echo e($paginator->url(1)); ?>">1</a>
            <?php endif; ?>
        </li>
        
        
        <?php if($paginator->lastPage() > 1): ?>
            
            <?php
                $start = max(2, $paginator->currentPage() - 2);
                $end = min($paginator->lastPage() - 1, $paginator->currentPage() + 2);
                
                // Ensure we always show some pages
                if ($end - $start < 4) {
                    if ($start == 2) {
                        $end = min($paginator->lastPage() - 1, $start + 4);
                    } else {
                        $start = max(2, $end - 4);
                    }
                }
            ?>
            
            
            <?php if($start > 2): ?>
                <li class="page-item disabled"><span class="page-link">...</span></li>
            <?php endif; ?>
            
            
            <?php for($page = $start; $page <= $end; $page++): ?>
                <li class="page-item <?php echo e($paginator->currentPage() == $page ? 'active' : ''); ?>">
                    <?php if($paginator->currentPage() == $page): ?>
                        <span class="page-link"><?php echo e($page); ?></span>
                    <?php else: ?>
                        <a class="page-link" href="<?php echo e($paginator->url($page)); ?>"><?php echo e($page); ?></a>
                    <?php endif; ?>
                </li>
            <?php endfor; ?>
            
            
            <?php if($end < $paginator->lastPage() - 1): ?>
                <li class="page-item disabled"><span class="page-link">...</span></li>
            <?php endif; ?>
            
            
            <?php if($paginator->lastPage() > 1): ?>
                <li class="page-item <?php echo e($paginator->currentPage() == $paginator->lastPage() ? 'active' : ''); ?>">
                    <?php if($paginator->currentPage() == $paginator->lastPage()): ?>
                        <span class="page-link"><?php echo e($paginator->lastPage()); ?></span>
                    <?php else: ?>
                        <a class="page-link" href="<?php echo e($paginator->url($paginator->lastPage())); ?>"><?php echo e($paginator->lastPage()); ?></a>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</nav>
<?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/vendor/pagination/custom.blade.php ENDPATH**/ ?>