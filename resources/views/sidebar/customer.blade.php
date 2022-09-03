<div>
    <a href="{{ route('user.userHome') }}">
        <i class='bx bx-grid-alt' ></i>
        <span class="links_name">Dashboard</span>
    </a>
    <span class="tooltip">Dashboard</span>
</div>

<div class="profile-content mt-auto mx-auto">
    <div>
        <a href="#">
            <i class='bx bx-cog'></i>
            <span class="links_name">Settings</span>
        </a>
        <span class="tooltip">Settings</span>
    </div>

    <div>
        <a href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Logout</span>
            <form action="{{ route('user.logout') }}" method="POST" class="d-none" id="logout-form">@csrf</form>
        </a>
        <span class="tooltip">Logout</span>
    </div>

</div>