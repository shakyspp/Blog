<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarLabel">Blog Management System</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            @if (auth()->user()->role_id === 2)
                <li class="nav-item">
                    <a class="nav-link" href="/blogs">My Blogs</a>
                </li>
            @endif
            @if (auth()->user()->role_id === 1)
                <li class="nav-item">
                    <a class="nav-link" href="/admin/blogs">Submitted Blogs</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="/all-blogs">All Blogs</a>
            </li>
        </ul>
    </div>
</div>
