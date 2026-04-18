<script>
    // Theme Manager - Prevents FOUC (Flash of Unstyled Content)
    (function () {
        const theme = localStorage.getItem('theme') || 'dark'; // Default to dark as per current aesthetic
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    })();
</script>
