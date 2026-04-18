<button 
    onclick="toggleDarkMode()" 
    class="theme-toggle-btn relative group p-2.5 rounded-2xl bg-white/5 dark:bg-white/5 border border-emerald-500/10 dark:border-white/10 text-emerald-600 dark:text-amber-400 hover:scale-110 active:scale-95 transition-all duration-300 shadow-xl shadow-emerald-500/5 dark:shadow-none overflow-hidden" 
    aria-label="Toggle Theme">
    
    <!-- Glow Effect -->
    <div class="absolute inset-0 bg-emerald-500/10 dark:bg-amber-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

    <!-- Moon Icon (Dark Mode) -->
    <svg class="moon-icon w-6 h-6 transform transition-all duration-500 {{ (old('theme', 'dark') === 'dark') ? '' : 'rotate-90 scale-0 opacity-0' }}" 
         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
    </svg>

    <!-- Sun Icon (Light Mode) -->
    <svg class="sun-icon w-6 h-6 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transform transition-all duration-500 {{ (old('theme', 'dark') === 'dark') ? '-rotate-90 scale-0 opacity-0' : '' }}" 
         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
    </svg>
</button>

<script>
    function updateToggleIcons() {
        const isDark = document.documentElement.classList.contains('dark');
        const sunIcons = document.querySelectorAll('.sun-icon');
        const moonIcons = document.querySelectorAll('.moon-icon');

        sunIcons.forEach(icon => {
            if (isDark) {
                icon.classList.add('-rotate-90', 'scale-0', 'opacity-0');
            } else {
                icon.classList.remove('-rotate-90', 'scale-0', 'opacity-0');
            }
        });

        moonIcons.forEach(icon => {
            if (isDark) {
                icon.classList.remove('rotate-90', 'scale-0', 'opacity-0');
            } else {
                icon.classList.add('rotate-90', 'scale-0', 'opacity-0');
            }
        });
    }

    // Initialize icons on load
    document.addEventListener('DOMContentLoaded', updateToggleIcons);
    // Also handle Livewire or dynamic updates
    window.addEventListener('load', updateToggleIcons);

    function toggleDarkMode() {
        const html = document.documentElement;
        html.classList.toggle('dark');
        
        const isDark = html.classList.contains('dark');
        localStorage.theme = isDark ? 'dark' : 'light';
        
        updateToggleIcons();
        
        // Dispatch custom event for other components
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: { theme: isDark ? 'dark' : 'light' } }));
    }
</script>
