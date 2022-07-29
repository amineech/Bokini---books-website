<!-- menu icon start -->
<div class="burger-icon">
    Menu
    <div class="show-btn">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- menu icon end -->

<!-- admin side nav start -->
<nav id="admin-nav" class="nav-bar-admin">
    <div class="hide-btn">
        <div class="x-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="links">
        <a class="list-item" href="index.php">Home</a>
        <a class="list-item" href="authors.php">Authors</a>
        <a class="list-item" href="categories.php">Categories</a>
        <a class="list-item" href="articles.php">Articles</a>
    </div>
    <div class="Logout">
        <!-- path according to where this file is included  -->
        <a href="../resources/logout-process.php">Log out</a>
    </div>
</nav>


<script>
    // side nav bar slide animation start
    let show = document.querySelector('.burger-icon .show-btn'),
        hide = document.querySelector('.hide-btn'),
        navbar = document.querySelector('.nav-bar-admin');

    show.onclick = () => {
        navbar.classList.add('nav-bar-admin-toggled');
    };
    hide.onclick = () => {
        navbar.classList.remove('nav-bar-admin-toggled');
    };
    // side nav bar slide animation end
</script>

<!-- admin side nav end -->

