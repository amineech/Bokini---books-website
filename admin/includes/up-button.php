<div title="Scroll to the top" class="UP">
    <!-- scroll to top of the page on click event -->
</div>

<script>
    const up_btn = document.querySelector('.UP');

    //make up button appears on scroll 
    window.onscroll = () => {
        if(document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            up_btn.style.transform = "translateY(0px)";
            up_btn.style.opacity = "1";
        } else {
            up_btn.style.transform = "translateY(50px)";
            up_btn.style.opacity = "0";
        }

    };

    up_btn.onclick = () => {
        window.scrollTo(0, 0);
    }
</script>